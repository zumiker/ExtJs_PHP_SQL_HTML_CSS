<?php
	require_once('../include.php');
	$facid = GetFacid( 'D' );
	$sql="select * from V_SPI_PREDSEDATEL where facid='$facid'";
	//echo $sql;
	$cur=execq($sql);
	$record['PRED'] = "не выбран";
	//$record['PRED'] = " ";
	$record['MANID'] = "";
	$record['FACID'] = '$facid';
	array_unshift($cur,$record);
	
	echo '{rows:'.json_encode($cur).'}';  
?>