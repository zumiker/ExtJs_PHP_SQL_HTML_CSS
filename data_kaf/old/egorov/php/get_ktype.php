<?
	include('/var/www/lib.php');//'./../../../../../lib.php'

	$script = "select ktype_id, ktype_name
	from t_ktype
	union select 0 as ktype_id, 'Все' ktype_name from dual
	order by ktype_id" ;

	$response = execq( $script );

	foreach( $response as $i=>$data )
	{
		$lists[$i]['ktype_id']	= $data['KTYPE_ID'];
		$lists[$i]['ktype_name']= $data['KTYPE_NAME'];
	}

	echo '{rows:'.json_encode($lists).'}';
?>
