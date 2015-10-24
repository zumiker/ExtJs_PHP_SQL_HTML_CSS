<?php
require_once 'Spreadsheet/Excel/Writer.php';


// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();
$kaf=$_GET['kaf'];
$god=$_GET['god'];
$sem=$_GET['sem'];

if($sem=='01.09.')
$sem='Осенний';
else
$sem='Весенний';

$god=$god.'/'.($god+1);

if ($sem=='Весенний')
	$zagod=1;
else
	$zagod=0;

$worksheet =& $workbook->addWorksheet('Штат');

$worksheet->setMargins_LR(0);
$worksheet->setMargins_TB(0);
$worksheet->setLandscape();

$sheetTitleFormat =& $workbook->addFormat(array('bold'=>1,'size'=>10));
$sheetTitleFormat->setAlign('center'); 
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
$titleFormat->setBold();
$titleFormat->setVAlign('vcenter');
//$titleFormat->setFgColor('silver');


$format =& $workbook->addFormat();
$format->setFontFamily('Helvetica'); 
$format->setAlign('center'); 
$format->setSize('8');
$format->setTop(1); 
$format->setBottom(1); 
$format->setLeft(1); 
$format->setRight(1);
$format->setTextWrap(1);

$format_grey =& $workbook->addFormat();
$format_grey->setFontFamily('Helvetica'); 
$format_grey->setAlign('center'); 
$format_grey->setSize('8');
$format_grey->setTop(1); 
$format_grey->setBottom(1); 
$format_grey->setLeft(1); 
$format_grey->setRight(1);
$format_grey->setTextWrap(1);
$workbook->setCustomColor(12, 255, 255, 153);
$format_grey->setFgColor(12);

$format_bold =& $workbook->addFormat();
$format_bold->setFontFamily('Helvetica'); 
$format_bold->setAlign('center'); 
$format_bold->setSize('8');
$format_bold->setTop(1); 
$format_bold->setBottom(1); 
$format_bold->setLeft(1); 
$format_bold->setRight(1);
$format_bold->setTextWrap(1);
$format_bold->setBold();

$format_grey_bold =& $workbook->addFormat();
$format_grey_bold->setFontFamily('Helvetica'); 
$format_grey_bold->setAlign('center'); 
$format_grey_bold->setSize('8');
$format_grey_bold->setTop(1); 
$format_grey_bold->setBottom(1); 
$format_grey_bold->setLeft(1); 
$format_grey_bold->setRight(1);
$format_grey_bold->setTextWrap(1);
$workbook->setCustomColor(12, 255, 255, 153);
$format_grey_bold->setFgColor(12);
$format_grey_bold->setBold();

$format_itog =& $workbook->addFormat();
$format_itog->setFontFamily('Helvetica'); 
$format_itog->setAlign('center'); 
$format_itog->setSize('8');
$format_itog->setTop(1); 
$format_itog->setBottom(1); 
$format_itog->setLeft(1); 
$format_itog->setRight(1);
$format_itog->setTextWrap(1);
$format_itog->setFgColor('silver');

$format_itog_bold =& $workbook->addFormat();
$format_itog_bold->setFontFamily('Helvetica'); 
$format_itog_bold->setAlign('center'); 
$format_itog_bold->setSize('8');
$format_itog_bold->setTop(1); 
$format_itog_bold->setBottom(1); 
$format_itog_bold->setLeft(1); 
$format_itog_bold->setRight(1);
$format_itog_bold->setTextWrap(1);
$format_itog_bold->setBold();
$format_itog_bold->setFgColor('silver');


$format_red =& $workbook->addFormat();
$format_red->setFontFamily('Helvetica'); 
$format_red->setAlign('center'); 
$format_red->setSize('8');
$format_red->setTop(1); 
$format_red->setBottom(1); 
$format_red->setLeft(1); 
$format_red->setRight(1);
$format_red->setTextWrap(1);
$format_red->setBold();
$format_red->setColor('red');
$format_red->setFgColor('silver');

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

