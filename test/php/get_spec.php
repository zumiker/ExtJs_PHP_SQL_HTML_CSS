<?
require_once("../include.php");
$groid = $_REQUEST['groid'];
$facid = $_REQUEST['facid'];

$sql = "SELECT a.SPCNAME, a.SPCID
		FROM spcialist a
        inner join ABI_CON_SPEC b
			on a.SPCID = b.ID_SPEC
				and b.ID_CON = '$groid'
				and a.facid = '$facid'
		order by a.SPCNAME
";
//  echo $sql;
$cur = execq( $sql );
$sch = count($cur);
if($sch>1){
    $record['SPCNAME'] = "Все";
    //$record['PRED'] = " ";
    $record['SPCID'] = "0";
    //$record['FACID'] = '$facid';
    array_unshift($cur,$record);
}
echo '{rows:'.json_encode($cur).'}';
?>