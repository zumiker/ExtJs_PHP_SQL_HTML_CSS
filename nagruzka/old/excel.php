<?php
require_once 'Spreadsheet/Excel/Writer.php';


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$kaf=$_GET['kaf'];
$god=$_GET['god'];
$sem=$_GET['sem'];

if($sem=='01.09.')
$sem='Осенний';
else
$sem='Весенний';

$god=$god.'/'.($god+1);

// sending HTTP headers
$workbook->send('nagruzka.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Нагрузка');
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

$verticalformat =& $workbook->addFormat();
$verticalformat->setFontFamily('Helvetica'); 
$verticalformat->setAlign('center'); 
$verticalformat->setSize('8');
$titleFormat1->setColor('navy'); 
$verticalformat->setTop(2); 
$verticalformat->setBottom(2); 
$verticalformat->setLeft(2); 
$verticalformat->setRight(2);
$verticalformat->setTextWrap(1);
$verticalformat->setTextRotation(270);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT UPPER(SPRING_AUTUMN), YEAR_GROCODE, DIVABBREVIATE ".
	 "FROM Z_PREPOD_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god'";
$cur=ora_do($conn,$sql);

$SPRING_AUTUMN=ora_getcolumn($cur,0);
$YEAR=ora_getcolumn($cur,1);	
$DIVABBREVIATE=ora_getcolumn($cur,2);			
ora_fetch($cur);

$worksheet ->write(0,0, 'Российский Государственный Университет нефти и газа имени И.М. Губкина',$titleFormat1); 
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
$worksheet ->write(0,14, '',$titleFormat1); 
$worksheet ->write(0,15, '',$titleFormat1); 
$worksheet ->write(0,16, '',$titleFormat1); 
$worksheet ->write(0,17, '',$titleFormat1); 
$worksheet ->write(0,18, '',$titleFormat1); 
$worksheet ->write(0,19, '',$titleFormat1); 
$worksheet ->write(0,20, '',$titleFormat1); 
$worksheet ->write(0,21, '',$titleFormat1); 
$worksheet ->write(0,22, '',$titleFormat1); 
$worksheet ->write(0,23, '',$titleFormat1); 
$worksheet ->write(0,24, '',$titleFormat1); 
$worksheet ->write(0,25, '',$titleFormat1); 
$worksheet ->write(0,26, '',$titleFormat1); 



$worksheet ->write(1,0, 'Учебная нагрузка преподавателей кафедры '.$DIVABBREVIATE,$titleFormat1); 
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
$worksheet ->write(1,14, '',$titleFormat1); 
$worksheet ->write(1,15, '',$titleFormat1); 
$worksheet ->write(1,16, '',$titleFormat1); 
$worksheet ->write(1,17, '',$titleFormat1); 
$worksheet ->write(1,18, '',$titleFormat1); 
$worksheet ->write(1,19, '',$titleFormat1); 
$worksheet ->write(1,20, '',$titleFormat1); 
$worksheet ->write(1,21, '',$titleFormat1); 
$worksheet ->write(1,22, '',$titleFormat1); 
$worksheet ->write(1,23, '',$titleFormat1); 
$worksheet ->write(1,24, '',$titleFormat1); 
$worksheet ->write(1,25, '',$titleFormat1); 
$worksheet ->write(1,26, '',$titleFormat1);




$worksheet ->write(3,0, 'на  '.$sem.'  семестр '.$god.' учебный год',$titleFormat1); 
$worksheet ->write(3,1, '',$titleFormat1); 
$worksheet ->write(3,2, '',$titleFormat1); 
$worksheet ->write(3,3, '',$titleFormat1); 
$worksheet ->write(3,4, '',$titleFormat1); 
$worksheet ->write(3,5, '',$titleFormat1); 
$worksheet ->write(3,6, '',$titleFormat1); 
$worksheet ->write(3,7, '',$titleFormat1); 
$worksheet ->write(3,8, '',$titleFormat1); 
$worksheet ->write(3,9, '',$titleFormat1); 
$worksheet ->write(3,10, '',$titleFormat1); 
$worksheet ->write(3,11, '',$titleFormat1); 
$worksheet ->write(3,12, '',$titleFormat1); 
$worksheet ->write(3,13, '',$titleFormat1); 
$worksheet ->write(3,14, '',$titleFormat1); 
$worksheet ->write(3,15, '',$titleFormat1); 
$worksheet ->write(3,16, '',$titleFormat1); 
$worksheet ->write(3,17, '',$titleFormat1); 
$worksheet ->write(3,18, '',$titleFormat1); 
$worksheet ->write(3,19, '',$titleFormat1); 
$worksheet ->write(3,20, '',$titleFormat1); 
$worksheet ->write(3,21, '',$titleFormat1); 
$worksheet ->write(3,22, '',$titleFormat1); 
$worksheet ->write(3,23, '',$titleFormat1); 
$worksheet ->write(3,24, '',$titleFormat1); 
$worksheet ->write(3,25, '',$titleFormat1); 
$worksheet ->write(3,26, '',$titleFormat1); 




