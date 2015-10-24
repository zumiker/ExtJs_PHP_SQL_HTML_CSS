<?
require_once("../include.php");
$groid = $_REQUEST['groid'];
//$facid = $_REQUEST['facid'];
/*
$sql = "SELECT a.SPCNAME, a.SPCID FROM ABI_SPEC a
        inner join ABI_CON_SPEC b on b.ID_CON='$groid'
        where a.SPCID=b.ID_SPEC
";
*/
$sql = "select distinct s.spcname, s.spcid
		from abi_fis_campaign f
		inner join abi_congroup c
			on f.campaign_id = c.campaign_id
				and f.activated = 1
		inner join abi_con_spec a
			on c.id_con = a.id_con
				and c.id_con = $groid
		inner join spcialist s
			on a.id_spec = s.spcid
--				and s.facid = $facid
		order by s.spcname";
//  echo $sql;
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>