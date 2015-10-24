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
		$where .= "$param = '$data'";
		break;
	}
	if( $i != 0 )
		$where .= " and ";
}


$sql = "SELECT distinct COURSE.COUID,substr(lower(COUNAME),1,50) COUNAME 
from VBLANK,COURSE 
$where AND VBLANK.COUID=COURSE.COUID AND YEAR_GROCODE = GET_EDUC_GOD AND SPRING_AUTUMN LIKE GET_SEMESTR_OV_RAT order by COUNAME";


$cur = execq($sql);
foreach( $cur as $i=>$data )
{
	$facname[$i]['couid']	= $data['COUID'];
	$facname[$i]['couname']	= $data['COUNAME'];
}
echo '{rows:'.json_encode($facname).'}';


?>