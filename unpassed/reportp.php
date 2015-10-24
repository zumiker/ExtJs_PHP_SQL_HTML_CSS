<?php
function ora_getcolumnnbsp($cur,$pos)
{
	if (ora_getcolumn($cur,$pos)==' ')	return "&nbsp"; 
	else								return ora_getcolumn($cur,$pos);
}
$header_date='';
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
//$sql="SELECT CONGROUP, LASTNAME, FIRSTNAME, PATRONYMIC, PREDMET, BALL100 FROM ABI09_NEPROSHLI where ball100 > 0 ORDER BY ID_CON, LASTNAME, FIRSTNAME, PATRONYMIC, PREDMET";
$sql="select con_id, fio, predmet, ball100 from abi_neproshol where niz_b = '-1' order by con_id, fio, predmet";

$html .= "<table border='1' style='text-align:center; font-family: Verdana; font-size: 10px;'>";
 			
$d=date("d.m.Y H:i ");
$hdate="Отчёт сформирован $d";
$html .= "<tr><td colspan='99' align='center' family='TimesNewRomanPS-BoldMT' size='14'><h2>Списки абитуриентов, не набравшие минимальные баллы</td></tr>";
$html .= "<tr><td colspan='99' align='right' family='TimesNewRomanPS-BoldMT' size='8'>$hdate<br/></td></tr>";

$s1 .= 	"<tr>" .
		"<td align='center'>№</td>" .
		"<td align='center'>ФИО</td>" .
		"<td align='center'>Предмет</td>" .
		"<td align='center'>Балл</td>";
				
$col = "#ffffff";
$con_id_old=0;
$cur=ora_do($conn,$sql);
$num=1;	
for ($i=0;$i<ora_numrows($cur);$i++)
{			
	$num = $num + 1;
	$con_id		= ora_getcolumnnbsp($cur,0);
	$fio		= ora_getcolumnnbsp($cur,1);
	$predmet	= ora_getcolumnnbsp($cur,2);
	$ball100	= ora_getcolumnnbsp($cur,3);
	if( $con_id_old != $con_id ){
		$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' align='left'>Конкурсная группа $con_id</td></tr>";
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
	ora_fetch($cur);		
}
define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');
	
$p = new PDFTable();
$p->AddPage('P');
$p->SetMargins(10,10,10);
$p->AddFont('TimesNewRomanPSMT','','times.php');  
$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',8); 
$p->htmltable($html);
$p->output('','I');	
?>