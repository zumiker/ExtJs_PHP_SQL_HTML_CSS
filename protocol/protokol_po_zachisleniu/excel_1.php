<?php
require_once 'Spreadsheet/Excel/Writer.php';

function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return " "; 
else return ora_getcolumn($cur,$pos);
}

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

if(isset($_GET['id_fac']))
{
	$id_fac=$_GET['id_fac'];
	$sql1="FACID='$id_fac' ";
}


if(isset($_GET['id_con']))
{
	$id_con=$_GET['id_con'];
	$sql1.="CON_ID='$id_con' ";
}

if(isset($_GET['nabor']))
{
	$nab = $_GET['nabor'];
	if($nab=='1')
		{$name='бюджетный набор';
		$sql3=" AND (TNABOR=1 OR TNABOR=8)";}
	if($nab=='2')
		{$name='целевой набор';
		$sql3=" AND TNABOR=2";}
	if($nab=='3')
		{$name='коммерческий набор';
		$sql3=" AND (TNABOR=3 OR TNABOR=8)";}
	if($nab=='4')
		{$name='контракт';
		$sql3=" AND TNABOR=4";}
}

if(isset($_GET['podl']))
{
	$podl=$_GET['podl'];
	if ($podl==1)
	{
		$sql3.=" AND DOC='Подл'";
		$doc="подлинники";
	}
	else 
		$doc="";
}	

if(isset($_GET['tur']))
{
	$tur=$_GET['tur'];
	$sql4 = $sql3;
	$sql3 .=" AND TUR='$tur'";
}

 $sql="SELECT CONGROUP,MEST_HOST FROM ABI_CONGROUP WHERE ID_CON=$id_con";
 $cur=ora_do($conn,$sql);

	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$CONGROUP=ora_getcolumn($cur,0);
			$MEST=ora_getcolumn($cur,1);
	 }


   $sql="SELECT SPCNAME, SPCBRIFE, SPCCODENEW" .
		" FROM ABIVIEW_CON_SPEC " .
		" WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";
		
		$cur=ora_do($conn,$sql);

		$date = date("d.m.y");		
		
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('protokol.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('protokol');
$worksheet->setMargins_LR(0);
$worksheet->setMarginBottom(0.8);
$worksheet->setMarginTop(0);
$worksheet->setFooter('стр.&P');

$titleFormat =& $workbook->addFormat(); 
$titleFormat->setFontFamily('Helvetica'); 
$titleFormat->setSize('10'); 
$titleFormat->setColor('navy'); 
//$titleFormat->setTextRotation(270);
$titleFormat->setBottom(2); 
$titleFormat->setLeft(2); 
$titleFormat->setRight(2); 
$titleFormat->setBottomColor('navy'); 
$titleFormat->setAlign('merge'); 
$titleFormat->setTextWrap(1); 

$format =& $workbook->addFormat();
$format->setFontFamily('Helvetica'); 
$format->setAlign('center'); 
$format->setSize('10');
$format->setTop(1); 
$format->setBottom(1); 
$format->setLeft(1); 
$format->setRight(1);
$format->setTextWrap(1);

$format_bold_13 =& $workbook->addFormat();
$format_bold_13->setFontFamily('Helvetica'); 
$format_bold_13->setAlign('right'); 
$format_bold_13->setSize('10');
$format_bold_13->setBold();

$format_bold_12 =& $workbook->addFormat();
$format_bold_12->setFontFamily('Helvetica'); 
$format_bold_12->setAlign('center'); 
$format_bold_12->setSize('10');
$format_bold_12->setBold();

$format_bold =& $workbook->addFormat();
$format_bold->setFontFamily('Helvetica'); 
$format_bold->setAlign('left'); 
$format_bold->setSize('10');
$format_bold->setBold();

$format_11 =& $workbook->addFormat();
$format_11->setFontFamily('Helvetica'); 
$format_11->setAlign('left'); 
$format_11->setSize('10');

$format_12 =& $workbook->addFormat();
$format_12->setFontFamily('Helvetica'); 
$format_12->setAlign('center'); 
$format_12->setSize('10');

$format_13 =& $workbook->addFormat();
$format_13->setFontFamily('Helvetica'); 
$format_13->setAlign('right'); 
$format_13->setSize('10');

$worksheet ->write($n,0, '',$titleFormat1); 
$worksheet ->write($n,1, $date,$format_bold); 
$worksheet ->write($n,2, '',$format_bold); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$n++;
$year=date("Y");
$worksheet ->write($n,0, '',$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, '',$titleFormat1); 

$n++;

$worksheet ->write($n,0, '',$titleFormat1); 
//$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,1, 'Рекомендовать к зачислению на 1 курс РГУ нефти и газа имени И.М.Губкина ',$format_bold); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 

$n++;
$worksheet ->write($n,0, '',$titleFormat1); 
//$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,1, '',$format_bold); 
$worksheet ->write($n,3, $tur.' тур',$format_bold_12); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 

$n++;
$worksheet ->write($n,0, '',$titleFormat1); 
//$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,1, $CONGROUP,$format_bold); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
if($nab!='3') $worksheet ->write($n,5, 'Мест в общежитии '.$MEST,$format_bold); else $worksheet ->write($n,5, 'Мест в общежитии 0',$format_bold);
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 

$n++;
$worksheet ->write($n,0, '',$titleFormat1); 
//$worksheet ->write($n,1, '',$titleFormat1); 
if ($id_con=='1' || $id_con=='3')
{
$worksheet ->write($n,1, 'специальности: ',$format_bold); 
}
else
{
$worksheet ->write($n,1, 'направления: ',$format_bold); 
}
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '('.$name.')',$format_bold); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 

