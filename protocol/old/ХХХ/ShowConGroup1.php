<SELECT id="id_con" onChange="ConGrChange1(this.value);">
<?php
$facid=$_GET['facid'];
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $sql="SELECT ID_CON,CONGROUP FROM ABI_CONGROUP WHERE FACID=$facid  AND GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual) ORDER BY ID_CON";
 $cur=ora_do($conn,$sql);
 echo "<OPTION VALUE=''>--выберите--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
	 		echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
	  ora_fetch($cur);
	 }
 ?>
      </SELECT></td><td>
      <button onClick='GetReportCon1(1)'>(Бюд.) с тел.</button>
      <button onClick='GetReportCon1(3)'>(Ком.) с тел.</button>