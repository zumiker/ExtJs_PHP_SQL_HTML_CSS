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
//echo "<font color='blue'>Debug info: $semestr $god $kafedra $kurs <br></font>";
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
		 $sql="SELECT DISTINCT PREDMET2,KOD FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND COUVID='0' ORDER BY PREDMET2";
		//$sql="SELECT DISTINCT PREDMET,KOD FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND COUVID='0' ORDER BY PREDMET ";
	//	$sql="SELECT GROCODE,GROID FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND KOD='270' ORDER BY GROCODE ";
		$cur=ora_do($conn,$sql);
	
	if (false)
	{ 
	echo "<CENTER><B><H2><BR>Нет данных по запросу";
	$cur=ora_do($conn,"TRUNCATE TABLE TEMP_VIBOR");
	}
	else 
	{
?>
<table>
<tr><td width='300'>
<B>Выберите Предмет: 
</td><td>
<select name="kod" id="kod" onchange="ShowGroup(this.value)" >
<option value='0'>--выбрать--</option>
<?php

	for ($i=0;$i<ora_numrows($cur);$i++)
	{
		$predmet=ora_getcolumn($cur,0);
		$kod=ora_getcolumn($cur,1);
		
		echo "<OPTION VALUE='$kod'>$predmet</option>";
		
		ora_fetch($cur);
	}


	ora_logoff($conn);
	}
?>
</select>
</td></tr>
</table>
<table>
<tr>
	<td width='300' valign='top'>
	<div id="text3" align='right' > </div>
	</td>
	<td valign='top'>
	<div id="text4"> </div>
	</td>
	</tr>
</table>