$n++;
//if ($id_con==251 || $id_con==252)
if ($id_con==251 || $id_con==250)
{
$worksheet ->write($n,5, 'очно-заочная',$format_bold); 
$n++;
$worksheet ->write($n,5, 'форма обучения',$format_bold);
}
else
$worksheet ->write($n,5, 'очная форма обучения',$format_bold); 
$n++;
$worksheet ->write($n,5, $doc,$format_bold); 
$n++;

$worksheet->setColumn(0,0,9);
$worksheet->setColumn(0,1,4);
$worksheet->setColumn(0,2,8);
$worksheet->setColumn(0,3,40);
$worksheet->setColumn(0,4,5);
$worksheet->setColumn(0,5,6);
$worksheet->setColumn(0,6,9);
$worksheet->setColumn(0,7,12);


for ($i=0;$i<ora_numrows($cur);$i++)
		{		
			$SPCNAME = ora_getcolumnnbsp($cur,0);
			$SPCBRIFE = ora_getcolumnnbsp($cur,1);
			$SPCCODE = ora_getcolumn($cur,2);
			
			$n++;	
			$worksheet ->write($n,1, $SPCBRIFE,$frmt); 
			$worksheet ->write($n,2, $SPCNAME,$frmt); 
			$worksheet ->write($n,0, $SPCCODE,$frmt); 
			
			//$html.= "<tr><td colspan='6' size='14' align='left'>" .
			//"$SPCBRIFE    $SPCNAME</tr>";	
			//if(strlen($SPCNAME)>=55)
			//{
			//	$html.= "<tr><td>";
			//}
			ora_fetch($cur);		
		}
	
	$n= $n+2;
	
	$worksheet ->write($n,1, 'следующих абитуриентов: ',$format_bold); 
	$n++;
		
		$sql="SELECT VSEGO, HOST " .
		" FROM ABI_PODVAL_2 " .
		" WHERE  CON_ID='$id_con' $sql3";
		$cur=ora_do($conn,$sql);
		
		$VSEGO2 = ora_getcolumnnbsp($cur,0);
		$HOST = ora_getcolumnnbsp($cur,1);	
		
		$sql="SELECT  NEUD " .
		" FROM ABI_PODVAL_4 " .
		" WHERE  CON_ID='$id_con' $sql3";
		$cur=ora_do($conn,$sql);
		
		$NEUD = ora_getcolumnnbsp($cur,0);	
		$VIDERJALI=$VSEGO2-$NEUD;
		 $sql="SELECT MUJ,JEN " .
		" FROM ABI_PODVAL_3 " .
		" WHERE  CON_ID='$id_con' $sql3";
		$cur=ora_do($conn,$sql);
		$MUJ = ora_getcolumnnbsp($cur,0);
		$JEN = ora_getcolumnnbsp($cur,1);	

		
		if($nab==3)
		{
			
		$sql="SELECT SUM(MEST_COM) FROM ABI_CON_SPEC WHERE ID_CON='$id_con'";
		$cur=ora_do($conn,$sql);
		 $MEST_BUD = ora_getcolumnnbsp($cur,0);
		 $MEST_BUD_host=0;
		}
		else
		{
		 $sql="SELECT SUM(MEST_BUD) FROM ABI_CON_SPEC WHERE ID_CON='$id_con'";
		 $cur=ora_do($conn,$sql);
		 $MEST_BUD = ora_getcolumnnbsp($cur,0);
		 $MEST_BUD_host=$MEST_BUD;
		}
		
		
		$tmp = $VSEGO2/$MEST_BUD;
		$tmp =  number_format($tmp, 1, '.', '');;
				
		//$viderjali = $VSEGO - $NEUD;
		/*
		$n++;
		$worksheet ->write($n,1, 'Всего мест в конкурсной группе',$titleFormat1);
		$worksheet ->write($n,5, $MEST_BUD,$titleFormat1);
		$n++;
		$worksheet ->write($n,1, 'Из них с общежитием',$titleFormat1);
		$worksheet ->write($n,5, $MEST_BUD_host,$titleFormat1);
		$n++;
		$worksheet ->write($n,1, 'Всего подано заявлений',$titleFormat1);
		$worksheet ->write($n,5, $VSEGO2,$titleFormat1);
		$n++;
		$worksheet ->write($n,1, 'Конкурс по заявлениям',$titleFormat1);
		$worksheet ->write($n,5, $tmp,$titleFormat1);
		
		$sql = "SELECT  VSEGO, HOST, SOBESED, 
 			PODTV, OTL, VNEKON FROM ABI_PODVAL_1 WHERE CON_ID= '$id_con' $sql3";
		$cur=ora_do($conn,$sql);
		$VSEGO = ora_getcolumnnbsp($cur,0);
		$HOST= ora_getcolumnnbsp($cur,1);
		$SOBESED= ora_getcolumnnbsp($cur,2);
		$PODTV= ora_getcolumnnbsp($cur,3);
		$OTL= ora_getcolumnnbsp($cur,4);
		$VNEKON= ora_getcolumnnbsp($cur,5);
			 
	$n++;
	$worksheet ->write($n,1, 'Подлежат обязательному зачислению',$titleFormat1);
	$worksheet ->write($n,5, $VSEGO,$titleFormat1);		
	$n++;
	$worksheet ->write($n,3, 'из них с общежитием',$titleFormat1);
	$worksheet ->write($n,5, $HOST,$titleFormat1);
	$n++;
	$worksheet ->write($n,3, 'победители олимпиад',$titleFormat1);
	$worksheet ->write($n,5, $HOST,$titleFormat1);		
	$n++;
	$worksheet ->write($n,3, 'вне конкурса',$titleFormat1);
	$worksheet ->write($n,5, $VNEKON,$titleFormat1);
	
	$n++;
	$worksheet ->write($n,1, 'Всего мужчин',$titleFormat1);
	$worksheet ->write($n,5, $MUJ,$titleFormat1);
	$n++;
	$worksheet ->write($n,1, 'Всего женщин',$titleFormat1);
	$worksheet ->write($n,5, $JEN,$titleFormat1);
	*/
	$n++;
	
