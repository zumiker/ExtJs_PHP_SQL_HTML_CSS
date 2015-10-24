<?php session_start(); 
define('FPDF_FONTPATH','font/'); 
require('fpdf.php'); 
//create a FPDF object
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
//$sql="SELECT TO_CHAR(DATE_FOR_LIST, 'DD.MM.YYYY') FROM ABI_USTAVKI";
//$cur=ora_do($conn,$sql);
//$data=ora_getcolumn($cur,0); 

//ora_fetch($cur);

$pdf=new FPDF();
$pdf-> AddFont('TimesNewRomanPSMT','','times.php'); 
$pdf-> AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');

//set up a page


if($_GET['id_fac']!='')
{
	$id_fac=$_GET['id_fac'];
	$sql1="FACID='$id_fac' ";
}
if(isset($_GET['id_abi']))
{
	$id_spec=$_GET['id_spec'];
	$sql1.="AND SPECID='$id_spec' AND ";
	$abi=$_GET['id_abi'];
	$sql1.="ABI_ID='$abi' ";
}else if(isset($_GET['id_spec']))
{
	$id_spec=$_GET['id_spec'];
	$sql1.="AND SPECID='$id_spec' ";
}else if(isset($_GET['id_con']))
{
	$id_con=$_GET['id_con'];
	$sql1.="AND CON_ID='$id_con' ";
}




if(isset($_GET['nabor']))
{
	$nab = $_GET['nabor'];
	$sql3=" AND TNABOR='$nab'";
	
	if($nab=='3')
	{
		$sql3=" AND TNABOR IN (3,4,8)";
	}
	if($nab=='undefined')
		$sql3=" AND TNABOR IN(1,3,4,8)";
	
}

if(isset($_GET['medal']))
{
	$medal = $_GET['medal'];

	if($medal=='1')
	{
		$sql4=" AND AWARD IN (2,3,4)";
	}
	if($medal=='2')
		$sql4=" AND AWARD='0'";
	
}

 $sql="SELECT DISTINCT FORMA, FACNAME, SPCNAME, ABI_NUMBER, ABI_GRUPPA, ".
     " FIO, FACID, CON_ID, SPECID, ABI_ID FROM ABIVIEW_LISTOFEXAM ". 
     "WHERE $sql1 $sql3 $sql4 ORDER BY FACID, CON_ID, SPECID, ABI_GRUPPA, FIO";

$cur1=ora_do($conn,$sql);
$sw=0;
for ($i=0;$i<ora_numrows($cur1);$i++)
{
	
//switch($sw)
//{
//case "0":
$pdf->AddPage('P');
$pdf->SetDisplayMode(real,'default');
$pdf->SetAutoPageBreak(0);
$forma=ora_getcolumn($cur1,0);
$fac=ora_getcolumn($cur1,1);
$spec=ora_getcolumn($cur1,2);
$number=ora_getcolumn($cur1,3);
$group=ora_getcolumn($cur1,4);
$fio=ora_getcolumn($cur1,5);
$abi_id=ora_getcolumn($cur1,9);

$date=date("m.d.y");

//display the title with a border around it
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->SetXY(20,5);
$pdf->Cell(170,5,'РГУ НЕФТИ И ГАЗА имени И.М. ГУБКИНА',0,0,'C',0);
//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY (10,15);
$pdf->SetFontSize(12);

$pdf->Write(5,'Дата выдачи: ');
$pdf->SetXY (60,15);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->Write(5, date("d.m.y"));
$pdf->Ln(); 
$pdf->SetXY (10,20);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Факультет: ');
$pdf->SetXY (60,20);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->MultiCell(0,5, $fac,0, 'L');
$pdf->Ln(); 
$pdf->SetXY (10,30);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Специальность: ');
$pdf->SetXY (60,30);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->MultiCell(0,5,$spec,0,'L'); 
$pdf->Ln(); 
$pdf->SetXY (10,40);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Форма обучения: ');
$pdf->SetXY (60,40);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->Write(5,$forma);
$pdf->SetXY(35,50);
$pdf->SetFontSize(15);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->SetFontSize(14);
$pdf->Write(5,'Экзаменационный лист № ');
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->SetFontSize(14);
$pdf->Write(5,$number);
$pdf->SetXY(135,50);
$pdf->SetFontSize(14);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Группа № ');
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->SetFontSize(14);
$pdf->Write(5,$group);
$pdf->SetXY(15,58); 
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);  
$pdf->SetFontSize(14);
$pdf->Cell(170,5,$fio,0,0,'C',0);
$pdf->Ln(); 
$pdf->Ln(); 
$pdf->SetXY(10,65);
$pdf->SetFontSize(12);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);
$pdf->Cell(60,5,'Наименование экзамена','LRBT',0,'C'); 
$pdf->Cell(30,5,'Дата','LRBT',0,'C');
$pdf->Cell(30,5,'Баллы','LRBT',0,'C');
$pdf->Cell(40,5,'Экзаменатор','LRBT',0,'C');
$pdf->Cell(30,5,'Подпись','LRBT',0,'C');

