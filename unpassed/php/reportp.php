<?php
require_once("../include.php");
define('FPDF_FONTPATH','../../../../lib/fpdf/font/');
require('../../../../lib/pdftable/lib/pdftable.inc.php');


$header_date='';
//$sql="SELECT CONGROUP, LASTNAME, FIRSTNAME, PATRONYMIC, PREDMET, BALL100 FROM ABI09_NEPROSHLI where ball100 > 0 ORDER BY ID_CON, LASTNAME, FIRSTNAME, PATRONYMIC, PREDMET";

//$sql="select con_id, fio, predmet, ball100, abi_number from abi_neproshol where $sqlz order by con_id, fio, predmet";
$groid = $_REQUEST['groid'];
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );
echo $facid;
echo $groid;
if($groid=='null'){
	$sql = "SELECT distinct cs.ID_CON as GROID
				FROM abi_spec s, abi_con_spec cs, ABI_CONGROUP c
				WHERE s.FACID=$facid
				AND c.GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual)
				and cs.id_spec=s.spcid
				and cs.id_con=c.id_con
				ORDER BY GROID";
	$cur = execq( $sql );
	$sqlll=" con_id in (";
	foreach($cur as $k=>$row){
	if($k!=0)
	$sqlll.=", ";
		$sqlll.=$row['GROID'];
		

	}	
	$sqlll.=")";
}
else
	$sqlll="con_id='$groid'";	

$sql = "select initcap( fio_full ) as fio_full,
			fio,
			min( niz_b ) as niz_b,
			min( niz_c ) as niz_c,
			predmet, ball100 ,abi_number,con_id
		from abi_neproshol
		where $sqlll
		group by fio_full, fio, predmet, ball100, abi_number, con_id
		order by con_id, fio_full, predmet";
//echo $sql;

$html = "<table border='1' align='center'  style='text-align:left; font-family: Verdana; font-size: 14px;>";
$d=date("d.m.Y H:i ");
$n= DecodeStr('Отчёт сформирован');
$hdate="$n $d";
$text = DecodeStr('Списки абитуриентов, не набравшие минимальные баллы');
$html .= "<tr><td colspan='99' align='center' family='TimesNewRomanPSMT' size='14'>$text</td></tr>";
$html .= "<tr><td colspan='99' align='right' family='TimesNewRomanPSMT' size='10'>$hdate<br/></td></tr>";
$text1 = DecodeStr('№');
$text6 = DecodeStr('Номер <br> личного дела');
$text2 = DecodeStr('ФИО');
$text3 = DecodeStr('Предмет');
$text4 = DecodeStr('Балл');
$text5 = DecodeStr('Конкурсная группа');
$text7 = DecodeStr('Бюджет');
$text8 = DecodeStr('Коммерц');

$s1 .= 	"<tr>" .
		"<td align='center' valign='middle'>$text1</td>" .
		"<td align='center' valign='middle'>$text6</td>" .
		"<td align='center' valign='middle'>$text2</td>" .
		"<td align='center' valign='middle'>$text3</td>" .
		"<td align='center' valign='middle'>$text4</td>" . 
		"<td align='center' valign='middle'>$text7</td>" . 
		"<td align='center' valign='middle'>$text8</td>" ;
				
$col = "#ffffff";
$con_id_old=0;
$cur = execq($sql);
$num=1;	
foreach($cur as $k=>$row)
{			
	$num = $num + 1;
	$con_id		= DecodeStr($row['CON_ID']);
	$fio		= DecodeStr($row['FIO']);
	$predmet	= DecodeStr($row['PREDMET']);
	$ball100	= DecodeStr($row['BALL100']);
	$ABI_NUMBER	= DecodeStr($row['ABI_NUMBER']);
	$NIZ_C	= DecodeStr($row['NIZ_C']);
	$NIZ_B	= DecodeStr($row['NIZ_B']);
	
	if( $con_id_old != $con_id ){
		$html.= "<tr><td colspan='99' family='TimesNewRomanPSMT' align='center' size=12>$text5 $con_id</td></tr>";
		$html.=$s1;
		$num=1;
		$con_id_old = $con_id;	
	}	
	
	$html .= "<tr>" .
	"<td align='center' family='TimesNewRomanPSMT'>$num</td>" .
	"<td align='center' family='TimesNewRomanPSMT'>$ABI_NUMBER</td>" .
	"<td align='left'>$fio</td>" .
	"<td align='center'>$predmet</td>" .
	"<td align='center'>$ball100</td>";
	
	if ($NIZ_B>'-1')	{
		$col='#ffffff';
		$html .="<td bgcolor='$col'></td>";
	}
	else{
		$col='#555555';	
		$html .="<td bgcolor='$col'> </td>";
	}
	if ($NIZ_C>'-1')	{
		$col='#ffffff';
		$html .="<td bgcolor='$col'></td>";
	}
	else{
		$col='#555555';	
		$html .="<td bgcolor='$col'> </td>";
	}
	
	$html .="</tr>";
	if($groid!='null'){
	if($num==33) 
	$html.=$s1;
	if($num==70){
	$html.=$s1;
	$num_old=$num;
	}
	if(($num-$num_old)==37 &&$num>70){
		$html.=$s1;
		$num_old=$num;
	}}
	/*if($num%35==0 )
		$html.=$s1;
*/}
$html .="</table>";
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont('TimesNewRomanPSMT','','times.php');  
//$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',10);
//$p->SetFont('TimesNewRomanPS-BoldMT','',10);
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage();
if ($cur==[])
{
            $adf12	= DecodeStr( 'Нет данных для отображения' );
            $pdf_table1 ="<table width='100%' cellpadding='3' border='1' align='center'>
				<tr><td  align ='center' size='14' > $adf12 </tr>
				</table>";
       

        $p->htmltable( $pdf_table1 );
}
else
$p->htmltable( $html );
ob_get_contents();
ob_clean();
flush();
$time = strtotime( date('d.m.Y H.i.s') );
$p->Output("Не прошли $time.pdf",'D');     // сохраняет в Документы
?>