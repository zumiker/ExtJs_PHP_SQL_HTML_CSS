<?php
	require_once('../include.php');
	$data=json_decode(file_get_contents('php://input'),true);
	$student=$data['STUDENT_ID'];
	$otpusk=$data['NA_OTPUSK'];
	if($data['MANID_PREDSEDATEL']=="")
		$predsed = 'null'; 
	else
		$predsed=$data['MANID_PREDSEDATEL'];
	$not_form = $data['NOT_FORM']?1:0;
	$not_spec = $data['NOT_SPEC']?1:0;
	
	$response = 0;
	if(isset($student)&&isset($otpusk)&&isset($not_form)&&isset($not_spec)&&isset($predsed))
	{
		$sql="UPDATE 
				DIPLOM 
			SET 
				NA_OTPUSK={$otpusk},
				NOT_FORM = {$not_form},
				NOT_SPEC = {$not_spec},
				MANID_PREDSEDATEL = $predsed
			WHERE 
				STUDENT_ID='{$student}'";
		execq($sql);
		$response=1;
	}
	echo $response;
?>