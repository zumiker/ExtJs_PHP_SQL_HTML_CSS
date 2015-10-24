<?
require_once("../include.php");

$sql = "select distinct studyid,
                     (periodname|| ' ' || TYPENAME || ' ' || YEARNAME) as study,
                     YEARNAME,periodname
from  V_STUDY  
where ARHIV=0 or ARHIV=2
order by YEARNAME desc, periodname 
";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>