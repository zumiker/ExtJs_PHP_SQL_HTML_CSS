<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.06.15
 * Time: 3:42
 */
require_once("../include.php");
/*
$sql = "
select decode( c.gorod, 0, 'Москва', 1, 'Оренбург', 'Ошибка' ) as gorod, c.id_con as con_id, c.congroup, r.id_pr, p.predmet, r.prioritet, r.kogda, r.clock
from abi_congroup c
left join abi_rasp r
    on c.id_con = r.id_con
left join abi_predmet p
    on r.id_pr = p.id_pr
order by gorod, c.congroup, r.prioritet, p.predmet
";

$cur = execq( $sql, false );
echo '{rows:'.json_encode($cur).'}';*/


$conn = connect(false);


$query = "ALTER SESSION SET NLS_DATE_FORMAT = 'DD.MM.YYYY'";
$result = oci_parse($conn, $query);
oci_execute($result);
oci_free_statement($result);

$query = "
      select decode( c.gorod, 0, 'Москва', 1, 'Оренбург', 'Ошибка' ) as gorod, c.id_con as con_id, c.congroup, r.id_pr, p.predmet, r.prioritet, r.kogda, r.clock
from abi_congroup c
left join abi_rasp r
    on c.id_con = r.id_con
left join abi_predmet p
    on r.id_pr = p.id_pr
order by gorod, c.congroup, r.prioritet, p.predmet
     ";
$result = oci_parse($conn, $query);
//oci_bind_by_name($result, ':manid', $man);
oci_execute($result);
while($row = oci_fetch_array($result, OCI_ASSOC)){
    $output[] = $row;
}
oci_free_statement($result);
echo '{rows:'.json_encode($output).'}';




?>