<?
echo '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
ini_set('display_errors', 1);
ini_set("error_reporting", E_ALL);
//include_once('firephp.php');
echo '>>>>>>>>>>>'.getcwd().'!!!!!';
session_start();
$_SESSION['MANID'] = 35609;
include("index.php");

?>