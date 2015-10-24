<SELECT id="id_spec" onChange="SpecChange(this.value);">
<?php
$id_con=$_GET['id_con'];
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 
 $sql1="SELECT ID_CON, ID_SPEC FROM ABI_CON_SPEC WHERE  ID_CON='$id_con'";
	$cur1=ora_do($conn,$sql1);
echo "<OPTION VALUE=''>--выберите--</option>";	
	 for ($i=0;$i<ora_numrows($cur1);$i++)
 {
 	$spcid=ora_getcolumn($cur1,1);
 	$sql2="SELECT SPCNAME, SPCID FROM ABI_SPEC WHERE  SPCID='$spcid'";
	$cur2=ora_do($conn,$sql2);
	
		 for ($g=0;$g<ora_numrows($cur2);$g++)
 		{
		 	 
		 $SPCNAME= ora_getcolumn($cur2,0);
		 $SPCID= ora_getcolumn($cur2,1);
		 	 
		 echo "<OPTION VALUE='$SPCID'>$SPCNAME</OPTION>";
		
		 ora_fetch($cur2);
 		}
 ora_fetch($cur1);
 } 
 
 ?>
      </SELECT></td><td><!--<button onClick='GetReportSpec()'>получить отчёт</button>-->
      <button onClick='GetReportSpec(1)'>(Бюд.)</button>
      <button onClick='GetReportSpec(2)'>(Цел.)</button>
      <button onClick='GetReportSpec(3)'>(Ком.)</button>
      <!--<button onClick='GetReportSpec(undefined,1)'>Только медалисты</button>
      <button onClick='GetReportSpec(undefined,2)'>Без медалистов</button>-->