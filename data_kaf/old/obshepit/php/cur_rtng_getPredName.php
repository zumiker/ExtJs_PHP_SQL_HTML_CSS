<?php
//include( "./../../lib_debug.php" );
require('/var/www/lib.php');//include('./../../../../../lib_debug.php');
/* $arr	= explode('_',$_REQUEST['groid']);
$groid	= $arr[0];
$num = 0;
$sql3 = "select distinct ( couname || decode(treid,4,' (ÊÏ)',5,' (ÊÐ)','') ) as predmet, 
				n.couid || decode(treid,4,' (ÊÏ)',5,' (ÊÐ)','') as couid , 
                sum( max_ball ) as max_ball
			from v_nagruzka_fact_kaf n, course c, v_student_works w 
			where n.groid = '$groid' 
                and n.groid = w.groid(+) 
                and n.vblid = w.vblid(+) 
                and week(+) <= '$week' 
				and ( n.difid = '$difid' or n.difid = 0 )
				and c.couid = n.couid 
            group by couname, treid, n.couid 
			order by predmet";
$sql3 = EncodeStr($sql3);
//logstring($sql3);	
$cur3 = execq( $sql3 );
foreach( $cur3 as $k=>$data )
{
	$num++;
	$list[$k]['predmet']		=  $data['PREDMET'];
	$list[$k]['num']			= $num;
	//= DecodeStr( $data[$j] );
} */


/*
$list[0]['max']= '0'; ;
for( $i=0; $i<30; $i++ )
{
	$list[$i+1]['max']= $i+1 ;
}
echo '{rows:'.json_encode($list).'}';
*/

$script = "SELECT column_name, comments 
	FROM user_col_comments 
	WHERE table_name = 'DATA_KAF' 
		and column_name in( 'AMOUNT_CLASSBOOK','AMOUNT_OTHERBOOK','AMOUNT_DPO_PROGRAM','PART_STUDENT_PRACTICE','A26','A27','A28','A31','A34','A37','A40')
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