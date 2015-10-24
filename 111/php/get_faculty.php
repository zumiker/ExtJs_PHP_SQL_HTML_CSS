<?
require_once("../include.php");

$facid = GetFacid( 'D' );
$facid = str_replace( ",", "','", $facid );

$sql = "select fac as FAC, facid as FACID
        from faculty
        where facid in ( '$facid' )
        order by FAC";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>