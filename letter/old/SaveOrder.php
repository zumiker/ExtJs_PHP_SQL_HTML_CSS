<?php


  	$ordernum=$_GET["ordernum"];
  	
  	$orderdate=$_GET["orderdate"];
  	
  	$ordercomment=$_GET["ordercomment"];
  	$tnabor=$_GET["tnabor"];
  	
 $year=date('Y');  	
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 	
 	$sql="SELECT SEQ_ABI_ORDERS.NextVal FROM DUAL";
 	$cur=ora_do($conn,$sql);
 	$nextval=ora_getcolumn($cur,0);
 	
	$sql="INSERT INTO ABI_ORDERS (ORDERID,ORDERNUMBER,ORDERDATE,COMMENTS,YEAR,TNABOR) VALUES('$nextval','$ordernum', TO_DATE('$orderdate','DD-MM-YYYY'),'$ordercomment','$year','$tnabor')";
		$cur=ora_do($conn,$sql);

	
 
 	ora_logoff($conn);
 	
  	//echo "<center><b>Запись сохранена ".date("H:i:s")."</b></center>";  
	//$_GET["year"]=$year;
	//$_GET["facid"]=$facid;
	//$_GET["idcon"]=$idcon;
	include("ViewOrders.php");


?>
