<?php
//include( "./../../lib_debug.php" );
require('/var/www/lib.php');//include('./../../../../../lib_debug.php');


$script = "SELECT column_name, comments 
	FROM user_col_comments 
	WHERE table_name = 'DATA_KAF' 
		and column_name in( 'A7')
	order by comments" ;

$response = execq( $script );

//rsort($response);

for($i = 0; $i<count($response); $i++)
{
	$list[$i]['predmet']		=  $response[$i]['COMMENTS'];
	$list[$i]['num']			= $i+1;
} 
//logstring(print_r($list,true)); */

echo '{rows:'.json_encode($list).'}';


?>