<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.15
 * Time: 3:42
 */
require_once("../include.php");
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );
$groid = $_REQUEST['groid'];
$specid = $_REQUEST['specid'];
$vubid = $_REQUEST['vubid'];

$sql = "";

$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>