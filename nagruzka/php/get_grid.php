<?php
require_once("../include.php");
$fac  = $_REQUEST['fac'];
$studyid = $_REQUEST['studyid'];


$sql = "select FACID, DIVID, FAC, DIVABBREVIATE, SS, TO_CHAR(KOGDA, 'DD-MM-YYYY') as kogda,STATUS from Z_STATUS where FACID='$fac' AND studyid= '$studyid'  ORDER BY DIVABBREVIATE ";
 //echo $sql;
$cur = execq( $sql);
//echo $sql;
echo '{rows:'.json_encode($cur).'}';
?>