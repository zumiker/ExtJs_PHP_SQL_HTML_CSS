<?
require_once("../include.php");

$facid = GetFacid( 'D' );
$facid = str_replace( ",", "','", $facid );

$sql = "SELECT FACID,FACNAME AS FAC from V_SPI_FAC_GUM WHERE FACID NOT IN (9,11) ORDER BY FAC";/*"select facname as FAC, facid as FACID
        from faculty
        where facid in ( '$facid' )
        order by FAC";*/
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>