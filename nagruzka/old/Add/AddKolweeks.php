<?php

$d1=$_GET["d1"];
$d2=$_GET["d2"];
$kod=$_GET["kod"];
$sw=$_GET["sw"];
$kolw=$_GET["kolw"];

$god=$_GET["god"];
$semestr=$_GET["semestr"];



if($semestr=='01.09.')$semestr='Осенний';
else $semestr='Весенний';
		$god=$god.'/'.($god+1);



	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
					   
	if($sw==1)
	{
	
	 $sql="UPDATE NAGRUZKA_SOVM SET KOLWEEKS1='$kolw'
	WHERE DIVID1='$d1' AND DIVID2='$d2' AND COUID='$kod' AND SPRING_AUTUMN='$semestr' AND YEAR_GROCODE='$god'";
	}
	if($sw==2)
	{
	 $sql="UPDATE NAGRUZKA_SOVM SET KOLWEEKS2='$kolw'
	WHERE DIVID1='$d1' AND DIVID2='$d2' AND COUID='$kod' AND SPRING_AUTUMN='$semestr' AND YEAR_GROCODE='$god'";

	}
				$cur=ora_do($conn,$sql);
	echo "Сохранено";
	ora_logoff($conn);
	

?>