$worksheet ->write(5,0, 'Фамилия, Имя, Отчество',$titleFormat); 
$worksheet ->write(6,0, '',$titleFormat); 
$worksheet ->write(5,1, 'НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ',$titleFormat); 
$worksheet ->write(5,2, '',$titleFormat); 
$worksheet ->write(5,3, '',$titleFormat); 
$worksheet ->write(5,4, '',$titleFormat); 
$worksheet ->write(5,5, '',$titleFormat); 
$worksheet ->write(5,6, '',$titleFormat); 
$worksheet ->write(5,7, '',$titleFormat); 
$worksheet ->write(5,8, '',$titleFormat); 
$worksheet ->write(5,9, '',$titleFormat); 
$worksheet ->write(5,10,'' ,$titleFormat); 
$worksheet ->write(5,11,'',$titleFormat);
$worksheet ->write(5,12,'',$titleFormat); 
$worksheet ->write(5,13, 'Всего по учебному плану',$verticalformat); 
$worksheet ->write(6,13, '',$verticalformat);
$worksheet ->write(7,13, '',$verticalformat); 
$worksheet ->write(5,14, 'ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ',$titleFormat);  
$worksheet ->write(5,15, '',$titleFormat); 
$worksheet ->write(5,16, '',$titleFormat); 
$worksheet ->write(5,17, '',$titleFormat);
$worksheet ->write(5,18, '',$titleFormat); 
$worksheet ->write(5,19, '',$titleFormat);
$worksheet ->write(5,20, '',$titleFormat);
$worksheet ->write(5,21, 'ПРОЧИЕ ВИДЫ РАБОТ',$titleFormat); 
$worksheet ->write(5,22, '',$titleFormat); 
$worksheet ->write(5,23, '',$titleFormat); 
$worksheet ->write(5,24, '',$titleFormat);
$worksheet ->write(5,25, '',$titleFormat);
$worksheet ->write(5,26, 'Всего за семестр',$verticalformat); 


$worksheet ->write(6,0, 'Штатные',$titleFormat); 
$worksheet ->write(6,1, 'АУДИТОРНАЯ НАГРУЗКА',$titleFormat); 
$worksheet ->write(6,2, '',$titleFormat); 
$worksheet ->write(6,3, '',$titleFormat); 
$worksheet ->write(6,4, '',$titleFormat); 
$worksheet ->write(6,5, '',$titleFormat); 
$worksheet ->write(6,6, '',$titleFormat); 
$worksheet ->write(6,7, 'ВНЕАУДИТОРНАЯ НАГРУЗКА',$titleFormat); 
$worksheet ->write(6,8, '',$titleFormat); 
$worksheet ->write(6,9, '',$titleFormat); 
$worksheet ->write(6,10,'' ,$titleFormat); 
$worksheet ->write(6,11,'',$titleFormat);
$worksheet ->write(6,12,'',$titleFormat); 
$worksheet ->write(6,13, '',$titleFormat); 
$worksheet ->write(6,14, ' ',$titleFormat);
$worksheet ->write(6,15, '',$titleFormat); 
$worksheet ->write(6,16, '',$titleFormat);  
$worksheet ->write(6,17, '',$titleFormat); 
$worksheet ->write(6,18, '',$titleFormat); 
$worksheet ->write(6,19, '',$titleFormat);
$worksheet ->write(6,20, '',$titleFormat); 
$worksheet ->write(6,21, '  ',$titleFormat);
$worksheet ->write(6,22, '',$titleFormat);
$worksheet ->write(6,23, '',$titleFormat); 
$worksheet ->write(6,24, '',$titleFormat); 
$worksheet ->write(6,25, '',$titleFormat); 
$worksheet ->write(6,26, '',$titleFormat); 


