<SELECT id="id_con" onChange="ConGrChange(this.value);">
<?php
$facid=$_GET['facid'];
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
//	$sql="SELECT ID_CON,CONGROUP FROM ABI_CONGROUP WHERE FACID=$facid AND GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual) ORDER BY ID_CON";
	$sql = "SELECT distinct cs.ID_CON, CONGROUP
			FROM abi_spec s, abi_con_spec cs, ABI_CONGROUP c
			WHERE s.FACID=$facid
			AND c.GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual)
			and cs.id_spec=s.spcid
			and cs.id_con=c.id_con
			ORDER BY ID_CON";
 $cur=ora_do($conn,$sql);
 echo "<OPTION VALUE=''>--выберите--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
	 		echo "<OPTION VALUE='$FACID'>$FACNAME</OPTION>";
	  ora_fetch($cur);
	 }
 ?>
      </SELECT></td><td><!--<button onClick='GetReportCon()'>получить отчёт</button>-->
      <button onClick='GetReportCon(1,undefined)'>(Бюд.)</button>
      <button onClick='GetReportCon(2,undefined)'>(Цел.)</button>
      <button onClick='GetReportCon(3,undefined)'>(Ком.)</button>
      <!--<button onClick='GetReportCon(undefined,1)'>Только медалисты</button>
      <button onClick='GetReportCon(undefined,2)'>Без медалистов</button>-->
