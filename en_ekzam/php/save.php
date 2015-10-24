<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.06.15
 * Time: 10:25
 */
require_once("../include.php");

$flag = $_REQUEST['flag'];
$CON_ID = $_REQUEST['CON_ID'];
$PR_ID  = $_REQUEST['ID_PR'];
$PRIORITET = $_REQUEST['PRIORITET'];
$KOGDA = $_REQUEST['KOGDA'];
$CLOCK = $_REQUEST['CLOCK'];
if ($flag == 1){
    $sql="UPDATE ABI_RASP SET
                          PRIORITET = '$PRIORITET',
                          KOGDA = to_date('$KOGDA','dd.mm.yyyy'),
                          CLOCK = '$CLOCK'
                          WHERE ID_CON = '$CON_ID' AND ID_PR = '$PR_ID'";
}
//ECHO $sql;
$cur = execq($sql,false);

echo json_encode(array('success'=>true));
?>