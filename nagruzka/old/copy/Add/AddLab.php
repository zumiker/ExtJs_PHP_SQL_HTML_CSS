<?php
$nagid=$_GET["nag"];
$manid=$_GET["manid"];
$room=$_GET["room"];
$labid=$_GET["labid"];
$str=$_GET["str"];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
echo "<FONT FACE='Garamond' SIZE='2' color='red'>";
	for($i=0;$i<sizeof($nag);$i++)
	{
	    
		if($manid==0)
		{
		// echo "удаляю ";
//		 echo "$nag[$i]";
				$sql="SELECT COUNT(*) FROM NAGRUZKA_LABS WHERE NAGID='$nag[$i]' AND ID='$labid'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
				if($lec==0)
				{
				   
		   		}
				else
				{
			       $sql="DELETE FROM NAGRUZKA_LABS WHERE NAGID='$nag[$i]' AND ID='$labid'";
				   $cur=ora_do($conn,$sql);
				   echo "Запись удалена</font><br/>";
				}
		}
		else
		{
		$sql="SELECT COUNT(*) FROM NAGRUZKA_LABS WHERE NAGID='$nagid' AND ID='$labid'";
		$cur=ora_do($conn,$sql);
		$lec=ora_getcolumn($cur,0);

		if($lec==0)
		{
			$sql="INSERT INTO NAGRUZKA_LABS (NAGID,PREPID_LAB,ROOM_LAB) VALUES('$nag','$manid','$room')";
			$cur=ora_do($conn,$sql);
			echo "Запись сохарнена";
		}
		else
		{
			$sql="UPDATE NAGRUZKA_LABS SET PREPID_LAB='$manid',ROOM_LAB='$room' WHERE NAGID='$nag[$i]' AND ID='$labid'";
			$cur=ora_do($conn,$sql);
			echo "Запись изменена";
		}
		//echo "NAGID $nag[$i] MANID $manid to NAGRUZKA_LABS ADDED<br/>";
		}
	}
	//echo "<br/><input type='button' onclick='ShowPrepods($str)' value='Обновить'>";
ora_logoff($conn);
?>