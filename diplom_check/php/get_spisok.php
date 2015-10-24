<?php
	require_once('../include.php');
	$grocode=$_REQUEST['grocode'];
	$sql="SELECT INITCAP(V.FIO_FULL) FIO_FULL,
			V.STUDENT_ID,
			D.NA_OTPUSK,
			D.NOT_FORM,
			D.NOT_SPEC,
			D.MANID_PREDSEDATEL
		FROM 
			V_SPI_STUDENT V,
			--V_SPI_PREDSEDATEL, 
			DIPLOM D 
		WHERE D.STUDENT_ID=V.STUDENT_ID 
		AND D.GROCODE='{$grocode}'
		ORDER BY V.FIO_FULL";
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}'; 
?>