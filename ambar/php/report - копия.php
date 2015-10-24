<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.14
 * Time: 21:00
 */
define('FPDF_FONTPATH','../../../../lib/fpdf/font/');
require('../../../../lib/pdftable/lib/pdftable.inc.php');
require_once("../include.php");

$divid = $_REQUEST['divid'];
$groid = $_REQUEST['groid'];
$subid = $_REQUEST['subid'];
$dateb = $_REQUEST['dateb'];
$datee = $_REQUEST['datee'];
$sor = $_REQUEST['sor'];
$vub = $_REQUEST['vub'];
if($datee!="")
$wher1e=" AND DATE_IN >= TO_DATE('$dateb', 'dd.mm.yyyy') AND DATE_IN <= TO_DATE('$datee', 'dd.mm.yyyy')+1 ";
else
    $wher1e="AND DATE_IN LIKE TO_DATE('$dateb', 'dd.mm.yyyy')";
//выбор бюджет целевой коммерция
if($vub=='1')			$sql3=" AND NABOR IN (1,4,8,10)";
if($vub=='2')			$sql3=" AND NABOR IN (3,4,8,10)";
if($vub=='3')	        $sql3=" AND NABOR IN (1,3,4,8,10)";
//сортировка по
if($sor=='0')			$sql4=" ABI_ID";
if($sor=='1')			$sql4=" LASTNAME";
if($sor=='2')			$sql4=" PRIORITET, LASTNAME ";
if($sor=='3')			$sql4=" ABI_NUMBER";
if($sor=='4')			$sql4=" TO_CHAR(BIRTHDAY,'yyyy.mm.dd')";

$sql="SELECT DISTINCT
				FAC, CONGROUP, ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, SEX, TO_CHAR(BIRTHDAY, 'dd.mm.yyyy'), PASNUMBER,
				HOST, FACID, CON_ID, SPECID, NABOR, MUSOR, PRIORITET, TCENAME, EDUDOCUMENT, DOCUMENT, EDUDOCUMENTNUMBER, DOC,
				SIROTAID, ABITUR, AWARD, TAWNAME, DATE_IN, ABI_ID, SPCBRIFE, NN, PHONE, PHONE2, EDUFINISH, POSTINDEX, ADDRESS,
				STAID, STANAME
				FROM ABIVIEW_AMBAR
				WHERE facid='$divid' AND CON_ID='$groid' AND SPECID='$subid' $wher1e $sql3  AND PRIORITET in (1,4,7) ORDER BY $sql4";
//echo $sql;
$d=date("d.m.Y H:i ");
$html .= //"<center><h2>АНКЕТНЫЕ ДАННЫЕ<br/>$header_date<br/></h2>$hdate<br/><br/></center>".
    "<table border='1' " .
    "style='" .
    "text-align:center; " .
    "font-family: " .
    "Verdana; " .
    "font-size: 10px;>";
//	$html .= "<tr><td colspan='99'><center><h2>АНКЕТНЫЕ ДАННЫЕ<br/>$header_date<br/></h2>$hdate<br/><br/></center></td></tr>";
$n	= DecodeStr( '№' );
$n1	= DecodeStr( '№ <br/>л.д.' );
$n2	= DecodeStr( 'ФИО' );
$n3	= DecodeStr( 'Пол' );
$n4	= DecodeStr( 'Набор/</br>Прио-<br/>ритет' );
$n5	= DecodeStr( 'Общеж.' );
$n6	= DecodeStr( 'Медаль/</br>Льготн.' );
$n7	= DecodeStr( 'Год<br/>оконч<br/>ОУ' );
$n8	= DecodeStr( 'Документ<br/>атт/дипл' );
$n9	= DecodeStr( 'Заявлен<br/>рез-т' );
$n10	= DecodeStr( 'Заявка на<br/>трад.' );
$n11	= DecodeStr( 'Дата рожд.' );
$n12	= DecodeStr( 'Паспорт<br/>(Серия<br/>Номер)' );
$n13	= DecodeStr( 'Адрес' );
$n14	= DecodeStr( 'Телефон 1' );
$n15	= DecodeStr( 'Телефон 2' );
$n16	= DecodeStr( 'Экз. лист<br>выд.' );
$n17	= DecodeStr( 'Док-т получ.' );
$n18	= DecodeStr( 'Прим.' );

