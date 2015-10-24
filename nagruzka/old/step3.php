<?php
function ora_getcolumnzero($cur,$i)
{
	$a=ora_getcolumn($cur,$i);
	if ($a=='0') $a='&nbsp';
	return $a;
}
//get the q parameter from URL
$kurs=$_GET["kurs"];
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr2=$semestr=$_GET["semestr"];

$kod=$_GET["kod"];
//echo "<font color='blue'>Debug info: $semestr $god $kafedra $kurs $kod <br></font>";
if($semestr=='01.09.')
$semestr=$semestr.($god);
else
{
$semestr=$semestr.($god+1);
}
		$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		 $sql="INSERT INTO TEMP_VIBOR (KAFEDRA, VIPISKA, KURS) VALUES ('$kafedra', '$semestr','$kurs')";
		$cur=ora_do($conn,$sql);
		$cur=0;
		
		$sql="SELECT COUNT(GROCODE) FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND KOD='$kod'";
		$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
		$num=ora_getcolumnzero($cur,0);
		
		 
		ora_fetch($cur);
		}
		$cur=0;
		
		 $sql="SELECT GROCODE,GROID,KOLVO,SOVMESTNO,DIVID2,KOLWEEKS FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND KOD='$kod' ORDER BY GROCODE ";
		$cur=ora_do($conn,$sql);
		
	if (false)
	{ 
	echo "<CENTER><B><H2><BR>Нет данных по запросу";
	$cur=ora_do($conn,"TRUNCATE TABLE TEMP_VIBOR");
	}
	else 
	{
	 
	 // echo "$num";
?>
<INPUT TYPE='button' NAME="btnCheck" VALUE="Посмотреть нагрузку" onClick="ShowRasp(<?php echo "'$kafedra','$god','$semestr2'"; ?>)"><br/>
<INPUT TYPE='button' NAME="btnExcel" VALUE="Посмотреть в Excel" onClick="ShowRaspExcel(<?php echo "'$kafedra','$god','$semestr2'"; ?>)"><br/>
<B>Группы:</b><br />

<INPUT TYPE='button' NAME="btnCheck" VALUE="Выбрать" onClick="checkAll(true,<?php echo "$num";?>)">
<INPUT TYPE='button' NAME="btnCheck" VALUE="?" onClick="alert('Выделить все группы! Когда выделено больше 1-й группы, назначенный преподаатель автоматически присваивается каждой выбранной группе')"><br/>
<INPUT TYPE='button' NAME="btnCheck" VALUE="Снять" onClick="checkAll(false,<?php echo "$num";?>)">
<INPUT TYPE='button' NAME="btnCheck" VALUE="?" onClick="alert('Снять выделение с групп')"><br/>
<FORM id="check">
<table width='10'>
<tr><td widht='10' align='center'>Группа</td><td align='center'>Количество<br/>студентов</td><td></td></tr>
<?php
	for ($i=0;$i<ora_numrows($cur);$i++)
	{
		$grocode=ora_getcolumnzero($cur,0);
		$groid=ora_getcolumnzero($cur,1);
		$kolvo=ora_getcolumnzero($cur,2);
		$sovmestno=ora_getcolumnzero($cur,3);
		$divid2=ora_getcolumnzero($cur,4);
		$kolweeks=ora_getcolumnzero($cur,5);
		
		echo "<tr>
		 <td widht='10'  align='center'>$grocode</td>
		 <td align='center'>$kolvo</td><td align='center'><input type='checkbox' id='check$i' name='check' value='$groid' onClick='ShowPrepods($num)'></td>
		 </tr>";
		 
		ora_fetch($cur);
	}
	echo "</table>";
	
	
	if($sovmestno!='no' && isset($sovmestno))
	{		
		if($semestr2=='01.09.')$semestr='Осенний';
		else $semestr='Весенний';
		$god=$god.'/'.($god+1);
		
		 $sql="SELECT 
			COUNT(*) 
			FROM NAGRUZKA_SOVM 
			WHERE YEAR_GROCODE = '$god' AND SPRING_AUTUMN='$semestr'
			AND (DIVID1 = '$kafedra' OR DIVID2 = '$kafedra')  AND COUID='$kod'";
			$cur=ora_do($conn,$sql);
		 	$count=ora_getcolumn($cur,0);
		if($count==0)
		{
			 $sql="INSERT INTO NAGRUZKA_SOVM 
			(DIVID1,DIVID2,KOLWEEKS,SPRING_AUTUMN,YEAR_GROCODE,COUID) values
			('$kafedra','$divid2','$kolweeks','$semestr','$god','$kod')";
			$cur=ora_do($conn,$sql);
			$count=1;
		 	
		}
		if($count==1){
			 $sql="SELECT 
			DIVID1,DIVID2,KOLWEEKS,KOLWEEKS1,KOLWEEKS2,SPRING_AUTUMN,YEAR_GROCODE 
			FROM NAGRUZKA_SOVM 
			WHERE YEAR_GROCODE = '$god' AND SPRING_AUTUMN='$semestr'
			AND (DIVID1 = '$kafedra' OR DIVID2 = '$kafedra') AND COUID='$kod'";
			$cur=ora_do($conn,$sql);
		 	
		 	 $DIVID1=ora_getcolumnzero($cur,0);
		 	 $DIVID2=ora_getcolumnzero($cur,1);
			 $KOLWEEKS=ora_getcolumnzero($cur,2);
		 	 $KOLWEEKS1=ora_getcolumnzero($cur,3);
		 	 $KOLWEEKS2=ora_getcolumnzero($cur,4);
		 	 $SPRING_AUTUMN=ora_getcolumnzero($cur,5);
		 	 $YEAR_GROCODE=ora_getcolumnzero($cur,6);
		 	
			if($DIVID1==$kafedra)
			{
			$sw=1;
		   	$kol1=$KOLWEEKS1;
		   	$kol2=$KOLWEEKS2;
			}
			else
			{
			$sw=2;
		   	$kol1=$KOLWEEKS2;
		   	$kol2=$KOLWEEKS1;
			}
					
		echo "<center><font size='3' color='blue'>Занятия ведутся совместно с кафедрой: $sovmestno<br/>
		Введите кол-во недель, которое ведёт ваша кафедра.<br/>
		<input type='text' id='kolweeks' size='3' value='$kol1'> из <b>$KOLWEEKS</b>
		<input type='button' onClick='AddKolweeks($DIVID1,$DIVID2,$kod,$sw,$KOLWEEKS)' value='Записать'><br/>";
		
		if($kol2!=0)
		{
		echo "Кафедра $sovmestno отметила, что они ведут <b>$kol2</b> часов.";
		}
		
		echo "</center> 
		<div id='text6'></div>";
		}
		if($count==2){
		echo "<font size='3' color='red'>Внимание! Обратитесь в лабораторию, найдена дублирующая запись наличие которой может неправильно формировать отчётность!.";
		}
	}
	
	ora_logoff($conn);
}

?>
</table>
</FORM>
