<SELECT id="fac" onChange="FacChange(this.value);">
<?php
$_SESSION['tur']=$tur=$_GET['tur'];
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
      </SELECT><br/>
	  <?php echo "tur ".$tur;?>

	