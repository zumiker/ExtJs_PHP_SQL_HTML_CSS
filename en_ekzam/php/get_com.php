<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.15
 * Time: 3:42
 */
require_once("../include.php");
$con_id = $_REQUEST['con_id'];
$vub = $_REQUEST['vub'];

$sql = "
select p.id_pr, p.predmet
from abi_predmet p
where not exists (
    select 1
    from abi_rasp
    where id_con = '$con_id'
        and id_pr = p.id_pr
)
order by p.predmet
";
if ($vub){
    $sql = "
select p.id_pr, p.predmet
from abi_predmet p
order by p.predmet
";
}

$cur = execq( $sql, false );
echo '{rows:'.json_encode($cur).'}';
?>