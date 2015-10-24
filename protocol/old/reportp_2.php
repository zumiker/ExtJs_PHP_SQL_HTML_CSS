
<?php
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return " "; 
else return ora_getcolumn($cur,$pos);
}
session_start();

$header='';

$fac=$_GET['fac'];

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


$sql="SELECT FACID from ABI_FAC WHERE FACID=$fac ORDER BY FACNAME";
$cur=ora_do($conn,$sql);
$id_fac=ora_getcolumn($cur,0);

/* if(isset($_GET['id_fac']))
{
	$id_fac=$_GET['id_fac'];
	$sql1="FACID='$id_fac' ";
} */

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
	{
		$name='бюджетный набор';
		$sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
		}
	if($nab=='2')
		$name='целевой набор';
	if($nab=='3')
	{
		$name='коммерческий набор';
		$sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
		//$sql3 .= " AND TNABOR='8'";
		}
	if($nab=='4')
		$name='контракт';
	
}
$sql5="";

if(isset($_GET['podl']))
{
	$podl=$_GET['podl'];
	if ($podl==1)
	{
		$sql5.=" AND DOC='Подл'";
		$doc=", подлинники";
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

$date = date("d.m.y H:i");

		
$html.= "<table border='0' width='180'>";
$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>" .
		"Протокол по зачислению на 1 курс РГУ нефти и газа </td></tr>";
$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>" .
		"имени И.М.Губкина на $date</td></tr>"; 
//$html.= "<tr><td colspan='99' align='center'>" .
//		"на $date</td></tr>"; 		
$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>" .
		"на следующие специальности</td></tr>";	

/*		
$html.= "<tr><td><tr><td colspan='99' align='center'>" .
		"ИС \"АБИТУРИЕНТ\"                     $CONGROUP </td></tr><tr><td>";
$html.= "<tr><td colspan='99' align='center'>" .
		"($name $doc) тур $tur</td></tr><tr><td>";
*/
$html.= "<tr><td><tr><td colspan='99' align='left'>" .
		"$CONGROUP   ($name $doc) тур $tur</td></tr><tr><td>";
		//"($name $doc) </td></tr><tr><td>"; 	
for ($i=0;$i<ora_numrows($cur);$i++)
		{		
			$SPCNAME = ora_getcolumnnbsp($cur,0);
			$SPCBRIFE = ora_getcolumnnbsp($cur,1);
			$SPCCODE = ora_getcolumn($cur,2);
			
if ($CONGROUP=='Конкурсная группа 11')
	{
	if ($nab==1)
		{
		if ($SPCBRIFE!='')
		{
			$html.= "<tr><td colspan='6' size='14' align='left'>" .
			"$SPCBRIFE    $SPCNAME</tr>";	
			if(strlen($SPCNAME)>=55)
			{
				$html.= "<tr><td>";
			}
		}
/* 		else if ($SPCBRIFE!='ШЭ')
		{
			$html.= "<tr><td colspan='6' size='14' align='left'>" .
			"$SPCBRIFE    $SPCNAME</tr>";	
			if(strlen($SPCNAME)>=55)
			{
				$html.= "<tr><td>";
			}
		} */
		}
	}
	else
	{
	$html.= "<tr><td colspan='6' size='14' align='left'>" .
			"$SPCBRIFE    $SPCNAME</tr>";	
			if(strlen($SPCNAME)>=55)
			{
				$html.= "<tr><td>";
			}
	}
			ora_fetch($cur);		
		}

 		$sql="SELECT sum(VSEGO), sum(HOST) ,sum(OSTATKI) " .
		" FROM ABI_PODVAL_2 " .
		" WHERE  CON_ID='$id_con' $sql4";
		$cur=ora_do($conn,$sql);
		
		$VSEGO2 = ora_getcolumnnbsp($cur,0);
		$HOST = ora_getcolumnnbsp($cur,1);
		$OSTATKI = ora_getcolumn($cur,2);
		
		$sql="SELECT  sum(NEUD) " .
		" FROM ABI_PODVAL_4 " .
		" WHERE  CON_ID='$id_con' $sql4";
		$cur=ora_do($conn,$sql);
		
		$NEUD = ora_getcolumnnbsp($cur,0);	
		$VIDERJALI=$VSEGO2-$NEUD;
		 $sql="SELECT sum(MUJ),sum(JEN) " .
		" FROM ABI_PODVAL_3 " .
		" WHERE  CON_ID='$id_con' $sql4";
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
			
$html.= "<tr><td><tr><td><tr><td colspan='5' size='15' align='left'>" .
			"Всего мест в конкурсной группе</td><td  width='15' > $MEST_BUD</td></tr>";	
			if($tur==2)
			{
				$html.= "<td><td><tr><td colspan='5' size='15' align='left'>" .
				"Осталось мест в конкурсной группе</td><td  width='15' > $OSTATKI</td></tr>";	
			}
	if ($nab!='3')
	{
		$html.= "<td><tr><td><tr><td colspan='5' size='15' align='left'>" .
			"Мест в общежитии</td><td  width='15' > $MEST</td></tr>";
		if($tur==2)
			{
				$html.= "<td><td><tr><td colspan='5' size='15' align='left'>" .
				"Осталось мест в общежитии</td><td  width='15' > </td></tr>";	
			}
	}
	else
	{
		$html.= "<td><tr><td><tr><td colspan='5' size='15' align='left'>" .
			"Мест в общежитии</td><td  width='15' > 0</td></tr>";	
	}
//$html.= "<tr><td colspan='5' size='15' align='left'>" ."Из них с общежитием</td><td width='15' >$MEST_BUD_host</td></tr>";

if ($podl!='1' && $tur!='3')
{
	$html.= "<tr><td colspan='5' size='15' align='left'>" .
			"Всего подано заявлений</td><td width='15' >$VSEGO2</td></tr>";
			
		
	$html.= "<tr><td colspan='5' size='15' align='left'>" .
				"Конкурс по заявлениям</td><td width='15' >$tmp</td></tr>";
				
	$sql = "SELECT  sum(VSEGO), sum(HOST), sum(SOBESED), 
				sum(PODTV), sum(OTL), sum(VNEKON) FROM ABI_PODVAL_1 WHERE CON_ID= '$id_con' $sql4";
			$cur=ora_do($conn,$sql);
			$VSEGO = ora_getcolumnnbsp($cur,0);
			$HOST= ora_getcolumnnbsp($cur,1);
			$SOBESED= ora_getcolumnnbsp($cur,2);
			$PODTV= ora_getcolumnnbsp($cur,3);
			$OTL= ora_getcolumnnbsp($cur,4);
			$VNEKON= ora_getcolumnnbsp($cur,5);
				 
				
	if ($nab!='3')
	{
		$html.= "<tr><td colspan='5' size='15' align='left'>" .
					"Подлежат обязательному зачислению</td><td></td></tr>";
		///$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" ."            из них с общежитием</td><td width='15' >$HOST</td></tr>";					
		/*$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" .
					"            по собеседованию</td><td>$SOBESED</td></tr>";*/
		$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" .
					"            (победители олимпиад)</td><td width='15' >$PODTV</td></tr>";
		$html.= "<tr><td colspan='5' size='15'  align='left'>" .
					"Вне конкурса</td><td width='15' >$VNEKON</td></tr>";
		/*$html.= "<tr><td></td><td colspan='4' size='15'  align='left'>" .
					"            отличники</td><td>$OTL</td></tr>";*/
		/*	$sql = "SELECT COUNT(*),CON_ID FROM ABITURIENT WHERE TUR = 26 AND CON_ID='$id_con' $sql3 GROUP BY CON_ID";		
			$cur=ora_do($conn,$sql);
			$NEUD = ora_getcolumnnbsp($cur,0);*/
	}	
		
	/*$html.= "<tr><td colspan='5' size='15' align='left'>" .
				"Всего</td><td></td></tr>";//$VIDERJALI*/
	$html.= "<tr><td colspan='5' size='15'  align='left'>" .
				"Всего мужчин</td><td width='15' >$MUJ</td></tr>";
	$html.= "<tr><td colspan='5' size='15'  align='left'>" .
				"Всего женщин</td><td width='15' >$JEN</td></tr>";

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
}
									
		 "<table border='0' width='180'>"; 		
		 ///////////////////////////////////////////from 21/07/11
	if ($nab!='3')
	{
	if ($podl==1)
		{
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
        FROM ABIVIEW_PODVAL_24
        WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) AND DOC='Подл' ORDER BY KATEGOR,BALL DESC, LASTNAME";
		}
		else
		{
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
        FROM ABIVIEW_PODVAL_24
        WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) ORDER BY KATEGOR,BALL DESC, LASTNAME";
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
		$DOC = ora_getcolumnnbsp($cur,7);
		$PRIORITET = ora_getcolumnnbsp($cur,8);
		$BALL = ora_getcolumnnbsp($cur,9);
		$PRIKAZ = ora_getcolumnnbsp($cur,10);
		$OJID = ora_getcolumnnbsp($cur,11);
		
		$s1 = "<table border='1' " .
 			"style='" .
 			"text-align:center; " .
 			"font-family: " .
 			"Verdana; " .
 			"font-size: 7px;'><tr><td colspan='9' align=center family='TimesNewRomanPSMT' size='7'><b>СПИСОК К ЗАЧИСЛЕНИЮ</td></b></tr>";
		
		$s1.=
						"<tr><td rowspan='2' align='center' width='5'><b>№<br> п/п</b></td>" .
						"<td rowspan='2' align='center' width='30'><b>ФИО</b></td>" .
						//"<td align='center' valign='middle'  rowspan=2 ><b>Имя</b></td>" .
						//"<td align='center' valign='middle'  rowspan=2 ><b>Отчество</b></td>" .
						"<td rowspan='2' align='center' width='10'><b>Сумма<br>баллов</b></td>".
						"<td rowspan='2' align='center' width='15'><b>Приоритет</b></td>" .
						"<td rowspan='2' align='center' width='11'><b>Медаль</b></td>".
						"<td rowspan='2' align='center'><b>Документ</b></td></tr>".
						"<td colspan='2' align='center' width='27'><b>Общежитие</b></td></tr>".
						//"<td align='center' width='10' ><b>№ л.д.</b></td></tr>";
						"<td rowspan='2' align='center' width='10' ><b>№ л.д.</b></td></tr>".
						"<tr><td align='center'><b>Требуется</b></td>".
						"<td align='center'><b>Выделено</b></td></tr>";
						
		
		
		if($KATEGORIA_OLD!=$KATEGORIA)
		{
		if ($KATEGORIA_OLD=='ned')
		{
			$html.=$s1;
		}
			//$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA</td></tr>";
			$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA";
			//$num=1;
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
		?>
		<TABLE border='1'>
		<?
		$html .= "<tr bgcolor='$col'>" .
		"<td align='center' family='TimesNewRomanPSMT' width='10' size='10'>$num</td>" .
		//"<td align='center'>$ABI_NUMBER</td>" .
		"<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
		"<td align='center' >$BALL</td>".
		"<td align='center' >$PRIORITET </td>".
		"<td align='center'>$TAWNAME_SMALL</td>".
		"<td align='center'>$DOC</td>".
		"<td align='center'>$HOST</td>".//.
		//if ($OJID==1)
		"<td align='center' size='9'>$OJID</td>";
		//else
		//$html .= "<td align='center'></td>";
		//"<td align='center'></td>";
//		"<td align='center'>$PRIKAZ</td>";
		if ( $PRIORITET != 1 )
			$html .= "<td align='center' size='9'>$ABI_NUMBER</td>";
		else
			$html .= "<td align='center'></td>";

		
		$html .="</tr>";
		
		
			ora_fetch($cur);		
		}
	}
	else if ($nab=='3')
		{
		if ($podl==1)
		{
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
        FROM ABIVIEW_PODVAL_24
        WHERE CON_ID='$id_con' AND (TNABOR=3) AND KATEGOR IN (21,23) AND DOC='Подл' ORDER BY KATEGOR,BALL DESC, LASTNAME";
		}
		else
		{
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
        FROM ABIVIEW_PODVAL_24
        WHERE CON_ID='$id_con' AND (TNABOR=3) AND KATEGOR IN (21,23) ORDER BY KATEGOR,BALL DESC, LASTNAME";
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
		$DOC = ora_getcolumnnbsp($cur,7);
		$PRIORITET = ora_getcolumnnbsp($cur,8);
		$BALL = ora_getcolumnnbsp($cur,9);
		$PRIKAZ = ora_getcolumnnbsp($cur,10);
		$OJID = ora_getcolumnnbsp($cur,11);
		
		$s1 = "<table border='1' " .
 			"style='" .
 			"text-align:center; " .
 			"font-family: " .
 			"Verdana; " .
 			"font-size: 7px;'><tr><td colspan='9' align=center family='TimesNewRomanPSMT' size='7'><b>СПИСОК К ЗАЧИСЛЕНИЮ</td></b></tr>";
		
		$s1.=
						"<tr><td rowspan='2' align='center' width='5'><b>№<br> п/п</b></td>" .
						"<td rowspan='2' align='center' width='30'><b>ФИО</b></td>" .
						//"<td align='center' valign='middle'  rowspan=2 ><b>Имя</b></td>" .
						//"<td align='center' valign='middle'  rowspan=2 ><b>Отчество</b></td>" .
						"<td rowspan='2' align='center' width='10'><b>Сумма<br>баллов</b></td>".
						"<td rowspan='2' align='center' width='15'><b>Приоритет</b></td>" .
						"<td rowspan='2' align='center' width='11'><b>Медаль</b></td>".
						"<td rowspan='2' align='center'><b>Документ</b></td></tr>".
						"<td colspan='2' align='center' width='27'><b>Общежитие</b></td></tr>".
						//"<td align='center' width='10' ><b>№ л.д.</b></td></tr>";
						"<td rowspan='2' align='center' width='10' ><b>№ л.д.</b></td></tr>".
						"<tr><td align='center'><b>Требуется</b></td>".
						"<td align='center'><b>Выделено</b></td></tr>";
						
		
		
		if($KATEGORIA_OLD!=$KATEGORIA)
		{
			if ($KATEGORIA_OLD=='ned')
			{
			$html.=$s1;
			}
			//$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA</td></tr>";
			$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA";
			//$num=1;
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
		?>
		<TABLE border='1'>
		<?
		$html .= "<tr bgcolor='$col'>" .
		"<td align='center' family='TimesNewRomanPSMT' width='10' size='10'>$num</td>" .
		//"<td align='center'>$ABI_NUMBER</td>" .
		"<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
		"<td align='center' >$BALL</td>".
		"<td align='center' >$PRIORITET </td>".
		"<td align='center'>$TAWNAME_SMALL</td>".
		"<td align='center'>$DOC</td>".
		"<td align='center'>$HOST</td>".//.
		//if ($OJID==1)
		"<td align='center' size='9'>$OJID</td>";
		//else
		//$html .= "<td align='center'></td>";
		//"<td align='center'></td>";
//		"<td align='center'>$PRIKAZ</td>";
		if ( $PRIORITET != 1 )
			$html .= "<td align='center' size='9'>$ABI_NUMBER</td>";
		else
			$html .= "<td align='center'></td>";

		
		$html .="</tr>";
		
		
			ora_fetch($cur);		
		}
	}
/////////////////from 21/07/11	





//////////////////////////////////////////////// end	
		for ($j=0;$j<=0;$j++)
		{
			if($j==0)
			{
			if ($podl==1)
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, decode(PRIORITET,1,1,4,2,7,3), PRIKAZ, OJID " .
			" FROM ABIVIEW_PODVAL_24 " .
			" WHERE  CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR='29' AND DOC='Подл' ORDER BY KATEGOR, BALL desc, LASTNAME";
			}
			else
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, decode(PRIORITET,1,1,4,2,7,3), PRIKAZ, OJID " .
			" FROM ABIVIEW_PODVAL_24 " .
			" WHERE  CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR='29' ORDER BY KATEGOR, BALL desc, LASTNAME";
			}
			}
			else
			{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0), KATEGOR, OJID" .
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
			$PRIKAZ= ora_getcolumnnbsp($cur,12);
			$OJID=ora_getcolumnnbsp($cur,13);
			
		$s1 = "<table border='1' " .
 			"style='" .
 			"text-align:center; " .
 			"font-family: " .
 			"Verdana; " .
 			"font-size: 7px;'><tr><td colspan='9' align=center family='TimesNewRomanPSMT' size='7'><b>СПИСОК К ЗАЧИСЛЕНИЮ</td></b></tr>";
		
		$s1.=
						"<tr><td rowspan='2' align='center' width='7'><b>№<br> п/п</b></td>" .
						"<td rowspan='2' align='center' width='30'><b>ФИО</b></td>" .
						//"<td align='center' valign='middle'  rowspan=2 ><b>Имя</b></td>" .
						//"<td align='center' valign='middle'  rowspan=2 ><b>Отчество</b></td>" .
						"<td rowspan='2' align='center' width='10'><b>Сумма<br>баллов</b></td>".
						"<td rowspan='2' align='center' width='15'><b>Приоритет</b></td>" .
						"<td rowspan='2' align='center' width='11'><b>Медаль</b></td>".
						"<td rowspan='2' align='center'><b>Документ</b></td></tr>".
						"<td colspan='2' align='center' width='27'><b>Общежитие</b></td></tr>".
						//"<td align='center' width='10' ><b>№ л.д.</b></td></tr>";
						"<td rowspan='2' align='center' width='10' ><b>№ л.д.</b></td></tr>".
						"<tr><td align='center'><b>Требуется</b></td>".
						"<td align='center'><b>Выделено</b></td></tr>";
			
			if ($nab=='3')
			{
			if($KATEGOR!=$KATEGOR_OLD)
			{
			
				$KATEGOR_OLD=$KATEGOR;
				if ($KATEGORIA_OLD=='ned')
			{
			$html.=$s1;
			}
				//$html.=$s1;
				switch($KATEGOR)
				{
					case 29:
						if ($tur!='3')
							$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Рекомендованные к зачислению</td></tr>";
						else
							$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td></tr>";
						break;
					case 31:
						$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Резерв</td></tr>";
						break;
						
				}
				
			}
			}
			else
			{
			if($KATEGOR!=$KATEGOR_OLD)
			{
				$KATEGOR_OLD=$KATEGOR;
			if ($KATEGORIA_OLD=='ned')
			{
			$html.=$s1;
			}
				switch($KATEGOR)
				{
					case 29:
						if ($tur!='3')
							$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Рекомендованные к зачислению</td></tr>";
						else
							$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td></tr>";
						break;
					case 31:
						$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Резерв</td></tr>";
						break;
						
				}
			}
			}
			/*if($KATEGOR=='24')
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
					$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=14 align='left'>Абитуриенты, набравшие $BALL16 баллов</td></tr>";
					}
					
					
					if($BALL16<=$nummm && $switchhh=='0')
					{
						$switchhh=1;
						$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=14 align='left'>Не сдали экзамены</td></tr>";
					}
					//$num=1;
					$BALL16_OLD=$BALL16;	
				
				}
			}
			if($KATEGOR=='26' && $switchhh=='0')
			{
				$switchhh=1;
				$html.= "<tr><td><tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size=14 align='left'>Не сдали экзамены</td></tr>";
			}	*/
			
			if ($COLOR==1)
			{
				$col='#eeeeee';
			}
			else
			{
				$col='#ffffff';
			}
				
			$html .= "<tr bgcolor='$col'>" .
			"<td align='center' family='TimesNewRomanPSMT' size='10'>$num</td>" .
			//"<td align='center'>$ABI_NUMBER</td>" .
			"<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
			"<td align='center'>$BALL16</td>".
			"<td align='center'>$PRIORITET</td>".
			"<td align='center'>$TAWNAME_SMALL</td>".
			"<td align='center'>$DOC</td>".
			"<td align='center'>$HOST</td>".//.
			//if ($OJID==1)
			"<td align='center' size='9'>$OJID</td>";
		//else
		//$html .= "<td align='center'></td>";
			//"<td align='center'></td>";
//			"<td align='center'>$PRIKAZ</td>";
			if ( $PRIORITET != 1 )
				$html .= "<td align='center' valign='bottom' size='7'>$ABI_NUMBER</td>";
			else
				$html .= "<td align='center'></td>";
			
			$html .="</tr>";
			
			
				ora_fetch($cur);		
			}	
		}
	
	define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');
	
$p = new PDFTable();
$p->AddPage('P');
$p->SetMargins(10,10,10);
$p->AddFont('TimesNewRomanPSMT','','times.php');  
$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',14); 
$p->htmltable($html);

$p->output('','I');	


	//$html .="</table>";
?>
