
<?php
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return " "; 
else return ora_getcolumn($cur,$pos);
}

$header='';

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
	$sql3=" AND TNABOR='$nab'";
	if($nab=='1')
		$name='бюджетный набор';
	if($nab=='2')
		$name='целевой набор';
	if($nab=='3')
		$name='коммерческий набор';
	if($nab=='4')
		$name='контракт';
	
}

   $sql="SELECT SPCNAME, SPCBRIFE" .
		" FROM ABIVIEW_CON_SPEC " .
		" WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";
		
		$cur=ora_do($conn,$sql);
		
$html.= "<table border='0' width='180'>";
$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>" .
		"Протокол по зачислению на 1 курс РГУ нефти и газа </td></tr>";
$html.= "<tr><td colspan='99' align='center'>" .
		"имени И.М.Губкина на следующие специальности</td></tr>"; 			
$html.= "<tr><td><tr><td colspan='99' align='center'>" .
		"ИС \"АБИТУРИЕНТ\"                     Конкурсная группа № $id_con </td></tr><tr><td>";
$html.= "<tr><td colspan='99' align='center'>" .
		"($name)</td></tr><tr><td>"; 	
for ($i=0;$i<ora_numrows($cur);$i++)
		{		
			$SPCNAME = ora_getcolumnnbsp($cur,0);
			$SPCBRIFE = ora_getcolumnnbsp($cur,1);
				
			$html.= "<tr><td colspan='8' size='14' align='left'>" .
			"$SPCBRIFE    $SPCNAME</tr>";	
			if(strlen($SPCNAME)>=55)
			{
				$html.= "<tr><td>";
			}
			ora_fetch($cur);		
		}

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

		if($nab==2)
		{
			
		$sql="SELECT MEST_CEL FROM ABI_CONGROUP WHERE ID_CON='$id_con'";
		$cur=ora_do($conn,$sql);
		 $MEST_BUD = ora_getcolumnnbsp($cur,0);
		 $MEST_BUD_host=0;
		}
		if($nab==3)
		{
			
		$sql="SELECT MEST_COM FROM ABI_CONGROUP WHERE ID_CON='$id_con'";
		$cur=ora_do($conn,$sql);
		 $MEST_BUD = ora_getcolumnnbsp($cur,0);
		 $MEST_BUD_host=0;
		}
		if($nab==1)
		{
		 $sql="SELECT MEST_BUD FROM ABI_CONGROUP WHERE ID_CON='$id_con'";
		$cur=ora_do($conn,$sql);
		 $MEST_BUD = ora_getcolumnnbsp($cur,0);
		 $MEST_BUD_host=$MEST_BUD;
		}
		
		
		$tmp = $VSEGO2/$MEST_BUD;
		$tmp =  number_format($tmp, 1, '.', '');;
				
		//$viderjali = $VSEGO - $NEUD;
			
$html.= "<tr><td><tr><td><tr><td colspan='8' size='15' align='left'>" .
			"Всего мест в конкурсной группе</td><td>$MEST_BUD</td></tr>";	
$html.= "<tr><td colspan='8' size='15' align='left'>" .
			"Из них с общежитием</td><td>$MEST_BUD_host</td></tr>";
$html.= "<tr><td colspan='8' size='15' align='left'>" .
			"Всего подано заявлений</td><td>$VSEGO2</td></tr>";
		
$html.= "<tr><td colspan='8' size='15' align='left'>" .
			"Конкурс по заявлениям</td><td>$tmp</td></tr>";
			
$sql = "SELECT  VSEGO, HOST, SOBESED, 
 			PODTV, OTL, VNEKON FROM ABI_PODVAL_1 WHERE CON_ID= '$id_con' $sql3";
		$cur=ora_do($conn,$sql);
		$VSEGO = ora_getcolumnnbsp($cur,0);
		$HOST= ora_getcolumnnbsp($cur,1);
		$SOBESED= ora_getcolumnnbsp($cur,2);
		$PODTV= ora_getcolumnnbsp($cur,3);
		$OTL= ora_getcolumnnbsp($cur,4);
		$VNEKON= ora_getcolumnnbsp($cur,5);
			 
			

