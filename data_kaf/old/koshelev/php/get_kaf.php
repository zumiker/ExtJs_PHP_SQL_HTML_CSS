<?
include('/var/www/lib.php');
$param	= array();
$data	= array();
$facid = $_REQUEST['facid'];
//$typeid = $_REQUEST['ktype'];

$script = "SELECT column_name, comments 
			FROM user_col_comments 
			WHERE table_name = 'DATA_KAF' 
				and column_name in( 'A5' )
			order by comments" ;

$response = execq( $script );

$sql = "select vsk.kaf, vsk.divid,";
if(count($response)!= 1)
{
	for($j = 0; $j < count($response) - 1;$j++)
	{
		$sql.= "dk.".$response[$j]['COLUMN_NAME'].",";
	}
}
$sql.= "dk.".$response[count($response) - 1]['COLUMN_NAME'];
/*
if($typeid == '0')
{
*/
// при переписывании задачи перейти с PERIOD на DATAID
	$sql .= " from v_spi_kafedr vsk
			left join data_kaf dk
				on vsk.divid = dk.divid
					and dk.period = get_studyid
			where vsk.facid = '".$facid."'
			order by vsk.facid, vsk.kaf";
/*
}
else
{
	$sql.= " from v_spi_kafedr vsk, data_kaf dk  where vsk.divid = dk.divid(+) and vsk.facid = $facid and vsk.ktype_id = $typeid order by vsk.facid, vsk.kaf";
}
*/
$cur = execq( $sql );

foreach( $cur as $i=>$data )
{
	$lists[$i]['kaf']	= $data['KAF'];
	$lists[$i]['divid']	= $data['DIVID'];

	$lists[$i]['p1']	= $data[$response[0]['COLUMN_NAME']];
	$lists[$i]['p2']	= $data[$response[1]['COLUMN_NAME']];
}
//logstring(print_r($lists, true));
echo '{rows:'.json_encode($lists).'}';
?>