$worksheet->setColumn(0,0,13);
$worksheet->setColumn(0,1,4);
$worksheet->setColumn(0,2,4);
$worksheet->setColumn(0,3,4);
$worksheet->setColumn(0,4,4);
$worksheet->setColumn(0,5,4);
$worksheet->setColumn(0,6,4);
$worksheet->setColumn(0,7,4);
$worksheet->setColumn(0,8,4);
$worksheet->setColumn(0,9,4);
$worksheet->setColumn(0,10,4);
$worksheet->setColumn(0,11,4);
$worksheet->setColumn(0,12,4);
$worksheet->setColumn(0,13,5);
$worksheet->setColumn(0,14,5);
$worksheet->setColumn(0,15,4);
$worksheet->setColumn(0,16,3);
$worksheet->setColumn(0,17,3);
$worksheet->setColumn(0,18,3);
$worksheet->setColumn(0,19,3);
$worksheet->setColumn(0,20,4);
$worksheet->setColumn(0,21,3);
$worksheet->setColumn(0,22,3);
$worksheet->setColumn(0,23,3);
$worksheet->setColumn(0,24,3);
$worksheet->setColumn(0,25,3);
$worksheet->setColumn(0,26,5);
$worksheet->setColumn(0,27,5);

$n=0;



$sql="SELECT UPPER(SPRING_AUTUMN), YEAR_GROCODE, DIVABBREVIATE ".
	 "FROM TEMP_PREPOD_NAGRUZKA WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god'";
$cur=ora_do($conn,$sql);

$SPRING_AUTUMN=ora_getcolumn($cur,0);
$YEAR=ora_getcolumn($cur,1);	
$DIVABBREVIATE=ora_getcolumn($cur,2);			
ora_fetch($cur);

$sql="SELECT FAC ".
	 "FROM FACULTY WHERE FACID='$fac'";
$cur=ora_do($conn,$sql);
$FACULTY=ora_getcolumn($cur,0);
ora_fetch($cur);


$worksheet ->write($n,0, 'УМУ, отдел АСУ',$titleFormat1);
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, 'Российский Государственный Университет нефти и газа имени И.М. Губкина',$titleFormat1); 
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
$worksheet ->write($n,13, '',$titleFormat1); 
$worksheet ->write($n,14, '',$titleFormat1); 
$worksheet ->write($n,15, '',$titleFormat1); 
$worksheet ->write($n,16, '',$titleFormat1); 
$worksheet ->write($n,17, '',$titleFormat1); 
$worksheet ->write($n,18, '',$titleFormat1); 
$worksheet ->write($n,19, '',$titleFormat1); 
$worksheet ->write($n,20, '',$titleFormat1); 
$worksheet ->write($n,21, '',$titleFormat1); 
$worksheet ->write($n,22, '',$titleFormat1); 
$worksheet ->write($n,23, '',$titleFormat1); 
$worksheet ->write($n,24, '',$titleFormat1); 
$worksheet ->write($n,25, '',$titleFormat1); 
$worksheet ->write($n,26, '',$titleFormat1); 


$n++;
$worksheet ->write($n,0, date("d.m.Y"),$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, 'Учебная нагрузка преподавателей факультета '.$FACULTY,$titleFormat1); 
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
$worksheet ->write($n,13, '',$titleFormat1); 
$worksheet ->write($n,14, '',$titleFormat1); 
$worksheet ->write($n,15, '',$titleFormat1); 
$worksheet ->write($n,16, '',$titleFormat1); 
$worksheet ->write($n,17, '',$titleFormat1); 
$worksheet ->write($n,18, '',$titleFormat1); 
$worksheet ->write($n,19, '',$titleFormat1); 
$worksheet ->write($n,20, '',$titleFormat1); 
$worksheet ->write($n,21, '',$titleFormat1); 
$worksheet ->write($n,22, '',$titleFormat1); 
$worksheet ->write($n,23, '',$titleFormat1); 
$worksheet ->write($n,24, '',$titleFormat1); 
$worksheet ->write($n,25, '',$titleFormat1); 
$worksheet ->write($n,26, '',$titleFormat1);

$n+=2;

$worksheet ->write($n,0, 'на  '.$sem.'  семестр '.$god.' учебный год',$titleFormat1); 
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
$worksheet ->write($n,13, '',$titleFormat1); 
$worksheet ->write($n,14, '',$titleFormat1); 
$worksheet ->write($n,15, '',$titleFormat1); 
$worksheet ->write($n,16, '',$titleFormat1); 
$worksheet ->write($n,17, '',$titleFormat1); 
$worksheet ->write($n,18, '',$titleFormat1); 
$worksheet ->write($n,19, '',$titleFormat1); 
$worksheet ->write($n,20, '',$titleFormat1); 
$worksheet ->write($n,21, '',$titleFormat1); 
$worksheet ->write($n,22, '',$titleFormat1); 
$worksheet ->write($n,23, '',$titleFormat1); 
$worksheet ->write($n,24, '',$titleFormat1); 
$worksheet ->write($n,25, '',$titleFormat1); 
$worksheet ->write($n,26, '',$titleFormat1); 
if($zagod==1)$worksheet ->write($n,27, '',$titleFormat1);

