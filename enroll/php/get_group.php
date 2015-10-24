<?
require_once("../include.php");
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );
/*
//$manid	= GetClientManid();	 
$sql	= "select manid, role_id, facid, responsible
			from abi_roles
			where manid = '".$manid."'";
$res	= execq( $sql );	 
$role	= $res[0]['ROLE_ID'];
$facid	= $res[0]['FACID'];

if ( $role === '1' )
	$where = " ";
else if ( ( $role === '2' ) || ( $role === '4' ) )
	$where = " and c.arhiv = 0 ";
else
	$where = " and facid = '������ ������' ";
*/
$sql = "select distinct cs.id_con as GROID, congroup as GRO
		from spcialist s, abi_con_spec cs, abi_congroup c
		where s.facid=$facid
			--and c.god=(select to_char(sysdate, 'yyyy')  from dual)
			and cs.id_spec=s.spcid
			and cs.id_con=c.id_con
			and c.quaid in ( 1, 2 )
		order by groid";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>