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
$header_date="";

$n56	= DecodeStr( 'с' );
$n65	= DecodeStr( 'по' );
if($datee!=""){
	$wher1e=" AND DATE_IN >= TO_DATE('$dateb', 'dd.mm.yyyy') AND DATE_IN <= TO_DATE('$datee', 'dd.mm.yyyy')+1 ";
$header_date="$n56 $dateb $n65 $datee.";
	}
else{
$header_date="$dateb.";
    $wher1e="AND DATE_IN LIKE TO_DATE('$dateb', 'dd.mm.yyyy')";
	}
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

$d=date("d.m.Y H:i ");
$html .= 
    "<table border='1' " .
    "style='" .
    "text-align:center; " .
    "font-family: " .
    "Verdana; " .
    "font-size: 10px;>";

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


$i=-1;
foreach($cur as $k=>$row){

    $i++;
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


		if( $SPECID_OLD != $SPECID )
		{
			$konec = 0;
			$num = 1;
			$SPECID_OLD = $SPECID;	
		}	

if( ( !(($i)%5) ) )
		{

			$yy=DecodeStr("Список абитуриентов, подавших заявление");
			$yy1=DecodeStr("Факультет:");
			$yy2=DecodeStr("Специальность:");
			
			$html .= "<tr><td colspan='99' size='8'>$yy $header_date" .
						"<br/>$yy1 $FAC" .
//"                                                                                                                                              $d" .
						"<br/>$CONGROUP" .
						"<br/>$yy2 $SPCBRIFE</b></td></tr>"; 	

			$html.=$s1;
			$SPECID_OLD=$SPECID;	
			$col = "#ffffff";
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
		$html .= "<tr bgcolor='$col'>" .
					"<td rowspan='2' align='center' valign='middle' size='10'>$k</td>" .
					
					"<td align='center' valign='middle' height='12'>$ABI_NUMBER</td>" .
					"<td align='left' valign='middle' size='8'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>" .
					"<td align='center' valign='middle' size='8'>$SEX</td>" .
					"<td align='center' valign='middle' size='8'>$MUSOR/$PRIORITET</td>" .
					"<td align='center' valign='middle' size='8'>$HOST</td>";
					
	if ( !$TAWNAME && !$ABITUR )
			$html .= "<td align='center'></td>";
		else
			$html .= "<td align='center' valign='middle' size='8'>$TAWNAME/<br/>$ABITUR</td>";
		$html .= "<td align='center' valign='middle' size='8'>$EDUFINISH</td>" .
					"<td align='center' valign='middle' size='8'>$DOCUMENT/$DOC</td>";
		$sqlpr="SELECT DISTINCT a.ID_PR, a.PREDMET, BALL100, r.ID_PR as ID_PR1 FROM ABI_MINI_EXAM a, ABIVIEW_RASPISANIE r WHERE ABI_ID='$ABI_ID' AND CON_ID='$CON_ID' AND a.ID_PR=r.ID_PR ORDER BY a.ID_PR";
		
		$cur2 = execq($sqlpr);
		$tmp=DecodeStr("");
		foreach($cur2 as $k=>$row){
			$ID_PR = DecodeStr($row['ID_PR']);
			$PREDMET = DecodeStr($row['PREDMET']);
			
			
			$BALL100 = DecodeStr($row['BALL100']);
			$ID_PR= DecodeStr($row['ID_PR1']);	
			$tmp .="$PREDMET($BALL100) ";
		}
		
$html .= "<td align='center'>$tmp</td>";
		$sqlpr2="SELECT predmet FROM ABI_NA_TRAD tr, abi_predmet pr WHERE ABI_ID='$ABI_ID' AND  tr.id_predmet = pr.id_pr ORDER BY pr.ID_PR";
	
		$cur4 = execq($sqlpr2);
		$tmp2=DecodeStr("");
		foreach($cur4 as $k=>$row)
		{
			$PP1 = SUBSTR (DecodeStr($row['predmet']), 0, 1);
			$tmp2 .='$PP1';
		}

		$html .= "<td align='center'>$tmp2</td>";
		$html .= "<td colspan='2' align='center' valign='middle'>$BIRTHDAY </td>" .
					"<td align='center' valign='middle' size='8'>$PASNUMBER</td>" .
					"<tr bgcolor='$col'><td colspan='8' align='center' valign='middle' height='12'>$POSTINDEX $ADDRESS</td>" .
					"<td align='center' valign='middle' size='8'>$PHONE</td>" .
					"<td align='center' valign='middle' size='8'>$PHONE2</td>" .
					"<td align='center' valign='middle' size='8'></td>" .
					"<td align='center' valign='middle' size='8'></td>";
		if ( $STAID != 148 )
			$html .= "<td align='center' valign='middle'></td>$STANAME</tr>";
		else		
	$html .= "<td align='center' valign='middle'></td></tr>";
		
	}
	if ( $header_date )
	{
		$html .= "<tr><td colspan='99' size='8'>$header_date";
	}
	else
	{
		$html .= "<tr><td colspan='99' size='8'>На $d";
	}
	
	$sqlpodval="SELECT * FROM ABI_MINI_PODVAL WHERE facid='$divid' AND CON_ID='$groid' AND SPECID='$subid'";//CON_ID = '$id_con' AND SPECID = '$id_spec'";
	$cur11 = execq($sqlpodval);
	foreach($cur11 as $k=>$row){
	$VSEGO = DecodeStr($row['VSEGO']);	
	$P1 = DecodeStr($row['P1']);	
	$P2 = DecodeStr($row['P2']);	
	$P3 = DecodeStr($row['P3']);	
	$PODL = DecodeStr($row['PODL']);	
	$MEDAL = DecodeStr($row['MEDAL']);	
	$VNEKON = DecodeStr($row['VNEKON']);	
	$BUD = DecodeStr($row['BUD']);	
	$COM = DecodeStr($row['COM']);	
	$KONTR = DecodeStr($row['KONTR']);	
	}
	$ewq	= DecodeStr( 'всего подано:' );
	$ewq1	= DecodeStr( 'Из них:' );
	$ewq2	= DecodeStr( '1 приоритет - ' );
	$ewq3	= DecodeStr( '2 приоритет - ' );
	$ewq4	= DecodeStr( '3 приоритет - ' );
	$ewq5	= DecodeStr( 'По 1 приоритету: ' );
	$ewq6	= DecodeStr( 'Подлинников             -  ' );
	$ewq7	= DecodeStr( 'Медалей / Дипломов - ' );
	$ewq8	= DecodeStr( 'Льгот                            - ' );
	
	$html .= "<br/>$CONGROUP $ewq $VSEGO.   $ewq1    </td></tr>" .
				"<tr><td rowspan='2' colspan='3'><br/> $ewq2 $P1" .
				"<br/>$ewq3 $P2" .
				"<br/>$ewq4 $P3</td>" .
				"<td colspan='99'>$ewq5</td></tr>" .
				"<tr><td colspan='6'><br/>$ewq6 $PODL" .
				"<br/>$ewq7	$MEDAL" .
				"<br/>$ewq8 $VNEKON</td>" .
				"<td colspan='5'></td></tr>";
	//$html	.= $s1;	
	$html	.= "</table>";	
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 10 );
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage('L');
$p->htmltable( $html );
$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
//$exit = EncodeStr( "$grocode" );  // кодирует название, чтобы читался русский язык при сохранении
ob_get_contents();
ob_clean();
flush();
$p->Output("Амбарная книга $time.pdf",'D');     // сохраняет в Документы*/

?>