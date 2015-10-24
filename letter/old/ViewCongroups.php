<table border="0" align="center">
  <tr> 
    <td><B>Выберите конкурсную группу:</B></td></tr>

<?php
 $year=date('Y');
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $cur=ora_do($conn,"SELECT ID_CON,CONGROUP from ABI_CONGROUP");

	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$id_con=ora_getcolumn($cur,0);
	 		$CONGROUP=ora_getcolumn($cur,1);
	 		//echo "<tr><td align='center'><button onClick='ViewCongroup($ID_CON)' style='background-color:lightblue; width: 180px;'>$CONGROUP</button></td></tr>";
	 			echo "<tr><td align='left'><a href=# onClick='ViewCongroup($id_con)'>$CONGROUP</a></td></tr>";
	  ora_fetch($cur);
	 }
 ?>
    
  
  </table>