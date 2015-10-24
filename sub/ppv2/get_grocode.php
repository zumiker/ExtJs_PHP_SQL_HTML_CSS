<?
include("./../../../lib_debug.php");
$param	= array();
$data	= array();

foreach ( $_REQUEST as $key=>$value )
{
	$param[]= $key;
	$data[]	= urldecode($value);
}
for( $i=0; $i<count( $param ); $i++ )
{
	$param	= $param[$i];
	$data	= $data[$i];
	if( substr( $param, 0, 1 ) != '_' )
	{
		if( $i == 0 )
			$where = 'where ';
		$where .= "$param like '$data'";
		break;
	}
	if( $i != 0 )
		$where .= " and ";
}
$sql = "select grocode, groid from nv_spi_groups $where order by kurs, grocode";
//echo $sql;
$cur = execq($sql);
foreach( $cur as $i=>$data )
{
	$grocode[$i]['grocode']	= $data['GROCODE'];
	$grocode[$i]['groid']	= $data['GROID'];
}
echo '{rows:'.json_encode($grocode).'}';
?>