<?
require_once("../include.php");
/*
$manid	= GetClientManid();	 
$sql	= "select manid, role_id, facid, responsible
			from abi_roles
			where manid = '".$manid."'";
$res	= execq( $sql );	 
$role	= $res[0]['ROLE_ID'];
$facid	= $res[0]['FACID'];

if ( $role === '1' )
	$where = " ";
else if ( $role === '4' )
	$where = " and facid = '15' ";
else if ( $role === '2' )
	$where = " and facid <> '15' ";
else
	$where = " and facid = '������ ������' ";
 */
$sql = "select facname, facid
			from v_spi_fac_gum
			where facid not in ( 9, 11, 14, 15, 18 )
			order by facname";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>