<?php
$tur=$_GET['tur'];
$nab=$_GET['nab'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
switch($nab)
{
	case 1:
	$nabor='��������� ������';
	break;
	case 3:
	$nabor='������������� ������';
	break;
}
        $sql="begin ABI_RECOMMEND2020 ('$nab',0 ); end;";
 	 $cur=ora_do($conn,$sql);	
 	 ora_logoff($conn); 	 

	 echo "<center>��������� ��� $nabor ($tur ���)</center>";

?>
