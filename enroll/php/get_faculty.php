<?
require_once("../include.php");

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
	$where = " and facid = 'делаем ошибку' ";
 
$sql = "select FACID, facname as FAC
        from faculty
        where factype in ( 1, 2 )
			$where
        order by FAC";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>