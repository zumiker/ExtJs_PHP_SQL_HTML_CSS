<SELECT id="id_pr" onChange="">
<?php
$id_spec=$_GET['id_con'];
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $sql="SELECT DISTINCT CON_ID, ID_PR, PREDMET FROM ABIVIEW_LISTOFEXAM WHERE CON_ID=$id_con";
 $cur=ora_do($conn,$sql);
 echo "<OPTION VALUE=''>--выберите--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$ID_PR=ora_getcolumn($cur,1);
	 		$PREDMET=ora_getcolumn($cur,2);
	 		echo "<OPTION VALUE='$ID_PR'>$PREDMET</option>";
	  ora_fetch($cur);
	 }
 ?>
      </SELECT></td><td>
