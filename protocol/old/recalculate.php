<?php
$tur=$_GET['tur'];
$nab=$_GET['nab'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
// ��� ������ ���������� 
switch($nab)
{
	case 1:
	  $nabor='��������� ������';
	  break;
	case 3:
	  $nabor='������������� ������';
	  break;
	case 4:
	  $nabor='30 ����';
	  break;
	case 5:
	  $nabor='����������� ���������';
	  break;
}

// ������ ��������� � ����������� �� ������� ����������
// ������, 1 ���
if ($nab == 1 and $tur == 1) {
	$sql="begin abi_rec_GRAN_2013; end;";//1 ��� ������, ����������������, ����� �� ����� ������
}
// ������, 2 ���
if ($nab == 1 and $tur == 2) {
//	$sql="begin abi_rec_GRAN_2TUR_2012; end;";
}
// ���������, 1 ���
if ($nab == 3 and $tur == 1) {
	$sql="begin abi_rec_MEST_2012; end;";
}
// ���������, 2 ���
if ($nab == 3 and $tur == 2) {
//	$sql="begin null; end;";
}
// 30 ����
if ($nab == 4) {
	$sql="begin abi_30072012; end;";//1 ��� ������, ����������������, ����� �� ����� ������
}
// ����������� ���������
if ($nab == 5) {
	$sql="begin abi_PERESCHET_HOSTEL_2012; end;";
}
$cur = ora_do( $conn, $sql );	
ora_logoff( $conn ); 	 
echo "<center>��������� ��� $nabor ($tur ���).</center>";
?>