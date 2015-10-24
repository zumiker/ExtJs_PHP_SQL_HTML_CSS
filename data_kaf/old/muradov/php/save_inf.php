 <?
session_start();
include('/var/www/lib.php');
$inf_arr=DecodeStr($_POST['inf_arr']);
$inf_arr = explode(';', $inf_arr); //��������� �� �������
$manid = '16512';
//$period = '21';
$dataform = 'sysdate';
$dataid = '3';

	$script = "SELECT column_name, comments 
	FROM user_col_comments 
	WHERE table_name = 'DATA_KAF' 
		and column_name in( 'A15', 'A24', 'A25', 'A31', 'A34', 'A37', 'A49', 'A51' )
	order by comments" ;

	$response = execq( $script );
	logstring($script);
foreach($inf_arr as $ia)
{
		//logstring($ia);
		$str_ia= (string) $ia ;		
		$ia = str_replace(',','.',$str_ia); //������ �������
		
		$buff = explode('_',$ia);
		$divid = $buff[1];

		$sql="merge into DATA_KAF dk
			using dual
			on ( dk.divid = '".$divid."' and dk.period = get_studyid) 
			when matched then 
				update set ";
		for($i = 0; $i < count($response); $i++)
		{
			$sql.="dk.".$response[$i]['COLUMN_NAME']."='".$buff[$i + 2]."',"; 
		}
		$sql.="dk.MANID='".$manid."', dk.DATAFORM=sysdate, dk.DATAID='".$dataid."'";
		$sql.=" when not matched then ";
		$sql.="insert ("; 
		for($j = 0; $j < count($response); $j++)
		{
			$sql.="dk.".$response[$j]['COLUMN_NAME'].","; 
		}
		$sql.="dk.MANID,  dk.PERIOD,  dk.DATAFORM,  dk.DATAID, dk.divid) values (";
		for($k = 0; $k < count($response); $k++)
		{
			$sql.="'".$buff[$k + 2]."',"; 
		}
		$sql.="'".$manid."', get_studyid, sysdate, '".$dataid."', '".$divid."')" ;

		logstring($sql);

		execq($sql);
}
 
 echo '1';
?>