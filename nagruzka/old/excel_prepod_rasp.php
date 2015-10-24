<?
session_start();
//include ('query.php');
require_once 'Spreadsheet/Excel/Writer.php';


$fac=$_GET["fac"];
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
$format->setTop(1); 
$format->setBottom(1); 
$format->setLeft(1); 
$format->setRight(1);

$formatcenter =& $workbook->addFormat();
$formatcenter->setNumFormat('@');
$formatcenter->setSize('8');
$formatcenter->setHAlign('center');
$formatcenter->setTextWrap(1);
$formatcenter->setTop(1); 
$formatcenter->setBottom(1); 
$formatcenter->setLeft(1); 
$formatcenter->setRight(1);

$formatcenterbold =& $workbook->addFormat();
$formatcenterbold->setNumFormat('@');
$formatcenterbold->setSize('8');
$formatcenterbold->setHAlign('center');
$formatcenterbold->setTextWrap(1);
$formatcenterbold->SetBold();  
$formatcenterbold->setTop(1); 
$formatcenterbold->setBottom(1); 
$formatcenterbold->setLeft(1); 
$formatcenterbold->setRight(1);

//$worksheet->setColumn(6,0,4);

//$worksheet ->setMerge(0,0,7,0);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


$sql="SELECT KAF FROM V_SPI_KAFEDR WHERE DIVID=$kaf";
$cur=ora_do($conn,$sql);
$kaf_name=ora_getcolumn($cur,0);

$sql2="SELECT FAC ".
	 "FROM FACULTY WHERE FACID='$fac'";
$cur=ora_do($conn,$sql2);
$FACULTY=ora_getcolumn($cur,0);

$worksheet =& $workbook->addWorksheet("prepod");


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
			

			if($fac!='999') $worksheet ->write(3,0, 'Факультет '.$FACULTY,$titleFormat1); 
			else $worksheet ->write(3,0, 'Уровень университета',$titleFormat1); 
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
			
			$worksheet ->write(6,0, '',$formatcenterbold); 
			$worksheet ->write(6,1, 'Категория',$formatcenterbold); 
			$worksheet ->write(6,2, 'Ставки',$formatcenterbold); 
			$worksheet ->write(6,3, 'Всего ставок',$formatcenterbold); 
			$worksheet ->write(6,4, 'Всего физ.лиц',$formatcenterbold); 
			$worksheet ->write(6,5, 'Проф.',$formatcenterbold); 
			$worksheet ->write(6,6, 'Доц.',$formatcenterbold); 
			$worksheet ->write(6,7, 'Ст.Преп.',$formatcenterbold); 
			$worksheet ->write(6,8, 'Преп.',$formatcenterbold); 
			$worksheet ->write(6,9, 'Асс.',$formatcenterbold); 
			$worksheet ->write(6,10, 'Примеч.',$formatcenterbold); 
			
			$worksheet->setColumn(0,0,3);
			$worksheet->setColumn(0,1,15);
			$worksheet->setColumn(0,2,6);
			$worksheet->setColumn(0,3,7);
			$worksheet->setColumn(0,4,7);
			$worksheet->setColumn(0,5,6);
			$worksheet->setColumn(0,6,6);
			$worksheet->setColumn(0,7,7);
			$worksheet->setColumn(0,8,6);
			$worksheet->setColumn(0,9,6);
			$worksheet->setColumn(0,10,8);
			//$worksheet ->setMerge(6,1,6,2);
$cur=0;

//$worksheet->setColumn(6,0,4);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

if($fac=='999')
{
	$sql="SELECT STAT_ID,STAT,BEZ,SUM(SUM_STAVKA),SUM(PROF),SUM(DOC),SUM(STAR),SUM(PREP),SUM(ASS),SUM(VSEGO),STAVKA 
	      from Z_PREPOD_UMU
	      group by stat_id,stat,bez,stavka  
	      order by stat_id,stat, stavka DESC";
	      //echo "<Center>Уровень университета";	      
}
else
{
	$sql="SELECT STAT_ID,STAT,BEZ,SUM(SUM_STAVKA),SUM(PROF),SUM(DOC),SUM(STAR),SUM(PREP),SUM(ASS),SUM(VSEGO),STAVKA
	      from Z_PREPOD_UMU
		  WHERE FACID='$fac'
	      group by stat_id,stat,bez,stavka 
	      order by stat_id,stat, stavka DESC";
}

