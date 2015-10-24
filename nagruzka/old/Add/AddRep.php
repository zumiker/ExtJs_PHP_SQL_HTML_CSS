<?php

$nagis=$_GET["nag"];
$manid=$_GET["prepid"];
$oldprep=$_GET["oldprep"];

$str=$_GET["str"];
$n1=$_GET["rep1"];
$n2=$_GET["rep2"];
$n3=$_GET["rep3"];
$n4=$_GET["rep4"];
$n5=$_GET["rep5"];
$n7=$_GET["rep7"];

$kurs=$_GET["kurs"];
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
$kod= $_GET["kod"];
$groupnum= $_GET["groupnum"];
$groups= $_GET["groups"];

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

//echo "<FONT FACE='Garamond' SIZE='2' color='red'>";


	if($manid==0)
		{										   
			      	  echo $sql="DELETE FROM NAGRUZKA_REP WHERE NAGID='$nagis' AND PREPID='$oldprep'";
				   $cur=ora_do($conn,$sql);
				  // echo "Запись удалена<br/>";
		}
	else
		{
			if($oldprep==0)
			{
				echo $sql="INSERT INTO NAGRUZKA_REP (NAGID,PREPID,N1,N2,N3,N4,N5,N7) VALUES('$nagis','$manid','$n1','$n2','$n3','$n4','$n5','$n7')";
				$cur=ora_do($conn,$sql);
				//echo "Запись изменена<br/>";
			}
			else
			{
				echo $sql="UPDATE NAGRUZKA_REP SET PREPID='$manid',N1='$n1',N2='$n2',N3='$n3',N4='$n4',N5='$n5',N7='$n7' WHERE NAGID='$nagis'  AND PREPID='$oldprep'";
				$cur=ora_do($conn,$sql);
				//echo "Запись изменена<br/>";
			}
		}	
	//echo "<input type='button' onclick='ShowPrepods($str)' value='Обновить'>";
	ora_logoff($conn);
	
$_GET["kurs"]=$kurs;
$_GET["kafedra"]=$kafedra;
$_GET["god"]=$god;
$_GET["semestr"]=$semestr;
$_GET["kod"]=$kod;
$_GET["groupnum"]=$groupnum;
$_GET["groups"]=$groups;
$_GET['str']=$str;
include('../step4.php');
?>