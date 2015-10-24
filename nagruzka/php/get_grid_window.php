<?
require_once("../include.php");
$div = $_REQUEST['div'];
$sql="SELECT DIVID,STAT_ID,STAT,BEZ, DECODE(trunc(SUM_STAVKA), SUM_STAVKA, TO_CHAR(SUM_STAVKA), TO_CHAR(SUM_STAVKA, 'FM999999999990D999999999999')) as SUM_STAVKA,PROF,DOC,STAR,PREP,ASS, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA,VSEGO
	      from Z_PREPOD_UMU WHERE DIVID='$div'
	      order by stat_id,stavka desc";
/*$conn = connect();
$result = oci_parse($conn, $sql);
oci_bind_by_name($result, ':div', $div);
oci_execute($result);
while($row = oci_fetch_array($result, OCI_ASSOC)){
    $output[] = $row;
}
oci_free_statement($result);
echo '{rows:'.json_encode($output).'}';
*/
$cur = execq( $sql);
foreach($cur as $k=> $row){
    //echo $row['SUM_STAVKA'];
    $cur[$k]['SUM_STAVKA'] = str_replace(".",",",$row['SUM_STAVKA']);
    $cur[$k]['STAVKA'] = str_replace(".",",",$row['STAVKA']);

}
//echo $sql;
echo '{rows:'.json_encode($cur).'}';
?>
