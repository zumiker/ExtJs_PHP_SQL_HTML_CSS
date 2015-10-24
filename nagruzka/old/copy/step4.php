<?php
function ora_getcolumnzero($cur,$i)
{
	$a=ora_getcolumn($cur,$i);
	if ($a=='0') $a='&nbsp';
	return $a;
}

function ora_getcolumnzzzz($cur,$i)
{
	$a=ora_getcolumn($cur,$i);
	if ($a=='') $a='';
	return $a;
}
//содание списка преподавателей ведущих лабораторные работы.
function lab_make($labn,$kafedra,$str,$lab,$nagids,$onenagid)
{
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
	if($nagids==1){
	$sql="SELECT PREPID_LAB,ROOM_LAB,ID FROM NAGRUZKA_LABS WHERE NAGID='$onenagid'";
	$cur2=ora_do($conn,$sql);
	//$labis=ora_getcolumn($cur2,0);
//	$labroomis=ora_getcolumn($cur2,1);
	$labs=0;
	

	for ($i=0;$i<ora_numrows($cur2);$i++)
		{
			
			$labis[$i]=ora_getcolumn($cur2,0);
			$labroomis[$i]=ora_getcolumn($cur2,1);
			$labidis[$i]=ora_getcolumn($cur2,2);
			$labs++;
			ora_fetch($cur2);
		}
		
	$labnum=$labn+$labs+1;
	
	
	
	for($j=0;$j<$labnum;$j++)
	{
	echo "<tr><td>";
	

		
	if($j==0)echo "Лабораторные: ";
	echo "</td><td><select name='lab$j' id='lab$j'>";
	echo "<option value='0'>--не выбрано--</option>";
	$sql="SELECT MANID,FIO,ZVAN,STEPEN FROM V_SPI_PREPOD_2_KAF WHERE DIVID='$kafedra' ORDER BY FIO";
	$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$manid=ora_getcolumnzero($cur,0);
			$fio=ora_getcolumnzero($cur,1);
			$zvan=ora_getcolumnzero($cur,2);
			$stepen=ora_getcolumnzero($cur,3);
			if($labis[$j]==$manid)
			{
				$sel="selected";
			}
			else
			{
				$sel="";
			}
	    	echo "<option value='$manid' $sel>$fio $zvan $stepen</option>";
			ora_fetch($cur);
		}
		echo "</select></td><td><input type='text' name='labroom$j' id='labroom$j' value='$labroomis[$j]'>";
		if($labidis[$j]=="")$labidis[$j]=0;
		echo "</td><td><input type='button' onClick='AddLab($onenagid,$j,$labidis[$j],$str)' value='Записать'> $lab час.";
		
		if($j==$labnum-1)
		{

			if($labnum!=$labs) echo "<input type='button' onClick='ShowPrepods($str,$labnum-$labs-2)' value='-'>";
			
		echo "<input type='button' onClick='ShowPrepods($str,$labnum-$labs)' value='+'>";
		}
		echo "</td></tr>";
	}
	
	}
		ora_logoff($conn);
}


		
//get the q parameter from URL
$kurs=$_GET["kurs"];
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
$semestr=$semestr.$god;
$kod=$_GET["kod"];
$groupnum=$_GET["groupnum"];
$groups=$_GET["groups"];
$labnum=$_GET["labnum"];
if($labnum=="undefined")
{
$labnum="0";
}
$str=$_GET["str"];


		$nagids=0;	
		$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		$groid=split (",", $groups);
		$onenagid=-1;
		for($i=0;$i<sizeof($groid);$i++)
		{
		
			
			if($groid[$i]!="")
			{
			echo "";
				$sql="SELECT COUNT(*) FROM NAGRUZKA WHERE DIVID='$kafedra' AND KURS='$kurs' AND COUID='$kod' AND GROID='$groid[$i]'";
				$cur=ora_do($conn,$sql);
				$num=ora_getcolumn($cur,0);
				if($num==0)				
				{
				
					$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
					
					$sql="INSERT INTO TEMP_VIBOR (KAFEDRA, VIPISKA, KURS) VALUES ('$kafedra', '$semestr','$kurs')";
					$cur=ora_do($conn,$sql);
					$cur=0;
					
					$sql="SELECT DIVNAME, GROCODE, KOLVO, VSEGO, LEC, LAB, SEM, SMDSEM, SROK, EXAM, ZACH, PROEKT, PREDMET, VIBOR, FACID, FAC, KOD, FACNAME, V1, V2, V3, V4, V5, V7 FROM V_NAGRUZKA_ALL WHERE KURS='$kurs' AND KOD='$kod' AND GROID='$groid[$i]' ";						
					$cur=ora_do($conn,$sql);
					for ($j=0;$j<ora_numrows($cur);$j++)
					{
						$divname_all=ora_getcolumnzzzz($cur,0);		
					//	echo "divname_all $divname_all  <br/>";	
						$grocode_all=ora_getcolumnzzzz($cur,1);					 
				//		echo "grocode_all $grocode_all  <br/>";	
						$kolvo_all=ora_getcolumnzzzz($cur,2);					 
				//		echo "kolvo_all $kolvo_all <br/>";	
						$vsego_all=ora_getcolumnzzzz($cur,3);					 
				//		echo "vsego_all $vsego_all <br/>";	
						$lec_all=ora_getcolumnzzzz($cur,4);					 
				//		echo "lec_all $lec_all <br/>";	
						$lab_all=ora_getcolumnzzzz($cur,5);					 
				//		echo "lab_all $lab_all  <br/>";	
						$sem_all=ora_getcolumnzzzz($cur,6);					 
				//		echo "sem_all $sem_all  <br/>";	
						$smdsem_all=ora_getcolumnzzzz($cur,7);					 
				//		echo "smdsem_all $smdsem_all  <br/>";	
						$srok_all=ora_getcolumnzzzz($cur,8);					 
				//		echo "srok_all $srok_all  <br/>";	
						$exam_all=ora_getcolumnzzzz($cur,9);
				//		echo "exam_all $exam_all  <br/>";	
						$zach_all=ora_getcolumnzzzz($cur,10);
				//		echo "zach_all $zach_all <br/>";	
						$proek_all=ora_getcolumnzzzz($cur,11);
				//		echo "proek_all $proek_all <br/>";	
						$predmet_all=ora_getcolumnzzzz($cur,12);
				//		echo "predmet_all $predmet_all <br/>";	
						$vibor_all=ora_getcolumnzzzz($cur,13);
				//		echo "vibor_all $vibor_all <br/>";	
						$facid_all=ora_getcolumnzzzz($cur,14);
				//	echo "facid_all $facid_all <br/>";	
						$fac_all=ora_getcolumnzzzz($cur,15);
				//		echo "fac_all $fac_all <br/>";	
						$kod_all=ora_getcolumnzzzz($cur,16);
				//		echo "kod_all $kod_all <br/>";	
						$facname_all=ora_getcolumnzzzz($cur,17);
				//		echo "facname_all $facname_all <br/>";	
						$v1_all=ora_getcolumnzzzz($cur,18);
				//		echo "v1_all $v1_all <br/>";
						$v2_all=ora_getcolumnzzzz($cur,19);
				//		echo "v2_all $v2_all <br/>";
						$v3_all=ora_getcolumnzzzz($cur,20);
				//		echo "v3_all $v3_all <br/>";
						$v4_all=ora_getcolumnzzzz($cur,21);
				//		echo "v4_all $v4_all <br/>";
						$v5_all=ora_getcolumnzzzz($cur,22);
				//		echo "v5_all $v5_all <br/>";
						$v7_all=ora_getcolumnzzzz($cur,23);
				//		echo "v7_all $v7_all <br/>";
									 
						ora_fetch($cur);
					}
				
			//		echo "Записи нет, создаю запись... <br/>";
				//$sql="INSERT INTO NAGRUZKA (DIVID,KURS,COUID,GROID,DIVNAME,GROCODE,KOLVO,VSEGO,LEC,LAB,SEM,SMDSEM,SROK,EXAM,ZACH,PROEKT,PREDMET,VIBOR,FACID,FAC,KOD,FACNAME,V1,V2,V3,V4,V5,V7) 	VALUES('$kafedra','$kurs','$kod','$groid[$i]','$divname_all','$grocode_all','$kolvo_all','$vsego_all','$lec_all','$lab_all','$sem_all','$smdsem_all','$srok_all','$exam_all','$zach_all','$proek_all','$predmet_all','$vibor_all','$facid_all','$fac_all','$kod_all','$facname_all','$v1_all','$v2_all','$v3_all','$v4_all','$v5_all','$v7_all')";
				$sql="INSERT INTO NAGRUZKA (DIVID,KURS,COUID,GROID,DIVNAME,GROCODE,KOLVO,VSEGO,LEC,LAB,SEM,SMDSEM,SROK,EXAM,ZACH,PROEKT,PREDMET,VIBOR,FACID,FAC,FACNAME,V1,V2,V3,V4,V5,V7) VALUES('$kafedra','$kurs','$kod','$groid[$i]','$divname_all','$grocode_all','$kolvo_all','$vsego_all','$lec_all','$lab_all','$sem_all','$smdsem_all','$srok_all','$exam_all','$zach_all','$proek_all','$predmet_all','$vibor_all','$facid_all','$fac_all','$facname_all','$v1_all','$v2_all','$v3_all','$v4_all','$v5_all','$v7_all')";
			//	echo "$sql";
				$cur=ora_do($conn,$sql);
			//		echo "Создал... Ищу запись.. <br/>";
				}

				$sql="SELECT NAGID FROM NAGRUZKA WHERE DIVID='$kafedra' AND KURS='$kurs' AND COUID='$kod' AND GROID='$groid[$i]'";
				$cur=ora_do($conn,$sql);
				$num=ora_getcolumn($cur,0);
				
				echo "<input  TYPE='hidden' VALUE='$num' NAME='nag$i' ID='nag$i'>";
				$onenagid=$num;
				$nags[$nagids];
			//		echo "Запись - есть: NAGID=$num GROID=$groid[$i] NAGNUM=$num<br />";
				$nagids++;
				
			}
		}
		ora_logoff($conn);
		
