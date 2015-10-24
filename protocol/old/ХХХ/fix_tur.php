<?php
$tur=$_GET['tur'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$tur1 = $tur-1;
   //  $sql="UPDATE ABI_PRIOR SET TUR_FIX='$tur' WHERE TUR='$tur' AND TUR_FIX='$tur1'";
	 //$sql="UPDATE ABI_PRIOR SET proshel=tur WHERE nabor=1";
 	 $cur=ora_do($conn,$sql);	
 	 ora_logoff($conn); 	 
	 
     echo "<center>$tur успешно зафиксирован</center>";

?>