$n+=2;



$worksheet ->write($n,0, 'Штатные',$titleFormat); 
//$worksheet ->write($n+1,0, '',$titleFormat); 
$worksheet ->write($n,1, 'НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ',$titleFormat); 
$worksheet ->write($n,2, '',$titleFormat); 
$worksheet ->write($n,3, '',$titleFormat); 
$worksheet ->write($n,4, '',$titleFormat); 
$worksheet ->write($n,5, '',$titleFormat); 
$worksheet ->write($n,6, '',$titleFormat); 
$worksheet ->write($n,7, '',$titleFormat); 
$worksheet ->write($n,8, '',$titleFormat); 
$worksheet ->write($n,9, '',$titleFormat); 
$worksheet ->write($n,10,'' ,$titleFormat); 
$worksheet ->write($n,11,'',$titleFormat);
$worksheet ->write($n,12,'',$titleFormat); 
$worksheet ->write($n,13, 'Всего по учебному плану',$verticalformat); 
$worksheet ->write($n+1,13, '',$verticalformat);
$worksheet ->write($n+2,13, '',$verticalformat); 
$worksheet ->write($n,14, 'ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ',$titleFormat);  
$worksheet ->write($n,15, '',$titleFormat); 
$worksheet ->write($n,16, '',$titleFormat); 
$worksheet ->write($n,17, '',$titleFormat);
$worksheet ->write($n,18, '',$titleFormat); 
$worksheet ->write($n,19, '',$titleFormat);
$worksheet ->write($n,20, '',$titleFormat);
$worksheet ->write($n,21, 'ПРОЧИЕ ВИДЫ РАБОТ',$titleFormat); 
$worksheet ->write($n,22, '',$titleFormat); 
$worksheet ->write($n,23, '',$titleFormat); 
$worksheet ->write($n,24, '',$titleFormat);
$worksheet ->write($n,25, '',$titleFormat);
$worksheet ->write($n,26, 'Всего за семестр',$verticalformat); 
	if($zagod==1)
	{
		$worksheet ->write($n,27, 'Всего за год',$verticalformat);
		$worksheet ->write($n+1,27, '',$verticalformat);
		$worksheet ->write($n+2,27, '',$verticalformat);
		
	}  

$worksheet ->setMerge($n,0,$n+1,0);
$worksheet ->setMerge($n,13,$n+2,13);
//$worksheet ->setMerge(5,25,7,25);
if($zagod==1)$worksheet ->setMerge($n,27,$n+2,27);
$worksheet ->setMerge($n,26,$n+2,26);
$worksheet ->setMerge($n,14,$n+1,20);

$worksheet ->setMerge($n,21,$n+1,25);


$n++;
$worksheet ->write($n,0, 'Штатные',$titleFormat); 
$worksheet ->write($n,1, 'АУДИТОРНАЯ НАГРУЗКА',$titleFormat); 
$worksheet ->write($n,2, '',$titleFormat); 
$worksheet ->write($n,3, '',$titleFormat); 
$worksheet ->write($n,4, '',$titleFormat); 
$worksheet ->write($n,5, '',$titleFormat); 
$worksheet ->write($n,6, '',$titleFormat); 
$worksheet ->write($n,7, 'ВНЕАУДИТОРНАЯ НАГРУЗКА',$titleFormat); 
$worksheet ->write($n,8, '',$titleFormat); 
$worksheet ->write($n,9, '',$titleFormat); 
$worksheet ->write($n,10,'' ,$titleFormat); 
$worksheet ->write($n,11,'',$titleFormat);
$worksheet ->write($n,12,'',$titleFormat); 
//$worksheet ->write($n,13, '',$titleFormat); 
$worksheet ->write($n,14, '',$titleFormat);
$worksheet ->write($n,15, '',$titleFormat); 
$worksheet ->write($n,16, '',$titleFormat);  
$worksheet ->write($n,17, '',$titleFormat); 
$worksheet ->write($n,18, '',$titleFormat); 
$worksheet ->write($n,19, '',$titleFormat);
$worksheet ->write($n,20, '',$titleFormat); 
$worksheet ->write($n,21, '',$titleFormat);
$worksheet ->write($n,22, '',$titleFormat);
$worksheet ->write($n,23, '',$titleFormat); 
$worksheet ->write($n,24, '',$titleFormat); 
$worksheet ->write($n,25, '',$titleFormat); 
$worksheet ->write($n,26, '',$titleFormat); 
	if($zagod==1)$worksheet ->write($n,27, '',$titleFormat);  
