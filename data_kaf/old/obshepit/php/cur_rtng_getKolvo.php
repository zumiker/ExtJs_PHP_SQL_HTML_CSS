<?
require('/var/www/lib.php');//require("./../../../../../lib.php");//include( "./../../lib_debug.php" );
$arr	= explode('_',$_REQUEST['groid']);
$groid	= $arr[0];
$difid	= $arr[1];
$sql = "select count ( distinct couname || decode(treid,4,' (ÊÏ)',5,' (ÊÐ)','') ) as count
            from v_nagruzka_fact_kaf n, course c 
            where groid = '$groid' 
				and ( n.difid = '$difid' or n.difid = 0 )
                and c.couid = n.couid";
//logstring($sql);				
$cur = execq( $sql );
foreach( $cur as $i=>$data )
{
	$list[$i]['kolvo']	= $data['COUNT'];
}
echo '{rows:'.json_encode($list).'}';
?>