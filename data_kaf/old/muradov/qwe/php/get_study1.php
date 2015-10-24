<?
include("./../../../include.php");
/* $grocoutre = $_REQUEST['grocoutre'];
$arr = explode('--',$grocoutre);
$couid = $arr[1];
$vblid = $arr[3]; */
$sql = "select vblid, student_id, fio_full, couname, treid, trename, re_num, GET_tmaabrev(tmaid) as tmaid, rating, year_grocode, spring_autumn
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
echo '{rows:'.json_encode($list).'}';
?>