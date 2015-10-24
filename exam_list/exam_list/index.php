<?
require_once('../roles.php');
?>
<html>
<head>
<title>Экзаменационный лист абитуриента</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script.js"></script>
</head>

<body>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER">Экзаменационный лист абитуриента</B></font>

<table border="1" align="center">
  <tr> 
    <td><B>Факультет:</B></td>
    <td><SELECT id="fac" onChange="FacChange(this.value);">
<?php

 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 
if ( $role == 'vip' )
	$cur=ora_do($conn,"SELECT DISTINCT FACID,FACNAME from ABIVIEW_LISTOFEXAM ORDER BY FACNAME");
else if ( $clientdivid != 485 )
	$cur=ora_do($conn,"SELECT DISTINCT FACID,FACNAME from ABIVIEW_LISTOFEXAM where facid <> 15 ORDER BY FACNAME");
else
	$cur=ora_do($conn,"SELECT DISTINCT FACID,FACNAME from ABIVIEW_LISTOFEXAM where facid = 15 ORDER BY FACNAME");

 echo "<OPTION VALUE=''>--выберите--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
	 		echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
	  ora_fetch($cur);
	 }
 ?>
      </SELECT><div id='facs'></div></td>
  </tr>
  <tr> 
  <td><B>Конкурсная группа:</td>
  <td><div id='congr'>выберите факультет</div></td>
  </tr>
    <tr> 
  <td><B>Специальность:</td>
  <td><div id='spec'>выберите конкурсную группу</div></td>
  </tr>
  <tr> 
  <td><B>Абитуриент:</td>
  <td><div id='abi'>выберите специальность</div></td>
  </tr> </table>
  
<!--  <form name="form1">
  <table><tr><td>&nbsp;</td></tr>
  <tr><td><FONT FACE="Garamond" SIZE=4>
  <input type="radio" name="radios" id="radios">Только медалисты</td></tr>
  <tr><td><FONT FACE="Garamond" SIZE=4><input type="radio" name="radios" id="radios">Без медалистов
  </td></tr></table>

</form>-->
 
</body>
</html>
