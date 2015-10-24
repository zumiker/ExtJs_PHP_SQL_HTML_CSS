<style type="text/css">
<!--

table {

  width:100%;
  border-collapse:collapse;
}

/* the border will be defined by the td tags */
td.BorderMeRed {

  border:2px solid red;

}

/* let's do a blue... */
td.last {

  border:2px solid blue;

}

/* and of course a default one */
td {

  border:1px solid black;
}

-->
</style>

<script type="text/javascript" src="script.js"></script>
<body onLoad="pageLoad()">

<hr>
<center><h1>НАГРУЗКА УМУ</h1></center>
<br><br>
<h2><a href="stuff/" target="_blank">Список преподавателей</a></h2>
<h2><a href="../pps" target="_blank">ППС</a></h2>
<table style="">
<tr>
<td width='300'>
<B>Учебный год:  
</td>
<td>
<SELECT NAME="god" id="god" onChange="ShowKurs(this.value)">
<option value="0">--выбрать--</option>
<?php
$rdate=getdate();
$curryear=$rdate[year];
$curryear--;
//$curryear++;
echo $currmonth=$rdate[mon];
/*
if ($currmonth<9) $curryear--;
echo '<OPTION VALUE="'.$curryear.'">'.$curryear;
echo '/';
echo ($curryear+1);
for ($i=1;$i<4;$i++)
{
echo '<OPTION VALUE="'.($curryear+$i);
echo '">'.($curryear+$i);
echo '/';
echo ($curryear+$i+1);
}
*/
if ( $currmonth < 9 )
	$curryear = $curryear - 2;
echo '<OPTION VALUE="'.$curryear.'">'.$curryear;
echo '/';
echo ( $curryear + 1 );
for ( $i = 1; $i < 4 ; $i++ )
{
	echo '<OPTION VALUE="'.( $curryear + $i );
	echo '">'.( $curryear + $i );
	echo '/';
	echo ( $curryear + $i + 1 );
}

?>
</SELECT>
</td>

<tr><td>
<B>Выберите семестр:
</td>
<td>
<SELECT NAME="semestr" id="semestr" onChange="ShowKurs(this.value)">
<option value="0">--выбрать--</option>
<OPTION VALUE="01.09.">Осенний</OPTION>
<OPTION VALUE="01.03.">Весенний</OPTION>
</SELECT>
</td>

<tr><td>
<B>Выберите факультет:
</td><td>
<select name="fac" id="fac" onChange="ShowFac(this.value)" >
<option value="999" selected>Уровень университета</option>
<?php
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$cur=ora_do($conn,"SELECT FACID,FAC from V_SPI_FAC_GUM WHERE FACID NOT IN (9,11) ORDER BY FAC"); 
for ($i=0;$i<ora_numrows($cur);$i++)
 {
 echo "<OPTION VALUE='";
 echo ora_getcolumn($cur,0);
 echo "'>";
 echo ora_getcolumn($cur,1);
 ora_fetch($cur);
 }
 $cur=0;
// <input type='button' onclick="ShowKurs(this.value)" value='Продолжить'>
 ?>
</select> </td>
<td width='150'><input type='button' onClick='ShowRaspShtat()' value='Нагрузка по кафедрам'>
<input type='button' onClick='ShowPlanPPS()' value='Плановая численность ППС'>
 <!-- <input type='button' onClick='ShowRaspPochas()' value='Нагрузка по кафедрам (почас.)'> 
<input type='button' onClick='ShowRaspSovm()' value='Нагрузка по кафедрам (совм.)'> -->
</td> 
<td width='150'><input type='button' onClick='ShowRaspExcelFull()' value='Нагрузка (итоговая/годовая)'>
<!-- <input type='button' onClick='ShowRaspExcelItog()' value='Нагрузка (итог) - excel'> -->
<input type='button' onClick='ShowRaspPrepodsExcel()' value='Преподаватели - excel'></td>
</tr>
</table>


<div id="text"> </div>

<br><br><hr>
<?php include ("../copyright.php");
?>