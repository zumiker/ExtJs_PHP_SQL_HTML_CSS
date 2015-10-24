<?
require_once("../include.php");
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );

$sql = "select distinct kurs, kurs || ' курс - ' || grocode as GRO, groid as GROID, quaid
        from nv_spi_groups_new
        where facid in ( '$facid' )
            and arhiv = 0
            and kurs > 0
    order by kurs, decode( quaid, 3, 3, 0 ), GRO ";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>