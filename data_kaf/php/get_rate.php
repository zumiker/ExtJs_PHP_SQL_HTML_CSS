<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.05.15
 * Time: 18:19
 */
include('../include.php');

$facid = $_REQUEST['facid'];
$colname = $_REQUEST['col'];

$sq = "";
$z = 1;
$boolfa = false;
for ($i = 0; $i < strlen($colname) - 1; $i++)
    if (($colname[$i] == "'")) {
        if($boolfa)
            $sq .= ", ";
        while ($colname[$i + 1] != "'") {
            $i++;
            $sq .= $colname[$i];
        }
        $boolfa = true;
        $z++;
        $i++;
    }

//echo $sq;
$sql = "select (vsk.kaf) as DIVNAME, vsk.divid AS DIVID, $sq from v_spi_kafedr vsk
			left join data_kaf dk
				on vsk.divid = dk.divid
            and dk.period = get_studyid
			where vsk.facid = '$facid'
			order by vsk.facid, DIVNAME";
//echo $sql;
$cur = execq($sql,false);
foreach($cur as $k=>$row){
    $list[$k]['DIVNAME']	= $row['DIVNAME'];
    $list[$k]['DIVID']	= $row['DIVID'];
    $zz = 1;
    $sq = "";
    for ($i = 0; $i < strlen($colname) - 1; $i++)
        if (($colname[$i] == "'")) {
            while ($colname[$i + 1] != "'") {
                $i++;
                $sq .= $colname[$i];
            }
            $i++;
            //echo $zz."    ".$sq;
            $list[$k][$zz] = $row[$sq];
            $sq = "";
            $zz++;
        }
}


echo '{rows:' . json_encode($list) . '}';
?>