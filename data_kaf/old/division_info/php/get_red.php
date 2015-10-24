<?php
	include('../lib.php');
	$facid=$_REQUEST['facid'];
	if($facid==9)
	{
		$sql="select GROCODE,initcap(FIO) fio,SRED_BALL,SRED_RATING,HOLDINGNAME,COMPANYNAME,KAT,RED,manid from V_STUDKARTA_RED_DIPLOM WHERE FACID='$facid' AND RED=1 ORDER BY GROCODE,FIO,KAT";
	}
	else 
	{
		$sql="select GROCODE,initcap(FIO) fio,SRED_BALL,SRED_RATING,HOLDINGNAME,COMPANYNAME,KAT,RED,manid from V_STUDKARTA_RED_DIPLOM WHERE FACID='$facid' ORDER BY GROCODE,FIO,KAT";	
	}
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}';  
?>