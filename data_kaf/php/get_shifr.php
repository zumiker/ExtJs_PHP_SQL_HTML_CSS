<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.05.15
 * Time: 16:27
 */
include('../include.php');
$group = $_REQUEST['group'];

$sql = "SELECT column_name, comments
			FROM user_col_comments
			WHERE table_name = 'DATA_KAF'
				and column_name in ('$group')
			order by comments";
//echo $sql;
$cur = execq($sql);

echo '{rows:'.json_encode($cur).'}';
?>