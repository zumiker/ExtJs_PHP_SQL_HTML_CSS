<?
require_once('../roles.php');
?>
<html>
<head>
<title>Проверка базы данных по абитуриенту ("Амбарная книга")</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script.js"></script>
</head>

<body>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER">Проверка базы данных по абитуриенту </br>("Амбарная книга для магистров")</B>

<table border="1" align="center">
  <tr> 
    <td><B>Факультет:</B></td>
    <td>
<SELECT id="fac" onChange="FacChange(this.value);">
<?php

 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

if ( $role == 'vip' )
	$cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC ORDER BY FACNAME");
else if ( $clientdivid != 349 )
	$cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC where facid <> 15 ORDER BY FACNAME");
else
	$cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC where facid = 15 ORDER BY FACNAME");

 echo "<OPTION VALUE=''>--выберите--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
		
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
			if(!($FACID=='9'))
			{
				echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
			}	
/*			else
			{
				echo "<OPTION disabled VALUE='$FACID'>$FACNAME</option>";
			}*/
	  ora_fetch($cur);
	 }
	 $d1=date("d.m.Y");
 ?>
      </SELECT><div id='facs'></div></td>
  </tr>
<!--  <tr> 
  <td><B>Конкурсная группа:</td>
  <td><div id='congr'>выберите факультет</div></td>
  </tr>
    <tr> 
  <td><B>Специальность:</td>
  <td><div id='spec'>выберите конкурсную группу</div></td>
  </tr>-->
  <tr>
  <td colspan='2' align='center'><!-- сортировка:
  <select id='sort'>
  <option value=1 selected>Конкурсная группа, Специальность, Набор, Номер л.д.</option>
  <option value=2>Конкурсная группа, Специальность, Набор, Фамилия, Имя, Отчество</option>
  <option value=3>Фамилия, Имя, Отчество</option>
  </select>
  <br/>Отчёт в PDF:<INPUT TYPE=CHECKBOX checked id='pdf'>
   <br/>Отчёт в PDF:--><INPUT TYPE=HIDDEN NAME="pdf" checked id='pdf'>
 <p align="left">  Сортировка:<br>
 <select id="sort1">
 <option value="1">По умолчанию</option>
 <option value="2">По фамилии</option>
 <option value="3">По приоритету</option>
 <option value="4" disabled>По номеру личного дела</option>
 <option value="5" disabled>По дате рождения</option>
<!--<input type="radio"  name="sort1" value="0"> По умолчанию<Br>
<input type="radio"  name="sort1" value="1"> По фамилии<Br>
<input type="radio"  name="sort1" value="2"> По приоритету<Br>
<input type="radio"  name="sort1" value="3"> По номеру личного дела<Br>-->
</select>
</p>
 </td></tr>
  </table>
  
  <table><tr><td colspan='6' align='center'>Для того, чтобы получить отчёт на конкретный<br/> промежуток времени, введите дату</td></tr>
<tr><td>За промежуток c:</td>
<!--<textarea rows="1" cols="10" name="date1"><?php echo $d1; ?></textarea>:<br /> 
	<td> <?php //echo '<input type="text" id="start" value="dd.mm.yyyy">'; ?> </td><td>по:</td>//-->
	<td> <?php echo '<input type="text" id="start" value='.$d1.'>'; ?> </td><td>по:</td>

	<td><?php echo '<input type="text" id="end" >'; ?></td></tr>
</table>
<?php $d=date("d.m.Y H:i ");
//echo $d;
//	echo "Введите текущую дату в первое поле, например 03.03.2010";?>
<!-- <textarea rows="1" cols="20" name="date2"> <?php echo $d1; ?></textarea>:<br /> //-->
</body>
</html>