$KONK=($VIDERJALI/$MEST_BUD);
$KONK =  number_format($KONK, 1, '.', '');
/*$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" .
			"Конкурс по выдержавшим экзамен</td><td></td></tr>";//$KONK*/
			
			$MEST=$MEST_BUD-$VSEGO;
/*$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" .
			"Осталось мест на свободный конкурс</td><td>$MEST</td></tr>";	*/		
			
$KONK=($VIDERJALI-$SOBESED)/($MEST_BUD-$SOBESED);
$KONK =  number_format($KONK, 1, '.', '');
			
/*$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" .
			"Конкурс с учётом обязательного зачисления</td><td></td></tr>";//$KONK*/	
									
//	$worksheet ->write($n,1, 'Без вступительных испытаний',$format_bold); 
//	$n++;
	
		 "<table border='0' width='180'>"; 		
	if ($podl==1)
	{	 
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR" .
		" FROM ABIVIEW_PODVAL_24 " .
		" WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) AND DOC='Подл' ORDER BY KATEGOR,BALL DESC, LASTNAME";
	}
	else
	{
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR" .
		" FROM ABIVIEW_PODVAL_24 " .
		" WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) ORDER BY KATEGOR,BALL DESC, LASTNAME";
	}
		
		$cur=ora_do($conn,$sql);
		$num=0;	
		$KATEGORIA_OLD='ned';
			
		for ($i=0;$i<ora_numrows($cur);$i++)
		{			
			
		$num=$num+1;
		$ABI_NUMBER = ora_getcolumnnbsp($cur,0);
		$LASTNAME = ora_getcolumnnbsp($cur,1);
		$FIRSTNAME = ora_getcolumnnbsp($cur,2);
		$PATRONYMIC = ora_getcolumnnbsp($cur,3);
		$HOST = ora_getcolumnnbsp($cur,4);
		$TAWNAME_SMALL = ora_getcolumnnbsp($cur,5);
		$KATEGORIA = ora_getcolumnnbsp($cur,6);
		//$KATEGORIA = substr($KATEGORIA,11);
		$DOC = ora_getcolumnnbsp($cur,7);
		$BALL = ora_getcolumnnbsp($cur,8);
		$KATEGOR = ora_getcolumnnbsp($cur,9);
		if($KATEGORIA_OLD!=$KATEGORIA)
		{
			$n++;
			$worksheet ->write($n,1, $KATEGORIA,$format_bold);
			$n=$n+2;
			$worksheet ->write($n,1, '№',$format_bold);
			$worksheet ->write($n,3, 'ФИО',$format_bold);
			$worksheet ->write($n,5, 'Балл',$format_bold);
			$worksheet ->write($n,6, 'Аттестат',$format_bold_12);
			$worksheet ->write($n,7, 'Общежитие',$format_bold_13);
			$n=$n+2;

			$KATEGORIA_OLD=$KATEGORIA;	
		}	
		
		/*if ($col=='#ffffff')
		{
			$col='#eeeeee';
		}
		else*/
		{
			$col='#ffffff';
		}
		
		$worksheet ->write($n,1, $num,$titleFormat1); 
		//$worksheet ->write($n,2, $ABI_NUMBER,$titleFormat1); 
		//$worksheet ->write($n,2, $CONGROUP,$titleFormat1); 
		$worksheet ->write($n,3, $LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC,$titleFormat1); 
		if($KATEGOR!=21)
		$worksheet ->write($n,5, $BALL,$format_11);
		$worksheet ->write($n,6, $DOC,$format_12); 
		if ( $HOST == 'Д' && $nab == 1 )
			$worksheet ->write($n,7, 'Предоставл',$format_12);
		else
			$worksheet ->write($n,7, '',$format_12);
		//$worksheet ->write($n,9, $TAWNAME_SMALL,$titleFormat1); 
		//$worksheet ->write($n,10, $DOC,$titleFormat1);
		$n++;
	
		
			ora_fetch($cur);		
		}
		
	//$worksheet ->write($n,1, 'Прошедших по конкурсу',$titleFormat1); 
	//$n++;
	
