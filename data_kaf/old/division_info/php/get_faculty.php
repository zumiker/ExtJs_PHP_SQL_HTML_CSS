<?php
	include('../lib.php');
	$sql="SELECT FACID,FACNAME from V_SPI_FAC_GUM ORDER BY FACNAME";
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}';  
?>