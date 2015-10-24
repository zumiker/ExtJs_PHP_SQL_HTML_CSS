<?
include("./../../../include.php");
$info_id = $_REQUEST['info_id'];
$arr = explode('_',$info_id);
$tip_id = $arr[0];
$sort_id = $arr[1]; 
if ($sort_id == 'g')
	{
		$sql = "select distinct student_id, fio_full
				from v_student_to_reexam
				where groid = '$tip_id'
					and YEAR_GROCODE LIKE '2012/2013'
					and spring_autumn like 'Осенний'
				order by fio_full";
		$cur = execq( $sql );
			foreach( $cur as $i=>$data )
			{
				$list[$i]['student_id']		= $data['STUDENT_ID']/*.'_'.$sort_id*/;
				$list[$i]['fio_full']		= $data['FIO_FULL'];
			}
			echo '{rows:'.json_encode($list).'}';
	}
?>