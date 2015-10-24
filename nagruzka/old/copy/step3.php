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
$semestr=$_GET["semestr"];
$kod=$_GET["kod"];
//echo "<font color='blue'>Debug info: $semestr $god $kafedra $kurs $kod <br></font>";
$semestr=$semestr.$god;

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
		
		$sql="SELECT GROCODE,GROID FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND KOD='$kod' ORDER BY GROCODE ";
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
<B>Группы:</b><br />

<INPUT TYPE='button' NAME="btnCheck" VALUE="Выбрать" onClick="checkAll(true,<?php echo "$num";?>)">
<INPUT TYPE='button' NAME="btnCheck" VALUE="?" onClick="alert('Выделить все группы! Когда выделено больше 1-й группы, назначенный преподаатель автоматически присваивается каждой выбранной группе')"><br/>
<INPUT TYPE='button' NAME="btnCheck" VALUE="Снять" onClick="checkAll(false,<?php echo "$num";?>)">
<INPUT TYPE='button' NAME="btnCheck" VALUE="?" onClick="alert('Снять выделение с групп')"><br/>
<FORM id="check">
<table width='10'>

<?php
	for ($i=0;$i<ora_numrows($cur);$i++)
	{
		$grocode=ora_getcolumnzero($cur,0);
		$groid=ora_getcolumnzero($cur,1);
		 //echo "$grocode$groid</td></tr>";
		 echo "<tr><td widht='10' align='right'>$grocode</td><td><input type='checkbox' id='check$i' name='check' value='$groid' onClick='ShowPrepods($num)'></td></tr>";
		 
		ora_fetch($cur);
	}
	ora_logoff($conn);
}?>
</table>
</FORM>
