<?php
$nag=$_GET["nagid"];

$manid=$_GET["manid"];
$room_sem=$_GET["room_sem"];
$semid=$_GET["semid"];
$kurs=$_GET["kurs"];
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
$kod= $_GET["kod"];
$groupnum= $_GET["groupnum"];
$groups= $_GET["groups"];


echo "<FONT FACE='Garamond' SIZE='2' color='red'>";

	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		if($semid!=0)
		{
		 $sss = "AND ID='$semid'";
		}
		else
		{
			$sss = "";
		}
		if($manid==0)
		{
		 //echo "удаляю<br/>";

				$sql="SELECT COUNT(*) FROM NAGRUZKA_LABS WHERE NAGID='$nag' AND ID='$semid'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0)
				{
				   
		   		}
				else
				{
			       $sql="DELETE FROM NAGRUZKA_LABS WHERE NAGID='$nag'  AND ID='$semid'";
				   $cur=ora_do($conn,$sql);
				   "Запись удалена<br/>";
				}
		}
		else
		{
				$sql="SELECT COUNT(*) FROM NAGRUZKA_LABS WHERE NAGID='$nag' $sss";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0 || $semid==0)
				{
					$sql="INSERT INTO NAGRUZKA_LABS (NAGID,PREPID_LAB,ROOM_LAB) VALUES('$nag','$manid','$room_sem')";
					$cur=ora_do($conn,$sql);
					echo "Запись сохранена<br/>";
				}
				else
				{
					$sql="UPDATE NAGRUZKA_LABS SET PREPID_LAB='$manid',ROOM_LAB='$room_sem' WHERE NAGID='$nag' $sss";
					//echo $sql;
					$cur=0;
					$cur=ora_do($conn,$sql);
					echo "Запись измена<br/>";
				}
			//echo "NAGID $nag[$i] MANID $manid to NAGRUZKA_SEM ADDED<br/>";		
		}
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
//echo "<input type='button' onclick='ShowPrepods($str)' value='Обновить'>";

?>