$html.= "<tr><td colspan='8' size='15' align='left'>" .
			"Подлежат обязательному зачислению</td><td>$VSEGO</td></tr>";
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"            из них с общежитием</td><td>$HOST</td></tr>";					
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"            по собеседованию</td><td>$SOBESED</td></tr>";
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"            подтвердили медаль</td><td>$PODTV</td></tr>";
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"            вне конкурса</td><td>$VNEKON</td></tr>";
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"            отличники</td><td>$OTL</td></tr>";
/*	$sql = "SELECT COUNT(*),CON_ID FROM ABITURIENT WHERE PROSHEL = 26 AND CON_ID='$id_con' $sql3 GROUP BY CON_ID";		
	$cur=ora_do($conn,$sql);
	$NEUD = ora_getcolumnnbsp($cur,0);*/
	
	
$html.= "<tr><td colspan='8' size='15' align='left'>" .
			"Выдержали экзамены</td><td>$VIDERJALI</td></tr>";
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"                  мужчин</td><td>$MUJ</td></tr>";
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"                  женщин</td><td>$JEN</td></tr>";

$KONK=($VIDERJALI/$MEST_BUD);
$KONK =  number_format($KONK, 1, '.', '');
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"Конкурс по выдержавшим экзамен</td><td>$KONK</td></tr>";
			
			$MEST=$MEST_BUD-$VSEGO;
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"Осталось мест на свободный конкурс</td><td>$MEST</td></tr>";			
			
$KONK=($VIDERJALI-$SOBESED)/($MEST_BUD-$SOBESED);
$KONK =  number_format($KONK, 1, '.', '');
			
$html.= "<tr><td></td><td colspan='7' size='15'  align='left'>" .
			"Конкурс с учётом обязательного зачисления</td><td>$KONK</td></tr></table>";	
									
		 "<table border='0' width='180'>"; 		
		
		$sqlbal="SELECT DISTINCT " .
		" ID_PR, PREDMET " .
		" FROM ABI_BAL " .
		" WHERE $sql1 ORDER BY ID_PR";

		$cur=ora_do($conn,$sqlbal);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$ID_PR = ora_getcolumnnbsp($cur,0);
			$PREDMET = ora_getcolumnnbsp($cur,1);
			if($ID_PR==8)
			{
				$PREDMET[0]='Я';
			}
			if($ID_PR==3)
			{
				$PRED='у';
			}
			else
			{
				$PRED='';
			}
			$s22 .= "<td align='center'  family='TimesNewRomanPSMT' >$PREDMET[0]$PRED</td>";
			$s21 .= "<td align='center'></td>";
			$PREMETID[$i]=$ID_PR;
			ora_fetch($cur);	
		}		
		 
   $sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC" .
		" FROM ABIVIEW_OBAZAL " .
		" WHERE  $sql1  $sql3 ORDER BY KATEGOR, LASTNAME";
		
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
		$DOC = ora_getcolumnnbsp($cur,7);
		
		if($KATEGORIA_OLD!=$KATEGORIA)
		{
			
			$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='14' align='left'>$KATEGORIA</td></tr>";
			$html.=$s1;
			//$num=1;
			$KATEGORIA_OLD=$KATEGORIA;	
		}	
		
		if ($col=='#ffffff')
		{
			$col='#eeeeee';
		}
		else
		{
			$col='#ffffff';
		}
			
		$html .= "<tr bgcolor='$col'>" .
		"<td align='center' family='TimesNewRomanPSMT' width='10' size='10'>$num</td>" .
		"<td align='center' >$ABI_NUMBER</td>" .
		"<td align='left' width='80'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
		"<td align='center'>$HOST</td>".
		"<td align='center'>$TAWNAME_SMALL</td>".
		"<td align='center'>$DOC</td>".$s21;

		
		$html .="</tr>";
		
		
			ora_fetch($cur);		
		}
		for ($j=0;$j<2;$j++)
		{
			if($j==0)
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0), KATEGOR, OJID" .
			" FROM ABIVIEW_PODVAL_24 " .
			" WHERE  $sql1  $sql3 ORDER BY KATEGOR, NVL(BALL16,0) desc, LASTNAME";
			}
			else
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0), KATEGOR, OJID" .
			" FROM ABIVIEW_PODVAL_26 " .
			" WHERE  $sql1  $sql3 ORDER BY KATEGOR, NVL(BALL16,0) desc, LASTNAME";	
				
			}
			
			$cur=ora_do($conn,$sql);
			
			$BALL16_OLD='ned';
			$KATEGOR='ned';
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
			$OJID= ora_getcolumnnbsp($cur,10);
			if($KATEGOR=='24')
			{	
				if($BALL16_OLD!=$BALL16)
				{
					
					if ($id_con==13 || $id_con==14 || $id_con==15 ||  $id_con==17)
					{
						$nummm=23;
					}
					else
					{
						$nummm=11;
					}
									
					if($BALL16>$nummm)
					{
					$html.= "<tr><td><tr><td colspan='7' family='TimesNewRomanPS-BoldMT' size=14 align='left'>Абитуриенты, набравшие $BALL16 баллов</td>$s22</tr>";
					}
					
					
					if($BALL16<=$nummm && $switchhh=='0')
					{
						$switchhh=1;
						$html.= "<tr><td><tr><td colspan='7' family='TimesNewRomanPS-BoldMT' size=14 align='left'>Не сдали экзамены</td>$s22</tr>";
					}
					//$num=1;
					$BALL16_OLD=$BALL16;	
				
				}
			}
			if($KATEGOR=='26' && $switchhh=='0')
			{
				$switchhh=1;
				$html.= "<tr><td><tr><td colspan='7' family='TimesNewRomanPS-BoldMT' size=14 align='left'>Не сдали экзамены</td>$s22</tr>";
			}	
			
			if ($col=='#ffffff')
			{
				$col='#eeeeee';
			}
			else
			{
				$col='#ffffff';
			}
				
			$html .= "<tr bgcolor='$col'>" .
			"<td align='center' family='TimesNewRomanPSMT' size='10'>$num</td>" .
			"<td align='center'>$ABI_NUMBER</td>" .
			"<td align='left' width='80'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
			"<td align='center'>$HOST</td>".
			"<td align='center'>$TAWNAME_SMALL</td>".
			"<td align='center'>$DOC</td>".
			"<td align='center'  family='TimesNewRomanPS-BoldMT' ></td>"