$j=1;
$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
		//$worksheet ->write(j,j, 'Российский Государственный Университет нефти и газа имени И.М. Губкина',$titleFormat1); 
			
			$id = ora_getcolumn($cur,0);
			$STAT=ora_getcolumn($cur,1);
			/*$aSTAVKA+=*/$STAVKA=ora_getcolumn($cur,3);
			/*$aPROF+=*/$PROF=ora_getcolumn($cur,4);
			/*$aDOC+=*/$DOC=ora_getcolumn($cur,5);
			/*$aSTAR+=*/$STAR=ora_getcolumn($cur,6);
			/*$aPREP+=*/$PREP=ora_getcolumn($cur,7);
			/*$aASS+=*/$ASS=ora_getcolumn($cur,8);
			$PRIM=ora_getcolumn($cur,2);
			if ($id!='3')  /*$aVSEGO+=*/$VSEGO=ora_getcolumn($cur,9); 	
			/*$aSTAVKACAT+=*/$STAVKACAT=ora_getcolumn($cur,10);
			
			$worksheet ->write($j+6,0, $j,$format); 
			$worksheet ->write($j+6,1, $STAT,$format); 
			$worksheet ->write($j+6,2, $STAVKACAT,$formatcenter);
			$worksheet ->write($j+6,3, $STAVKA,$formatcenter); 
			$worksheet ->write($j+6,4, $VSEGO,$formatcenter); 
			$worksheet ->write($j+6,5, $PROF,$formatcenter); 
			$worksheet ->write($j+6,6, $DOC,$formatcenter); 
			$worksheet ->write($j+6,7, $STAR,$formatcenter); 
			$worksheet ->write($j+6,8, $PREP,$formatcenter); 
			$worksheet ->write($j+6,9, $ASS,$formatcenter); 
			$worksheet ->write($j+6,10, $PRIM,$format); 
				
			$j=$j+1;
												
		ora_fetch($cur);
		}
//////////////////////////////////////////////////////////////////////////////
$sql = "SELECT sum(SUM_STAVKA) as SUM_STAVKA,
				sum(PROF) as PROF,
				sum(DOC) as DOC,
				sum(STAR) as STAR,
				sum(PREP) as PREP,
				sum(ASS) as ASS,
				sum(STAVKA) as STAVKA
          from Z_PREPOD_UMU 
		 WHERE FACID='$fac'
          order by stat_id,stavka desc";
$cur = ora_do($conn,$sql);
$STAVKA	= ora_getcolumn($cur,0);
$PROF	= ora_getcolumn($cur,1);
$DOC	= ora_getcolumn($cur,2);
$STAR	= ora_getcolumn($cur,3);
$PREP	= ora_getcolumn($cur,4);
$ASS	= ora_getcolumn($cur,5);
$STAVKA2= ora_getcolumn($cur,6);

$sql = "SELECT sum(VSEGO) as VSEGO from Z_PREPOD_UMU WHERE FACID='$fac' and stat_id not in ( 3, 5 ) order by stat_id,stavka desc";
$cur = ora_do($conn,$sql);
$VSEGO	= ora_getcolumn($cur,0);
	
$aSTAVKA	= $STAVKA;
$aPROF		= $PROF;
$aDOC		= $DOC;
$aSTAR		= $STAR;
$aPREP		= $PREP;
$aASS		= $ASS;
$aVSEGO		= $VSEGO;
$aSTAVKA2	= $STAVKA2;
//////////////////////////////////////////////////////////////////////////////

		$worksheet ->write($j+6,0, "",$formatcenterbold); 
		$worksheet ->write($j+6,1, "Итого (без почасовиков):",$formatcenterbold); 
		$worksheet ->write($j+6,2, "",$formatcenterbold);
		$worksheet ->write($j+6,3, $aSTAVKA,$formatcenterbold); 
		$worksheet ->write($j+6,4, $aVSEGO,$formatcenterbold); 
		$worksheet ->write($j+6,5, $aPROF,$formatcenterbold); 
		$worksheet ->write($j+6,6, $aDOC,$formatcenterbold); 
		$worksheet ->write($j+6,7, $aSTAR,$formatcenterbold); 
		$worksheet ->write($j+6,8, $aPREP,$formatcenterbold); 
		$worksheet ->write($j+6,9, $aASS,$formatcenterbold); 
		$worksheet ->write($j+6,10, "",$formatcenterbold); 
		
// Let's send the file
$workbook->close();
 ?>