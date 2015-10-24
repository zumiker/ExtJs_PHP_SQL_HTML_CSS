<?php

  	
  	$abi_id=$_GET["abi_id"];
  	$sort=$_GET["sort"];
	$filter=$_GET["filter"];
  	$id_con=$_GET["id_con"];
  	
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

 	if(strlen($abi_id)!=0)
 	{
		$sql="select tnabor from abi_orders where orderid=(select orderid FROM ABI_ORDERS_MAN WHERE ABI_ID='$abi_id')";
		$cur=ora_do($conn,$sql);
		$nabor=ora_getcolumn($cur,0);
 		$sql="DELETE FROM ABI_ORDERS_MAN WHERE ABI_ID='$abi_id'";
		$cur=ora_do($conn,$sql);
		$sql="UPDATE ABITURIENT SET PROSHEL='29' WHERE ABI_ID='$abi_id'";
		$cur=ora_do($conn,$sql);
		$sql="update abi_prior set proshel=29,tur=3 where ABI_ID='$abi_id' AND con_id='$id_con' and nabor=$nabor";
		$cur=ora_do($conn,$sql);
 	}
			
			
 	ora_logoff($conn);
 	
 	
  	//echo "<center><b>Запись сохранена ".date("H:i:s")."</b></center>";  
	$_GET["sort"]=$sort;
	$_GET["filter"]=$filter;
	$_GET["id_con"]=$id_con;
	include("ViewCongroup.php");


?>
