<?
session_start();
require('/var/www/lib.php');//require("./../../../../../lib.php");
$grocode = $_REQUEST['grocode'];
$sql="select fio, rus, mat, fiz, him, ist, obsh, geo 
		from v_ege_student 
		where grocode like '$grocode' 
		order by fio";
logstring($sql);
$cur=execq($sql);
$c=0;	
foreach($cur as $i=>$data)
{
	$c++;
	$prop[$i]['fio']	= $data['FIO'];
	$prop[$i]['rus']	= $data['RUS'];
	$prop[$i]['mat']	= $data['MAT'];
	$prop[$i]['fiz']	= $data['FIZ'];
	$prop[$i]['him']	= $data['HIM'];
	$prop[$i]['ist']	= $data['IST'];
	$prop[$i]['obsh']	= $data['OBSH'];
	$prop[$i]['geo']	= $data['GEO'];
}
if($c==0)
	echo '{rows:[]}';
else
	echo '{rows:'.json_encode($prop).'}';
?>