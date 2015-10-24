<html>
<head></head>

<body>
<?php
ini_set('display_errors', 1);
error_reporting(2047);

include_once('OracleDB.php');

$orderid = $_GET['id'];

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql = "SELECT ORDERNUMBER,TNABOR FROM ABI_ORDERS WHERE ORDERID = $orderid";
$cur=ora_do($conn,$sql);
$ORDERNUMBER=ora_getcolumn($cur,0);
$TNABOR=ora_getcolumn($cur,1);
				


$sql =  'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
	initcap(LASTNAME) || \' \' || initcap(FIRSTNAME) || \' \' || initcap(PATRONYMIC) as NAME, 
	FACNAME  , con.congroup AS CONGR, NEEDHOSTEL, pr.SUMBALL as BALL, con.id_con AS CONID
	FROM abi_orders_man o, abiturient a, abi_spec s, faculty f, abi_prior pr, abi_congroup con
	WHERE  f.FACID=s.FACID AND o.ABI_ID=a.ABI_ID AND pr.CON_ID=con.ID_CON AND a.ABI_ID=pr.abi_id AND pr.nabor='.$TNABOR.' AND pr.SPECID=s.SPCID 
	AND o.ORDERID=' . $orderid . ' and pr.proshel=30 ORDER BY pr.CON_ID, s.SPCNAME, pr.SUMBALL desc';

$sql =  'SELECT SPC, 
	initcap(LASTNAME) || \' \' || initcap(FIRSTNAME) || \' \' || initcap(PATRONYMIC) as NAME, 
	FACNAME  , congroup , NEEDHOSTRL, BALL, CON_ID
	FROM ABI_REPORT_PRIKAZ 
  	WHERE TNABOR='.$TNABOR.' AND ORDERID=' . $orderid . '  AND PROSHEL=30 ORDER BY CON_ID, SPC, BALL desc';

		
$data = $db -> fetchAll($sql);

$cur_fac = '';
$cur_spc = '';

$counter = 1;
foreach ($data as $row)
{
	if ($row['FACNAME'] !== $cur_fac)
	{
		$cur_fac = $row['FACNAME'];
		echo '<h2>‘¿ ”À‹“≈“: ' . $cur_fac . '</h2>';
	}
	
	if ($row['SPC'] !== $cur_spc)
	{
		$cur_spc = $row['SPC'];
		echo '<h3>—œ≈÷»¿À‹ÕŒ—“‹: ' . $cur_spc . '</h3>';
		$counter = 1;
	}
	
	echo $counter . '. ' . $row['NAME'] . '<br />';
	$counter++;
}
?>
</body>
</html>