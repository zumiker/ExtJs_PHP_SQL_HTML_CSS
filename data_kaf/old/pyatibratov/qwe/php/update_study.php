<?
include("./../../../include.php");

$date		= date('d.M.Y');        //текущая дата в формате (24.Jan.2013) P.S. именно  такой формат нужен для сохранения в базу в формате (24.01.2013)
$prepid		= GetClientManid();     //айди преподавателя
$tmaid		= $_POST['tmaid'];    	//оценка
$rating     = $_POST['rating'];   	//рейтинг
$student_id	= $_POST['student_id']; //айди студента
$vblid		= $_POST['vblid'];   	//номер ведомости
$re_num     = $_POST['re_num'];  	//номер персдачи
$treid      = $_POST['treid'];   	//вид отчетности
$re_date    = $_POST['re_date']; 	//дата пересдачи

//$tmaid      = get_tmaid($tmaid,$treid);       
$re_date    = date('d.M.Y',strtotime($re_date)); // дата пересдачи(Правильный формат для сохранения)
$str_value	= (string) $rating ;
$rating		= str_replace(',','.',$str_value);   //замена запятой
$arr_s      = explode('-',$student_id);
$manid      = $arr_s[0];

	if ( ( $treid == 2 ) || ( $treid == 3 ) )	//zachets
		{
			$type = 'z';
		}
		else
		{
			$type = 'i';
		}

	 $sql="update studkarta set tmaid_$type=get_tmaid('$tmaid','$treid'), rating_i='$rating'
			where vblid='$vblid' and student_id='".$student_id."'";
	execq( $sql );
 
	 $sql2="insert into reexamin(manid, student_id, vblid,reedata,tmaid_$type,rating_i,re_num_$type, reeinsert, maninsert)
		    values ('".$manid."','".$student_id."','$vblid','$re_date',get_tmaid('$tmaid','$treid'),'$rating','$re_num','$date','$prepid')"; 
	 execq( $sql2 ); 
	 
?>