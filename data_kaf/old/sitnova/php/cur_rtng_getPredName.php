<?
require('/var/www/lib.php');

$script = "SELECT column_name, comments 
	FROM user_col_comments 
	WHERE table_name = 'DATA_KAF' 
		and column_name in( 'A7' )
	order by comments" ;

$response = execq( $script );

for($i = 0; $i<count($response); $i++)
{
	$list[$i]['predmet']		=  $response[$i]['COMMENTS'];
	$list[$i]['num']			= $i+1;
} 
echo '{rows:'.json_encode($list).'}';
?>