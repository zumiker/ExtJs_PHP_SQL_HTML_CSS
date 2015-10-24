<?
include("./../../../lib.php");
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
//$sql = "select facname, facid from v_spi_fac_gum order by facname";
$sql = "select facname, facid from v_spi_fac_gum where facid not in ( 8, 9, 11, 14 ) order by facname";// основные 9 факультетов
$cur = execq($sql);
foreach( $cur as $i=>$data )
{
	$facname[$i]['facname']	= $data['FACNAME'];
	$facname[$i]['facid']	= $data['FACID'];
}
echo '{rows:'.json_encode($facname).'}';
?>
