<?php
	include('../lib.php');
	$sql="SELECT FACID,FACNAME from V_SPI_FAC ORDER BY FACNAME";
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}';  
?>