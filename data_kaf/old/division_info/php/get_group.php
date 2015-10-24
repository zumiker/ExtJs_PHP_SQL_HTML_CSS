<?php
	include('../lib.php');
	$facid=$_REQUEST['facid'];
	$sql="SELECT GROCODE,GROID 
			FROM V_SPI_GROUPS 
			WHERE FACID='$facid' 
			AND kurs>0 
			ORDER BY GROCODE,KURS";
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}';  
?>