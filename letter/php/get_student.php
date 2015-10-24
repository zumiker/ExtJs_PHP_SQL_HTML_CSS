<?php
require_once("../include.php");
$con_id  = $_REQUEST['con_id'];
$filter = $_REQUEST['filter'];
$zach = $_REQUEST['zach'];

if($filter!='0')
{
        $sql_filter="AND NABOR='$filter'";
}else{
        $sql_filter='';

}
if($zach=='1')
    $sqlerty='and p.proshel in ( 23, 30 )';
else
    $sqlerty='';
$sql = "SELECT distinct initcap(lastname) || ' ' || initcap(firstname) || ' ' || initcap(patronymic) as fio, p.ABI_ID, p.ABI_NUMBER,  POSTINDEX, ADDRESS
		FROM ABITURIENT a, ABI_PRIOR p
		WHERE a.ABI_ID = p.ABI_ID
--AND p.PROSHEL = 30
			$sql_filter
			$sqlerty
			AND p.CON_ID = '$con_id'
		ORDER BY fio";
   // echo $sql;
$cur = execq( $sql);
//echo $sql;
echo '{rows:'.json_encode($cur).'}';
?>