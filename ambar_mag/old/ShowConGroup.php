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
		echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
		ora_fetch($cur);
	}
?>
</SELECT>
	<br/><button onClick='GetReportCon()'>Все</button>
	<button onClick='GetReportCon(1)'>(Бюд.)</button>
	<button onClick='GetReportCon(2)'>(Цел.)</button>
	<button onClick='GetReportCon(3)'>(Ком.)</button>
	<button onClick='GetReportCon(4)'>(Иностр.)</button>