//			"<td align='center'  family='TimesNewRomanPS-BoldMT' >$BALL16</td>"
			;
			for($z=0;$z<sizeof($PREMETID);$z++)
		{
		$sqlpr="SELECT " .
		" ABI_ID " .
		" FROM ABITURIENT " .
		" WHERE ABI_NUMBER='$ABI_NUMBER'";
			$cur2=ora_do($conn,$sqlpr);
			$ABI_ID= ora_getcolumnnbsp($cur2,0);
		
			$sqlpr="SELECT " .
		" BAL,BALL16,VST " .
		" FROM ABI_BAL " .
		" WHERE ABI_ID='$ABI_ID' AND ID_PR='$PREMETID[$z]'";
			$cur2=ora_do($conn,$sqlpr);
			$ABI_BAL= ora_getcolumnnbsp($cur2,0);
			$BAL16= ora_getcolumnnbsp($cur2,1);
			$VST= ora_getcolumnnbsp($cur2,2);
			
			if (strlen($BAL16)>0) {
				if($BAL16<=5)
					{
						$ojidan=' Ожидание';
					}
				
				
				$BAL16="$BAL16";
				$VST = $VST[0];
				if($VST=='О')
				{
					$olimp=' Олимпиада';
				}
			}
			else {$BAL16='';
					$VST = '';
			}
			if ($id_con==13||$id_con==14||$id_con==15||$id_con==17)
			{
				
			}
			else
			{
				if($PREMETID[$z]==1)
				{
				if($BAL16>=6)
				{
					$BAL16='З';
				}
				else
				{
					$BAL16='';
				}
				}
			}
			
			  //<b>$VST</b> $ABI_BAL
			$html .= "<td  family='TimesNewRomanPSMT'  align='center'>$BAL16</td>";
		}
			$html .="</tr>";
			
			
				ora_fetch($cur);		
			}	
		}
	
	define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');
	
$p = new PDFTable();
$p->AddPage('P');
$p->SetMargins(5,10,10);
$p->AddFont('TimesNewRomanPSMT','','times.php');  
$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',14); 
$p->htmltable($html);

$p->output('','I');	

	
?>