//echo "<font color='blue'>Debug info: $nagids $semestr $god $kafedra $kurs $kod $groupnum $groups $str $labnum<br></font>";
$semestr=$semestr.$god;

?>
<B>Назначение предметов:</b><br />
<?php
echo "Выбрано групп: $groupnum</br>";

if($groupnum=="0")
{

	echo "Выберите группу.";

}
else
{
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

	$cur=0;
	$sql="SELECT LEC,SEM,LAB FROM NAGRUZKA WHERE NAGID='$onenagid'";
	$cur=ora_do($conn,$sql);

		$lec=ora_getcolumn($cur,0);
		$sem=ora_getcolumn($cur,1);
		$lab=ora_getcolumn($cur,2);

		ora_fetch($cur);

	if($groupnum>"1")
	{
		for($i=0;$i<sizeof($nags);$i++)
		{

			$sql="SELECT PREPID_LEC, ROOM_LEC FROM NAGRUZKA_LEC WHERE NAGID='$nags[$i]'";
			$cur2=ora_do($conn,$sql);
			$lecis=ora_getcolumn($cur2,0);
			$lecroomis=ora_getcolumn($cur2,1);
			
					
			$sql="SELECT PREPID_SEM,ROOM_SEM FROM NAGRUZKA_SEM WHERE NAGID='$nags[$i]'";
			$cur2=ora_do($conn,$sql);
			$semis=ora_getcolumn($cur2,0);
			$semroomis=ora_getcolumn($cur2,1);
			echo " <FONT FACE='Garamond' SIZE='3' color='red'>
			
			Внимание. преподаватели назначаются для всех выбранных групп.</br>";
		}
	}
	else
	{
		
			$sql="SELECT PREPID_LEC, ROOM_LEC FROM NAGRUZKA_LEC WHERE NAGID='$onenagid'";
			$cur2=ora_do($conn,$sql);
			$lecis=ora_getcolumn($cur2,0);
			$lecroomis=ora_getcolumn($cur2,1);
				
			$sql="SELECT PREPID_SEM,ROOM_SEM FROM NAGRUZKA_SEM WHERE NAGID='$onenagid'";
			$cur2=ora_do($conn,$sql);
			$semis=ora_getcolumn($cur2,0);
			$semroomis=ora_getcolumn($cur2,1);
		
	}
		
	    



		$cur=0;	
	
	echo "<FONT FACE='Garamond' SIZE='5' color='black'><table><tr><td></td><td>Преподаватель</td><td>Аудитория</td><td></td></tr>";
	if($lec!=0){
	echo "<tr><td>Лекции:</td><td><select name='lect' id='lect'>";
	echo "<option value='0'>--не выбрано--</option>";
	

	$sql="SELECT MANID,FIO,ZVAN,STEPEN FROM V_SPI_PREPOD_2_KAF WHERE DIVID='$kafedra' ORDER BY FIO";
	$cur=ora_do($conn,$sql);			
	for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$manid=ora_getcolumnzero($cur,0);
			$fio=ora_getcolumnzero($cur,1);
			$zvan=ora_getcolumnzero($cur,2);
			$stepen=ora_getcolumnzero($cur,3);
			if($lecis==$manid)
			{	
				$sel="selected";					
			}
			else
			{
				$sel="";
			}
			
			echo "<option value='$manid' $sel>$fio $zvan $stepen</option>";
			ora_fetch($cur);
		}
	echo "</select></td><td><input type='text' id='lecroom' value='$lecroomis'></td><td><input type='button' onClick='AddLec($nagids,$str)' value='Записать'>";
	echo " $lec час.";
	echo "</td></tr>";
	}
	if($sem!=0)
	{
	echo "<tr><td>Семинары:</td><td><select name='sem' id='sem'>";
	echo "<option value='0'>--не выбрано--</option>";
	$sql="SELECT MANID,FIO,ZVAN,STEPEN FROM V_SPI_PREPOD_2_KAF WHERE DIVID='$kafedra' ORDER BY FIO";
	$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$manid=ora_getcolumnzero($cur,0);
			$fio=ora_getcolumnzero($cur,1);
			$zvan=ora_getcolumnzero($cur,2);
			$stepen=ora_getcolumnzero($cur,3);
			if($semis==$manid)
			{	
				$sel="selected";					
			}
			else
			{
				$sel="";
			}
			
			echo "<option value='$manid' $sel>$fio $zvan $stepen</option>";
			ora_fetch($cur);
		}
	echo "</select></td><td><input type='text' id='semroom' name='semroom' value='$semroomis'></td><td><input type='button' onClick='AddSem($nagids,$str)' value='Записать'>";
	 echo " $sem час.";
	 echo "</td></tr>";
	}
		ora_logoff($conn);
	if($lab!=0)	lab_make($labnum,$kafedra,$str,$lab,$nagids,$onenagid);

	echo "<tr><td colspan='3'>";
	echo "<div id=text5></div>";
	echo "</td></tr></table>";

}
?>

