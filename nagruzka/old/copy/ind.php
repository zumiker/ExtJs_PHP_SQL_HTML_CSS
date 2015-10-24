<style type="text/css">
<!--

table {
  background-color:#DEDFDE;
  width:100%;
  border-collapse:collapse;
}

/* the border will be defined by the td tags */
td.BorderMeRed {
  background-color:#DEDFDE;
  border:2px solid red;

}

/* let's do a blue... */
td.last {
  background-color:#DEDFDE;
  border:2px solid blue;

}

/* and of course a default one */
td {
  background-color:#DEDFDE;
  border:1px solid black;
}

-->
</style>

<script type="text/javascript" src="script.js"></script>
<body onLoad="pageLoad()">

<hr>
<B><FONT FACE="Garamond" SIZE=6><P align="center"> НАГРУЗКА <FONT FACE="Garamond" SIZE=5></B>

<FONT FACE="Garamond" SIZE=5><P align="center"> введите указания для формирования нагрузки <FONT FACE="Garamond" SIZE=5><br><br>


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
$curryear=$rdate['year'];
$currmonth=$rdate['month'];
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
<B>Выберите кафедру или факультет:
</td><td>
<select name="kafedra" id="kafedra" onChange="ShowKurs(this.value)" >
<option value="0">--выбрать--</option>
<?php
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$cur=ora_do($conn,"SELECT DIVID,DIVABBREVIATE from V_SPI_KAFEDR WHERE DIVID!=209 ORDER BY DIVNAME"); 
for ($i=0;$i<ora_numrows($cur);$i++)
 {
 echo "<OPTION VALUE='";
 echo ora_getcolumn($cur,0);
 if (!isset($_SESSION['kafedra'])) $_SESSION['kafedra']=ora_getcolumn($cur,0);
 if (ora_getcolumn($cur,0)==$_SESSION['kafedra']) echo "' selected >";
 	else echo "'>";
 echo ora_getcolumn($cur,1);
 ora_fetch($cur);
 }
 $cur=0;
// <input type='button' onclick="ShowKurs(this.value)" value='Продолжить'>
 ?>
 </select> 
</td> 
</tr>
</table>


<div id="text"> </div>

<br><br><hr>
<?php include ("../copyright.php");
?>