<?
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.07.14
 * Time: 22:02
 */
require_once("../include.php");

$specid =$_REQUEST['specid'];
$conid =$_REQUEST['conid'];

$sql = "SELECT DISTINCT CON_ID, ABI_ID, LASTNAME, FIRSTNAME,PATRONYMIC
		FROM ABIVIEW_LISTOFEXAM
		WHERE SPECID=$specid
			and con_id = $conid
		ORDER BY LASTNAME";
$cur = execq( $sql);

echo '{rows:'.json_encode($cur).'}';
//echo json_encode($cur);

?>