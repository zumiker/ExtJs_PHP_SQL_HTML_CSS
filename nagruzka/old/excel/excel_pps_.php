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
$god_sled	= ( $god + 1 ) . '/' . ( $god + 2 );
$god		= $god . '/' . ( $god + 1 );

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

$sql = "select fac
		from faculty
		where facid='$fac'";
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

$n++;

$worksheet ->write($n,0, date("d.m.Y"),$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
if ($fac!=999)
	$worksheet ->write($n,2, 'Предложение по плановой численности ППС (без почас.) факультета '.$FACULTY,$titleFormat1); 
else
	$worksheet ->write($n,2, 'Предложение по плановой численности ППС (без почас.) ',$titleFormat1); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$worksheet ->write($n,11, '',$titleFormat1); 

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

	
if ($fac==999)
	$sql5="select facid, fac from V_SPI_FAC_GUM order by facid";
else
	$sql5="select facid, fac from V_SPI_FAC_GUM where facid='$fac'";
$cur5=ora_do($conn,$sql5);
$n=$n+2;

for ($j=0;$j<ora_numrows($cur5);$j++)
{
	$newfac	= ora_getcolumn($cur5,1);
	$fac1	= ora_getcolumn($cur5,0);
	$itog1=0;
	$itog2=0;
	$itog3=0;
	$itog4=0;
	$itog5=0;
	$itog6=0;
	$itog7=0;
	$itog8=0;
	$itog9=0;
	if ($fac1!=9 && $fac1!=11)
	{
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

		$n+=2;

		$worksheet ->setMerge($n,0,$n+1,0);
		$worksheet ->setMerge($n,1,$n+1,1);
		$worksheet ->setMerge($n,4,$n+1,4);
		$worksheet ->setMerge($n,5,$n+1,5);
		$worksheet ->setMerge($n,6,$n+1,6);
		$worksheet ->setMerge($n,7,$n+1,7);
		$worksheet ->setMerge($n,10,$n+1,10);
		$worksheet ->setMerge($n,11,$n+1,11);
		$worksheet ->setMerge($n,12,$n+1,12);
		//$worksheet ->setMerge(5,25,7,25);

		$worksheet ->write($n,0, 'Кафедры',$titleFormat); 
		$worksheet ->write($n,1, 'Планов. числ. ППС '.$god.' г.',$titleFormat); 
		$worksheet ->write($n,2, 'Числ. ППС '.$god.' г. (в ставках)',$titleFormat); 
		$worksheet ->write($n,3, '',$titleFormat); 
		$worksheet ->write($n,4, 'Общая нагр. (план) '.$god.' г.',$titleFormat); 
		$worksheet ->write($n,5, 'Общая нагр. (план) '.$god_sled.' г.',$titleFormat); 
		$worksheet ->write($n,6, 'Аудит. нагр. (план) '.$god.' г.',$titleFormat); 
		$worksheet ->write($n,7, 'Аудит. нагр. (план) '.$god_sled.' г.',$titleFormat); 
		$worksheet ->write($n,8, 'Расчёт численности',$titleFormat); 
		$worksheet ->write($n,9, '',$titleFormat); 
		$worksheet ->write($n,10, 'Факт. числ. на '.date("d.m.y"),$titleFormat); 
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
		$worksheet ->write($n,8, 'по общ. нагр.',$titleFormat); 
		$worksheet ->write($n,9, 'по ауд. нагр.',$titleFormat); 
		$worksheet ->write($n,10,'' ,$titleFormat); 
		$worksheet ->write($n,11,'' ,$titleFormat); 

		$n++;

		$worksheet->setColumn(0,0,20);
		$worksheet->setColumn(0,1,10);
		$worksheet->setColumn(0,2,10);
		$worksheet->setColumn(0,3,10);
		$worksheet->setColumn(0,4,10);
		$worksheet->setColumn(0,5,10);
		$worksheet->setColumn(0,6,10);
		$worksheet->setColumn(0,7,10);
		$worksheet->setColumn(0,8,8);
		$worksheet->setColumn(0,9,8);
		$worksheet->setColumn(0,10,10);
		$worksheet->setColumn(0,11,10);
		$n++;

		$sum=array();	
		$sum_f=array();

		$sql = "select divid,divabbreviate 
				from v_spi_kafedr 
				where facid='$fac1' 
				order by divabbreviate";
		$cur=ora_do($conn,$sql);

		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$kaf		= ora_getcolumn($cur,0);
			$kaf_name	= ora_getcolumn($cur,1);
			$worksheet	->writeString($n,0, trim($kaf_name), $format);
		 
			$sql1 = "select a.f_sem, b.sem, a.f_itog, b.itog, c.stavka_st, c.vsego_st
						from (
								select sum(f_semestr) as f_sem, sum(f_itogo7) as f_itog 
								from z_semestr_kategor 
								where for_sort<>3 
									and divid='$kaf' 
									and year_grocode='$god'
							) a,
							(
								select sum(semestr) as sem, sum(itogo7) as itog 
								from z_semestr_kategor 
								where for_sort<>3
									and divid='$kaf' 
									and year_grocode='$god_sled'
							) b,
							(
								select stat_id,stat,sum(sum_stavka) as stavka_st,sum(vsego) as vsego_st
								from z_prepod_umu 
								where divid='$kaf' 
									and stat_id = 1
								group by stat_id,stat
							) c";
			$cur1 = ora_do($conn,$sql1);

			$sql3 = "select d.stavka_sovm, d.vsego_sovm 
						from (
							select stat_id,stat,sum(sum_stavka) as stavka_sovm,sum(vsego) as vsego_sovm
							from z_prepod_umu 
							where divid='$kaf' 
								and stat_id = 2
							group by stat_id,stat
						) d";
			$cur3 = ora_do($conn,$sql3);

			$sql2 = "select e.stavka_sovm2, e.vsego_sovm2 
						from (
							select stat_id,stat,sum(sum_stavka) as stavka_sovm2,sum(vsego) as vsego_sovm2
							from z_prepod_umu 
							where divid='$kaf' 
								and stat_id = 4
							group by stat_id,stat
						) e";
			$cur2 = ora_do($conn,$sql2);

			$sql4 = "select nomrmativ 
						from division 
						where divid='$kaf'";
			$cur4 = ora_do($conn,$sql4);
			
			 $f_sem=ora_getcolumn($cur1,0);
			 $sem=ora_getcolumn($cur1,1);
			 $f_itog=ora_getcolumn($cur1,2);
			 $itog=ora_getcolumn($cur1,3);
			 $normativ=ora_getcolumn($cur4,0);
			 $chisl_obsch=$sem/900;
			 $chisl_aud=$itog/(35*$normativ);
			 $stavka_st=ora_getcolumn($cur1,4);
			 $vsego_st=ora_getcolumn($cur1,5);
			 
			 $stavka_sovm=ora_getcolumn($cur3,0);
			 $vsego_sovm=ora_getcolumn($cur3,1);
			 
			 $stavka_sovm2=ora_getcolumn($cur2,0);
			 $vsego_sovm2=ora_getcolumn($cur2,1);
			 
			 $stavka_sovm = $stavka_sovm + $stavka_sovm2;
			 $vsego_sovm = $vsego_sovm + $vsego_sovm2;
			 $stavka_vsego = $stavka_st + $stavka_sovm;
			 $vsego_vsego = $vsego_st + $vsego_sovm;
			 
			 $worksheet->writeString($n,2, trim($stavka_st).'/'.trim($stavka_sovm), $format);
			 $worksheet->writeString($n,3, trim($stavka_vsego), $format);
			 $worksheet->writeString($n,4, trim($f_sem), $format);
			 $worksheet->writeString($n,5, trim($sem), $format);
			 $worksheet->writeString($n,6, trim($f_itog), $format);
			 $worksheet->writeString($n,7, trim($itog), $format);
			 $worksheet->writeString($n,8, round(trim($chisl_obsch),2), $format);
			 $worksheet->writeString($n,9, round(trim($chisl_aud),2), $format);
			
			 $itog1=$itog1+$stavka_st;
			 $itog2=$itog2+$stavka_sovm;
			 $itog3=$itog3+$stavka_vsego;
			 $itog4=$itog4+$f_sem;
			 $itog5=$itog5+$sem;
			 $itog6=$itog6+$f_itog;
			 $itog7=$itog7+$itog;
			 $itog8=$itog8+$chisl_obsch;
			 $itog9=$itog9+$chisl_aud;
		 
			$n++;
			ora_fetch($cur);
		}
		$worksheet->writeString($n,0, 'Итого:', $format);
		$worksheet->writeString($n,2, trim($itog1).'/'.trim($itog2), $format);
		$worksheet->writeString($n,3, trim($itog3), $format);
		$worksheet->writeString($n,4, trim($itog4), $format);
		$worksheet->writeString($n,5, trim($itog5), $format);
		$worksheet->writeString($n,6, trim($itog6), $format);
		$worksheet->writeString($n,7, trim($itog7), $format);
		$worksheet->writeString($n,8, round(trim($itog8),2), $format);
		$worksheet->writeString($n,9, round(trim($itog9),2), $format);

		$n=$n+2;
		ora_fetch($cur5);
	}
//			$n+=4;
}
/*$worksheet->writeString($i+3,4, "i12=".$i12, $footerFormat);
$worksheet->writeString($i+3,5, "cli12=".$ci12, $footerFormat);*/
// Let's send the file
?>