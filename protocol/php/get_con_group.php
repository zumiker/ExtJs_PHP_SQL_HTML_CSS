<?
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.08.14
 * Time: 2:51
 */

require_once("../include.php");
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );

/*
$sql = "SELECT distinct cs.ID_CON as GROID, CONGROUP as GRO
			FROM abi_spec s, abi_con_spec cs, ABI_CONGROUP c
			WHERE s.FACID=$facid
			AND c.GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual)
			and cs.id_spec=s.spcid
			and cs.id_con=c.id_con
			ORDER BY GROID";

$sql = "select distinct c.id_con as groid, c.congroup as gro
		from abi_fis_campaign f
		inner join abi_congroup c
			on f.campaign_id = c.campaign_id
				and f.activated = 1
				and c.quaid in ( 1, 2 )
		inner join abi_con_spec a
			on c.id_con = a.id_con
		inner join spcialist s
			on a.id_spec = s.spcid
				and s.facid = $facid
		order by groid";
*/
$sql="SELECT ID_CON as CONID,CONGROUP as conname FROM ABI_CONGROUP WHERE FACID=$facid  AND GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual) ORDER BY ID_CON";

$cur = execq( $sql );
//echo $cur;
echo '{rows:'.json_encode($cur).'}';
?>