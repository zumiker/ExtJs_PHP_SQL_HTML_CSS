<?
require_once("../include.php");
$groid = $_REQUEST['groid'];

$sql = "SELECT a.SPCNAME, a.SPCID FROM ABI_SPEC a
        inner join ABI_CON_SPEC b on b.ID_CON='$groid'
        where a.SPCID=b.ID_SPEC
";
//  echo $sql;
$cur = execq( $sql,false );
echo '{rows:'.json_encode($cur).'}';
?>