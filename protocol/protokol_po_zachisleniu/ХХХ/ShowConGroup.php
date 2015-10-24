<SELECT id="id_con" onChange="ConGrChange(this.value);">
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
      </SELECT><br/>
      <button onClick='GetReportCon(1,0)' style='width: 150px;'>(Бюд.)</button>
      <button onClick='GetReportConEx(1,0)' style='width: 150px;'>Excel (Бюд.)</button>
	  <button onClick='GetReportCon(2,0)' style='width: 150px;'>(Цел.)</button>
	  <button onClick='GetReportConEx(2,0)' style='width: 150px;'>Excel (Цел.)</button>
      <button onClick='GetReportCon(3,0)' style='width: 150px;'>(Ком.)</button>
     <button onClick='GetReportConEx(3,0)' style='width: 150px;'>Excel (Ком.)</button>
	 
	 <br/><button onClick='GetReportCon(1,1)' style='width: 150px;'>Подл.(Бюд.)</button>
	 <button onClick='GetReportConEx(1,1)' style='width: 150px;'>Подл. Excel (Бюд.)</button>
	 <button onClick='GetReportCon(2,1)' style='width: 150px;'>Подл.(Цел.)</button>
	 <button onClick='GetReportConEx(2,1)' style='width: 150px;'>Подл. Excel (Цел.)</button>
     <button onClick='GetReportCon(3,1)' style='width: 150px;'>Подл. (Ком.)</button>
     <button onClick='GetReportConEx(3,1)' style='width: 150px;'>Подл. Excel (Ком.)</button>
	 
	 <br/><button onClick='GetReportConPodval(1,1)' style='width: 150px;'>Подл.(Бюд.) с резервом</button></td></tr>
	