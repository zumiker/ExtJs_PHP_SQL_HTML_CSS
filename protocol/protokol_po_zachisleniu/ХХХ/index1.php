<html>
<head>
<title>Протокол по зачислению (с телефонами)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script.js"></script>
</head>
<?php
 session_start();
 $year=date('Y');
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $cur=ora_do($conn,"SELECT ID_CON,CONGROUP,DOPUSK from ABI_CONGROUP WHERE ID_CON<=252 AND GOD='$year'");
 ?>
 
<body>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER">Протокол по зачислению (с телефонами)</B>

<table border="1" align="center">

<tr>
	<td><b>Тур</b></td>
	<td><select  id='id_tur'>
<OPTION VALUE=99 selected>--выберите--</option>
<OPTION VALUE=1>Первый</option>
<OPTION VALUE=2>Второй</option>
<OPTION VALUE=3>Третий</option>
</select></td>
	<td></td>
 </tr>
 
  <tr> 
    <td><B>Факультет:</B></td>
    <td><SELECT id="fac" onChange="FacChange1(this.value);">
<?php

 //$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC ORDER BY FACNAME");
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
  <tr><td colspan='2' align='center'><!-- Без предметов:--><INPUT TYPE=HIDDEN NAME="pdf" id='pdf' checked>
  </td></tr>
  </table>

 
</body>
</html>
