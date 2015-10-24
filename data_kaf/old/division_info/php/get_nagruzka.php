<?php
	include('../lib.php');
	$divid = $_REQUEST['divid'];
	$god=get_currentyear();
	$sql = "select sum(vsego5) aud,sum(semestr) vsego_god
			from Z_SEMESTR_STROKA
			where year_grocode='$god' 
			and divid='$divid'";
	$cur=execq($sql);
	echo $cur[0]['AUD'].'_'.$cur[0]['VSEGO_GOD'];  
?>