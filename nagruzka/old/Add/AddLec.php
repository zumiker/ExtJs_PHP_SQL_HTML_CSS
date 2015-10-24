<?php
$nagis=$_GET["nags"];
$manid=$_GET["manid"];
$room_lec=$_GET["room_lec"];
$str=$_GET["str"];
$nag=split(",", $nagis);
$potok=$_GET["potok"];


$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

$sql="SELECT SEQ_NAG_POTOK.NEXTVAL FROM DUAL";

$cur=ora_do($conn,$sql);
$nextval=ora_getcolumn($cur,0);

echo "<FONT FACE='Garamond' SIZE='2' color='red'>";

	for($i=0;$i<sizeof($nag);$i++)
	{
	if($manid==0)
		{
		// echo "удаляю ";
		// echo "$nag[$i]";
				$sql="SELECT COUNT(*) FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0)
				{
				   
		   		}
				else
				{
				   $sql="SELECT PREPID_LEC FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
				   $cur=ora_do($conn,$sql);
			           $prepid=ora_getcolumn($cur,0);
			           
										   
			      	   $sql="DELETE FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
				   $cur=ora_do($conn,$sql);
				   echo "Запись удалена<br/>";
				}
		}
		else
		{
			$sql="SELECT COUNT(*) FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
			$cur=ora_do($conn,$sql);
			$lec=ora_getcolumn($cur,0);
	
			if($lec==0)
			{
				echo $sql="INSERT INTO NAGRUZKA_LEC (NAGID,PREPID_LEC,ROOM_LEC,POTOK_LEK) VALUES('$nag[$i]','$manid','$room_lec','$nextval')";
				$cur=ora_do($conn,$sql);
				echo "Запись создана<br/>";
			}
			else
			{
				echo $sql="UPDATE NAGRUZKA_LEC SET PREPID_LEC='$manid',ROOM_LEC='$room_lec' WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				echo "Запись изменена<br/>";
			}
			if($potok=="1")
			{
			   $sql="UPDATE NAGRUZKA SET POTOK_LEK='$nextval' WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
			}
			//echo "NAGID $nag[$i] MANID $manid to NAGRUZKA_LEC ADDED<br/>";
		}
	}
	if($potok=="1")
	{
	echo "Сохранено как поток $nextval<br/>";
	}
	echo "<input type='button' onclick='ShowPrepods($str)' value='Обновить'>";
	ora_logoff($conn);
?>