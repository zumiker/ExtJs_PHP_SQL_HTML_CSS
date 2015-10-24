<?php
require_once("../include.php");
define('FPDF_FONTPATH', 'font/');
require('fpdf.php');
$pdf = new FPDF();
$pdf->AddFont('TimesNewRomanPSMT', '', 'times.php');
$pdf->AddFont('TimesNewRomanPS-BoldMT', '', 'timesbd.php');

$divid = $_REQUEST['divid'];
$groid = $_REQUEST['groid'];
$subid = $_REQUEST['subid'];
$abi = $_REQUEST['abi_id'];
$vub = $_REQUEST['vub'];

$sql1 = "FACID='$divid' ";

if ($abi != 'null') {
    $sql1 .= "AND SPECID='$subid' AND ";
    $sql1 .= "ABI_ID='$abi' ";
} else if ($subid != 'null') {

    $sql1 .= "AND SPECID='$subid' ";
} else if ($groid != 'null') {
    $sql1 .= "AND CON_ID='$groid' ";
}


if ($vub != 'null') {


    if ($vub == '3')
        $sql3 = " AND TNABOR IN (3,4,8)";
    if ($vub == '2')
        $sql3 = " AND TNABOR IN(2)";
    if ($vub == '1')
        $sql3 = " AND TNABOR IN(1)";
} else
    $sql3 = " AND TNABOR IN(1,2,3,4,8)";


/*if (isset($_GET['medal'])) {
    $medal = $_GET['medal'];

    if ($medal == '1') {
        $sql4 = " AND AWARD IN (2,3,4)";
    }
    if ($medal == '2')
        $sql4 = " AND AWARD='0'";

}*/

$sql = "SELECT DISTINCT FORMA, FACNAME, SPCNAME, ABI_NUMBER, ABI_GRUPPA,
     FIO, FACID, CON_ID, SPECID, ABI_ID FROM ABIVIEW_LISTOFEXAM
     WHERE $sql1 $sql3 $sql4 ORDER BY FACID, CON_ID, SPECID, ABI_GRUPPA, FIO";

$cur = execq($sql);
$sw = 0;
//echo $sql;
//echo json_encode($cur);

