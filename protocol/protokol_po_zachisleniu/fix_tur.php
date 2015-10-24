<?php
$tur=$_GET['tur'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$tur1 = $tur-1;

//$sql="update abi_prior_12 set tur_fix='$tur' where tur='$tur' and tur_fix='$tur1'";
//$sql="update abi_prior set proshel=tur where nabor in ( 1, 2 )";
/*
$sql = "update abi_prior 
		set proshel = tur 
		where nabor in ( 1, 2 )
			and tur_fix = 1";
*/
$sql = "update abi_prior
		set proshel = 30
		where nabor = 3
			and tur = 29
			and edudocoriginal = 1
			and proshel <> 30
			and abi_id in ( 
				select abi_id
				from abi_comdog
				where oplata = 1
			)";
$cur=ora_do($conn,$sql);	
ora_logoff($conn); 	 
	 
echo "<center>Тур $tur успешно зафиксирован</center>";

?>
