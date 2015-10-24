<?php
$tur=$_GET['tur'];
$nab=$_GET['nab'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
// для вывода результата 
switch($nab)
{
	case 1:
	  $nabor='бюжетного набора';
	  break;
	case 3:
	  $nabor='коммерческого набора';
	  break;
	case 4:
	  $nabor='30 июля';
	  break;
	case 5:
	  $nabor='Пересчитать общежитие';
	  break;
}

// запуск процедуры в зависимости от входных параметров
// бюджет, 1 тур
if ($nab == 1 and $tur == 1) {
	$sql="begin abi_rec_GRAN_2013; end;";//1 тур прошел, закомментировано, чтобы не сбить списки
}
// бюджет, 2 тур
if ($nab == 1 and $tur == 2) {
//	$sql="begin abi_rec_GRAN_2TUR_2012; end;";
}
// коммерция, 1 тур
if ($nab == 3 and $tur == 1) {
	$sql="begin abi_rec_MEST_2012; end;";
}
// коммерция, 2 тур
if ($nab == 3 and $tur == 2) {
//	$sql="begin null; end;";
}
// 30 июля
if ($nab == 4) {
	$sql="begin abi_30072012; end;";//1 тур прошел, закомментировано, чтобы не сбить списки
}
// Пересчитать общежитие
if ($nab == 5) {
	$sql="begin abi_PERESCHET_HOSTEL_2012; end;";
}
$cur = ora_do( $conn, $sql );	
ora_logoff( $conn ); 	 
echo "<center>Завершено для $nabor ($tur тур).</center>";
?>