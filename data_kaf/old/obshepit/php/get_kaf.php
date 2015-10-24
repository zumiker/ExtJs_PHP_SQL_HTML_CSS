<?
include('/var/www/lib.php');//'./../../../../../lib.php'
$param	= array();
$data	= array();
//logstring('111');
$facid = $_REQUEST['facid'];

$script = "SELECT column_name, comments 
			FROM user_col_comments 
			WHERE table_name = 'DATA_KAF' 
				and column_name in( 'AMOUNT_CLASSBOOK','AMOUNT_OTHERBOOK','AMOUNT_DPO_PROGRAM','PART_STUDENT_PRACTICE','A26','A27','A28','A31','A34','A37','A40')
			order by comments";

$response = execq( $script );

//rsort($response);

$sql = "select vsk.kaf, vsk.divid,";
for($j = 0; $j < count($response) - 1;$j++)
{
	$sql.= "dk.".$response[$j]['COLUMN_NAME'].",";
}
$sql.= "dk.".$response[count($response) - 1]['COLUMN_NAME'];
$sql.= " from v_spi_kafedr vsk, data_kaf dk
		where vsk.divid = dk.divid(+)
			and vsk.facid = $facid
		order by vsk.facid, vsk.kaf";
$cur = execq( $sql );

foreach( $cur as $i=>$data )
{
	$lists[$i]['kaf']	= $data['KAF'];
	$lists[$i]['divid']	= $data['DIVID'];

	$lists[$i]['p1']	= $data[$response[0]['COLUMN_NAME']];
	$lists[$i]['p2']	= $data[$response[1]['COLUMN_NAME']];
	$lists[$i]['p3']	= $data[$response[2]['COLUMN_NAME']];
	$lists[$i]['p4']	= $data[$response[3]['COLUMN_NAME']];
	$lists[$i]['p5']	= $data[$response[4]['COLUMN_NAME']];
	$lists[$i]['p6']	= $data[$response[5]['COLUMN_NAME']];
	$lists[$i]['p7']	= $data[$response[6]['COLUMN_NAME']];
	$lists[$i]['p8']	= $data[$response[7]['COLUMN_NAME']];
	$lists[$i]['p9']	= $data[$response[8]['COLUMN_NAME']];
	$lists[$i]['p10']	= $data[$response[9]['COLUMN_NAME']];
	$lists[$i]['p11']	= $data[$response[10]['COLUMN_NAME']];
}
//logstring(print_r($lists, true));
echo '{rows:'.json_encode($lists).'}';
?>