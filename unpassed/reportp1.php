<?php
require_once("../include.php");
define('FPDF_FONTPATH','../../../../lib/fpdf/font/');
require('../../../../lib/pdftable/lib/pdftable.inc.php');

$nap_id = $_REQUEST['napid'];
if($nap_id=='0'){
    $sqlz="niz_b = '-1'";
}
else{
    $sqlz="niz_c = '-1'";
}
$header_date='';
//$sql="SELECT CONGROUP, LASTNAME, FIRSTNAME, PATRONYMIC, PREDMET, BALL100 FROM ABI09_NEPROSHLI where ball100 > 0 ORDER BY ID_CON, LASTNAME, FIRSTNAME, PATRONYMIC, PREDMET";

$sql="select con_id, fio, predmet, ball100 from abi_neproshol where $sqlz order by con_id, fio, predmet";

$html = "<table border='1' align='center'  style='text-align:left; font-family: Verdana; font-size: 14px;>";
$d=date("d.m.Y H:i ");
$n= DecodeStr( 'Отчёт сформирован' );
$hdate="$n $d";
$text = "Списки абитуриентов, не набравшие минимальные баллы";
$html .= "<tr><td colspan='99' align='center' family='TimesNewRomanPS-BoldMT' size='14'>$text</td></tr>";
$html .= "<tr><td colspan='99' align='right' family='TimesNewRomanPS-BoldMT' size='8'>$hdate<br/></td></tr>";
$text1 = "№";
$text2 = "ФИО";
$text3 = "Предмет";
$text4 = "Балл";
$text5 = "Конкурсная группа";

$s1 .= 	"<tr>" .
		"<td align='center'>$text1</td>" .
		"<td align='center'>$text2</td>" .
		"<td align='center'>$text3</td>" .
		"<td align='center'>$text4</td>";
				
$col = "#ffffff";
$con_id_old=0;
$cur = execq($sql);
$num=1;	
foreach($cur as $k=>$row)
{			
	$num = $num + 1;
	$con_id		= DecodeStr($row['CON_ID']);;
	$fio		= DecodeStr($row['FIO']);;
	$predmet	= DecodeStr($row['PREDMET']);;
	$ball100	= DecodeStr($row['BALL100']);;
	if( $con_id_old != $con_id ){
		$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' align='left'>$text5 $con_id</td></tr>";
		$html.=$s1;
		$num=1;
		$con_id_old = $con_id;	
	}	
	if ($col=='#ffffff')	$col='#dddddd';
	else					$col='#ffffff';
	$html .= "<tr bgcolor='$col'>" .
	"<td align='center' family='TimesNewRomanPSMT'>$num</td>" .
	"<td align='left'>$fio</td>" .
	"<td align='center'>$predmet</td>" .
	"<td align='center'>$ball100</td>";
	$html .="</tr>";		
}
$html .="</table>";
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont('TimesNewRomanPSMT','','times.php');  
$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',10);
$p->SetFont('TimesNewRomanPS-BoldMT','',10);
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage();
$p->htmltable( $html );
ob_get_contents();
ob_clean();
flush();
$p->Output("Порог ЕГЭ $time.pdf",'D');     // сохраняет в Документы
?>