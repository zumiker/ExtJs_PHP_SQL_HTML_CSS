<?
require_once("../include.php");
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );

$sql = "SELECT distinct cs.ID_CON as GROID, CONGROUP as GRO
			FROM abi_spec s, abi_con_spec cs, ABI_CONGROUP c
			WHERE s.FACID=$facid
			AND c.GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual)
			and cs.id_spec=s.spcid
			and cs.id_con=c.id_con
			ORDER BY GROID";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>