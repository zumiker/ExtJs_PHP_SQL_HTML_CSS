<?php

  	$musorid=$_GET["musorid"];
  	$id_con=$_GET["id_con"];
  	
  	$abi_id=$_GET["abi_id"];
  	$abi_id = explode(",", $abi_id);
  	
  	$orderid=$_GET["orderid"];
  	
  	
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 	for ($i = 0; $i < sizeof($abi_id); $i++) {
 	
 	if(strlen($abi_id[$i])==0)
 	{
 		continue;
 	}
		$sql="select tnabor from abi_orders where orderid=$orderid";
		$cur=ora_do($conn,$sql);
		$nabor=ora_getcolumn($cur,0);
		
		$sql="INSERT INTO ABI_ORDERS_MAN (ORDERID,ABI_ID,CON_ID) VALUES('$orderid','$abi_id[$i]','$id_con')";
		$cur=ora_do($conn,$sql);
		$sql="UPDATE ABI_PRIOR SET PROSHEL='$musorid' WHERE ABI_ID='$abi_id[$i]' AND NABOR=$nabor AND CON_ID='$id_con'";
		$cur=ora_do($conn,$sql);
		$sql="UPDATE ABITURIENT SET PROSHEL='$musorid' WHERE ABI_ID='$abi_id[$i]'";
		$cur=ora_do($conn,$sql);	
			
 	}
 	ora_logoff($conn);
  	//echo "<center><b>Запись сохранена ".date("H:i:s")."</b></center>";  
	//$_GET["year"]=$year;
	//$_GET["facid"]=$facid;
	//$_GET["idcon"]=$idcon;
	//include("ShowAbiRasp.php");


?>
