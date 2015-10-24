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

if ($sem=='Весенний')
	$zagod=1;
else
	$zagod=0;
$god_sled=($god+1).'/'.($god+2);
$god=$god.'/'.($god+1);

// sending HTTP headers
//$workbook->send('nagruzka.xls');

// Creating a worksheet
  
$worksheet =& $workbook->addWorksheet('Без почас.');
$worksheet->setInputEncoding('UTF-8');

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



$n=0;

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

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

$n++;

$worksheet ->write($n,0, date("d.m.Y"),$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
if ($fac!=999)
	$worksheet ->write($n,2, 'Предложение по плановой численности ППС (без почасовиков) факультета '.$FACULTY,$titleFormat1); 
else
	$worksheet ->write($n,2, 'Предложение по плановой численности ППС (без почасовиков) ',$titleFormat1); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$worksheet ->write($n,11, date("d.m.y"),$titleFormat1); 

$n+=2;

$worksheet ->write($n,0, '',$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, 'на  '.$god_sled.' учебный год',$titleFormat1); 
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

if ($fac==999)
	$sql5="select facid, fac from V_SPI_FAC_GUM order by facid";
else
	$sql5="select facid, fac from V_SPI_FAC_GUM where facid='$fac'";
$cur5=ora_do($conn,$sql5);
$n=$n+2;

if ($fac==999)
	$worksheet ->write($n,2, 'факультет '.$newfac,$titleFormat1);
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
 
$n=$n+2;

	$worksheet ->setMerge($n,0,$n+1,0);
	$worksheet ->setMerge($n,1,$n+1,1);
	$worksheet ->setMerge($n,4,$n+1,4);
	$worksheet ->setMerge($n,5,$n+1,5);
	$worksheet ->setMerge($n,6,$n+1,6);
	$worksheet ->setMerge($n,7,$n+1,7);
	$worksheet ->setMerge($n,8,$n+1,8);
	//$worksheet ->setMerge($n,9,$n,10);
	//$worksheet ->setMerge($n,10,$n+1,10);
	$worksheet ->setMerge($n,11,$n+1,11);
	$worksheet ->setMerge($n,12,$n+1,12);
	//$worksheet ->setMerge($n,13,$n+1,13);
	
if ($fac==999)
	$worksheet ->write($n,0, 'Факультеты ',$titleFormat1);
else $worksheet ->write($n,0, 'Кафедры',$titleFormat); 
$worksheet ->write($n,1, 'Планов. числ. ППС '.$god.' г.',$titleFormat); 
$worksheet ->write($n,2, 'Факт. числ. ППС '.$god.' г. (в ставках)',$titleFormat); 
$worksheet ->write($n,3, '',$titleFormat); 
$worksheet ->write($n,4, 'Общая нагр. (план) '.$god.' г.',$titleFormat); 
$worksheet ->write($n,5, 'Общая нагр. (план) '.$god_sled.' г.',$titleFormat); 
$worksheet ->write($n,6, 'Аудит. нагр. (план) '.$god.' г.',$titleFormat); 
$worksheet ->write($n,7, 'Аудит. нагр. (план) '.$god_sled.' г.',$titleFormat); 
$worksheet ->write($n,8, 'Норматив нед. ауд. нагрузки',$titleFormat); 
$worksheet ->write($n,9, 'Расчёт численности',$titleFormat); 
$worksheet ->write($n,10, '',$titleFormat); 
//$worksheet ->write($n,10, 'Факт. числ. на '.date("d.m.y"),$titleFormat); 
$worksheet ->write($n,11,'Предл. по штатам ППС '.$god_sled.' г.',$titleFormat); 

$n++;

$worksheet ->write($n,0, 'Кафедры',$titleFormat); 
$worksheet ->write($n,1, '',$titleFormat); 
$worksheet ->write($n,2, 'шт./совм.',$titleFormat); 
$worksheet ->write($n,3, 'всего',$titleFormat); 
$worksheet ->write($n,4, '',$titleFormat); 
$worksheet ->write($n,5, '',$titleFormat); 
$worksheet ->write($n,6, '',$titleFormat); 
$worksheet ->write($n,7, '',$titleFormat); 
$worksheet ->write($n,8, '',$titleFormat); 
$worksheet ->write($n,9, 'по общ. нагр.',$titleFormat); 
$worksheet ->write($n,10, 'по ауд. нагр.',$titleFormat); 
$worksheet ->write($n,11,'' ,$titleFormat); 
//$worksheet ->write($n,11,'' ,$titleFormat); 

$n++;

$worksheet->setColumn(0,0,20);
$worksheet->setColumn(0,1,10);
$worksheet->setColumn(0,2,14);
$worksheet->setColumn(0,3,8);
$worksheet->setColumn(0,4,10);
$worksheet->setColumn(0,5,10);
$worksheet->setColumn(0,6,10);
$worksheet->setColumn(0,7,10);
$worksheet->setColumn(0,8,8);
$worksheet->setColumn(0,9,8);
$worksheet->setColumn(0,10,10);
$worksheet->setColumn(0,11,10);

for ($j=0;$j<ora_numrows($cur5);$j++)
{
$newfac=ora_getcolumn($cur5,1);
$fac1=ora_getcolumn($cur5,0);
$itog1=0;
$itog2=0;
$itog3=0;
$itog4=0;
$itog5=0;
$itog6=0;
$itog7=0;
$itog8=0;
$itog9=0;
$itog10=0;
if ($fac1!=9 && $fac1!=11)
{

//$n++;

$sum=array();	
$sum_f=array();

$sql="select divid,divabbreviate from v_spi_kafedr where facid='$fac1' order by divabbreviate";
$cur=ora_do($conn,$sql);

if ($fac!=999)
{
for ($i=0;$i<ora_numrows($cur);$i++)
{
 $kaf=ora_getcolumn($cur,0);
 $kaf_name = ora_getcolumn($cur,1);
 

	$sql1="SELECT A.SEM, B.SEM, A.ITOG, B.ITOG, C.STAVKA_ST, C.VSEGO_ST FROM 
	(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from z_semestr_kategor where  divid='$kaf' and year_grocode='$god' and for_sort<>3) A,
	(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from z_semestr_kategor where divid='$kaf' and year_grocode='$god_sled'  and for_sort<>3) B,
	(SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_ST,SUM(VSEGO) AS VSEGO_ST
	      from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 1 
	      group by stat_id,stat) C";
	$cur1=ora_do($conn,$sql1);
	
	$sql21="SELECT A.SEM, B.SEM, A.ITOG, B.ITOG, C.STAVKA_ST, C.VSEGO_ST FROM 
	(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from z_semestr_kategor where  divid='$kaf' and year_grocode='$god' ) A,
	(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from z_semestr_kategor where divid='$kaf' and year_grocode='$god_sled' ) B,
	(SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_ST,SUM(VSEGO) AS VSEGO_ST
	      from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 1 
	      group by stat_id,stat) C";
	$cur21=ora_do($conn,$sql21);
	
	 $sql3="SELECT D.STAVKA_SOVM, D.VSEGO_SOVM FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_SOVM,SUM(VSEGO) AS VSEGO_SOVM
	      from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 2
	      group by stat_id,stat) D";
	$cur3=ora_do($conn,$sql3);
	
	$sql2="select E.STAVKA_SOVM2, E.VSEGO_SOVM2 FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_SOVM2,SUM(VSEGO) AS VSEGO_SOVM2
	      from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 4
	      group by stat_id,stat) E";
	$cur2=ora_do($conn,$sql2);
	
	$sql6="select F.STAVKA_POCH, F.VSEGO_POCH FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_POCH,SUM(VSEGO) AS VSEGO_POCH
	      from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 3
	      group by stat_id,stat) F";
	$cur6=ora_do($conn,$sql6);
	
	$sql4="SELECT NOMRMATIV FROM DIVISION WHERE DIVID='$kaf'";
	$cur4=ora_do($conn,$sql4);
	
	$sql7="SELECT PPS FROM DIVISION_PPS WHERE DIVID='$kaf' AND YEAR_GROCODE='$god'";
	$cur7=ora_do($conn,$sql7);
	
	$plan_chisl=ora_getcolumn($cur7,0);
	/**/
	 $f_sem=ora_getcolumn($cur1,0);
	 $sem=ora_getcolumn($cur1,1);
	 $f_itog=ora_getcolumn($cur1,2);
	 $itog=ora_getcolumn($cur1,3);
	 $stavka_st=ora_getcolumn($cur1,4);
	 $vsego_st=ora_getcolumn($cur1,5);
	 $stavka_sovm=ora_getcolumn($cur3,0);
	 $vsego_sovm=ora_getcolumn($cur3,1);
	 
	 $stavka_st += $stavka_sovm;
	 $vsego_st += $vsego_sovm;
	 
	 $stavka_sovm2=ora_getcolumn($cur2,0);
	 $vsego_sovm2=ora_getcolumn($cur2,1);
	 
	 //$stavka_sovm = $stavka_sovm2;
	 //$vsego_sovm = $vsego_sovm2;
	 
	 $stavka_vsego = $stavka_st + $stavka_sovm2 ;//+ $stavka_pochas;
	 $vsego_vsego = $vsego_st + $vsego_sovm2;// + $vsego_pochas;
	 
	 $normativ=ora_getcolumn($cur4,0);
	 $chisl_obsch=$sem/900;
	 $chisl_aud=$itog/(35*$normativ);
	 
	 $stavka_pochas=ora_getcolumn($cur6,0);
	 $vsego_pochas=ora_getcolumn($cur6,1);
	 
	 $stavka_vsego_poch = $stavka_st + $stavka_sovm2 + $stavka_pochas;
	 $vsego_vsego_poch = $vsego_st + $vsego_sovm2 + $vsego_pochas;
	 
	 $f_sem2=ora_getcolumn($cur21,0);
	 $sem2=ora_getcolumn($cur21,1);
	 $f_itog2=ora_getcolumn($cur21,2);
	 $itog2=ora_getcolumn($cur21,3);
	 $stavka_st2=ora_getcolumn($cur21,4);
	 $vsego_st2=ora_getcolumn($cur21,5);
	 $chisl_obsch2=$sem2/900;
	 $chisl_aud2=$itog2/(35*$normativ);
	 
///////////////////////////////////////////////////////////////////////////
$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where DIVID   = '$kaf' 
        AND   STAT_ID in ( 1, 2 )";
$cur0 = ora_do($conn,$sql0);
$stavka_st_new			= ora_getcolumn( $cur0, 0 );

$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where DIVID   = '$kaf' 
        AND   STAT_ID in ( 4 )";
$cur0 = ora_do($conn,$sql0);
$stavka_sovm2_new		= ora_getcolumn( $cur0, 0 );

$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where DIVID   = '$kaf' 
        AND   STAT_ID in ( 1, 2, 4 )";
$cur0 = ora_do($conn,$sql0);
$stavka_st_vsego		= ora_getcolumn( $cur0, 0 );

$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where DIVID   = '$kaf' 
        AND   STAT_ID in ( 1, 2, 3, 4 )";
$cur0 = ora_do($conn,$sql0);
$stavka_st_vsego_posh	= ora_getcolumn( $cur0, 0 );
///////////////////////////////////////////////////////////////////////////
	 
	  $m=$k=$n+15;
	  /*	$worksheet ->write($k,2, 'С почасовиками',$titleFormat1);
		$worksheet ->write($k,3, '',$titleFormat1); 
		$worksheet ->write($k,4, '',$titleFormat1); 
		$worksheet ->write($k,5, '',$titleFormat1); 
		$worksheet ->write($k,6, '',$titleFormat1); 
		$worksheet ->write($k,7, '',$titleFormat1); 
		$worksheet ->write($k,8, '',$titleFormat1); 
		$worksheet ->write($k,9, '',$titleFormat1); 
		$worksheet ->write($k,10, '',$titleFormat1); 
		$worksheet ->write($k,11, '',$titleFormat1); 
		$worksheet ->write($k,12, '',$titleFormat1); 
		$k++;
	  */
	 if ($fac!=999)
	 {
		 $worksheet->writeString($n,0, trim($kaf_name), $format);
		 $worksheet->writeString($n,1, trim($plan_chisl), $format);
/*		 $worksheet->writeString($n,2, trim($stavka_st).' / '.trim($stavka_sovm2), $format);
		 $worksheet->writeString($n,3, trim($stavka_vsego), $format);*/
		 $worksheet->writeString($n,2, trim($stavka_st_new).' / '.trim($stavka_sovm2_new), $format);
		 $worksheet->writeString($n,3, trim($stavka_st_vsego), $format);
		 $worksheet->writeString($n,4, trim($f_sem), $format);
		 $worksheet->writeString($n,5, trim($sem), $format);
		 $worksheet->writeString($n,6, trim($f_itog), $format);
		 $worksheet->writeString($n,7, trim($itog), $format);
		 $worksheet->writeString($n,8, trim($normativ), $format);
		 $worksheet->writeString($n,9, round(trim($chisl_obsch)), $format);
		 $worksheet->writeString($n,10, round(trim($chisl_aud)), $format);
		 $worksheet->writeString($n,11, '', $format);
		 
		 //с почасовиками
		  $worksheet->writeString($k,0, trim($kaf_name), $format);
		 $worksheet->writeString($k,1, trim($plan_chisl), $format);
/*		 $worksheet->writeString($k,2, trim($stavka_st).' / '.trim($stavka_sovm2), $format);
		 $worksheet->writeString($k,3, trim($stavka_vsego_poch), $format);*/
		 $worksheet->writeString($k,2, trim($stavka_st_new).' / '.trim($stavka_sovm2_new), $format);
		 $worksheet->writeString($k,3, trim($stavka_st_vsego_posh), $format);
		 $worksheet->writeString($k,4, trim($f_sem2), $format);
		 $worksheet->writeString($k,5, trim($sem2), $format);
		 $worksheet->writeString($k,6, trim($f_itog2), $format);
		 $worksheet->writeString($k,7, trim($itog2), $format);
		 $worksheet->writeString($k,8, trim($normativ), $format);
		 $worksheet->writeString($k,9, round(trim($chisl_obsch2)), $format);
		 $worksheet->writeString($k,10, round(trim($chisl_aud2)), $format);
		 $worksheet->writeString($k,11, '', $format);
	 }
	 
	 $itog0=$itog0+$plan_chisl;
	 $itog1=$itog1+$stavka_st;
	 $itog2_poch=$itog2_poch+$stavka_sovm2;
	 $itog3=$itog3+$stavka_vsego;
	 $itog3_poch=$itog3+$stavka_vsego_poch;
	 $itog4=$itog4+$f_sem;
	 $itog5=$itog5+$sem;
	 $itog6=$itog6+$f_itog;
	 $itog7=$itog7+$itog;
	 $itog8=$itog8+$chisl_obsch;
	 $itog9=$itog9+$chisl_aud;
	 //$itog10=$itog10+$stavka_pochas;
 
///////////////////////////////////////////////////////////////////////////
$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where facid   = '$fac' 
        AND   STAT_ID in ( 1, 2 )";
$cur0 = ora_do($conn,$sql0);
$itog1		= ora_getcolumn( $cur0, 0 );

$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where facid   = '$fac' 
        AND   STAT_ID in ( 4 )";
$cur0 = ora_do($conn,$sql0);
$itog2		= ora_getcolumn( $cur0, 0 );

$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where facid   = '$fac' 
        AND   STAT_ID in ( 1, 2, 4 )";
$cur0 = ora_do($conn,$sql0);
$itog3		= ora_getcolumn( $cur0, 0 );

$sql0 = "SELECT sum( SUM_STAVKA ) 
        FROM  Z_PREPOD_UMU
        where facid   = '$fac' 
        AND   STAT_ID in ( 1, 2, 3, 4 )";
$cur0 = ora_do($conn,$sql0);
$itog3_poch	= ora_getcolumn( $cur0, 0 );
///////////////////////////////////////////////////////////////////////////

 if ($fac!=999) $n++;
 ora_fetch($cur);
 }
 }//$fac!=999
 
	$k=$n+15;
	
     if ($fac!=999)
	 {
		 $worksheet->writeString($n,0, 'Итого:', $format_bold);
		 $worksheet->writeString($n,1, trim($itog0), $format_bold);
//		 $worksheet->writeString($n,2, trim($itog1).' / '.trim($itog2_poch), $format_bold);	 
		 $worksheet->writeString($n,2, trim($itog1).' / '.trim($itog2), $format_bold);	 
		 $worksheet->writeString($n,3, trim($itog3), $format_bold);
		 $worksheet->writeString($n,4, trim($itog4), $format_bold);
		 $worksheet->writeString($n,5, trim($itog5), $format_bold);
		 $worksheet->writeString($n,6, trim($itog6), $format_bold);
		 $worksheet->writeString($n,7, trim($itog7), $format_bold);
		 $worksheet->writeString($n,8, '', $format_bold);
		 $worksheet->writeString($n,9, round(trim($itog8)), $format_bold);
		 $worksheet->writeString($n,10, round(trim($itog9)), $format_bold);
		 $worksheet->writeString($n,11, '', $format_bold);
		 
		 //с почасовиками
		 $worksheet->writeString($k,0, 'Итого:', $format_bold);
		 $worksheet->writeString($k,1, trim($itog0), $format_bold);
//		 $worksheet->writeString($k,2, trim($itog1).' / '.trim($itog2), $format_bold);	 
		 $worksheet->writeString($k,2, trim($itog1).' / '.trim($itog2), $format_bold);	 
		 $worksheet->writeString($k,3, trim($itog3_poch), $format_bold);
		 $worksheet->writeString($k,4, trim($itog4), $format_bold);
		 $worksheet->writeString($k,5, trim($itog5), $format_bold);
		 $worksheet->writeString($k,6, trim($itog6), $format_bold);
		 $worksheet->writeString($k,7, trim($itog7), $format_bold);
		 $worksheet->writeString($k,8, '', $format_bold);
		 $worksheet->writeString($k,9, round(trim($itog8)), $format_bold);
		 $worksheet->writeString($k,10, round(trim($itog9)), $format_bold);
		 $worksheet->writeString($k,11, '', $format_bold);
	  
	 }
	 
