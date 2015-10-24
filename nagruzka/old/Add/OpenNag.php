<?php
$kafedra=$_GET["kafedra"];
$god2=$god=$_GET["god"];
$fac=$_GET["fac"];
$semestr2=$semestr=$_GET["semestr"];

if($semestr=='01.09.')
$sem='Осенний';
else
$sem='Весенний';


$god=$god.'/'.($god+1);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

		   $sql="UPDATE NAGRUZKA_STATUS SET STATUS='0', KOGDA=(SELECT SYSDATE FROM DUAL)   WHERE DIVID='$kafedra' AND YEAR_GROCODE='$god' AND SEMESTR='$sem'";			
		   $cur=ora_do($conn,$sql);
		
ora_logoff($conn);

$_GET["fac"]=$fac;
$_GET["god"]=$god2;
$_GET["semestr"]=$semestr2;
include("../step1.php");



// url=url+"?fac="+fac
 //rl=url+"&god="+god.value
 //url=url+"&semestr
//echo "Кафедра открыта";
//include("../ind.php");
?>