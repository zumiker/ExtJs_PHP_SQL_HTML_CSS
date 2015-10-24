<?php
//файл с кодировкой ANSI
session_start();
require("./../../../../../lib.php");

header( "Pragma: no-cache" );
header( 'Content-type: application/pdf' );
define('FPDF_FONTPATH','./../../../../../fpdf/font/');
include( "./../../../../../fpdf/lib/pdftable.inc.php" );

$student_id = $_REQUEST['student_id'];

$pdf = new PDFTable();
$pdf->AddFont('TimesNewRomanPSMT','','times.php');
$pdf->AddFont('TimesNewRomanPS-BoldMT','','times_b.php');
$pdf->AddFont('ArialMT','','arial.php');
$pdf->AddFont('Arial-BoldMT','','arial_bold.php');
$pdf->AddFont('ComicSansMS','','comic.php');
//$pdf->SetMargins( 25, 12, 10 );	
$pdf->SetMargins( 10, 3, 10 );	

$sql = "select initcap( fio_full ) as fio_full, groid, difid, 
			decode( quaid, 3, ( grocode || ' (' || difcode || ')' ), grocode ) as grocode 
		from v_spi_student_0 
		where student_id = '".$student_id."'";
$cur = execq( $sql );
$fio_full	= DecodeStr( $cur[0]['FIO_FULL'] );
$groid		= $cur[0]['GROID'];
$difid		= $cur[0]['DIFID'];
$grocode	= DecodeStr( $cur[0]['GROCODE'] );

$sql = "select count ( distinct couname || decode(treid,4,' (КП)',5,' (КР)','') ) as count
            from v_nagruzka_fact_kaf n, course c 
            where groid = '$groid' 
				and ( n.difid = '$difid' or n.difid = 0 )
                and c.couid = n.couid";
$sql = EncodeStr($sql);
//logstring( $sql );
$cur = execq( $sql );
$count = $cur[0]['COUNT'];
if ( $count > 16 ) {
	$pdf->AddPage('L');
	$width1 = 250;
	$width = 240;
}
else {
	$pdf->AddPage();
	$width1 = 195;
	$width = 185;
}
$width2 = 10;//колонки для пропусков

$pdf->SetFont('TimesNewRomanPS-BoldMT','',14);
$cnt = 0;
$date = date('d.m.Y');

$html = "<table border='1' align='center'>
			<tr valign='middle'>
				<td align='center' valign='middle' width = $width1 border='0'>
					<font size = 12>Календарный план для выполнения/защиты работ</font>
				</td>
			</tr>
			<tr valign='middle'>
				<td align='center' valign='middle' width = $width1 border='0'>
					<font size = 12> студент $fio_full</font>
				</td>
			</tr>
			<tr valign='middle'>
				<td align='center' valign='middle' width = $width1 border='0'>
					<font size = 12> группа $grocode</font>
				</td>
			</tr>
		</table>
		<table border='1' align='center'>"; 
			 			
$sql2 = "select fio_full, tstid, ";			
	$sql3 = "select distinct ( couname || decode(treid,4,' (КП)',5,' (КР)','') ) as predmet, 
				n.couid || decode(treid,4,' (КП)',5,' (КР)','') as couid 
			from v_nagruzka_fact_kaf n, course c 
			where n.groid = '$groid' 
				and ( n.difid = '$difid' or n.difid = 0 )
				and c.couid = n.couid 
            group by couname, treid, n.couid 
			order by predmet";
//$sql23 = $sql3;
	$sql3 = EncodeStr($sql3);
//	logstring( $sql3 );
	$cur3 = execq( $sql3 );
	$hAbbrev="<table border='1' align='center'>
				<tr valign='middle'>
					<td align='center' valign='middle' border='1' width ='5'>
						<font size = 8>№</font>
					</td>
					<td align='center'' valign='middle' border='1' width =$width>
						<font size = 8>ПРЕДМЕТ</font>
					</td>
				</tr>";
	foreach( $cur3 as $i=>$data )
	{	
		$cnt++;
//		$cnt1 = 'N'.$cnt;
		if($i!=0)$sql2 .=",";
		$buffCi[$i]		= DecodeStr($data['COUID']);
		$max_ball[$i]	= $data['MAX_BALL'];
//		$sql2 .=" SUM(CASE to_char(couid) WHEN '$buffCi' THEN nvl (ball, 0) END) as \"$cnt1\"";
		$sql2 .=" SUM(CASE to_char(couid) WHEN '$buffCi[$i]' THEN nvl (ball, 0) END) as \"$buffCi[$i]\"";
/*		$sqlpred = "select couname from course where couid =$buffCi";
		$sqlpred = EncodeStr($sqlpred);
		$curPred = execq( $sqlpred );
		$bufPred =  DecodeStr($curPred[0]['COUNAME']);*/
		$bufPred = DecodeStr($data['PREDMET']);
		$hAbbrev .= "<tr valign='middle'>
						<td align='center' valign='middle' border='1' width ='5'>
							<font size = 8>$cnt</font>
						</td>
						<td align='left' valign='middle' border='1' width =$width>
							<font size = 8>$bufPred</font>
						</td>
					</tr>";
	}
	$hAbbrev .= "</table>";