else //по университету
 {
		
	if ($fac1==0)	//выборка только по геологам, из временных соображений 
	{
		$sql10="SELECT A.SEM, B.SEM, A.ITOG, B.ITOG, C.STAVKA_ST, C.VSEGO_ST FROM 
		(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from z_semestr_kategor where  facid='$fac1' and year_grocode='$god') A,
		(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from z_semestr_kategor where facid='$fac1' and year_grocode='$god_sled') B,
		(SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_ST,SUM(VSEGO) AS VSEGO_ST
			  from Z_PREPOD_UMU WHERE facid='$fac1' AND STAT_ID = 1 
			  group by stat_id,stat) C";
		$cur10=ora_do($conn,$sql10);
		
		 $sql13="SELECT D.STAVKA_SOVM, D.VSEGO_SOVM FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_SOVM,SUM(VSEGO) AS VSEGO_SOVM
			  from Z_PREPOD_UMU WHERE facid='$fac1' AND STAT_ID = 2
			  group by stat_id,stat) D";
		$cur13=ora_do($conn,$sql13);
		
		$sql12="select E.STAVKA_SOVM2, E.VSEGO_SOVM2 FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_SOVM2,SUM(VSEGO) AS VSEGO_SOVM2
			  from Z_PREPOD_UMU WHERE facid='$fac1' AND STAT_ID = 4
			  group by stat_id,stat) E";
		$cur12=ora_do($conn,$sql12);
		
		$sql16="select F.STAVKA_POCH, F.VSEGO_POCH FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_POCH,SUM(VSEGO) AS VSEGO_POCH
			  from Z_PREPOD_UMU WHERE facid='$fac1' AND STAT_ID = 3
			  group by stat_id,stat) F";
		$cur16=ora_do($conn,$sql16);
		
		$sql14="SELECT NOMRMATIV FROM DIVISION WHERE facid='$fac1'";
		$cur14=ora_do($conn,$sql14);
		
		$sql17="SELECT PPS FROM DIVISION_PPS WHERE facid='$fac1' AND YEAR_GROCODE='$god'";
		$cur17=ora_do($conn,$sql17);
		
		$plan_chisl=ora_getcolumn($cur17,0);
		
		 $f_sem=ora_getcolumn($cur10,0);
		 $sem=ora_getcolumn($cur10,1);
		 $f_itog=ora_getcolumn($cur10,2);
		 $itog=ora_getcolumn($cur10,3);
		 $stavka_st=ora_getcolumn($cur10,4);
		 $vsego_st=ora_getcolumn($cur10,5);
		 $stavka_sovm=ora_getcolumn($cur13,0);
		 $vsego_sovm=ora_getcolumn($cur13,1);
		 
		 $stavka_st += $stavka_sovm;
		 $vsego_st += $vsego_sovm;
		 
		 $stavka_sovm2=ora_getcolumn($cur12,0);
		 $vsego_sovm2=ora_getcolumn($cur12,1);
		 
		 //$stavka_sovm = $stavka_sovm2;
		 //$vsego_sovm = $vsego_sovm2;
		 
		 $stavka_vsego = $stavka_st + $stavka_sovm2 ;//+ $stavka_pochas;
		 $vsego_vsego = $vsego_st + $vsego_sovm2;// + $vsego_pochas;
		 
		 $normativ=ora_getcolumn($cur14,0);
		 $chisl_obsch=$sem/900;
		 $chisl_aud=$itog/(35*$normativ);
		 
		 $stavka_pochas=ora_getcolumn($cur16,0);
		 $vsego_pochas=ora_getcolumn($cur16,1);
		 
		
		}
	 $itog0=$itog0+$plan_chisl;
	 $itog1=$itog1+$stavka_st;
	 $itog2=$itog2+$stavka_sovm2;
	 $itog3=$itog3+$stavka_vsego;
	 $itog4=$itog4+$f_sem;
	 $itog5=$itog5+$sem;
	 $itog6=$itog6+$f_itog;
	 $itog7=$itog7+$itog;
	 $itog8=$itog8+$chisl_obsch;
	 $itog9=$itog9+$chisl_aud;
	 
	
		
		 $worksheet->writeString($n,0, $newfac, $format_bold);
		 $worksheet->writeString($n,1, trim($itog0), $format_bold);
		 $worksheet->writeString($n,2, trim($itog1).' / '.trim($itog2), $format_bold);	 
		 $worksheet->writeString($n,3, trim($itog3), $format_bold);
		 $worksheet->writeString($n,4, trim($itog4), $format_bold);
		 $worksheet->writeString($n,5, trim($itog5), $format_bold);
		 $worksheet->writeString($n,6, trim($itog6), $format_bold);
		 $worksheet->writeString($n,7, trim($itog7), $format_bold);
		 $worksheet->writeString($n,8, '', $format_bold);
		 $worksheet->writeString($n,9, round(trim($itog8)), $format_bold);
		 $worksheet->writeString($n,10, round(trim($itog9)), $format_bold);
		 $worksheet->writeString($n,11, '', $format_bold);
		 
		 $un_itog0=$un_itog0+$itog0;
		 $un_itog1=$un_itog1+$itog1;
		 $un_itog2=$un_itog2+$itog2;
		 $un_itog3=$un_itog3+$itog3;
		 $un_itog4=$un_itog4+$itog4;
		 $un_itog5=$un_itog5+$itog5;
		 $un_itog6=$un_itog6+$itog6;
		 $un_itog7=$un_itog7+$itog7;
		 $un_itog8=$un_itog8+$itog8;
		 $un_itog9=$un_itog9+$itog9;
	 }
	 
 $n=$n+1;
ora_fetch($cur5);
}


}
	if ($fac==999) //итого по университету
	 {
		 $worksheet->writeString($n,0, 'Итого:', $format_bold);
		 $worksheet->writeString($n,1, trim($un_itog0), $format_bold);
		 $worksheet->writeString($n,2, trim($un_itog1).' / '.trim($itog2), $format_bold);	 
		 $worksheet->writeString($n,3, trim($un_itog3), $format_bold);
		 $worksheet->writeString($n,4, trim($un_itog4), $format_bold);
		 $worksheet->writeString($n,5, trim($un_itog5), $format_bold);
		 $worksheet->writeString($n,6, trim($un_itog6), $format_bold);
		 $worksheet->writeString($n,7, trim($un_itog7), $format_bold);
		 $worksheet->writeString($n,8, '', $format_bold);
		 $worksheet->writeString($n,9, '', $format_bold);
		 $worksheet->writeString($n,10, '', $format_bold);
		 $worksheet->writeString($n,11, '', $format_bold);
	 }		/*$worksheet->writeString($i+3,4, "i12=".$i12, $footerFormat);
			$worksheet->writeString($i+3,5, "cli12=".$ci12, $footerFormat);*/
// Let's send the file


?>
