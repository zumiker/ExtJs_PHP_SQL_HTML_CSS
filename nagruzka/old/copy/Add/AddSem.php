<?php
$nags=$_GET["nags"];
$manid=$_GET["manid"];
$room_sem=$_GET["room_sem"];
$str=$_GET["str"];
echo "$nags<br/>";
$nag=split (",", $nags);
echo "room = $room_sem<br/>";
echo "$manid<br/>";
echo "<FONT FACE='Garamond' SIZE='2' color='red'>";
	for($i=0;$i<sizeof($nag);$i++)
	{
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		
		if($manid==0)
		{
		 echo "удаляю ";
		 echo "$nag[$i]";
				$sql="SELECT COUNT(*) FROM NAGRUZKA_SEM WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0)
				{
				   
		   		}
				else
				{
			       $sql="DELETE FROM NAGRUZKA_SEM WHERE NAGID='$nag[$i]'";
				   $cur=ora_do($conn,$sql);
				   echo "Запись удалена<br/>";
				}
		}
		else
		{
				$sql="SELECT COUNT(*) FROM NAGRUZKA_SEM WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0)
				{
					$sql="INSERT INTO NAGRUZKA_SEM (NAGID,PREPID_SEM,ROOM_SEM) VALUES('$nag[$i]','$manid','$room_sem')";
					$cur=ora_do($conn,$sql);
					echo "Запись сохранена";
				}
				else
				{
					$sql="UPDATE NAGRUZKA_SEM SET PREPID_SEM='$manid',ROOM_SEM='$room_sem' WHERE NAGID='$nag[$i]'";
					//echo $sql;
					$cur=0;
					$cur=ora_do($conn,$sql);
					echo "Запись измена";
				}
				
			//echo "NAGID $nag[$i] MANID $manid to NAGRUZKA_SEM ADDED<br/>";		
		}
	ora_logoff($conn);
	}
//echo "<input type='button' onclick='ShowPrepods($str)' value='Обновить'>";

?>