$sql="SELECT DISTINCT predmet, TO_CHAR(kogda, 'DD.MM.YYYY') as kogda, ball100 FROM ABIVIEW_LISTOFEXAM WHERE abi_id=$abi_id AND $sql1 $sql3 $sql4  ORDER BY kogda";
$cur=ora_do($conn,$sql);

$y=70;
$numz=0;
for ($g=0; $g<ora_numrows($cur); $g++)
{
	$pdf->SetXY(10,$y);
 	$predmet=ora_getcolumn($cur,0); 
 	$date=ora_getcolumn($cur,1); 
	$ocenka100=ora_getcolumn($cur,2);

	$numz++;

$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);
$pdf->Cell(60,5,$predmet,'LRBT',0,'L'); 
$pdf-> SetFont('TimesNewRomanPSMT','',12);
$pdf->Cell(30,5,$date,'LRBT',0,'C');
//$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);

    {
    	$pdf->Cell(30,5,$ocenka100,'LRBT',0,'C');
    }
   
   
$pdf-> SetFont('TimesNewRomanPSMT','',12);
$pdf->Cell(40,5,'','LRBT',0,'L');
$pdf->Cell(30,5,'','LRBT',0,'L');
ora_fetch($cur);
$y=$y+5;
}

$y=$y+5;

//$pdf->Image('place_for_foto.png',30,$y+3,33,0,'','http://www.fpdf.org/');

$pdf->SetXY(80,$y);
$pdf-> SetFont('TimesNewRomanPSMT','',12);
$pdf->SetFontSize(12);
$pdf->SetXY(80,$y+5);
$pdf->Write(5,'Экзаменационный лист выдан:');
$pdf->Write(5,' ');
$pdf->Write(5,date("d.m.y"));
$pdf->SetXY(80,$y+14);
$pdf->Write(5,'Отв. секретарь приемной комиссии: ');
$pdf->SetXY(80,$y+23);

if($numz==2)$pdf->Image('podpis.jpg',90,104,33,0,'','http://www.fpdf.org/');
if($numz==3)$pdf->Image('podpis.jpg',90,109,33,0,'','http://www.fpdf.org/');
if($numz==4)$pdf->Image('podpis.jpg',90,114,33,0,'','http://www.fpdf.org/');
$pdf->Write(5,' ____________________Пирожков В.Г.');
$pdf->SetXY(80,$y+30);
$pdf->Write(5,'Экзаменационный лист должен быть возращён в');
$pdf->SetXY(80,$y+35);
$pdf->Write(5,'приемную комиссию после каждого экзамена');
$pdf->SetXY(80,$y+43);
$pdf->Write(5,'______________________(подпись абитуриента)');

