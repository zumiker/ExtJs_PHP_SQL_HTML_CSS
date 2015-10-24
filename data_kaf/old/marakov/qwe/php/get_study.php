<?
include("./../../../include.php");

$info_id    = $_REQUEST['info_id'];
$arr 		= explode('_',$info_id);
$tip_id		= $arr[0];
$sort_id 	= $arr[1]; //буква
$student_id = $_REQUEST['student_id'];
$start 		= $_REQUEST['start'];
$name  		= $_REQUEST['name'];
$search     = $_REQUEST['search'];
////форматирования постраничного вывода
	if ($start>0) {$limit=$start+30; $start=$start+1;}
	else $limit=30;

////прорека, посик по фамилии или нет
	 if ( $search=='yes')
	{	
		$name  = mb_strtoupper ($name, 'utf-8');
		$where = "fio_full LIKE  '%$name%' ";
	}
	else if ( $search=='no')// если не по фамилии
	{	 
		////проверка критерия запроса
		if ($sort_id == 'g')
			{
				$where = "student_id = '$student_id'";
			}
		else if ($sort_id=='k')
			{
				$where = "divid = '$tip_id'";
			}
		else
			{
				$where = "couid = '$tip_id'";
			
			}
	}	

	$query=get_limit_sql("select vblid, student_id, fio_full, couname, grocode, treid, trename, re_num, GET_tmaabrev(tmaid) as tmaid, rating, year_grocode, spring_autumn
						from v_student_to_reexam
						where $where
							and year_grocode = get_educ_god_ses
							and spring_autumn = get_semestr_ov_ses
						order by year_grocode, spring_autumn desc, couname, fio_full", $start, $limit);

    if(is_array($query))	
		{
			$count=execq("select count(vblid) as count
						from v_student_to_reexam 
						where $where 
							and year_grocode = get_educ_god_ses
							and spring_autumn = get_semestr_ov_ses");
							
		$total=$count[0]['COUNT'];
		
        foreach($query as $i=>$data)
		{
			$list[$i]['vblid']			= $data['VBLID'];
			$list[$i]['student_id']		= $data['STUDENT_ID'];
			$list[$i]['fio_full']		= $data['FIO_FULL'];
			$list[$i]['couname']		= $data['COUNAME'];
			$list[$i]['grocode']		= $data['GROCODE'];
			$list[$i]['treid']			= $data['TREID'];
			$list[$i]['trename']		= $data['TRENAME'];
			$list[$i]['re_num']			= $data['RE_NUM'];
			$list[$i]['tmaid']			= $data['TMAID'];
			$list[$i]['rating']			= $data['RATING'];
			$list[$i]['year_grocode']	= $data['YEAR_GROCODE'];
			$list[$i]['spring_autumn']  = $data['SPRING_AUTUMN'];
		}
	}
echo json_encode(array("rows"=>$list, "total"=>$total)); 
 
 
 
/* $sql = "select vblid, student_id, fio_full, couname, treid, trename, re_num, GET_tmaabrev(tmaid) as tmaid, rating, year_grocode, spring_autumn
		from v_student_to_reexam
		where $where
			and year_grocode = get_educ_god_ses
			and spring_autumn = get_semestr_ov_ses
		order by year_grocode, spring_autumn desc, couname, fio_full";
$cur = execq( $sql ); 

 foreach( $cur as $i=>$data )
{
	$list[$i]['vblid']			= $data['VBLID'];
	$list[$i]['student_id']		= $data['STUDENT_ID'];
	$list[$i]['fio_full']		= $data['FIO_FULL'];
	$list[$i]['couname']		= $data['COUNAME'];
	$list[$i]['treid']			= $data['TREID'];
	$list[$i]['trename']		= $data['TRENAME'];
	$list[$i]['re_num']			= $data['RE_NUM'];
	$list[$i]['tmaid']			= $data['TMAID'];
	$list[$i]['rating']			= $data['RATING'];
	$list[$i]['year_grocode']	= $data['YEAR_GROCODE'];
	$list[$i]['spring_autumn']  = $data['SPRING_AUTUMN'];

} 
$total = count($list);
echo'({"total":"'.$total.'","rows":'.json_encode($list).'})';
//echo '{rows:'.json_encode($list).'}';*/
?>