<?
session_start();
//include ('query.php');
require_once 'Spreadsheet/Excel/Writer.php';


$fac=$_GET['fac'];
$kaf=$_GET["kaf"];

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('prepod.xls');

$titleFormat1 =& $workbook->addFormat(); 
$titleFormat1->setFontFamily('Helvetica'); 
$titleFormat1->setAlign('merge'); 
$titleFormat1->setSize('8'); 
$titleFormat1->setColor('navy'); 
$titleFormat1->setTextWrap(1); 

$format =& $workbook->addFormat();
$format->setNumFormat('@');
$format->setSize('8');
//$format->setAlign('merge'); 
$format->setHAlign('left');
$format->setTextWrap(1); 

//$worksheet->setColumn(6,0,4);

//$worksheet ->setMerge(0,0,7,0);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


$sql="SELECT KAF FROM V_SPI_KAFEDR WHERE DIVID=$kaf";
$cur=ora_do($conn,$sql);
$kaf_name=ora_getcolumn($cur,0);

$worksheet =& $workbook->addWorksheet($grocode);


$worksheet ->write(0,0, 'Российский Государственный Университет нефти и газа им. И.М. Губкина',$titleFormat1); 
			$worksheet ->write(0,1, '',$titleFormat1); 
			$worksheet ->write(0,2, '',$titleFormat1); 
			$worksheet ->write(0,3, '',$titleFormat1); 
			$worksheet ->write(0,4, '',$titleFormat1); 
			$worksheet ->write(0,5, '',$titleFormat1);  
			

			$worksheet ->write(3,0, 'Кафедра '.$kaf_name,$titleFormat1); 
			$worksheet ->write(3,1, '',$titleFormat1); 
			$worksheet ->write(3,2, '',$titleFormat1); 
			$worksheet ->write(3,3, '',$titleFormat1); 
			$worksheet ->write(3,4, '',$titleFormat1); 
			$worksheet ->write(3,5, '',$titleFormat1); 
			
			$worksheet ->write(6,0, '',$titleFormat1); 
			$worksheet ->write(6,1, 'ФИО',$titleFormat1); 
			$worksheet ->write(6,2, 'Должность',$titleFormat1); 
			$worksheet ->write(6,3, 'Степень',$titleFormat1); 
			$worksheet ->write(6,4, 'Звание',$titleFormat1); 
			$worksheet ->write(6,5, 'Категория',$titleFormat1); 
			$worksheet ->write(6,6, 'Ставка',$titleFormat1); 
			
			$worksheet->setColumn(0,0,3);
			$worksheet->setColumn(0,1,28);
			$worksheet->setColumn(0,2,15);
			$worksheet->setColumn(0,3,7);
			$worksheet->setColumn(0,4,10);
			$worksheet->setColumn(0,5,12);
			$worksheet->setColumn(0,6,6);
			//$worksheet ->setMerge(6,1,6,2);
$cur=0;

//$worksheet->setColumn(6,0,4);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

if ($kaf!='0')
 $sql="SELECT FIO_PREPOD,DOL,STEPEN,ZVAN,STAT,STAVKA,ZAVKAF FROM V_SPI_PREPOD WHERE DIVID=$kaf ORDER BY FIO_PREPOD";
 else 
 $sql="SELECT FIO_PREPOD,DOL,STEPEN,ZVAN,STAT,STAVKA,ZAVKAF FROM V_SPI_PREPOD WHERE FACID=$fac ORDER BY FIO_PREPOD";

$j=1;
$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
		//$worksheet ->write(j,j, 'Российский Государственный Университет нефти и газа им. И.М. Губкина',$titleFormat1); 
			
			//$fio = ora_getcolumn($cur,0);
			$fio=ora_getcolumn($cur,0);
			$dol=ora_getcolumn($cur,1);
			$step=ora_getcolumn($cur,2);
			$zvan=ora_getcolumn($cur,3);
			$stat=ora_getcolumn($cur,4);
			$stavka=ora_getcolumn($cur,5);
			$zav=ora_getcolumn($cur,6);
			
			$worksheet ->write($j+8,0, $j,$format); 
			$worksheet ->write($j+8,1, $fio,$format); 
			if ($zav=="")
				$worksheet ->write($j+8,2, $dol,$format); 
			else
				$worksheet ->write($j+8,2, $dol.", ".$zav,$format);
			$worksheet ->write($j+8,3, $step,$format); 
			$worksheet ->write($j+8,4, $zvan,$format); 
			$worksheet ->write($j+8,5, $stat,$format); 
			$worksheet ->write($j+8,6, $stavka,$format); 
				
			$j=$j+1;
												
		ora_fetch($cur);
		}

// Let's send the file
$workbook->close();
 ?>