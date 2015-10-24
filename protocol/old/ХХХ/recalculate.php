<?php
$tur=$_GET['tur'];
$nab=$_GET['nab'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
switch($nab)
{
	case 1:
	$nabor='бюжетного набора';
	break;
	case 3:
	$nabor='коммерческого набора';
	break;
}
        $sql="begin ABI_RECOMMEND2020 ('$nab',0 ); end;";
 	 $cur=ora_do($conn,$sql);	
 	 ora_logoff($conn); 	 

	 echo "<center>Завершено для $nabor ($tur тур)</center>";

?>