$n++;
$worksheet ->write($n,0, 'Штатные',$titleFormat); 
$worksheet ->write($n,1, 'Лекции',$verticalformat); 
$worksheet ->write($n,2, 'Практические',$verticalformat); 
$worksheet ->write($n,3, 'Лабораторные',$verticalformat); 
$worksheet ->write($n,4, 'Всего',$verticalformat); 
$worksheet ->write($n,5, 'Зачёты, экзамены',$verticalformat); 
$worksheet ->write($n,6, 'Итого',$verticalformat); 
$worksheet ->write($n,7, 'Курсовой проект (раб.)',$verticalformat); 
$worksheet ->write($n,8, 'Дипломное проектирование',$verticalformat); 
$worksheet ->write($n,9, 'УНИРС',$verticalformat); 
$worksheet ->write($n,10,'Учебная практика' ,$verticalformat); 
$worksheet ->write($n,11,'Производственная практика',$verticalformat);
$worksheet ->write($n,12,'Всего',$verticalformat); 
//$worksheet ->write($n,13, '',$titleFormat); 
$worksheet ->write($n,14, 'Консультации',$verticalformat);
$worksheet ->write($n,15, 'Проверка контр. работ',$verticalformat); 
$worksheet ->write($n,16, 'Работа в ГАК',$verticalformat);  
$worksheet ->write($n,17, 'Приём вступит. экзаменов',$verticalformat); 
$worksheet ->write($n,18, 'Руководство аспирантами',$verticalformat); 
$worksheet ->write($n,19, 'Руководство магистрами',$verticalformat);
$worksheet ->write($n,20, 'Всего',$verticalformat); 
$worksheet ->write($n,21, 'Факультативы',$verticalformat);
$worksheet ->write($n,22, 'Кураторство, руководство СНО',$verticalformat);
$worksheet ->write($n,23, 'ФПК преподавателей',$verticalformat); 
$worksheet ->write($n,24, 'Прочее',$verticalformat); 
$worksheet ->write($n,25, 'Всего',$verticalformat);
$worksheet ->write($n,26, '',$titleFormat);
	if($zagod==1)$worksheet ->write($n,27, 'Всего за год',$verticalformat);
$n++;
$worksheet ->write($n,0, '1',$titleFormat); 
$worksheet ->write($n,1, '2',$titleFormat); 
$worksheet ->write($n,2, '3',$titleFormat); 
$worksheet ->write($n,3, '4',$titleFormat); 
$worksheet ->write($n,4, '5',$titleFormat); 
$worksheet ->write($n,5, '6',$titleFormat); 
$worksheet ->write($n,6, '7',$titleFormat); 
$worksheet ->write($n,7, '8',$titleFormat); 
$worksheet ->write($n,8, '9',$titleFormat); 
$worksheet ->write($n,9, '10',$titleFormat); 
$worksheet ->write($n,10,'11',$titleFormat); 
$worksheet ->write($n,11,'12',$titleFormat);
$worksheet ->write($n,12,'13',$titleFormat); 
$worksheet ->write($n,13, '14',$titleFormat); 
$worksheet ->write($n,14, '15',$titleFormat);
$worksheet ->write($n,15, '16',$titleFormat); 
$worksheet ->write($n,16, '17',$titleFormat);  
$worksheet ->write($n,17, '18',$titleFormat); 
$worksheet ->write($n,18, '19',$titleFormat); 
$worksheet ->write($n,19, '20',$titleFormat);
$worksheet ->write($n,20, '21',$titleFormat); 
$worksheet ->write($n,21, '22',$titleFormat);
$worksheet ->write($n,22, '23',$titleFormat);
$worksheet ->write($n,23, '24',$titleFormat); 
$worksheet ->write($n,24, '25',$titleFormat); 
$worksheet ->write($n,25, '26',$titleFormat);
$worksheet ->write($n,26, '27',$titleFormat);
	if($zagod==1)$worksheet ->write($n,27, '28',$titleFormat);


