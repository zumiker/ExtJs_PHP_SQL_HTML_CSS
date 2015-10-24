<?php

require_once("../include.php");
define('FPDF_FONTPATH','../../../../../fpdf/font/');

header( "Pragma: no-cache" );
//include("../../../../../../lib.php");
//include( "../../fpdf/lib/pdftable.inc.php" );
include( "../../../../../fpdf/fpdf.php" );
//require('../../../../lib/pdftable/lib/pdftable.inc.php');
$mas =json_decode($_REQUEST['mas']);
$str="";
for($i=0;$i<count($mas);$i++){
    $str.=$mas[$i];
    if($i!=count($mas)-1)
        $str.=", ";

}

$sql="SELECT initcap(LASTNAME) as LASTNAME,initcap(FIRSTNAME) as FIRSTNAME, initcap(PATRONYMIC) as PATRONYMIC, POSTINDEX, null as PLANAME, replace( replace( ADDRESS, POSTINDEX || ',' ),  'Российская Федерация,' ) as address
        FROM ABITURIENT
        WHERE  ABI_ID in ($str)
        ORDER BY LASTNAME";
//echo $sql;
$cur = execq($sql);
//echo json_encode($cur);
/*$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 12 );
$p->SetMargins( 10, 10, 10, 10 );
$p->AddPage();
*/
$pdf = new FPDF( "L", "mm", "letter" );
$pdf->AddFont('TimesNewRomanPSMT','','times.php');
$pdf->AddFont('TimesNewRomanPS-BoldMT','','times_b.php');
$pdf->AddFont('ArialMT','','arial.php');
$pdf->AddFont('Arial-BoldMT','','arial_bold.php');
$pdf->AddFont('ComicSansMS','','comic.php');
$pdf->AddPage();
$pdf->SetFont('TimesNewRomanPSMT','',12);

if($cur==[]){
    $text14	= DecodeStr('Нет данных для отображения');
    $html	.= "
	<table>
	<tr>
					<td border= '0' colspan='99' align='center' family='TimesNewRomanPSMT' size='20'>
						$text14
					</td>
				</tr>
				</table>
	";

}
foreach($cur as $cou=>$row){
    $LASTNAME	= DecodeStr($row['LASTNAME']);
    $FIRSTNAME	= DecodeStr($row['FIRSTNAME']);
    $PATRONYMIC	= DecodeStr($row['PATRONYMIC']);
    $PLANAME    = DecodeStr($row['PLANAME']);
    $POSTINDEX	= DecodeStr($row['POSTINDEX']);
    //$ADDRESS[$i] = ucwords(strtolower(ora_getcolumnnbsp($cur,5)));
    $ADDRESS     = DecodeStr($row['ADDRESS']);
//if(($cou+1)%2!=0){
    $fio=$LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC;
   $add=$ADDRESS;
    $pdf->SetXY(30,15);
    $pdf->Cell(0,0,'091',0,0,'L',false);
    $pdf->Ln();
    $pdf->SetXY(75,53);
    $pdf->MultiCell(60,5,$fio,0,'L',0);//$pdf->Cell(60,10,$fio,0,0,'L',false);
    $pdf->Ln();
    $pdf->SetXY(75,65);
    $pdf->MultiCell(65,6,$add,0,'L',0);//(0,0,$add,0,0,'L',false);
    $pdf->Ln();
    $pdf->SetXY(75,91);
    $pdf->Cell(0,0,$POSTINDEX,0,0,'L',false);
    $pdf->Ln();
/*}
    else{
        $fio=$LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC;
        $add=$ADDRESS;
        $pdf->SetXY(70,122);
        $pdf->Cell(0,0,'091',0,0,'L',false);
        $pdf->Ln();
        $pdf->SetXY(115,160);
        $pdf->MultiCell(60,5,$fio,0,'L',0);//$pdf->Cell(60,10,$fio,0,0,'L',false);
        $pdf->Ln();
        $pdf->SetXY(115,172);
        $pdf->MultiCell(65,6,$add,0,'L',0);//(0,0,$add,0,0,'L',false);
        $pdf->Ln();
        $pdf->SetXY(110,198);
        $pdf->Cell(0,0,$POSTINDEX,0,0,'L',false);
        $pdf->Ln();*/
        if($cou<(count($mas)-1))
            $pdf->AddPage();
//    }
    //$pdf->Cell(360,135,'312',0,0,'C',false);


}

$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
ob_get_contents();
ob_clean();
flush();
$pdf->Output("Письма $time.pdf",'D');     // сохраняет в Документы
//cho json_encode($cur);
/*
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
*/
?>