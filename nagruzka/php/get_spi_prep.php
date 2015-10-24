<?
require_once("../include.php");
$div = $_REQUEST['div'];
$sql = "SELECT initcap(FIO_PREPOD) as FIO_PREPOD,DOL,STEPEN,ZVAN,STAT, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA,ZAVKAF FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$div' and  lower(fio) not like 'вакансия%' ORDER BY FIO_PREPOD";
$cur = execq( $sql );
foreach($cur as $k=> $row)
    $cur[$k]['STAVKA'] = str_replace(".",",",$row['STAVKA']);
//echo $sql;
echo '{rows:'.json_encode($cur).'}';

?>