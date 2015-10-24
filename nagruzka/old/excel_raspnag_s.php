<?php
require_once 'Spreadsheet/Excel/Writer.php';


// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();
$kaf=$_GET['kaf'];
$god=$_GET['god'];



$sem='Весенний';

$god=$god.'/'.($god+1);

// sending HTTP headers
//$workbook->send('nazruzka.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Распред.нагрузки(Весна)');
$worksheet->setMargins_LR(0);
$worksheet->setMargins_TB(0);

$titleFormat1 =& $workbook->addFormat(); 
$titleFormat1->setFontFamily('Helvetica'); 
$titleFormat1->setAlign('merge'); 
$titleFormat1->setSize('10'); 
$titleFormat1->setColor('navy'); 
$titleFormat1->setTextWrap(1); 

$titleFormat =& $workbook->addFormat(); 
$titleFormat->setFontFamily('Helvetica'); 
$titleFormat->setSize('8'); 
$titleFormat->setColor('navy'); 
$titleFormat->setBottomColor('navy'); 
$titleFormat->setAlign('merge'); 
$titleFormat->setTop(2); 
$titleFormat->setBottom(2); 
$titleFormat->setLeft(2); 
$titleFormat->setRight(2);
$titleFormat->setTextWrap(1); 

$format =& $workbook->addFormat();
$format->setFontFamily('Helvetica'); 
$format->setAlign('center'); 
$format->setSize('8');
$format->setTop(1); 
$format->setBottom(1); 
$format->setLeft(1); 
$format->setRight(1);
$format->setTextWrap(1);

$format2 =& $workbook->addFormat();
$format2->setFontFamily('Helvetica'); 
$format2->setAlign('center'); 
$format2->setSize('10');
$format2->setBold(1);
$format2->setTop(1); 
$format2->setBottom(1); 
$format2->setLeft(1); 
$format2->setRight(1);
$format2->setTextWrap(1);