$n++;

$sum=array();	
$sum_f=array();

////kafedra goes here
$sql="SELECT DIVID,DIVABBREVIATE FROM V_SPI_KAFEDR WHERE FACID=$fac ORDER BY DIVABBREVIATE";
$cur1=ora_do($conn,$sql);
for ($i=0;$i<ora_numrows($cur1);$i++)
{
$kaf=ora_getcolumn($cur1,0);
$kaf_name=ora_getcolumn($cur1,1);

 		$where = "WHERE DIVID='$kaf' AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god' AND FOR_SORT=1";
 	if (!ora_numrows($cur1))
		$kaf_name="ИТОГО:";		

	if($zagod==1)$sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
		   	sum(f_SEMESTR)f_SEMESTR
		 	from temp_semestr_kategor
		 	WHERE  DIVID='$kaf' AND YEAR_GROCODE='$god' AND FOR_SORT=1
		 	group  by  YEAR_GROCODE";
			
			
	$sql="select sum(LECTIME) LECTIME,  
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME, 
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH, 
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR, 
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12, 
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15, 
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20, 
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim, 
		  sum(vsego25)vsego25,
		  sum(SEMESTR)SEMESTR,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME, 
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH, 
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR, 
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15, 
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
		  sum(f_vsego25)  f_vsego25,
		  sum(f_SEMESTR)f_SEMESTR
		 from temp_semestr_kategor $where";
  
$cur=ora_do($conn,$sql);
			//

			$j=0;
			$LECTIME=ora_getcolumn($cur,1);		
			$sum[$j]+=$LECTIME; $j++;
			$SEMTIME=ora_getcolumn($cur,2);
			$sum[$j]+=$SEMTIME; $j++;
			$LABTIME=ora_getcolumn($cur,3);
			$sum[$j]+=$LABTIME; $j++;
			$VSEGO5=ora_getcolumn($cur,4);
			$sum[$j]+=$VSEGO5; $j++;
			$EKZ_ZACH=ora_getcolumn($cur,5);
			$sum[$j]+=$EKZ_ZACH; $j++;
			$ITOGO7=ora_getcolumn($cur,6);
			$sum[$j]+=$ITOGO7; $j++;
			$KPR=ora_getcolumn($cur,7);
			$sum[$j]+=$KPR; $j++;
			$N9=ora_getcolumn($cur,8);
			$sum[$j]+=$N9; $j++;
			$N10=ora_getcolumn($cur,9);
			$sum[$j]+=$N10; $j++;
			$N11=ora_getcolumn($cur,10);
			$sum[$j]+=$N11; $j++;
			$N12=ora_getcolumn($cur,11);
			$sum[$j]+=$N12; $j++;
			$VSEGO13=ora_getcolumn($cur,12);
			$sum[$j]+=$VSEGO13; $j++;
			$VSEGOPLAN=ora_getcolumn($cur,13);
			$sum[$j]+=$VSEGOPLAN; $j++;
			$N15=ora_getcolumn($cur,14);
			$sum[$j]+=$N15; $j++;
			$N16=ora_getcolumn($cur,15);
			$sum[$j]+=$N16; $j++;
			$N17=ora_getcolumn($cur,16);
			$sum[$j]+=$N17; $j++;
			$N18=ora_getcolumn($cur,17);
			$sum[$j]+=$N18; $j++;
			$N19=ora_getcolumn($cur,18);
			$sum[$j]+=$N19; $j++;
			$N20=ora_getcolumn($cur,19);
			$sum[$j]+=$N20; $j++;
			$VSEGO21=ora_getcolumn($cur,20);
			$sum[$j]+=$VSEGO21; $j++;
			$N22=ora_getcolumn($cur,21);
			$sum[$j]+=$N22; $j++;
			$N23=ora_getcolumn($cur,22);
			$sum[$j]+=$N23; $j++;
			$N24=ora_getcolumn($cur,23);
			$sum[$j]+=$N24; $j++;
			$PRIM=ora_getcolumn($cur,24);
			$sum[$j]+=$PRIM; $j++;
			$VSEGO25=ora_getcolumn($cur,25);
			$sum[$j]+=$VSEGO25; $j++;
			$SEMESTR=ora_getcolumn($cur,26);
			$sum[$j]+=$SEMESTR; $j=0;
			$F2=ora_getcolumn($cur,27);
			$sum_f[$j]+=$F2; $j++;
			$F3=ora_getcolumn($cur,28);
			$sum_f[$j]+=$F3; $j++;
			$F4=ora_getcolumn($cur,29);
			$sum_f[$j]+=$F4; $j++;
			$F_VSEGO5=ora_getcolumn($cur,30);
			$sum_f[$j]+=$F_VSEGO5; $j++;
			$F6=ora_getcolumn($cur,31);
			$sum_f[$j]+=$F6; $j++;
			$F_ITOGO7=ora_getcolumn($cur,32);
			$sum_f[$j]+=$F_ITOGO7; $j++;
			$F8=ora_getcolumn($cur,33);
			$sum_f[$j]+=$F8; $j++;
			$F9=ora_getcolumn($cur,34);
			$sum_f[$j]+=$F9; $j++;
			$F10=ora_getcolumn($cur,35);
			$sum_f[$j]+=$F10; $j++;
			$F11=ora_getcolumn($cur,36);
			$sum_f[$j]+=$F11; $j++;
			$F12=ora_getcolumn($cur,37);
			$sum_f[$j]+=$F12; $j++;
			$F_VSEGO13=ora_getcolumn($cur,38);
			$sum_f[$j]+=$F_VSEGO13; $j++;
			$F_VSEGOPLAN=ora_getcolumn($cur,39);
			$sum_f[$j]+=$F_VSEGOPLAN; $j++;
			$F15=ora_getcolumn($cur,40);
			$sum_f[$j]+=$F15; $j++;
			$F16=ora_getcolumn($cur,41);
			$sum_f[$j]+=$F16; $j++;
			$F17=ora_getcolumn($cur,42);
			$sum_f[$j]+=$F17; $j++;
			$F18=ora_getcolumn($cur,43);
			$sum_f[$j]+=$F18; $j++;
			$F19=ora_getcolumn($cur,44);
			$sum_f[$j]+=$F19; $j++;
			$F20=ora_getcolumn($cur,45);
			$sum_f[$j]+=$F20; $j++;
			$F_VSEGO21=ora_getcolumn($cur,46);
			$sum_f[$j]+=$F_VSEGO21; $j++;
			$F22=ora_getcolumn($cur,47);
			$sum_f[$j]+=$F22; $j++;
			$F23=ora_getcolumn($cur,48);
			$sum_f[$j]+=$F23; $j++;
			$F24=ora_getcolumn($cur,49);
			$sum_f[$j]+=$F24; $j++;
			$FPRIM=ora_getcolumn($cur,50);
			$sum_f[$j]+=$FPRIM; $j++;
			$F_VSEGO25=ora_getcolumn($cur,51);
			$sum_f[$j]+=$F_VSEGO25; $j++;
			$F_SEMESTR=ora_getcolumn($cur,52);
			$sum_f[$j]+=$F_SEMESTR; $j++;
		if($zagod==1){ 
					$cur2=ora_do($conn,$sql2);
					$vsegogod=ora_getcolumn($cur2,1); 
					$sum[$j]+=$vsegogod;
					$fvsegogod=ora_getcolumn($cur2,2);
					$sum_f[$j]+=$fvsegogod;  $j++;
					}    
	
			$worksheet->writeString($n,0, trim($kaf_name), $format);
			$worksheet->writeString($n,1, trim($LECTIME), $format);
			$worksheet->writeString($n,2, trim($SEMTIME), $format);
			$worksheet->writeString($n,3, trim($LABTIME), $format);
			$worksheet->writeString($n,4, trim($VSEGO5), $format_grey);
			$worksheet->writeString($n,5, trim($EKZ_ZACH), $format);
			$worksheet->writeString($n,6, trim($ITOGO7), $format_grey);
			$worksheet->writeString($n,7, trim($KPR), $format);
			$worksheet->writeString($n,8, trim($N9), $format);
			$worksheet->writeString($n,9, trim($N10), $format);
			$worksheet->writeString($n,10, trim($N11), $format);
			$worksheet->writeString($n,11, trim($N12), $format);
			$worksheet->writeString($n,12, trim($VSEGO13), $format_grey);
			$worksheet->writeString($n,13, trim($VSEGOPLAN), $format_itog);
			$worksheet->writeString($n,14, trim($N15), $format);
			$worksheet->writeString($n,15, trim($N16), $format);
			$worksheet->writeString($n,16, trim($N17), $format);
			$worksheet->writeString($n,17, trim($N18), $format);
			$worksheet->writeString($n,18, trim($N19), $format);
			$worksheet->writeString($n,19, trim($N20), $format);
			$worksheet->writeString($n,20, trim($VSEGO21), $format_grey);
			$worksheet->writeString($n,21, trim($N22), $format);
			$worksheet->writeString($n,22, trim($N23), $format);
			$worksheet->writeString($n,23, trim($N24), $format);
			$worksheet->writeString($n,24, trim($PRIM), $format);
			$worksheet->writeString($n,25, trim($VSEGO25), $format_grey);
			$worksheet->writeString($n,26, trim($SEMESTR), $format_itog);
			if($zagod==1)$worksheet->writeString($n,27, trim($vsegogod), $format_itog);
			
			$worksheet->writeString($n+1,0, trim(''), $format_bold);
			$worksheet->writeString($n+1,1, trim($F2), $format_bold);
			$worksheet->writeString($n+1,2, trim($F3), $format_bold);
			$worksheet->writeString($n+1,3, trim($F4), $format_bold);
			$worksheet->writeString($n+1,4, trim($F_VSEGO5), $format_grey_bold);
			$worksheet->writeString($n+1,5, trim($F6), $format_bold);
			$worksheet->writeString($n+1,6, trim($F_ITOGO7), $format_grey_bold);
			$worksheet->writeString($n+1,7, trim($F8), $format_bold);
			$worksheet->writeString($n+1,8, trim($F9), $format_bold);
			$worksheet->writeString($n+1,9, trim($F10), $format_bold);
			$worksheet->writeString($n+1,10, trim($F11), $format_bold);
			$worksheet->writeString($n+1,11, trim($F12), $format_bold);
			$worksheet->writeString($n+1,12, trim($F_VSEGO13), $format_grey_bold);
			$worksheet->writeString($n+1,13, trim($F_VSEGOPLAN), $format_itog_bold);
			$worksheet->writeString($n+1,14, trim($F15), $format_bold);
			$worksheet->writeString($n+1,15, trim($F16), $format_bold);
			$worksheet->writeString($n+1,16, trim($F17), $format_bold);
			$worksheet->writeString($n+1,17, trim($F18), $format_bold);
			$worksheet->writeString($n+1,18, trim($F19), $format_bold);
			$worksheet->writeString($n+1,19, trim($F20), $format_bold);
			$worksheet->writeString($n+1,20, trim($F_VSEGO21), $format_grey_bold);
			$worksheet->writeString($n+1,21, trim($F22), $format_bold);
			$worksheet->writeString($n+1,22, trim($F23), $format_bold);
			$worksheet->writeString($n+1,23, trim($F24), $format_bold);
			$worksheet->writeString($n+1,24, trim($FPRIM), $format_bold);
			$worksheet->writeString($n+1,25, trim($F_VSEGO25), $format_grey_bold);
			$worksheet->writeString($n+1,26, trim($F_SEMESTR), $format_itog_bold);
			if($zagod==1)$worksheet->writeString($n+1,27, trim($fvsegogod), $format_itog_bold);
			
			$worksheet ->setMerge($n,0,$n+1,0);
			$n=$n+2;
	ora_fetch($cur1);
}

$worksheet->writeString($n,0, "Итого:", $format_itog_bold);
  $worksheet->writeString($n+1,0, "Итого (факт):", $format_itog_bold);
 for ($j=0;$j<26;$j++)
 {
	$worksheet->writeString($n,$j+1, $sum[$j], $format_itog_bold);
	$worksheet->writeString($n+1,$j+1, $sum_f[$j], $format_itog_bold);
 }
 if($zagod==1)
 {
	$worksheet->writeString($n,27, $sum[26], $format_itog_bold);
	$worksheet->writeString($n+1,27, $sum_f[26], $format_itog_bold);
 }

$footerFormat =& $workbook->addFormat(); 
$footerFormat->setFontFamily('Helvetica'); 
$footerFormat->setSize('9'); 
$footerFormat->setColor('navy'); 
$footerFormat->setBold();
$footerFormat->setAlign('center'); 

			$n+=5;

?>
