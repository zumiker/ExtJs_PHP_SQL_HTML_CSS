<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.12.14
 * Time: 14:57
 */
require_once("../include.php");
$div  = $_REQUEST['div'];
$studyid= $_REQUEST['studyid'];

$sql = "UPDATE NAGRUZKA_STATUS SET STATUS='0', KOGDA=(SELECT SYSDATE FROM DUAL)   WHERE DIVID='$div' AND studyid='$studyid'";
$cur = execq($sql);

echo json_encode(array('success'=>true));
?>