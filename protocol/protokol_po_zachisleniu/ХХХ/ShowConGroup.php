<SELECT id="id_con" onChange="ConGrChange(this.value);">
<?php
$facid=$_GET['facid'];

 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $sql="SELECT ID_CON,CONGROUP FROM ABI_CONGROUP WHERE FACID=$facid  AND GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual) ORDER BY ID_CON";
 $cur=ora_do($conn,$sql);
 echo "<OPTION VALUE=''>--��������--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
	 		echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
	  ora_fetch($cur);
	 }
 ?>
      </SELECT><br/>
      <button onClick='GetReportCon(1,0)' style='width: 150px;'>(���.)</button>
      <button onClick='GetReportConEx(1,0)' style='width: 150px;'>Excel (���.)</button>
	  <button onClick='GetReportCon(2,0)' style='width: 150px;'>(���.)</button>
	  <button onClick='GetReportConEx(2,0)' style='width: 150px;'>Excel (���.)</button>
      <button onClick='GetReportCon(3,0)' style='width: 150px;'>(���.)</button>
     <button onClick='GetReportConEx(3,0)' style='width: 150px;'>Excel (���.)</button>
	 
	 <br/><button onClick='GetReportCon(1,1)' style='width: 150px;'>����.(���.)</button>
	 <button onClick='GetReportConEx(1,1)' style='width: 150px;'>����. Excel (���.)</button>
	 <button onClick='GetReportCon(2,1)' style='width: 150px;'>����.(���.)</button>
	 <button onClick='GetReportConEx(2,1)' style='width: 150px;'>����. Excel (���.)</button>
     <button onClick='GetReportCon(3,1)' style='width: 150px;'>����. (���.)</button>
     <button onClick='GetReportConEx(3,1)' style='width: 150px;'>����. Excel (���.)</button>
	 
	 <br/><button onClick='GetReportConPodval(1,1)' style='width: 150px;'>����.(���.) � ��������</button></td></tr>
	