$format3 =& $workbook->addFormat();
$format3->setFontFamily('Helvetica'); 
$format3->setAlign('center'); 
$format3->setSize('8');
$format3->setBold(1);
$format3->setTop(1); 
$format3->setBottom(1); 
$format3->setLeft(1); 
$format3->setRight(1);
$format3->setTextWrap(1);
$n=0;

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
//for($sota=0;$sota<2;$sota++)
{
	/*if($sota==0)
	$sem='Осенний';
	else
	$sem='Весенний';*/
	
$sql="SELECT UPPER(SPRING_AUTUMN), YEAR_GROCODE, DIVNAME ".
	 "FROM Z_DISPETCH_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god'";
$cur=ora_do($conn,$sql);

$SPRING_AUTUMN=ora_getcolumn($cur,0);
$YEAR=ora_getcolumn($cur,1);	
$DIV=ora_getcolumn($cur,2);			
ora_fetch($cur);

$worksheet ->write($n,0, 'Распределение нагрузки на '.$SPRING_AUTUMN.' семестр '.$god.' уч.года',$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, '',$titleFormat1); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$worksheet ->write($n,11, '',$titleFormat1); 
$worksheet ->write($n,12, '',$titleFormat1); 
$n++;
$worksheet ->write($n,0, $DIV,$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, '',$titleFormat1); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$worksheet ->write($n,11, '',$titleFormat1); 
$worksheet ->write($n,12, '',$titleFormat1); 
$n++;
$n++;
$worksheet ->write($n,0, '№',$titleFormat); 
$worksheet ->write($n+1,0, '',$titleFormat); 
$worksheet ->write($n,1, 'ДИСЦИПЛИНА',$titleFormat); 
$worksheet ->write($n+1,1, '',$titleFormat); 
$worksheet ->write($n,2, 'Поток или группа',$titleFormat); 
$worksheet ->write($n+1,2, '',$titleFormat); 
$worksheet ->write($n,3, 'ЛЕКЦИИ',$titleFormat); 
$worksheet ->write($n,4, '',$titleFormat); 
$worksheet ->write($n,5, '',$titleFormat); 
$worksheet ->write($n+1,3, 'ч/н',$titleFormat); 
$worksheet ->write($n+1,4, 'Ф.И.О. преподавателя',$titleFormat); 
$worksheet ->write($n+1,5, '№ спец. ауд.',$titleFormat); 
$worksheet ->write($n,6, 'ПРАКТИЧЕСКИЕ ЗАНЯТИЯ',$titleFormat);
$worksheet ->write($n,7, '',$titleFormat); 
$worksheet ->write($n,8, '',$titleFormat); 
$worksheet ->write($n+1,6, 'ч/н',$titleFormat);
$worksheet ->write($n+1,7, 'Ф.И.О. преподавателя',$titleFormat); 
$worksheet ->write($n+1,8, '№ спец. ауд.',$titleFormat);  
$worksheet ->write($n,9, 'ЛАБОРАТОРНЫЕ РАБОТЫ',$titleFormat); 
$worksheet ->write($n,10, '',$titleFormat); 
$worksheet ->write($n,11, '',$titleFormat);
$worksheet ->write($n+1,9,  'ч/н',$titleFormat); 
$worksheet ->write($n+1,10, 'Ф.И.О. преподавателя',$titleFormat);
$worksheet ->write($n+1,11, '№ спец. ауд.',$titleFormat);
$worksheet ->write($n,12, 'ПРИМЕЧАНИЕ',$titleFormat); 
$worksheet ->write($n+1,12, '',$titleFormat); 

$worksheet->setMerge($n,0,$n+1,0);
$worksheet->setMerge($n,1,$n+1,1);
$worksheet->setMerge($n,2,$n+1,2);
$worksheet->setMerge($n,12,$n+1,12);
$n++;
$worksheet->setColumn(0,0,4);
$worksheet->setColumn(0,1,25);
$worksheet->setColumn(0,2,10);
$worksheet->setColumn(0,3,3);
$worksheet->setColumn(0,4,16);
$worksheet->setColumn(0,5,7);
$worksheet->setColumn(0,6,3);
$worksheet->setColumn(0,7,16);
$worksheet->setColumn(0,8,7);
$worksheet->setColumn(0,9,3);
$worksheet->setColumn(0,10,16);
$worksheet->setColumn(0,11,7);
$worksheet->setColumn(0,12,20);

$congr_old='netu';
$PREDMET_old='netu';
$LEKTOR_old='netu';
$SEMINAR_old='netu';
$LABRAB_old='netu';
$GROCODE_old='netu';
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT PREDMET, GROCODE, LEKTOR, ROOM_LEC, SEMINAR, ROOM_SEM, LABRAB, ROOM_LAB, PRIM, LEC, LAB, SEM ".
	 "FROM Z_DISPETCH_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god' ".
	 "ORDER BY POR_SORT, KURS, PREDMET, GROCODE, LEKTOR, SEMINAR, LABRAB";

$cur=ora_do($conn,$sql);
$g=0;	
$f=0;
$gr=0;
$pred=0;
$num=1;
$empty='';
$s=$n;
$nz=$n;



for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$n++;
			$PREDMET=ora_getcolumn($cur,0);
			$GROCODE=ora_getcolumn($cur,1);			
			$LEKTOR=ora_getcolumn($cur,2);
			$ROOM_LEC=ora_getcolumn($cur,3);
			$SEMINAR=ora_getcolumn($cur,4);
			$ROOM_SEM=ora_getcolumn($cur,5);
			$LABRAB=ora_getcolumn($cur,6);
			$ROOM_LAB=ora_getcolumn($cur,7);
			$PRIM=ora_getcolumn($cur,8);
			$LEC=ora_getcolumn($cur,9);
			$LAB=ora_getcolumn($cur,10);
			$SEM=ora_getcolumn($cur,11);
			
			if ($PREDMET==$PREDMET_old)
			{
				$pred++;
			
				if ($GROCODE==$GROCODE_old)
				{
						$worksheet->writeString($n,2, trim($empty), $format);
						$gr++;
															
				}
				else 
				{
						$worksheet->writeString($n,2, trim($GROCODE), $format);
				}
								
				
				if ($LEKTOR==$LEKTOR_old)
				{
				
			
					if ($SEMINAR==$SEMINAR_old)
					{
							
						if ($LABRAB==$LABRAB_old)
						{
						$g++;
						$f++;
						$worksheet->writeString($n,0, trim($empty), $format);
						$worksheet->writeString($n,1, trim($empty), $format);							
						$worksheet->writeString($n,3, trim($empty), $format);
						$worksheet->writeString($n,6, trim($empty), $format);
						$worksheet->writeString($n,5, trim($empty), $format);
						$worksheet->writeString($n,8, trim($empty), $format);
						$worksheet->writeString($n,9, trim($empty), $format);
						$worksheet->writeString($n,10, trim($empty), $format);
						$worksheet->writeString($n,11, trim($empty), $format);
						$worksheet->writeString($n,12, trim($empty), $format);
							
						
						}
						else 
						{					
						$g++;
						$worksheet->writeString($n,0, trim($empty), $format);
						$worksheet->writeString($n,1, trim($empty), $format);	
						$worksheet->writeString($n,3, trim($empty), $format);
						$worksheet->writeString($n,5, trim($empty), $format);
						$worksheet->writeString($n,6, trim($empty), $format);
						$worksheet->writeString($n,7, trim($empty), $format);
						$worksheet->writeString($n,8, trim($empty), $format);
						$worksheet->writeString($n,9, trim($LAB), $format);
						$worksheet->writeString($n,10, trim($LABRAB), $format3);
						$worksheet->writeString($n,11, trim($ROOM_LAB), $format);
						$worksheet->writeString($n,12, trim($empty), $format);
					
						}
					}	
					else 
					{	
						$g++;	
						$worksheet->writeString($n,0, trim($empty), $format);
						$worksheet->writeString($n,1, trim($empty), $format);
						//$worksheet->writeString($n,2, trim($GROCODE), $format);
						$worksheet->writeString($n,7, trim($SEMINAR), $format3);
						
						$worksheet->writeString($n,3, trim($empty), $format);		
						
						$worksheet->writeString($n,5, trim($empty), $format);
						$worksheet->writeString($n,6, trim($SEM), $format);
						$worksheet->writeString($n,8, trim($ROOM_SEM), $format);
						$worksheet->writeString($n,9, trim($LAB), $format);
						$worksheet->writeString($n,10, trim($LABRAB), $format3);
						$worksheet->writeString($n,11, trim($ROOM_LAB), $format);
						$worksheet->writeString($n,12, trim($empty), $format);
						
					}
				}			
				else 
				{
					
								
				$worksheet->writeString($n,0, trim($empty), $format);
				$worksheet->writeString($n,1, trim($empty), $format);
				$worksheet->writeString($n,4, trim($LEKTOR), $format3);
				$worksheet->writeString($n,3, trim($LEC), $format);
				$worksheet->writeString($n,7, trim($SEMINAR), $format3);
				$worksheet->writeString($n,10, trim($LABRAB), $format3); 
				$worksheet->writeString($n,3, trim($LEC), $format);
				$worksheet->writeString($n,6, trim($SEM), $format);
				$worksheet->writeString($n,9, trim($LAB), $format);
				$worksheet->writeString($n,12, trim($empty), $format);
				
				
				}
			
			}
			else 
			{ 
				
				if ($g!=0)
					{	
					$worksheet ->setMerge($s,0,$s+$g,0);
					$worksheet ->setMerge($s,1,$s+$g,1);
			
					$worksheet ->setMerge($s,3,$s+$g,3);
					$worksheet ->setMerge($s,4,$s+$g,4);
				    $worksheet ->setMerge($s,5,$s+$g,5);
					$worksheet ->setMerge($s,6,$s+$g,6);
					
					//if($f!=0){
					$worksheet ->setMerge($s,7,$s+$f,7);
					$worksheet ->setMerge($s,8,$s+$g,8);
					$worksheet ->setMerge($s,9,$s+$f,9);
					
					$worksheet ->setMerge($s,10,$s+$f,10);
					$worksheet ->setMerge($s,11,$s+$f,11);
					$worksheet ->setMerge($s,12,$s+$g,12);
					//}
					
					//$worksheet ->setMerge($i+3,8,$i+$g+3,8);
					
					if ($gr!=0)
					{
					$worksheet ->setMerge($s,2,$s+$gr,2);	
						
					}
			}
			
			
			$worksheet->writeString($n,0, trim($num), $format);
			$worksheet->writeString($n,1, trim($PREDMET), $format2);
			$worksheet->writeString($n,2, trim($GROCODE), $format);
			$worksheet->writeString($n,3, trim($LEC), $format);
			$worksheet->writeString($n,4, trim($LEKTOR), $format3);
			$worksheet->writeString($n,5, trim($ROOM_LEC), $format);
			$worksheet->writeString($n,6, trim($SEM), $format);
			$worksheet->writeString($n,7, trim($SEMINAR), $format3);
			$worksheet->writeString($n,8, trim($ROOM_SEM), $format);
			$worksheet->writeString($n,9, trim($LAB), $format);
			$worksheet->writeString($n,10, trim($LABRAB), $format3);
			$worksheet->writeString($n,11, trim($ROOM_LAB), $format);
			$worksheet->writeString($n,12, trim($PRIM), $format);
	
			$g=0;
			$f=0;
			$gr=0;
			$s=$n;
			$num++;	
			}	
			
			//$pred=0;
			$PREDMET_old=$PREDMET;
			$LEKTOR_old=$LEKTOR;
			$SEMINAR_old=$SEMINAR;
			$LABRAB_old=$LABRAB;
			$GROCODE_old=$GROCODE;
			ora_fetch($cur);	
				
			
	}

	if ($g!=0)
					{	
					$worksheet ->setMerge($s,0,$s+$g,0);
					$worksheet ->setMerge($s,1,$s+$g,1);
					//$worksheet ->setMerge($,2,$i+$g,2);
					$worksheet ->setMerge($s,3,$s+$g,3);
					$worksheet ->setMerge($s,4,$s+$g,4);
					$worksheet ->setMerge($s,5,$s+$g,5);
					//$worksheet ->setMerge($s+5,6,$s+$g+5,6);
					$worksheet ->setMerge($s,7,$s+$f,7);
					$worksheet ->setMerge($s,8,$s+$g,8);
					}
$footerFormat =& $workbook->addFormat(); 
$footerFormat->setFontFamily('Helvetica'); 
$footerFormat->setSize('9'); 
$footerFormat->setColor('navy'); 
$footerFormat->setBold();
$footerFormat->setAlign('center'); 


		
			$d=date("d.m.Y");
			$zav_kaf="ЗАВ. КАФЕДРОЙ   _____________________";
			$hdate="Отчёт сформирован $d";
			$n+=2;
			$worksheet->writeString($n,2, trim($zav_kaf), $footerFormat);
			$worksheet->writeString($n,8, trim($hdate), $footerFormat);
			$n+=10;
			/*$worksheet->writeString($i+3,4, "i12=".$i12, $footerFormat);
			$worksheet->writeString($i+3,5, "cli12=".$ci12, $footerFormat);*/
// Let's send the file
//$workbook->close();
}
?>