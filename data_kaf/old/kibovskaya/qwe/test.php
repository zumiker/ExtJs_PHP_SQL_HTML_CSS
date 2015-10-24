<?
include("./../../include.php");
/* $grocoutre = $_REQUEST['grocoutre'];
$arr = explode('--',$grocoutre);
$couid = $arr[1];
$vblid = $arr[3]; */
$sql = "select student_id, fio_full
		from v_spi_student
		where groid = '1727'
		order by fio_full";
$cur = execq( $sql );
foreach( $cur as $i=>$data )
{
	$list[$i]['student_id']		= $data['STUDENT_ID'];
	$list[$i]['fio_full']		= $data['FIO_FULL'];
}
logstring($sql);
echo '{rows:'.json_encode($list).'}';
?>