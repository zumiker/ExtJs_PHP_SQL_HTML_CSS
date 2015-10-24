<?php
require('../include.php');
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.09.14
 * Time: 13:58
 */
$manid	= GetClientManid();
//$manid	= 68403;
// $manid	= 16094;
$sql	= "select  role_id from abi_roles
			where manid = '$manid'";
$res=execq($sql);
//echo json_encode($res);
$role	= $res[0]['ROLE_ID'];

//$q=1;
echo $role;


?>