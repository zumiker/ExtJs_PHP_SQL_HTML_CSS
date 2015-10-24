<SELECT id="id_abi" onChange="">
<?php
$id_spec=$_GET['id_spec'];
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $sql="SELECT DISTINCT CON_ID, ABI_ID, LASTNAME, FIRSTNAME,PATRONYMIC FROM ABIVIEW_LISTOFEXAM WHERE SPECID=$id_spec ORDER BY LASTNAME"  ;
 $cur=ora_do($conn,$sql);
 echo "<OPTION VALUE=''>--выберите--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$ABI_ID=ora_getcolumn($cur,1);
	 		$LASTNAME =ora_getcolumn($cur,2);
	 		$FIRSTNAME=ora_getcolumn($cur,3);
	 		$PATRONYMIC=ora_getcolumn($cur,4);
	 		echo "<OPTION VALUE='$ABI_ID'>$LASTNAME $FIRSTNAME[0].$PATRONYMIC[0].</OPTION>";
	  ora_fetch($cur);
	 }
 ?>
      </SELECT></td><td><button onClick='GetReportAbi()'>получить отчёт</button>