$n7 = DecodeStr('Наименование экзамена');
$n8 = DecodeStr('Дата');
$n9 = DecodeStr('Баллы');
$n10 = DecodeStr('Экзаменатор');
$n11 = DecodeStr('Подпись');
$n = DecodeStr('РГУ НЕФТИ И ГАЗА имени И.М. ГУБКИНА');
$n1 = DecodeStr('Дата выдачи: ');
$n2 = DecodeStr('Факультет: ');
$n3 = DecodeStr('Специальность: ');
$n4 = DecodeStr('Форма обучения: ');
$n5 = DecodeStr('Экзаменационный лист № ');
$n12 = DecodeStr('Экзаменационный лист выдан:');
$n13 = DecodeStr(' ');
$n14 = DecodeStr('Отв. секретарь приемной комиссии: ');
$n15 = DecodeStr('Экзаменационный лист должен быть возращён в');
$n16 = DecodeStr('приемную комиссию после каждого экзамена');
$n17 = DecodeStr('______________________(подпись абитуриента)');
$n19 = DecodeStr(' ____________________Пирожков В.Г.');
$n18 = DecodeStr('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ');
foreach ($cur as $k => $row) {

//switch($sw)
//{
//case "0":
    $pdf->AddPage('P');
    $pdf->SetDisplayMode(real, 'default');
    $pdf->SetAutoPageBreak(0);
    $forma = DecodeStr($row['FORMA']);
    $fac = DecodeStr($row['FACNAME']);
    $spec = DecodeStr($row['SPCNAME']);
    $number = DecodeStr($row['ABI_NUMBER']);
    $group = DecodeStr($row['ABI_GRUPPA']);
    $fio = DecodeStr($row['FIO']);
    $abi_id = DecodeStr($row['ABI_ID']);

    $date = date("m.d.y");

//display the title with a border around it
    $pdf->SetFont('TimesNewRomanPSMT', '', 12);
    $pdf->SetXY(20, 5);

    $pdf->Cell(170, 5, $n, 0, 0, 'C', 0);
//Set x and y position for the main text, reduce font size and write content
    $pdf->SetXY(10, 15);
    $pdf->SetFontSize(12);
    $pdf->Write(5, $n1);
    $pdf->SetXY(60, 15);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->Write(5, date("d.m.y"));
    $pdf->Ln();
    $pdf->SetXY(10, 20);

    $pdf->SetFont('TimesNewRomanPSMT', '', 12);
    $pdf->Write(5, $n2);
    $pdf->SetXY(60, 20);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->MultiCell(0, 5, $fac, 0, 'L');
    $pdf->Ln();
    $pdf->SetXY(10, 30);
    $pdf->SetFont('TimesNewRomanPSMT', '', 12);

    $pdf->Write(5, $n3);
    $pdf->SetXY(60, 30);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->MultiCell(0, 5, $spec, 0, 'L');
    $pdf->Ln();
    $pdf->SetXY(10, 40);

    $pdf->SetFont('TimesNewRomanPSMT', '', 12);
    $pdf->Write(5, $n4);
    $pdf->SetXY(60, 40);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->Write(5, $forma);
    $pdf->SetXY(35, 50);
    $pdf->SetFontSize(15);
    $pdf->SetFont('TimesNewRomanPSMT', '', 12);
    $pdf->SetFontSize(14);

    $pdf->Write(5, $n5);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->SetFontSize(14);
    $pdf->Write(5, $number);
    $pdf->SetXY(135, 50);
    $pdf->SetFontSize(14);

    $pdf->SetFont('TimesNewRomanPSMT', '', 12);
    $pdf->Write(5, $n6);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->SetFontSize(14);
    $pdf->Write(5, $group);
    $pdf->SetXY(15, 58);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
    $pdf->SetFontSize(14);
    $pdf->Cell(170, 5, $fio, 0, 0, 'C', 0);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetXY(10, 65);
    $pdf->SetFontSize(12);
    $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);

    $pdf->Cell(60, 5, $n7, 'LRBT', 0, 'C');
    $pdf->Cell(30, 5, $n8, 'LRBT', 0, 'C');
    $pdf->Cell(30, 5, $n9, 'LRBT', 0, 'C');
    $pdf->Cell(40, 5, $n10, 'LRBT', 0, 'C');
    $pdf->Cell(30, 5, $n11, 'LRBT', 0, 'C');


    $sql1 = "SELECT DISTINCT predmet, TO_CHAR(kogda, 'DD.MM.YYYY') as kogda, ball100 FROM ABIVIEW_LISTOFEXAM WHERE abi_id=$abi_id ORDER BY kogda"; //для вывода всех заявленных предметов (на 5-ти не будет подписи)
    $cur1 = execq($sql1);

    $y = 70;
    $numz = 0;
    foreach ($cur1 as $k1 => $row1) {
        $pdf->SetXY(10, $y);
        $predmet = DecodeStr($row1['PREDMET']);
        $date = DecodeStr($row1['KOGDA']);
        $ocenka100 = DecodeStr($row1['BALL100']);

        $numz++;

        $pdf->SetFont('TimesNewRomanPS-BoldMT', '', 12);
        $pdf->Cell(60, 5, $predmet, 'LRBT', 0, 'L');
        $pdf->SetFont('TimesNewRomanPSMT', '', 12);
        $pdf->Cell(30, 5, $date, 'LRBT', 0, 'C');
//$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);

        {
            $pdf->Cell(30, 5, $ocenka100, 'LRBT', 0, 'C');
        }


        $pdf->SetFont('TimesNewRomanPSMT', '', 12);
        $pdf->Cell(40, 5, '', 'LRBT', 0, 'L');
        $pdf->Cell(30, 5, '', 'LRBT', 0, 'L');
        //ora_fetch($cur);
        $y = $y + 5;
    }

    $y = $y + 5;

//$pdf->Image('place_for_foto.png',30,$y+3,33,0,'','http://www.fpdf.org/');

    $pdf->SetXY(80, $y);
    $pdf->SetFont('TimesNewRomanPSMT', '', 12);
    $pdf->SetFontSize(12);
    $pdf->SetXY(80, $y + 5);
    $pdf->Write(5, $n12);
    $pdf->Write(5, $n13);
    $pdf->Write(5, date("d.m.y"));
    $pdf->SetXY(80, $y + 14);
    $pdf->Write(5, $n14);
    $pdf->SetXY(80, $y + 23);

    if ($numz == 2) $pdf->Image('podpis.jpg', 90, 104, 33, 0, '', 'http://www.fpdf.org/');
    if ($numz == 3) $pdf->Image('podpis.jpg', 90, 109, 33, 0, '', 'http://www.fpdf.org/');
    if ($numz == 4) $pdf->Image('podpis.jpg', 90, 114, 33, 0, '', 'http://www.fpdf.org/');
    if ($numz == 5) $pdf->Image('podpis.jpg', 90, 119, 33, 0, '', 'http://www.fpdf.org/');
    $pdf->Write(5, $n19);
    $pdf->SetXY(80, $y + 30);
    $pdf->Write(5, $n15);
    $pdf->SetXY(80, $y + 35);
    $pdf->Write(5, $n16);
    $pdf->SetXY(80, $y + 43);
    $pdf->Write(5, $n17);

    $pdf->SetXY(5, $y + 53);
    // ora_fetch($cur1);

    $pdf->Write(5, $n18);

}
$time = strtotime(date('d.m.Y H.i.s'));
//Output the document
ob_get_contents();
ob_clean();
flush();
$pdf->Output("Экзаменационный лист $time.pdf", 'D');

?>