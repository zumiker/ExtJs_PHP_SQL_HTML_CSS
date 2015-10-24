<?php
	require_once('../include.php');
	$facid = GetFacid( 'D' );
	$sql="select distinct D.GROCODE,D.GROID 
					FROM GROUPS_KAFEDRA K,V_SPI_GROUPS_DIPLOM D 
					WHERE K.GROCODE=D.GROCODE AND K.FACID in ( $facid )
					order by GET_KURS(D.GROCODE),D.GROCODE";
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}';  
?>