//дополнительный колонки с пропусками занятий
$sql7="select weeid 
		from weekofcontrol 
		where currentgod = get_educ_god 
			and semestr like get_semestr_real || '%' 
			and weestart < to_date('$date','dd.mm.yyyy') 
		order by weenomer desc";
//logstring( $sql7 );
$cur7	= execq( $sql7 );
$weeid	= $cur7[0]['WEEID'];
//дополнительный колонки с пропусками занятий

$sql2 .=", propusk_all, propusk_uv
		from(select fio_full, tstid, s.groid, couname||k as predmet, d.couid||k as couid, ball, propusk_all, propusk_uv 
			from v_spi_student s,course d,
				(SELECT V.VBLID,COUID,B.student_id,BALL,decode(treid_I,4,' (КП)',5,' (КР)','') K, groid, 
					decode(propusk_all,0,'',propusk_all) propusk_all, 
					decode(propusk_uv,0,'',propusk_uv) propusk_uv 
				FROM  vblank V, 
					(select student_id, sb.vblid,sum(nvl(ball,0)) BALL
					from v_student_balls sb
					group by student_id, sb.vblid) B, contpropusk j 
				WHERE B.VBLID(+) = V.VBLID
					AND YEAR_GROCODE = Get_Educ_God_Ses 
					AND SPRING_AUTUMN = Get_Semestr_Real
					and B.student_id = j.student_id(+) 
					and j.weeid(+) = '$weeid' ) v
			where s.student_id = v.student_id(+) 
				and s.groid = '$groid'
				and ( s.difid = '$difid' or nvl(s.difid,0) = 0 )
				and d.couid(+) = v.couid
				and v.groid(+) = s.groid
			order by predmet)
		group by tstid, fio_full, propusk_all, propusk_uv 
		order by tstid, fio_full";
//$sql22 = $sql2;
$sql2 = EncodeStr($sql2);
//logstring( $sql2 );
$cur2 = execq( $sql2 );

//$html3 = "<table><tr><td>$sql22</td></tr><tr><td>$sql23</td></tr></table>";
$html .= 		"<tr valign='middle'>
					<td  align='center' valign='middle' rowspan = 2 width ='5' border='1'>
						<font size = 10>№</font>
					</td>
					<td  align='center' valign='middle' rowspan = 2 width ='50' border='1'>
						<font size = 10>ФИО</font>
					</td>
					<td  align='center' valign='middle' width ='20' border='1'>
						<font size = 10>Предмет</font>
					</td>";
	for( $i = 1; $i <= $cnt; $i++ ) 
	{
		$html .=	"<td align='center' valign='middle' width ='6' border='1'>
							<font size = 10>$i</font>
						</td>";
	}
$html .=			"<td align='center' valign='middle' colspan = 2 width ='2*$width2' border='1'>
						<font size = 8>Пропуски</font>
					</td>
				</tr>
				<tr>
					<td align='center' valign='middle' width ='$width2' border='1'>
						<font size = 8>Максимальный</br>балл</font>
					</td>";
	for( $i = 0; $i < $cnt; $i++ ) 
	{
		$html .=	"<td align='center' valign='middle' width ='6' border='1'>
						<font size = 10>$max_ball[$i]</font>
					</td>";
	}
$html .=			"<td align='center' valign='middle' width ='$width2' border='1'>
						<font size = 8>Всего</font>
					</td>
					<td align='center' valign='middle' width ='$width2' border='1'>
						<font size = 8>в т.ч.</br>ув.</font>
					</td>
				</tr>";

foreach( $cur2 as $k=>$data )
{
	$bufFIO		=  DecodeStr( $data['FIO_FULL'] );
	$propusk_all=  $data['PROPUSK_ALL'];
	$propusk_uv	=  $data['PROPUSK_UV'];
	$num = $k+1;
	$html .="<tr valign='middle'>
					<td align='center' valign='middle' width ='5'><font size = 8>$num</font></td>
					<td align='left' valign='middle' colspan = 2><font size = 8>$bufFIO</font></td>";
//	for ($j=1; $j<=$cnt; $j++)
	for ($j=0; $j<$cnt; $j++)
	{
//		$bufBall = $list[$k][$j]  = DecodeStr( $data["N$j"] );
		$bufBall = $list[$k][$j]  = DecodeStr( $data["$buffCi[$j]"] );
		$average = 8;
// увеличение шрифта при суммарном балле меньше, чем треть от возможного максимально балла
		if ( $bufBall <= $max_ball[$j] / 3 )
			$html .= "<td align='center' valign='middle' width ='6' bgcolor = #E6E6FA><font size = 10>$bufBall</font></td>";
		else
			$html .= "<td align='center' valign='middle' width ='6'><font size = 8>$bufBall</font></td>";
	}			
	$html .=		"<td align='center' valign='middle' width ='$width2'><font size = 8>$propusk_all</font></td>
					<td align='center' valign='middle' width ='$width2'><font size = 8>$propusk_uv</font></td>
				</tr>";
}
$html .=	"</table>";
//logstring( 'begin' );
$pdf->htmltable($html); 
//logstring( 'end' );
//$pdf->Ln(5);
//$pdf->htmltable($html3); 
$pdf->Ln(5);
$pdf->htmltable($hAbbrev); 
$pdf->SetFont('TimesNewRomanPSMT','',12);
$pdf->Output("dreport$groid$difid.pdf",'D');
?>