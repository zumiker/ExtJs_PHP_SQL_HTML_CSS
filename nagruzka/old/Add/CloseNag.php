<?php
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];

if($semestr=='01.09.')
$sem='Осенний';
else
$sem='Весенний';

$god=$god.'/'.($god+1);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


		 $sql="SELECT COUNT(*) FROM NAGRUZKA_STATUS WHERE DIVID='$kafedra' AND YEAR_GROCODE='$god' AND SEMESTR='$sem'";
		$cur=ora_do($conn,$sql);
		 $COUNT=ora_getcolumn($cur,0);
				
	
		if($COUNT>0)
		{
			$sql="UPDATE NAGRUZKA_STATUS SET STATUS='1', KOGDA=(SELECT SYSDATE FROM DUAL)   WHERE DIVID='$kafedra' AND YEAR_GROCODE='$god' AND SEMESTR='$sem'";
		}
		else
		{
			$sql="INSERT INTO NAGRUZKA_STATUS (DIVID,YEAR_GROCODE,SEMESTR,STATUS,KOGDA) VALUES(" .
					"'$kafedra'," .
					"'$god'," .
					"'$sem'," .
					"'1'," .
					"(SELECT SYSDATE FROM DUAL)" .
					")";
								
		}
		
		   $cur=ora_do($conn,$sql);
		
ora_logoff($conn);
include("../step1.php");
?>