$pdf->SetXY(5,$y+53);
ora_fetch($cur1);
//$sw=1;
$pdf->Write(5,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ');
//break;

	
/*case "1":
			
$forma=ora_getcolumn($cur1,0);
$fac=ora_getcolumn($cur1,1);
$spec=ora_getcolumn($cur1,2);
$number=ora_getcolumn($cur1,3);
$group=ora_getcolumn($cur1,4);
$fio=ora_getcolumn($cur1,5);
$abi_id=ora_getcolumn($cur1,9);
$date=date("m.d.y");

$pdf->SetXY(20,155);
$pdf->Cell(170,10,'РГУ НЕФТИ И ГАЗА имени И.М. ГУБКИНА',0,0,'C',0);
//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY (10,170);
$pdf->SetFontSize(12);
$pdf->Write(5,'Дата выдачи: ');
$pdf->SetXY (60,170);; 
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->Write(5, date("d.m.y"));
$pdf->Ln(); 
$pdf->SetXY (10,175);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Факультет: ');
$pdf->SetXY (60,175);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->Write(5, $fac);
$pdf->Ln(); 
$pdf->SetXY (10,180);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Специальность: ');
$pdf->SetXY (60,180);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->MultiCell(0,5,$spec,0,'L'); 
$pdf->Ln(); 
$pdf->SetXY (10,190);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Форма обучения: ');
$pdf->SetXY (60,190);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->Write(5,$forma);
$pdf->SetXY(35,200);
$pdf->SetFontSize(15);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->SetFontSize(14);
$pdf->Write(5,'Экзаменационный лист № ');
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->SetFontSize(14);
$pdf->Write(5,$number);
$pdf->SetXY(135,200);
$pdf->SetFontSize(14);
$pdf-> SetFont('TimesNewRomanPSMT','',12); 
$pdf->Write(5,'Группа № ');
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12); 
$pdf->SetFontSize(14);
$pdf->Write(5,$group);
$pdf->SetXY(15,208); 
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);  
$pdf->SetFontSize(14);
$pdf->Cell(170,5,$fio,0,0,'C',0);
$pdf->Ln(); 
$pdf->Ln(); 
$pdf->SetXY(10,215);
$pdf->SetFontSize(12);
$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);
$pdf->Cell(60,5,'Наименование экзамена','LRBT',0,'C'); 
$pdf->Cell(30,5,'Дата','LRBT',0,'C');
$pdf->Cell(30,5,'Баллы','LRBT',0,'C');
$pdf->Cell(40,5,'Экзаменатор','LRBT',0,'C');
$pdf->Cell(30,5,'Подпись','LRBT',0,'C');

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT predmet, TO_CHAR(kogda, 'DD.MM.YYYY'), ball100, ball16 FROM ABIVIEW_LISTOFEXAM WHERE abi_id=$abi_id ORDER BY kogda";
$cur=ora_do($conn,$sql);

$y=220;
for ($g=0; $g<ora_numrows($cur); $g++)
{
	$pdf->SetXY(10,$y);
	$predmet=ora_getcolumn($cur,0); 
 	$date=ora_getcolumn($cur,1); 
	$ocenka100=ora_getcolumn($cur,2);
	$ocenka16=ora_getcolumn($cur,3);
	

$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);
$pdf->Cell(60,5,$predmet,'LRBT',0,'L'); 
$pdf-> SetFont('TimesNewRomanPSMT','',12);
$pdf->Cell(30,5,$date,'LRBT',0,'C');
//$pdf-> SetFont('TimesNewRomanPS-BoldMT','',12);
 if ($ocenka100=="")
    {
		$pdf->Cell(30,5,$ocenka16,'LRBT',0,'C');
    }
    else
    {
    	$pdf->Cell(30,5,$ocenka100.'('.$ocenka16.')','LRBT',0,'C');
    }
   
   
$pdf-> SetFont('TimesNewRomanPSMT','',12);
$pdf->Cell(40,5,'','LRBT',0,'L');
$pdf->Cell(30,5,'','LRBT',0,'L');
ora_fetch($cur);
$y=$y+5;
}

$y=$y+5;
$pdf->Image('place_for_foto.png',30,$y+3,33,0,'','http://www.fpdf.org/');
$pdf->SetXY(80,$y);
$pdf->SetFontSize(12);
$pdf->SetXY(80,$y+5);
$pdf->Write(5,'Экзаменационный лист выдан:');
$pdf->Write(5,' ');
$pdf->Write(5,date("d.m.y"));
$pdf->SetXY(80,$y+15);
$pdf->Write(5,'Отв. секретарь приемной комиссии:');
$pdf->SetXY(80,$y+23);
$pdf->Image('podpis.jpg',90,259,33,0,'','http://www.fpdf.org/');
$pdf->Write(5,' ____________________Пирожков В.Г.');
$pdf->SetXY(80,$y+30);
$pdf->Write(5,'Экзаменационный лист должен быть возращён в');
$pdf->SetXY(80,$y+35);
$pdf->Write(5,'приемную комиссию после каждого экзамена');
$pdf->SetXY(80,$y+43);
$pdf->Write(5,'______________________(подпись абитуриента)');

$pdf->SetXY(5,$y+50);		
		
ora_fetch($cur1);	
$sw=0;	
}
*/
//$_SESSION['medal']='';
}
//Output the document
$pdf->Output();

?>