<?php
$manid=$_GET["manid"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
$kafedra=$_GET["kafedra"];
$n9=$_GET["n9"];
$n10=$_GET["n10"];
$n11=$_GET["n11"];
$n12=$_GET["n12"];
$n15=$_GET["n15"];
$n16=$_GET["n16"];
$n17=$_GET["n17"];
$n18=$_GET["n18"];
$n19=$_GET["n19"];
$n20=$_GET["n20"];
$n22=$_GET["n22"];
$n23=$_GET["n23"];
$n24=$_GET["n24"];
$prim=$_GET["prim"];

if($semestr=='01.09.')
$sem='Осенний';
else
{
$sem='Весенний';
}
$year=$god."/".($god+1);
	ora_logoff($conn);
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
	$sql="UPDATE NAGRUZKA_PREP SET n9='$n9',n10='$n10',n11='$n11',n12='$n12'," .
					"n15='$n15',n16='$n16',n17='$n17',n18='$n18',n19='$n19',n20='$n20',n22='$n22'" .
					",n23='$n23',n24='$n24',prim='$prim' " .
					"WHERE MANID='$manid' and " .
	"DIVID='$kafedra' and SPRING_AUTUMN='$sem' and YEAR_GROCODE='$year'";
				$cur=ora_do($conn,$sql);

	ora_logoff($conn);

echo "<center><font color='red'>Сохранено.";

$_GET["manid"]=$manid;
$_GET["god"]=$god;
$_GET["semestr"]=$semestr;
$_GET["kafedra"]=$kafedra;
include("../step2-1.php");



?>