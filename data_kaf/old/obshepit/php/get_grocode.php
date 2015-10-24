<?
include('/var/www/lib.php');//require("./../../../../../lib.php");
$param	= array();
$data	= array();

$facid = $_REQUEST['facid'];
 
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
//$sql = "select grocode, groid from nv_spi_groups where facid = $facid order by kurs, grocode";
/* $sql = "select grocode, difcode, groid, difid, kurs 
			from nv_spi_groups 
			where facid = $facid
		union
		select d.grocode, difcodenew as difcode, d.groid, d.difid, kurs 
			from groups_difcode d, nv_spi_groups n 
			where n.facid = $facid and n.groid = d.groid
		order by kurs, grocode, difcode";
$cur = execq( $sql );
foreach( $cur as $i=>$data )
{
	$grocode[$i]['grocode']	= $data['GROCODE'];
	if ( $data['DIFID'] )
		$grocode[$i]['grocode']	.= ' ('.$data['DIFCODE'].')';
	$grocode[$i]['groid']	= $data['GROID'].'_'.$data['DIFID'].'_'.$grocode[$i]['grocode'];
}
echo '{rows:'.json_encode($grocode).'}';
?> */
$sql = "select grocode, difcode, groid, difid, kurs, quaid 
			from nv_spi_groups 
			where facid = $facid
		union
		select d.grocode, difcodenew as difcode, d.groid, d.difid, kurs, quaid 
			from groups_difcode d, nv_spi_groups n 
			where n.facid = $facid and n.groid = d.groid and quaid = 3
		order by kurs, grocode, difcode";
$cur = execq( $sql );
foreach( $cur as $i=>$data )
{
	$grocode[$i]['grocode']	= $data['GROCODE'];
	if ( $data['QUAID'] == 3 )
		$grocode[$i]['grocode']	.= ' ('.$data['DIFCODE'].')';
	$grocode[$i]['groid']	= $data['GROID'].'_'.$data['DIFID'].'_'.$grocode[$i]['grocode'];
}
echo '{rows:'.json_encode($grocode).'}';
?>