$worksheet ->write(7,0, '',$titleFormat); 
$worksheet ->write(7,1, 'Лекции',$verticalformat); 
$worksheet ->write(7,2, 'Практические',$verticalformat); 
$worksheet ->write(7,3, 'Лабораторные',$verticalformat); 
$worksheet ->write(7,4, 'Всего',$verticalformat); 
$worksheet ->write(7,5, 'Зачёты, экзамены',$verticalformat); 
$worksheet ->write(7,6, 'Итого',$verticalformat); 
$worksheet ->write(7,7, 'Курсовой проект (раб.)',$verticalformat); 
$worksheet ->write(7,8, 'Дипломное проектирование',$verticalformat); 
$worksheet ->write(7,9, 'УНИРС',$verticalformat); 
$worksheet ->write(7,10,'Учебная практика' ,$verticalformat); 
$worksheet ->write(7,11,'Производственная практика',$verticalformat);
$worksheet ->write(7,12,'Всего',$verticalformat); 
$worksheet ->write(7,13, '',$titleFormat); 
$worksheet ->write(7,14, 'Консультации',$verticalformat);
$worksheet ->write(7,15, 'Проверка контр. работ',$verticalformat); 
$worksheet ->write(7,16, 'Работа в ГАК',$verticalformat);  
$worksheet ->write(7,17, 'Приём вступит. экзаменов',$verticalformat); 
$worksheet ->write(7,18, 'Руководство аспирантами',$verticalformat); 
$worksheet ->write(7,19, 'Руководство магистрами',$verticalformat);
$worksheet ->write(7,20, 'Всего',$verticalformat); 
$worksheet ->write(7,21, 'Факультативы',$verticalformat);
$worksheet ->write(7,22, 'Кураторство, руководство СНО',$verticalformat);
$worksheet ->write(7,23, 'ФПК преподавателей',$verticalformat); 
$worksheet ->write(7,24, 'Прочее',$verticalformat); 
$worksheet ->write(7,25, 'Всего',$verticalformat);
$worksheet ->write(7,26, '',$titleFormat);

$worksheet ->write(8,0, '1',$titleFormat); 
$worksheet ->write(8,1, '2',$titleFormat); 
$worksheet ->write(8,2, '3',$titleFormat); 
$worksheet ->write(8,3, '4',$titleFormat); 
$worksheet ->write(8,4, '5',$titleFormat); 
$worksheet ->write(8,5, '6',$titleFormat); 
$worksheet ->write(8,6, '7',$titleFormat); 
$worksheet ->write(8,7, '8',$titleFormat); 
$worksheet ->write(8,8, '9',$titleFormat); 
$worksheet ->write(8,9, '10',$titleFormat); 
$worksheet ->write(8,10,'11',$titleFormat); 
$worksheet ->write(8,11,'12',$titleFormat);
$worksheet ->write(8,12,'13',$titleFormat); 
$worksheet ->write(8,13, '14',$titleFormat); 
$worksheet ->write(8,14, '15',$titleFormat);
$worksheet ->write(8,15, '16',$titleFormat); 
$worksheet ->write(8,16, '17',$titleFormat);  
$worksheet ->write(8,17, '18',$titleFormat); 
$worksheet ->write(8,18, '19',$titleFormat); 
$worksheet ->write(8,19, '20',$titleFormat);
$worksheet ->write(8,20, '21',$titleFormat); 
$worksheet ->write(8,21, '22',$titleFormat);
$worksheet ->write(8,22, '23',$titleFormat);
$worksheet ->write(8,23, '24',$titleFormat); 
$worksheet ->write(8,24, '25',$titleFormat); 
$worksheet ->write(8,25, '26',$titleFormat);
$worksheet ->write(8,26, '27',$titleFormat);



$worksheet->setColumn(0,0,15);
$worksheet->setColumn(0,1,4);
$worksheet->setColumn(0,2,4);
$worksheet->setColumn(0,3,4);
$worksheet->setColumn(0,4,4);
$worksheet->setColumn(0,5,4);
$worksheet->setColumn(0,6,5);
$worksheet->setColumn(0,7,4);
$worksheet->setColumn(0,8,4);
$worksheet->setColumn(0,9,4);
$worksheet->setColumn(0,10,4);
$worksheet->setColumn(0,11,4);
$worksheet->setColumn(0,12,4);
$worksheet->setColumn(0,13,4);
$worksheet->setColumn(0,14,4);
$worksheet->setColumn(0,15,4);
$worksheet->setColumn(0,16,4);
$worksheet->setColumn(0,17,4);
$worksheet->setColumn(0,18,4);
$worksheet->setColumn(0,19,4);
$worksheet->setColumn(0,20,4);
$worksheet->setColumn(0,21,4);
$worksheet->setColumn(0,22,4);
$worksheet->setColumn(0,23,4);
$worksheet->setColumn(0,24,4);
$worksheet->setColumn(0,25,4);
$worksheet->setColumn(0,26,4);

