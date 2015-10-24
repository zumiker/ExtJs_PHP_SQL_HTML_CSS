<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.06.14
 * Time: 12:58
 */
require_once("../include.php");
define('FPDF_FONTPATH','../../../lib/fpdf/font/');
require('../../../lib/pdftable/lib/pdftable.inc.php');
$groid = $_REQUEST['groid'];
$vblid = $_REQUEST['vblid'];
$couname = DecodeStr( $_REQUEST['couname']);

/*
$sql = "SELECT initcap(FIO_FULL) as FIO,v.MANID, v.STUDENT_ID
    from V_SPI_STUDENT v,MAN m
    WHERE v.GROID='$groid'
    AND m.MANID=v.MANID
    ORDER BY FIO";
*/
$sql = "select distinct initcap( s.fio_full ) as FIO, s.MANID, s.STUDENT_ID, decode( p.FLAG, null, 0, 1 ) as FLAG, s.tstid
		from v_spi_student s
		inner join marker m
			on s.student_id = m.student_id
				and m.vblid = '$vblid'
		left join predmet_vibor_student p
			on s.student_id = p.student_id
				and m.vblid = p.vblid
		where s.groid = '$groid'
		order by tstid, fio";
//echo $sql;
$cur = execq( $sql );

	$text = DecodeStr('Отчёт сформирован');
	$text1 = DecodeStr('Предмет по выбору');
	$text2 = DecodeStr('Список студентов, выбравших предмет: <br>"');
	$text3 = DecodeStr('"');
	$text4 = DecodeStr('ФИО');
	$text5 = DecodeStr('№');

	$html	= "<table border='1' align='center' style='text-align:center; font-family: Verdana; font-size: 7px;'>";
	$d		= date( "d.m.Y" );
	
	$hdate	= "$text $d";
	$html	.= "<tr >
					<td  border = '0' colspan='99' align='center' family='TimesNewRomanPSMT' size='14'>
						$text1							
					</td>
				</tr>
				<tr >
					<td border='0' colspan='99' align='center' family='TimesNewRomanPSMT' size='14'>
						$text2 $couname $text3 <br><br> $hdate<br>
					</td>
				</tr>";
	$s1		=  "<tr>
					<td align='center' width='10'><b>$text5</td>
					<td align='center' width='180'><b>$text4</td>
				</tr>";
				$num=0;
				
	foreach($cur as $k=>$row){
	if( $row['FLAG'] === '0' )
	{
	if($num==0)
		$html.=$s1;
	$FIO = DecodeStr($row['FIO']);
		$num++;
		$html .= "<tr>
						<td align='center'>$num</td>
						<td align='left' >$FIO</td>
						</tr>";
       
	}
	}
	
$html	.= "</table>";	

//echo $html;		
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 12 );
$p->SetMargins( 10, 10, 10, 10 );

$p->AddPage();
if($num==0){
$text14	= DecodeStr('Данный предмет никто не выбрал');
	$html	.= "
	<tr>
					<td border= '0' colspan='99' align='center' family='TimesNewRomanPSMT' size='20'>
						$text14						
					</td>
				</tr>
	";
	
}

$p->htmltable( $html );
$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
//$exit = EncodeStr( "$grocode" );  // кодирует название, чтобы читался русский язык при сохранении
ob_get_contents();
ob_clean();
flush();
$p->Output("Предмет по выбору $time.pdf",'D');     // сохраняет в Документы

?>