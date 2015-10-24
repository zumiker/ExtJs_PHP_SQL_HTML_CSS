<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.06.15
 * Time: 22:13
 */
require_once("../include.php");

$rat = $_REQUEST['vub'];

$sql = "
select distinct c.id_con as con_id, c.congroup
from abi_congroup c
left join abi_rasp r
    on c.id_con = r.id_con
left join abi_predmet p
    on r.id_pr = p.id_pr
order by c.congroup
";

$cur = execq( $sql, false );
if($rat == 0){
    $record['CON_ID'] = "0";
    $record['CONGROUP'] = "Все";
    array_unshift($cur,$record);
}
echo '{rows:'.json_encode($cur).'}';
?>