$worksheet ->setMerge(5,0,6,0);
$worksheet ->setMerge(5,13,7,13);
//$worksheet ->setMerge(5,25,7,25);
$worksheet ->setMerge(5,26,7,26);
$worksheet ->setMerge(5,14,6,20);
//$worksheet ->setMerge(5,15,6,15);
//$worksheet ->setMerge(5,16,6,16);
//$worksheet ->setMerge(5,17,6,17);
//$worksheet ->setMerge(5,18,6,18);
//$worksheet ->setMerge(5,19,6,19);
//$worksheet ->setMerge(5,20,6,20);
$worksheet ->setMerge(5,21,6,25);
//$worksheet ->setMerge(5,22,6,22);
//$worksheet ->setMerge(5,23,6,23);
//$worksheet ->setMerge(5,24,6,24);
//$worksheet ->setMerge(3,13,4,13);



$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, ".
"N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, ".
"F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, STAT, DOL_SMALL ".
"FROM Z_PREPOD_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god' ". 
"ORDER BY STAT_ID, DOL_ID DESC, FIO";
$n=0;	 
$cur=ora_do($conn,$sql);
for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$FIO=ora_getcolumn($cur,0);
			$LECTIME=ora_getcolumn($cur,1);			
			$SEMTIME=ora_getcolumn($cur,2);
			$LABTIME=ora_getcolumn($cur,3);
			$VSEGO5=ora_getcolumn($cur,4);
			$EKZ_ZACH=ora_getcolumn($cur,5);
			$ITOGO7=ora_getcolumn($cur,6);
			$KPR=ora_getcolumn($cur,7);
			$N9=ora_getcolumn($cur,8);
			$N10=ora_getcolumn($cur,9);
			$N11=ora_getcolumn($cur,10);
			$N12=ora_getcolumn($cur,11);
			$VSEGO13=ora_getcolumn($cur,12);
			$VSEGOPLAN=ora_getcolumn($cur,13);
			$N15=ora_getcolumn($cur,14);
			$N16=ora_getcolumn($cur,15);
			$N17=ora_getcolumn($cur,16);
			$N18=ora_getcolumn($cur,17);
			$N19=ora_getcolumn($cur,18);
			$N20=ora_getcolumn($cur,19);
			$VSEGO21=ora_getcolumn($cur,20);
			$N22=ora_getcolumn($cur,21);
			$N23=ora_getcolumn($cur,22);
			$N24=ora_getcolumn($cur,23);
			$PRIM=ora_getcolumn($cur,24);
			$VSEGO25=ora_getcolumn($cur,25);
			$SEMESTR=ora_getcolumn($cur,26);
			$F2=ora_getcolumn($cur,27);
			$F3=ora_getcolumn($cur,28);
			$F4=ora_getcolumn($cur,29);
			$F_VSEGO5=ora_getcolumn($cur,30);
			$F6=ora_getcolumn($cur,31);
			$F_ITOGO7=ora_getcolumn($cur,32);
			$F8=ora_getcolumn($cur,33);
			$F9=ora_getcolumn($cur,34);
			$F10=ora_getcolumn($cur,35);
			$F11=ora_getcolumn($cur,36);
			$F12=ora_getcolumn($cur,37);
			$F_VSEGO13=ora_getcolumn($cur,38);
			$F_VSEGOPLAN=ora_getcolumn($cur,39);
			$F15=ora_getcolumn($cur,40);
			$F16=ora_getcolumn($cur,41);
			$F17=ora_getcolumn($cur,42);
			$F18=ora_getcolumn($cur,43);
			$F19=ora_getcolumn($cur,44);
			$F20=ora_getcolumn($cur,45);
			$F_VSEGO21=ora_getcolumn($cur,46);
			$F22=ora_getcolumn($cur,47);
			$F23=ora_getcolumn($cur,48);
			$F24=ora_getcolumn($cur,49);
			$FPRIM=ora_getcolumn($cur,50);
			$F_VSEGO25=ora_getcolumn($cur,51);
			$F_SEMESTR=ora_getcolumn($cur,52);
			$STAT=ora_getcolumn($cur,53);
			$DOL_SMALL=ora_getcolumn($cur,54);
			
			
			$n=$n+2;
			
			$worksheet->writeString($n+7,0, trim($FIO), $format);
			$worksheet->writeString($n+7,1, trim($LECTIME), $format);
			$worksheet->writeString($n+7,2, trim($SEMTIME), $format);
			$worksheet->writeString($n+7,3, trim($LABTIME), $format);
			$worksheet->writeString($n+7,4, trim($VSEGO5), $format);
			$worksheet->writeString($n+7,5, trim($EKZ_ZACH), $format);
			$worksheet->writeString($n+7,6, trim($ITOGO7), $format);
			$worksheet->writeString($n+7,7, trim($KPR), $format);
			$worksheet->writeString($n+7,8, trim($N9), $format);
			$worksheet->writeString($n+7,9, trim($N10), $format);
			$worksheet->writeString($n+7,10, trim($N11), $format);
			$worksheet->writeString($n+7,11, trim($N12), $format);
			$worksheet->writeString($n+7,12, trim($VSEGO13), $format);
			$worksheet->writeString($n+7,13, trim($VSEGOPLAN), $format);
			$worksheet->writeString($n+7,14, trim($N15), $format);
			$worksheet->writeString($n+7,15, trim($N16), $format);
			$worksheet->writeString($n+7,16, trim($N17), $format);
			$worksheet->writeString($n+7,17, trim($N18), $format);
			$worksheet->writeString($n+7,18, trim($N19), $format);
			$worksheet->writeString($n+7,19, trim($N20), $format);
			$worksheet->writeString($n+7,20, trim($VSEGO21), $format);
			$worksheet->writeString($n+7,21, trim($N22), $format);
			$worksheet->writeString($n+7,22, trim($N23), $format);
			$worksheet->writeString($n+7,23, trim($N24), $format);
			$worksheet->writeString($n+7,24, trim($PRIM), $format);
			$worksheet->writeString($n+7,25, trim($VSEGO25), $format);
			$worksheet->writeString($n+7,26, trim($SEMESTR), $format);
	
			$worksheet->writeString($n+8,0, trim(''), $format);
			$worksheet->writeString($n+8,1, trim($F2), $format);
			$worksheet->writeString($n+8,2, trim($F3), $format);
			$worksheet->writeString($n+8,3, trim($F4), $format);
			$worksheet->writeString($n+8,4, trim($F_VSEGO5), $format);
			$worksheet->writeString($n+8,5, trim($F6), $format);
			$worksheet->writeString($n+8,6, trim($F_ITOGO7), $format);
			$worksheet->writeString($n+8,7, trim($F8), $format);
			$worksheet->writeString($n+8,8, trim($F9), $format);
			$worksheet->writeString($n+8,9, trim($F10), $format);
			$worksheet->writeString($n+8,10, trim($F11), $format);
			$worksheet->writeString($n+8,11, trim($F12), $format);
			$worksheet->writeString($n+8,12, trim($F_VSEGO13), $format);
			$worksheet->writeString($n+8,13, trim($F_VSEGOPLAN), $format);
			$worksheet->writeString($n+8,14, trim($F15), $format);
			$worksheet->writeString($n+8,15, trim($F16), $format);
			$worksheet->writeString($n+8,16, trim($F17), $format);
			$worksheet->writeString($n+8,17, trim($F18), $format);
			$worksheet->writeString($n+8,18, trim($F19), $format);
			$worksheet->writeString($n+8,19, trim($F20), $format);
			$worksheet->writeString($n+8,20, trim($F_VSEGO21), $format);
			$worksheet->writeString($n+8,21, trim($F22), $format);
			$worksheet->writeString($n+8,22, trim($F23), $format);
			$worksheet->writeString($n+8,23, trim($F24), $format);
			$worksheet->writeString($n+8,24, trim($PRIM), $format);
			$worksheet->writeString($n+8,25, trim($F_VSEGO25), $format);
			$worksheet->writeString($n+8,26, trim($F_SEMESTR), $format);
			
			$worksheet ->setMerge($n+7,0,$n+8,0);
			
			ora_fetch($cur);	
			}	
			
$footerFormat =& $workbook->addFormat(); 
$footerFormat->setFontFamily('Helvetica'); 
$footerFormat->setSize('9'); 
$footerFormat->setColor('navy'); 
$footerFormat->setBold();
$footerFormat->setAlign('center'); 


		
			$d=date("d.m.Y H:i ");
			$zav_kaf="Зав. кафедрой  ";
			$hdate="$d";
			$i++;
			$worksheet->writeString($n+11,3, trim($zav_kaf), $footerFormat);
			$worksheet->writeString($n+11,15, trim($hdate), $footerFormat);
			/*$worksheet->writeString($i+3,4, "i12=".$i12, $footerFormat);
			$worksheet->writeString($i+3,5, "cli12=".$ci12, $footerFormat);*/
// Let's send the file
$workbook->close();
?>