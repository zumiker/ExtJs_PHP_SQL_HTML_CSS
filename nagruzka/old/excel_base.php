<?php
require_once 'Spreadsheet/Excel/Writer.php';


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$kaf=$_GET['kaf'];
$god=$_GET['god'];
$sem=$_GET['sem'];

if($sem=='01.09.')
$sem='Îñåííèé';
else
$sem='Âåñåííèé';

$god=$god.'/'.($god+1);

// sending HTTP headers
$workbook->send('nazruzka.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('ÍÀÃÐÓÇÊÀ');
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

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT UPPER(SPRING_AUTUMN), YEAR_GROCODE, DIVNAME ".
	 "FROM Z_DISPETCH_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god'";
$cur=ora_do($conn,$sql);

$SPRING_AUTUMN=ora_getcolumn($cur,0);
$YEAR=ora_getcolumn($cur,1);	
$DIV=ora_getcolumn($cur,2);			
ora_fetch($cur);

$worksheet ->write(0,0, 'ÐÀÑÏÐÅÄÅËÅÍÈÅ ÍÀÃÐÓÇÊÈ ÍÀ '.$SPRING_AUTUMN.' ÑÅÌÅÑÒÐ '.$god.' Ó×.ÃÎÄÀ',$titleFormat1); 
$worksheet ->write(0,1, '',$titleFormat1); 
$worksheet ->write(0,2, '',$titleFormat1); 
$worksheet ->write(0,3, '',$titleFormat1); 
$worksheet ->write(0,4, '',$titleFormat1); 
$worksheet ->write(0,5, '',$titleFormat1); 
$worksheet ->write(0,6, '',$titleFormat1); 
$worksheet ->write(0,7, '',$titleFormat1); 
$worksheet ->write(0,8, '',$titleFormat1); 
$worksheet ->write(0,9, '',$titleFormat1); 
$worksheet ->write(0,10, '',$titleFormat1); 
$worksheet ->write(0,11, '',$titleFormat1); 
$worksheet ->write(0,12, '',$titleFormat1); 
$worksheet ->write(0,13, '',$titleFormat1); 

$worksheet ->write(1,0, $DIV,$titleFormat1); 
$worksheet ->write(1,1, '',$titleFormat1); 
$worksheet ->write(1,2, '',$titleFormat1); 
$worksheet ->write(1,3, '',$titleFormat1); 
$worksheet ->write(1,4, '',$titleFormat1); 
$worksheet ->write(1,5, '',$titleFormat1); 
$worksheet ->write(1,6, '',$titleFormat1); 
$worksheet ->write(1,7, '',$titleFormat1); 
$worksheet ->write(1,8, '',$titleFormat1); 
$worksheet ->write(1,9, '',$titleFormat1); 
$worksheet ->write(1,10, '',$titleFormat1); 
$worksheet ->write(1,11, '',$titleFormat1); 
$worksheet ->write(1,12, '',$titleFormat1); 
$worksheet ->write(1,13, '',$titleFormat1); 


$worksheet ->write(3,0, '¹',$titleFormat); 
$worksheet ->write(4,0, '',$titleFormat); 
$worksheet ->write(3,1, 'ÄÈÑÖÈÏËÈÍÀ',$titleFormat); 
$worksheet ->write(4,1, '',$titleFormat); 
$worksheet ->write(3,2, 'Ïîòîê èëè ãðóïïà',$titleFormat); 
$worksheet ->write(4,2, '',$titleFormat); 
$worksheet ->write(3,3, 'ËÅÊÖÈÈ',$titleFormat); 
$worksheet ->write(3,4, '',$titleFormat); 
$worksheet ->write(3,5, '',$titleFormat); 
$worksheet ->write(4,3, '÷àñ/íåä',$titleFormat); 
$worksheet ->write(4,4, 'Ô.È.Î. ïðåïîäàâàòåëÿ',$titleFormat); 
$worksheet ->write(4,5, '¹ ñïåö. àóä.',$titleFormat); 
$worksheet ->write(3,6, 'ÏÐÀÊÒÈ×ÅÑÊÈÅ ÇÀÍßÒÈß',$titleFormat);
$worksheet ->write(3,7, '',$titleFormat); 
$worksheet ->write(3,8, '',$titleFormat); 
$worksheet ->write(4,6, '÷àñ/íåä',$titleFormat);
$worksheet ->write(4,7, 'Ô.È.Î. ïðåïîäàâàòåëÿ',$titleFormat); 
$worksheet ->write(4,8, '¹ ñïåö. àóä.',$titleFormat);  
$worksheet ->write(3,9, 'ËÀÁÎÐÀÒÎÐÍÛÅ ÐÀÁÎÒÛ',$titleFormat); 
$worksheet ->write(3,10, '',$titleFormat); 
$worksheet ->write(3,11, '',$titleFormat);
$worksheet ->write(4,9,  '÷àñ/íåä',$titleFormat); 
$worksheet ->write(4,10, 'Ô.È.Î. ïðåïîäàâàòåëÿ',$titleFormat);
$worksheet ->write(4,11, '¹ ñïåö. àóä.',$titleFormat);
$worksheet ->write(3,12, 'ÓÍÏÊ',$titleFormat); 
$worksheet ->write(4,12, '',$titleFormat); 
$worksheet ->write(3,13, 'ÏÐÈÌÅ×ÀÍÈÅ',$titleFormat); 
$worksheet ->write(4,13, '',$titleFormat); 



$worksheet->setColumn(0,0,7);
$worksheet->setColumn(0,1,30);
$worksheet->setColumn(3,2,10);
$worksheet->setColumn(4,3,7);
$worksheet->setColumn(4,4,15);
$worksheet->setColumn(4,5,7);
$worksheet->setColumn(4,6,7);
$worksheet->setColumn(4,7,15);
$worksheet->setColumn(4,8,7);
$worksheet->setColumn(4,9,7);
$worksheet->setColumn(4,10,15);
$worksheet->setColumn(4,11,7);
$worksheet->setColumn(4,12,10);
$worksheet->setColumn(4,13,20);
$worksheet ->setMerge(3,0,4,0);
$worksheet ->setMerge(3,1,4,1);
$worksheet ->setMerge(3,2,4,2);
$worksheet ->setMerge(3,12,4,12);
$worksheet ->setMerge(3,13,4,13);


$congr_old='netu';
$PREDMET_old='netu';

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT PREDMET, GROCODE, LEKTOR, ROOM_LEC, SEMINAR, ROOM_SEM, LABRAB, ROOM_LAB, PRIM, LEC, LAB, SEM ".
	 "FROM Z_DISPETCH_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god' ".
	 "ORDER BY POR_SORT, KURS, PREDMET, GROCODE, LEKTOR, SEMINAR, LABRAB";
$cur=ora_do($conn,$sql);
$g=0;	
$f=0;	
$n=1;
$empty='';
for ($i=0;$i<ora_numrows($cur);$i++)
		{

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
						$worksheet->writeString($i+5,2, trim($empty), $format);
						$gr++;
															
				}
				else 
				{
						$worksheet->writeString($i+5,2, trim($GROCODE), $format);
				}
								
				
				if ($LEKTOR==$LEKTOR_old)
				{
				
			
					if ($SEMINAR==$SEMINAR_old)
					{
							
						if ($LABRAB==$LABRAB_old)
						{
						$g++;
						$f++;
						$worksheet->writeString($i+5,0, trim($empty), $format);
						$worksheet->writeString($i+5,1, trim($empty), $format);							
						$worksheet->writeString($i+5,3, trim($empty), $format);
						$worksheet->writeString($i+5,6, trim($empty), $format);
						$worksheet->writeString($i+5,5, trim($empty), $format);
						$worksheet->writeString($i+5,8, trim($empty), $format);
						$worksheet->writeString($i+5,9, trim($empty), $format);
						$worksheet->writeString($i+5,10, trim($empty), $format);
						$worksheet->writeString($i+5,11, trim($empty), $format);
						$worksheet->writeString($i+5,12, trim($empty), $format);
						$worksheet->writeString($i+5,13, trim($empty), $format);	
						
						}
						else 
						{					
						$g++;
						$worksheet->writeString($i+5,0, trim($empty), $format);
						$worksheet->writeString($i+5,1, trim($empty), $format);	
						$worksheet->writeString($i+5,3, trim($empty), $format);
						$worksheet->writeString($i+5,5, trim($empty), $format);
						$worksheet->writeString($i+5,6, trim($empty), $format);
						$worksheet->writeString($i+5,7, trim($empty), $format);
						$worksheet->writeString($i+5,8, trim($empty), $format);
						$worksheet->writeString($i+5,9, trim($LAB), $format);
						$worksheet->writeString($i+5,10, trim($LABRAB), $format);
						$worksheet->writeString($i+5,11, trim($ROOM_LAB), $format);
						$worksheet->writeString($i+5,12, trim($empty), $format);
						$worksheet->writeString($i+5,13, trim($empty), $format);	
						}
					}	
					else 
					{	
						$g++;	
						$worksheet->writeString($i+5,0, trim($empty), $format);
						$worksheet->writeString($i+5,1, trim($empty), $format);
						//$worksheet->writeString($i+5,2, trim($GROCODE), $format);
						$worksheet->writeString($i+5,7, trim($SEMINAR), $format);
						
						$worksheet->writeString($i+5,3, trim($empty), $format);
						
						
						$worksheet->writeString($i+5,5, trim($empty), $format);
						$worksheet->writeString($i+5,6, trim($SEM), $format);
						$worksheet->writeString($i+5,8, trim($ROOM_SEM), $format);
						$worksheet->writeString($i+5,9, trim($LAB), $format);
						$worksheet->writeString($i+5,10, trim($LABRAB), $format);
						$worksheet->writeString($i+5,11, trim($ROOM_LAB), $format);
						$worksheet->writeString($i+5,12, trim($empty), $format);
						$worksheet->writeString($i+5,13, trim($empty), $format);	
					}
				}			
				else 
				{
					
								
				$worksheet->writeString($i+5,0, trim($empty), $format);
				$worksheet->writeString($i+5,1, trim($empty), $format);
				$worksheet->writeString($i+5,4, trim($LEKTOR), $format);
				$worksheet->writeString($i+5,3, trim($LEC), $format);
				$worksheet->writeString($i+5,7, trim($SEMINAR), $format);
				$worksheet->writeString($i+5,10, trim($LABRAB), $format); 
				$worksheet->writeString($i+5,3, trim($LEC), $format);
				$worksheet->writeString($i+5,6, trim($SEM), $format);
				$worksheet->writeString($i+5,9, trim($LAB), $format);
				$worksheet->writeString($i+5,12, trim($empty), $format);
				$worksheet->writeString($i+5,13, trim($empty), $format);	
				
				}
			
			}
			else 
			{ 
				
				if ($g!=0)
					{	
					$worksheet ->setMerge($s+5,0,$s+$g+5,0);
					$worksheet ->setMerge($s+5,1,$s+$g+5,1);
					
					$worksheet ->setMerge($s+5,3,$s+$g+5,3);
					$worksheet ->setMerge($s+5,4,$s+$g+5,4);
				    $worksheet ->setMerge($s+5,5,$s+$g+5,5);
					$worksheet ->setMerge($s+5,6,$s+$g+5,6);
					$worksheet ->setMerge($s+5,7,$s+$f+5,7);
					$worksheet ->setMerge($s+5,8,$s+$f+5,8);
					$worksheet ->setMerge($s+5,9,$s+$f+5,9);
					$worksheet ->setMerge($s+5,10,$s+$f+5,10);
					$worksheet ->setMerge($s+5,11,$s+$f+5,11);
					//$worksheet ->setMerge($i+3,8,$i+$g+3,8);
					
					if ($gr!=0)
					{
					$worksheet ->setMerge($s+5,2,$s+$gr+5,2);	
						
					}
			}
			
			
			$worksheet->writeString($i+5,0, trim($n), $format);
			$worksheet->writeString($i+5,1, trim($PREDMET), $format);
			$worksheet->writeString($i+5,2, trim($GROCODE), $format);
			$worksheet->writeString($i+5,3, trim($LEC), $format);
			$worksheet->writeString($i+5,4, trim($LEKTOR), $format);
			$worksheet->writeString($i+5,5, trim($ROOM_LEC), $format);
			$worksheet->writeString($i+5,6, trim($SEM), $format);
			$worksheet->writeString($i+5,7, trim($SEMINAR), $format);
			$worksheet->writeString($i+5,8, trim($ROOM_SEM), $format);
			$worksheet->writeString($i+5,9, trim($LAB), $format);
			$worksheet->writeString($i+5,10, trim($LABRAB), $format);
			$worksheet->writeString($i+5,11, trim($ROOM_LAB), $format);
			$worksheet->writeString($i+5,12, trim($kc), $format);
			$worksheet->writeString($i+5,13, trim($PRIM), $format);
			$g=0;
			$f=0;
			$gr=0;
			$s=$i;
			$n++;	
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
					$worksheet ->setMerge($s+5,0,$s+$g+5,0);
					$worksheet ->setMerge($s+5,1,$s+$g+5,1);
					//$worksheet ->setMerge($,2,$i+$g,2);
					$worksheet ->setMerge($s+5,3,$s+$g+5,3);
					$worksheet ->setMerge($s+5,4,$s+$g+5,4);
					$worksheet ->setMerge($s+5,5,$s+$g+5,5);
					//$worksheet ->setMerge($s+5,6,$s+$g+5,6);
					$worksheet ->setMerge($s+5,7,$s+$f+5,7);
					$worksheet ->setMerge($s+5,8,$s+$g+5,8);
					}
$footerFormat =& $workbook->addFormat(); 
$footerFormat->setFontFamily('Helvetica'); 
$footerFormat->setSize('9'); 
$footerFormat->setColor('navy'); 
$footerFormat->setBold();
$footerFormat->setAlign('center'); 


		
			$d=date("d.m.Y H:i ");
			$zav_kaf="ÇÀÂ. ÊÀÔÅÄÐÎÉ   _____________________";
			$hdate="Îò÷¸ò ñôîðìèðîâàí $d";
			$i++;
			$worksheet->writeString($i+5,8, trim($zav_kaf), $footerFormat);
			$worksheet->writeString($i+5,3, trim($hdate), $footerFormat);
			/*$worksheet->writeString($i+3,4, "i12=".$i12, $footerFormat);
			$worksheet->writeString($i+3,5, "cli12=".$ci12, $footerFormat);*/
// Let's send the file
$workbook->close();
?>