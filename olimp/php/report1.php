<?php
define('FPDF_FONTPATH','../../../../lib/fpdf/font/');
require('../../../../lib/pdftable/lib/pdftable.inc.php');
require_once("../include.php");

    $id_fac=$_REQUEST['div'];
    $fac=DecodeStr($_REQUEST['fac']);
    $sql1=" FACID='$id_fac' ";


    $sort1 = $_REQUEST['vub'];
    if($sort1=='0')			$sql4=" FIO, PREDMET";
    if($sort1=='1')			$sql4=" PREDMET, FIO";

$sql="SELECT ABI_NUMBER, FIO, PREDMET, OLIMP, ID_CON, FACID, FAC, CONGROUP " .
    " FROM ABIVIEW_OLIMP " .
    " WHERE $sql1 ORDER BY $sql4 " ;
$cur=execq($sql);
$html .="<table border='1' align='center'  style='text-align:left; font-family: Verdana; font-size: 14px;>";
$d=date("d.m.Y H:i ");
$n6543= DecodeStr( 'Отчёт сформирован' );
$hdate="$n6543 $d";
$n65143= DecodeStr( 'Олимпиады ' );
$n651445= DecodeStr( 'Факультет:  ' );

$html .= "<tr><td colspan='100%' align='center' family='TimesNewRomanPSMT' size='14'><h2>$n65143
		<br/>$n651445 $fac<br/><br/></td></tr>";
$html .= "<tr><td colspan='100%' align='right' family='TimesNewRomanPSMT' size='8'>$hdate<br/></td></tr>";
$n	= DecodeStr( '№' );
$n1	= DecodeStr( '№ <br/>л.д.' );
$n2	= DecodeStr( 'ФИО' );
$n3	= DecodeStr( 'Предмет' );
$n4	= DecodeStr( 'Олимпиада' );
$s1 .= "<tr>" .
    "<td align='center' width='2%'><b>$n</td>" .
    "<td align='center' width='14%'><b>$n1</td>" .
    "<td  align='center' width='20%'><b>$n2</td>" .
    "<td align='center' width='10%'><b>$n3</td>".
    "<td align='center'><b>$n4</td>";


$html .=$s1;
$col = "#ffffff";
$CON_ID_OLD="netu";
$SPECID_OLD="netu";
$num=0;
$tmp='';
foreach($cur as $k=>$row)
{
    $num=$num+1;
    $ABI_NUMBER = DecodeStr($row['ABI_NUMBER']);
    $FIO = DecodeStr($row['FIO']);
    $PREDMET = DecodeStr($row['PREDMET']);
    $OLIMP = DecodeStr($row['OLIMP']);
    $ID_CON = DecodeStr($row['ID_CON']);
    $FACID = DecodeStr($row['FACID']);
    $FAC = DecodeStr($row['FAC']);
    $CONGROUP = DecodeStr($row['CONGROUP']);
    if ($tmp!=$CONGROUP)
        $html .= "<tr><td colspan='6' align='center'>$CONGROUP</td></tr>";
    $html .= "<tr valign='center' OnMouseOver=\"style.backgroundColor='#54FF9F'\" OnMouseOut=\"style.backgroundColor='#FFFFFF'\">" .
        "<td align='center' >$num</td>" .
        "<td align='left' >  $ABI_NUMBER</td>" .
        "<td align='left' nowrap> $FIO</td>".
        "<td align='left'> $PREDMET</td>".
        "<td align='left'> <span size='3'>$OLIMP</span></td>";
    $tmp=$CONGROUP;
    $html .="</tr>";
}
$html .="</table>";
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 10 );
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage();
$p->htmltable( $html );
$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
//$exit = EncodeStr( "$grocode" );  // кодирует название, чтобы читался русский язык при сохранении
ob_get_contents();
ob_clean();
flush();
$p->Output("Олимпиада $time.pdf",'D');     // сохраняет в Документы


?>
