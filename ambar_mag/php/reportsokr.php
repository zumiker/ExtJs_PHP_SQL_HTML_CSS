<?php
	
define('FPDF_FONTPATH','../../../../lib/fpdf/font/');
require('../../../../lib/pdftable/lib/pdftable.inc.php');
require_once("../include.php");

set_time_limit(0);

$divid = $_REQUEST['divid'];
$subid = $_REQUEST['subid'];
$dateb = $_REQUEST['dateb'];
$datee = $_REQUEST['datee'];
$vub = $_REQUEST['vub'];
$header_date="";

$n56	= DecodeStr( 'с' );
$n65	= DecodeStr( 'по' );
if( $datee == "" and $dateb == "" )
{
	$wher1e="";
	$header_date=DecodeStr('за весь период.');
}
else if( $datee != "" )
{
	$wher1e=" AND DATE_IN >= TO_DATE('$dateb', 'dd.mm.yyyy') AND DATE_IN <= TO_DATE('$datee', 'dd.mm.yyyy')+1 ";
	$header_date="$n56 $dateb $n65 $datee.";
}
else
{
	$header_date="$dateb.";
    $wher1e="AND DATE_IN LIKE TO_DATE('$dateb', 'dd.mm.yyyy')";
}
//выбор бюджет целевой коммерция
if($vub=='1')			$sql3=" AND NABOR IN (1,4,8,10) ";
if($vub=='2')           $sql3=" AND NABOR = '$vub' ";
if($vub=='3')			$sql3=" AND NABOR IN (3,4,8,10) ";
if($vub=='')	        $sql3=" AND NABOR IN (1,2,3,4,8,10) ";
//сортировка по
/*if($sor=='0')			$sql4=" ABI_ID ";
if($sor=='1')			$sql4=" LASTNAME ";
if($sor=='2')			$sql4=" PRIORITET, LASTNAME ";
if($sor=='3')			$sql4=" ABI_NUMBER ";
if($sor=='4')			$sql4=" TO_CHAR(BIRTHDAY,'yyyy.mm.dd') ";
*/

$fac= $_REQUEST['div'];
$fac = DecodeStr($fac);
	$sql1=" FACID='$divid' ";


$sql="SELECT DISTINCT FAC, CONGROUP, ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, " .
"SEX, TO_CHAR(BIRTHDAY, 'dd.mm.yyyy'), PASNUMBER, decode(HOST,'Д','+','Н','') as HOST, FACID, CON_ID, " .
"SPECID, NABOR, MUSOR, PRIORITET, " .
"AWARD, decode(TAWNAME,'Д','+') as TAWNAME, DATE_IN, ABI_ID, SPCBRIFE, STUFROM, POSTINDEX, ADDRESS, PHONE, PHONE2, EDUFINISH, AVGBALL, BALL100 " .
"FROM ABIVIEW_MAGISTR2010 WHERE $sql1 $wher1e	$sql3  ORDER BY SPCBRIFE, LASTNAME";
echo $sql;
$cur=execq($sql);

		
	$d=date("d.m.Y H:i ");
$html .= 
    "<table border='1' " .
    "style='" .
    "text-align:center; " .
    "font-family: " .
    "Verdana; " .
    "font-size: 10px;>";

$n	= DecodeStr( '№' );
$n1	= DecodeStr( 'Вступ.<br/>балл' );
$n2	= DecodeStr( 'ФИО' );
$n3	= DecodeStr( 'Пол' );
$n4	= DecodeStr( 'Набор' );
$n5	= DecodeStr( 'Общ.' );
$n6	= DecodeStr( 'Дипл.<br>с отл' );
$n7	= DecodeStr( 'Год<br/>оконч' );
$n8	= DecodeStr( 'Откуда' );
$n9	= DecodeStr( 'Телефон 1' );
$n10	= DecodeStr( 'Ср.<br/>балл' );
$n11	= DecodeStr( 'Дата рожд.' );
$n12	= DecodeStr( 'Паспорт<br/>(Серия<br/>Номер)' );
$n13	= DecodeStr( 'Адрес' );
$n14	= DecodeStr( 'Телефон 1' );
$n15	= DecodeStr( 'Телефон 2' );
$n16	= DecodeStr( 'Экз. лист<br>выд.' );
$n17	= DecodeStr( 'Док-т получ.' );
$n18	= DecodeStr( 'Прим.' );
	$s1 .= 	"<tr>" .
			"<td align='center' valign='middle' width='7' size='6'><b>$n</td> " .
			"<td align='center' valign='middle' width='60'><b>$n2</td> " .
			"<td align='center' valign='middle' width='10'><b>$n1</td> " .
			"<td align='center' valign='middle' width='10'><b>$n4</td> " .
			"<td align='center' valign='middle' width='8'><b>$n5</td> " .
			"<td align='center' valign='middle' width='9'><b>$n6</td> " .
			"<td align='center' valign='middle' width='8'><b>$n10</td> " .
			"<td align='center' valign='middle' width='10'><b>$n7</td> " .
			"<td align='center' valign='middle' width='50'><b>$n8</td> " .
			"</tr> " ;

	$col = "#ffffff";
	$CON_ID_OLD="netu";
	$SPCBRIFE_OLD="netu";
	
