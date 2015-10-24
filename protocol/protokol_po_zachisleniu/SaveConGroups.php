<?php

  	
  	$dop=$_GET["dop"];
  	$dop = explode(",", $dop);

  	$con=$_GET["con"];
  	$con = explode(",", $con);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 	for ($i = 0; $i < sizeof($con); $i++) {

		$sql="UPDATE ABI_CONGROUP SET DOPUSK='$dop[$i]' " .
				"WHERE ID_CON='$con[$i]'";
		$cur=ora_do($conn,$sql);	
	 	
 	}
 	
 	/*$sql="begin ABI_RECOMMEND ('1','0' ); end;";
 	 $cur=ora_do($conn,$sql);*/
	 
 	 ora_logoff($conn);	
 	 
  	echo "<center>Сохранение произведено успешно.</center>";	

?>