for ($j=0;$j<=0;$j++)
		{
			if($j==0)
			{
			if ($podl==1)
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, PRIORITET" .
			" FROM ABIVIEW_PODVAL_24 " .
			" WHERE  CON_ID='$id_con' AND (TNABOR='$nab')  AND KATEGOR IN (29,31)  AND DOC='Подл' ORDER BY KATEGOR, BALL desc, LASTNAME";
			}
			else
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, PRIORITET" .
			" FROM ABIVIEW_PODVAL_24 " .
			" WHERE  CON_ID='$id_con' AND (TNABOR='$nab')  AND KATEGOR IN (29,31) ORDER BY KATEGOR, BALL desc, LASTNAME";
			}
			}
			else
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0), KATEGOR, OJID" .
			" FROM ABIVIEW_PODVAL_26 " .
			" WHERE  CON_ID='$id_con' AND (TNABOR='$nab') ORDER BY KATEGOR, NVL(BALL,0) desc, LASTNAME";	
				
			}
			$cur=ora_do($conn,$sql);
			$BALL16_OLD='ned';
			$KATEGOR_OLD='ned';
			$switchhh=0;
			for ($i=0;$i<ora_numrows($cur);$i++)
			{			
				
			$num=$num+1;
			$ABI_NUMBER = ora_getcolumnnbsp($cur,0);
			$LASTNAME = ora_getcolumnnbsp($cur,1);
			$FIRSTNAME = ora_getcolumnnbsp($cur,2);
			$PATRONYMIC = ora_getcolumnnbsp($cur,3);
			$HOST = ora_getcolumnnbsp($cur,4);
			$TAWNAME_SMALL = ora_getcolumnnbsp($cur,5);
			$KATEGORIA = ora_getcolumnnbsp($cur,6);
			$DOC = ora_getcolumnnbsp($cur,7);
			$BALL16 = ora_getcolumnnbsp($cur,8);
			$KATEGOR = ora_getcolumnnbsp($cur,9);
			$COLOR= ora_getcolumnnbsp($cur,10);
			$PRIORITET= ora_getcolumnnbsp($cur,11);
			if($KATEGOR!=$KATEGOR_OLD)
			{
				$KATEGOR_OLD=$KATEGOR;
				switch($KATEGOR)
				{
					case 29:

						$n++;
						if ($tur!='3')
						{
							$worksheet ->write($n,1, 'Прошедшие по конкурсу',$format_bold); 
							$n++;
						}
						else
						{
							$worksheet ->write($n,1, 'Участники конкурса на оставшиеся бюджетные места',$format_bold); 
							$n++;
							$worksheet ->write($n,1, 'Завершение предоставления Документов - 20 августа, 17.00',$format_bold); 
							$n++;
							$worksheet ->write($n,1, 'Зачисление - 21 августа по сумме набранных баллов',$format_bold); 
							$n++;
						}
						$n=$n+2;
						$worksheet ->write($n,1, '№',$format_bold);
						$worksheet ->write($n,3, 'ФИО',$format_bold);
						$worksheet ->write($n,5, 'Балл',$format_bold);
						$worksheet ->write($n,6, 'Аттестат',$format_bold_12);
						$worksheet ->write($n,7, 'Общежитие',$format_bold_13);
						$n=$n+2;
						break;
					case 31:

						$n++;
						if ($tur!='3')
						{
							$worksheet ->write($n,1, 'Выдержавшие вступительные испытания и претендующие на поступление',$format_bold); 
							$n++;
							if ($tur=='1')
								$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места после 1 тура',$format_bold); 
							else
								$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места после 2 тура',$format_bold); 
							$n=$n+2;
						}
						else
							$worksheet ->write($n,1, 'Участники конкурса на оставшиеся бюджетные места',$format_bold); 
						$n++;
						
						$worksheet ->write($n,1, '№',$format_bold);
						$worksheet ->write($n,3, 'ФИО',$format_bold);
						$worksheet ->write($n,5, 'Балл',$format_bold);
						$worksheet ->write($n,6, 'Аттестат',$format_bold_12);
						$worksheet ->write($n,7, 'Общежитие',$format_bold_13);
						$n=$n+2;
						
						break;
						
				}
			}

			
			if ($COLOR==1)
			{
				$col='#eeeeee';
			}
			else
			{
				$col='#ffffff';
			}
				
			
			$worksheet ->write($n,1, $num,$titleFormat1); 
			//$worksheet ->write($n,2, $ABI_NUMBER,$titleFormat1); 
			$worksheet ->write($n,3, $LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC,$titleFormat1); 
			//$worksheet ->write($n,8, $HOST,$titleFormat1); 
			//$worksheet ->write($n,9, $TAWNAME_SMALL,$titleFormat1); 
			//$worksheet ->write($n,10, $DOC,$titleFormat1); 
			$worksheet ->write($n,5, $BALL16,$format_11); 
			$worksheet ->write($n,6, $DOC,$format_12); 
			if ( $HOST == 'Д' && $nab == 1 )
				$worksheet ->write($n,7, 'Предоставл',$format_12);
			else
				$worksheet ->write($n,7, '',$format_12);
			//$worksheet ->write($n,12, $PRIORITET,$titleFormat1);
			$n++;
			
			
				ora_fetch($cur);		
			}	
		}
//$worksheet->hideGridLines();

$workbook->close();
?>