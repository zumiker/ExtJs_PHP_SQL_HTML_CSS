<?
require('/var/www/lib.php'); 
$param	= array();
$data	= array();
/*foreach ( $_REQUEST as $key=>$value )
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
}*/
//$sql = "select facname, facid from v_spi_fac_gum order by facname";
//$sql = "select FACNAME, FACID from v_spi_fac_gum where FACID not in ( 8, 9, 11, 14 ) order by FACNAME";// основные 9 факультетов

$rules = GetVIP(); // предполагаемый полный доступ
//if ( $rules ) {
// основные 9 факультетов
	$sql = "select facname, facid 
			from v_spi_fac_gum 
			where facid not in ( 9, 11, 14, 15, 18 ) 
			order by facname";
	$cur = execq($sql);
	foreach( $cur as $i=>$data )
	{
		$list[$i]['facname']= $data['FACNAME'];
		$list[$i]['facid']	= $data['FACID'];
	}
//}
/*else {
	$divid1	= GetClientDekanatsDivid();
	$divid	= $divid1[0];
	if ( $divid > 0 ) {
		$facid	= $list[0]['facid'] = GetFacidForDivid($divid);
		$list[0]['facname']	= GetFacnameForFacid($facid);
	}
	else {
		$list[0]['facname']	= 'Вы не обладаете правами ни одного деканата.';
	}
}*/
echo '{rows:'.json_encode($list).'}';