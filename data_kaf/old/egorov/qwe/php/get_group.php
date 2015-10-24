<?
include("./../../../include.php");
$sort_id = $_REQUEST['sort_id'];	
	if ($sort_id == 'g')
	{
		$sql = "select distinct groid, kurs || ' курс   -   ' || grocode as grocode
				from nv_spi_groups_new
				where facid = 5
				order by grocode";
		$cur = execq( $sql );
			foreach( $cur as $i=>$data )
			{
				$list[$i]['id']			= $data['GROID'].'_'.$sort_id;
				$list[$i]['name']		= $data['GROCODE'];
			}
			echo '{rows:'.json_encode($list).'}';
	}
	else if ($sort_id=='k')
	{
		$sql = "select distinct d.divid, divabbreviate
				from v_student_to_reexam v, division d 
				where v.facid = 5
					and v.divid = d.divid 
					and YEAR_GROCODE = Get_Educ_God_Real
					and spring_autumn = Get_Semestr_Real
				order by divabbreviate";
		$cur = execq( $sql );
			foreach( $cur as $i=>$data )
			{
				$list[$i]['id']			= $data['DIVID'].'_'.$sort_id;
				$list[$i]['name']		= $data['DIVABBREVIATE'];
			}
			echo '{rows:'.json_encode($list).'}';
	}
	else
	{
		$sql = "select distinct couid, couname
				from v_student_to_reexam v 
				where v.facid = 5 
					and YEAR_GROCODE = Get_Educ_God_Real
					and spring_autumn = Get_Semestr_Real
				order by couname";
		$cur = execq( $sql );
			foreach( $cur as $i=>$data )
			{
			    $list[$i]['id']			= $data['COUID'].'_'.$sort_id;
				$list[$i]['name']		= $data['COUNAME']; 
			}
			echo '{rows:'.json_encode($list).'}';
	
	}
?>