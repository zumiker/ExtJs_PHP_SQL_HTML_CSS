<?php
$manid=$_GET["manid"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
$kafedra=$_GET["kafedra"];
$n2=$_GET["n2"];
$n3=$_GET["n3"];
$n4=$_GET["n4"];
$n6=$_GET["n6"];
$n8=$_GET["n8"];
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
	$sql="UPDATE NAGRUZKA_PREP SET f2='$n2',f3='$n3',f4='$n4',f6='$n6',f8='$n8',f9='$n9',f10='$n10',f11='$n11',f12='$n12'," .
					"f15='$n15',f16='$n16',f17='$n17',f18='$n18',f19='$n19',f20='$n20',f22='$n22'" .
					",f23='$n23',f24='$n24',fprim='$prim' " .
					"WHERE MANID='$manid' and " .
	"DIVID='$kafedra' and SPRING_AUTUMN='$sem' and YEAR_GROCODE='$year'";
				$cur=ora_do($conn,$sql);

	ora_logoff($conn);

echo "<center><font color='red'>Сохранено.";

$_GET["manid"]=$manid;
$_GET["god"]=$god;
$_GET["semestr"]=$semestr;
$_GET["kafedra"]=$kafedra;
include("../step2-1F.php");



?>