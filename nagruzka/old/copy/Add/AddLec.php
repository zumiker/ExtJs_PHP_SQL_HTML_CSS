<?php
$nagis=$_GET["nags"];
$manid=$_GET["manid"];
$room_lec=$_GET["room_lec"];
$str=$_GET["str"];
$nag=split (",", $nags);
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
echo "<FONT FACE='Garamond' SIZE='2' color='red'>";
	for($i=0;$i<sizeof($nag);$i++)
	{
	if($manid==0)
		{
		// echo "удаляю ";
//		 echo "$nag[$i]";
				$sql="SELECT COUNT(*) FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0)
				{
				   
		   		}
				else
				{
			       $sql="DELETE FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
				   $cur=ora_do($conn,$sql);
				   echo "Запись удалена";
				}
		}
		else
		{
			$sql="SELECT COUNT(*) FROM NAGRUZKA_LEC WHERE NAGID='$nag[$i]'";
			$cur=ora_do($conn,$sql);
			$lec=ora_getcolumn($cur,0);
	
			if($lec==0)
			{
				$sql="INSERT INTO NAGRUZKA_LEC (NAGID,PREPID_LEC,ROOM_LEC) VALUES('$nag[$i]','$manid','$room_lec')";
				$cur=ora_do($conn,$sql);
				echo "Запись сохранена";
			}
			else
			{
				$sql="UPDATE NAGRUZKA_LEC SET PREPID_LEC='$manid',ROOM_LEC='$room_lec' WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				echo "Запись изменена";
			}
			//echo "NAGID $nag[$i] MANID $manid to NAGRUZKA_LEC ADDED<br/>";
		}
	}
	//echo "<input type='button' onclick='ShowPrepods($str)' value='Обновить'>";
ora_logoff($conn);
?>