$s1 .= 	"<tr>" .
    "<td family='TimesNewRomanPSMT' rowspan='2' align='center' valign='middle' width='7' size='8'><b>$n</td>" .
    "<td align='center' valign='middle' width='15'><b>$n1</td>" .
    "<td align='center' valign='middle' width='80'><b>$n2</td>" .
    "<td align='center' valign='middle' width='9'><b>$n3</td>" .
    "<td align='center' valign='middle' width='12'><b>$n4</td>" .
    "<td align='center' valign='middle' width='12'><b>$n5</td>" .
    "<td align='center' valign='middle' width='14'><b>$n6</td>" .
    "<td align='center' valign='middle' width='11'><b>$n7</td>" .
    "<td align='center' valign='middle' width='16'><b>$n8</td>" .
    "<td align='center' valign='middle'><b>$n9</td>" .
//			"<td align='center' valign='middle'><b>Заявка на<br/>ЕГЭ/<br/>трад.</td>" .
    "<td align='center' valign='middle'><b>$n10</td>" .
    "<td colspan='2' align='center' valign='middle'><b>$n11</td>" .
    "<td align='center' valign='middle'><b>$n12</td></tr>" .
    "<tr><td colspan='8' align='center' valign='middle'><b>$n13</td>" .
    "<td align='center' valign='middle' width='19'><b>$n14</td>" .
    "<td align='center' valign='middle' width='18'><b>$n15</td>" .
    "<td align='center' valign='middle' width='10'><b>$n16</td>" .
    "<td align='center' valign='middle' width='10'><b>$n17</td>" .
    "<td align='center' valign='middle'><b>$n18</td></tr>";

$col = "#ffffff";

$cur=execq($sql);
$CON_ID_OLD="netu";
$SPECID_OLD="netu";


foreach($cur as $k=>$row){
//		$pdf=pdf_begin_page;
//		pdf_begin_page (int pdf object, float width, float height)
    $num=++$num;

    $FAC = DecodeStr($row['FAC']);
    $CONGROUP = DecodeStr($row['CONGROUP']);
    $ABI_NUMBER = DecodeStr($row['ABI_NUMBER']);
    $LASTNAME = DecodeStr($row['LASTNAME']);
    $FIRSTNAME = DecodeStr($row['FIRSTNAME']);
    $PATRONYMIC = DecodeStr($row['PATRONYMIC']);
    $SEX = DecodeStr($row['SEX']);
    $BIRTHDAY = DecodeStr($row['BIRTHDAY']);
    $PASNUMBER = DecodeStr($row['PASNUMBER']);
    $HOST = DecodeStr($row['HOST']);
    $FACID = DecodeStr($row['FACID']);
    $CON_ID= DecodeStr($row['CON_ID']);
    $SPECID = DecodeStr($row['SPECID']);
    $NABOR = DecodeStr($row['NABOR']);
    $MUSOR = DecodeStr($row['MUSOR']);
    $PRIORITET = DecodeStr($row['PRIORITET']);
    $TCENAME = DecodeStr($row['TCENAME']);
    $EDUDOCUMENT = DecodeStr($row['EDUDOCUMENT']);
    $DOCUMENT = DecodeStr($row['DOCUMENT']);
    $EDUDOCUMENTNUMBER = DecodeStr($row['EDUDOCUMENTNUMBER']);
    $DOC = DecodeStr($row['DOC']);
    $SIROTAID = DecodeStr($row['SIROTAID']);
    $ABITUR = DecodeStr($row['ABITUR']);
    $AWARD = DecodeStr($row['AWARD']);
    $TAWNAME= DecodeStr($row['TAWNAME']);
    $DATE_IN= DecodeStr($row['DATE_IN']);
    $ABI_ID=DecodeStr($row['ABI_ID']);
    $SPCBRIFE = DecodeStr($row['SPCBRIFE']);
    $NN = DecodeStr($row['NN']);
    $PHONE = DecodeStr($row['PHONE']);
    $PHONE2 = DecodeStr($row['PHONE2']);
    $EDUFINISH = DecodeStr($row['EDUFINISH']);
    $POSTINDEX = DecodeStr($row['POSTINDEX']);
    $ADDRESS = DecodeStr($row['ADDRESS']);
    $STAID = DecodeStr($row['STAID']);
    $STANAME = DecodeStr($row['STANAME']);
    //}
}
//$pdf_table .= "</table>";
$html.=$s1;
$p = new PDFTable();
$p->AliasNbPages();
echo $sql;
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 10 );
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage();
$adf1	= DecodeStr( 'Работа ведется ритмично, календарный план создан, рейтинг актуален!' );
$pdf_table1 ="<table widtd='100%' cellpadding='3' border='1' align='center'>
				<tr><td  align ='center' height=15 >$adf1</tr>";
$p->htmltable( $html );
$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
//$exit = EncodeStr( "$grocode" );  // кодирует название, чтобы читался русский язык при сохранении
ob_get_contents();
ob_clean();
flush();
$p->Output("Амбарная книга $time.pdf",'D');     // сохраняет в Документы
    ?>