foreach($cur as $k=>$row)
	{
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
		$AWARD = DecodeStr($row['AWARD']);
		$TAWNAME= DecodeStr($row['TAWNAME']);
		$DATE_IN= DecodeStr($row['DATE_IN']);
		$ABI_ID= DecodeStr($row['ABI_ID']);
		$SPCBRIFE = DecodeStr($row['SPCBRIFE']);
		$STUFROM = DecodeStr($row['STUFROM']);
		$POSTINDEX = DecodeStr($row['POSTINDEX']);
		$ADDRESS = DecodeStr($row['ADDRESS']);
		$PHONE = DecodeStr($row['PHONE']);
		$PHONE2 = DecodeStr($row['PHONE2']);
		$EDUFINISH = DecodeStr($row['EDUFINISH']);
		$AVGBALL =DecodeStr($row['AVGBALL']);
		$BALL100 = DecodeStr($row['BALL100']);
			$soso=DecodeStr('Список абитуриентов, подавших заявление');
		$soso1=DecodeStr('Факультет:');
		$soso11=DecodeStr('Направление:');
		if( $SPCBRIFE_OLD != $SPCBRIFE )
		{

			$html .= "<tr><td colspan='99' size='8'>$soso $header_date" .
						"<br/>$soso1 $FAC" .
"                                                                                                                                              $d" .
						"<br/>$CONGROUP" .
						"                                                    " .
						"$soso11 $SPCBRIFE</b></td></tr>";

			$html .= $s1;
			$konec = 0;
			$num = 1;
			$SPCBRIFE_OLD = $SPCBRIFE;	
		}	

		if ($col=='#ffffff')
		{
			$col='#dddddd';
		}
		else
		{
			$col='#ffffff';
		}
		$k=$i;
		$k=$k+1;
		$html .=	"<tr bgcolor='$col'> " .
				
					"<td align='center' valign='middle' size='10'>$num</td>" .
					"<td align='left' valign='middle' size='8'>$LASTNAME $FIRSTNAME $PATRONYMIC</td> " .
					"<td align='center' valign='middle' size='6'>$BALL100</td> " .
					"<td align='center' valign='middle' size='6'>$MUSOR</td> " .
					"<td align='center' valign='middle' size='8'>$HOST</td> " .
					"<td align='center' valign='middle' size='8'>$TAWNAME</td> " .
					"<td align='center' valign='middle' size='8'>$AVGBALL</td> " .
					"<td align='center' valign='middle' size='8'>$EDUFINISH</td> " .
					"<td align='center' valign='middle' size='8'>$STUFROM</td> " ;

	}

$html	.= "</table>";			
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 10 );
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage();
if ($cur==[])
{
    if ($datee!="")
        if($dateb!=""){
            $adf1	= DecodeStr( 'В данный период с' );
            $adf111	= DecodeStr( 'по' );
            $adf12	= DecodeStr( 'не было подано оригиналов документов' );
            $pdf_table1 ="<table widtd='100%' cellpadding='3' border='1' align='center'>
				<tr><td  align ='center' height=15 >$adf1 $dateb $adf111 $datee $adf12 </tr>";
        }
       else{$adf1	= DecodeStr( 'В данный день' );
    $adf12	= DecodeStr( 'не было подано оригиналов документов' );
    $pdf_table1 ="<table widtd='100%' cellpadding='3' border='1' align='center'>
				<tr><td  align ='center' height=15 >$adf1 $datee $adf12 </tr>";}
    else
        if($dateb!=""){
            $adf1	= DecodeStr( 'В данный день' );
            $adf12	= DecodeStr( 'не было подано оригиналов документов' );
            $pdf_table1 ="<table widtd='100%' cellpadding='3' border='1' align='center'>
				<tr><td  align ='center' height=15 >$adf1 $dateb $adf12 </tr>";
        }

        $p->htmltable( $pdf_table1 );
}
else
$p->htmltable( $html );
$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
//$exit = EncodeStr( "$grocode" );  // кодирует название, чтобы читался русский язык при сохранении
ob_get_contents();
ob_clean();
flush();
//$p->Output("Подлинник $time.pdf",'D');     // сохраняет в Документы
$p->Output("Амбарная книга магистров $time.pdf",'D');     // сохраняет в Документы

?>