<?php
//
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
			$sql="SELECT TREP_ID,SKOLKO FROM NAGRUZKA_REP WHERE NAGID='$onenagid' AND PREPID='$labis[$i]'";
			$cur3=ora_do($conn,$sql);
			
			$st1[$i]=0;
			$st2[$i]=0;
			$st3[$i]=0;
			$st4[$i]=0;
			$st5[$i]=0;
			$st7[$i]=0;
			
			for ($j=0;$j<ora_numrows($cur3);$j++)
			{
			$trep_id=ora_getcolumnzero($cur3,0);
			$skolko=ora_getcolumnzero($cur3,1);
			switch($trep_id)
			{	
				case 0:
				break;
				case 1:
				$st1[$i]=$skolko;
				break;
				case 2:
				$st2[$i]=$skolko;
				break;
				case 3:
				$st3[$i]=$skolko;
				break;
				case 4:
				$st4[$i]=$skolko;				
				break;
				case 5:
				$st5[$i]=$skolko;
				break;
				case 7:
				$st7[$i]=$skolko;
				break;
				default:
				break;
				
			}
			ora_fetch($cur3);
			}
			
			$labs++;
			ora_fetch($cur2);
			
		}
		
	$labnum=$labn+$labs+1;
	
	
	
	for($j=0;$j<$labnum;$j++)
	{
	echo "<tr><td>";
	
	if($j==0)echo "Лабораторные($lab час): ";
	echo "</td><td><select name='lab$j' id='lab$j'>";
	echo "<option value='0'>--не выбрано--</option>";
	$sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
	$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$manid=ora_getcolumnzero($cur,0);
			$fio=ora_getcolumnzero($cur,1);
			$zvan=ora_getcolumnzero($cur,2);

			if($labis[$j]==$manid)
			{
				$sel="selected";
			}
			else
			{
				$sel="";
			}
	    	echo "<option value='$manid' $sel>$fio $zvan </option>";
			ora_fetch($cur);
		}
		echo "</select></td><td><input type='text' name='labroom$j' id='labroom$j' value='$labroomis[$j]'>";
		
		if($labidis[$j]=="")$labidis[$j]=0;
		echo "</td>";
	echo "<td><input type='button' onClick='AddLab($onenagid,$j,$labidis[$j],$str)' value='Записать'>";
		
		if($j==$labnum-1)
		{

			if($labnum!=$labs) echo "<input type='button' onClick='ShowPrepods($str,$labnum-$labs-2)' value='-'>";
			
		echo "<input type='button' onClick='ShowPrepods($str,$labnum-$labs)' value='+'>";
		}
		echo "</td></tr>";
	}
	
	}
		//ora_logoff($conn);
}


		
//get the q parameter from URL
$kurs=$_GET["kurs"];
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$sem2=$semestr=$_GET["semestr"];

if($semestr=='01.09.')
{
  $spring_autumnt='Осенний';
}
else
{
  $spring_autumnt='Весенний';
}


if($semestr=='01.09.')
$semestr=$semestr.($god);
else
$semestr=$semestr.($god+1);

$semestr_year=$god.'/'.($god+1);
$kod=$_GET["kod"];
$groupnum=$_GET["groupnum"];
$groups=$_GET["groups"];
$labnum=$_GET["labnum"];
if($labnum=="undefined")
{
$labnum="0";
}

$lt1=0;
$lt2=0;
$lt3=0;
$lt4=0;
$lt5=0;
$lt7=0;

$st1=0;
$st2=0;
$st3=0;
$st4=0;
$st5=0;
$st7=0;

$str=$_GET["str"];


		$nagids=0;	
		$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		$groid=split (",", $groups);
		$onenagid=-1;
		for($i=0;$i<sizeof($groid);$i++)
		{
					
			if($groid[$i]>=1)
			{
			
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
					//	echo "v1_all $v1_all <br/>";
						$v2_all=ora_getcolumnzzzz($cur,19);
					//	echo "v2_all $v2_all <br/>";
						$v3_all=ora_getcolumnzzzz($cur,20);
					//	echo "v3_all $v3_all <br/>";
						$v4_all=ora_getcolumnzzzz($cur,21);
					//	echo "v4_all $v4_all <br/>";
						$v5_all=ora_getcolumnzzzz($cur,22);
					//	echo "v5_all $v5_all <br/>";
						$v7_all=ora_getcolumnzzzz($cur,23);
					//	echo "v7_all $v7_all <br/>";
						$sovmestno=ora_getcolumnzzzz($cur,24);
					
						ora_fetch($cur);
					}
				
				//echo "Записи нет, создаю запись... <br/>";
				//$sql="INSERT INTO NAGRUZKA (DIVID,KURS,COUID,GROID,DIVNAME,GROCODE,KOLVO,VSEGO,LEC,LAB,SEM,SMDSEM,SROK,EXAM,ZACH,PROEKT,PREDMET,VIBOR,FACID,FAC,KOD,FACNAME,V1,V2,V3,V4,V5,V7) 	VALUES('$kafedra','$kurs','$kod','$groid[$i]','$divname_all','$grocode_all','$kolvo_all','$vsego_all','$lec_all','$lab_all','$sem_all','$smdsem_all','$srok_all','$exam_all','$zach_all','$proek_all','$predmet_all','$vibor_all','$facid_all','$fac_all','$kod_all','$facname_all','$v1_all','$v2_all','$v3_all','$v4_all','$v5_all','$v7_all')";
				$ttt=strpos($kolvo_all, "("); 
				
				if($ttt>=1)
				{
				if($ttt=1)$kolvo_all=$kolvo_all[0];
				if($ttt=2)$kolvo_all=$kolvo_all[0].$kolvo_all[1];
				if($ttt=3)$kolvo_all=$kolvo_all[0].$kolvo_all[1].$kolvo_all[2];
				//echo $kolvo_all=substr($kolvo_all,0,$ttt);
				}
			 	$sql="INSERT INTO NAGRUZKA (DIVID,KURS,COUID,GROID,DIVNAME,GROCODE,
				KOLVO,VSEGO,LEC,LAB,SEM,SMDSEM,SROK,EXAM,ZACH,PROEKT,PREDMET,
				VIBOR,FACID,FAC,FACNAME,V1,V2,V3,V4,V5,V7,
				KOLWEEKS,SPRING_AUTUMN,YEAR_GROCODE,POTOK_COUID) 
				VALUES('$kafedra','$kurs','$kod','$groid[$i]','$divname_all','$grocode_all',
				'$kolvo_all','$vsego_all','$lec_all','$lab_all','$sem_all','$smdsem_all','$srok_all','$exam_all','$zach_all','$proek_all','$predmet_all',
				'$vibor_all','$facid_all','$fac_all','$facname_all','$v1_all','$v2_all','$v3_all','$v4_all','$v5_all','$v7_all',
				(select GET_KOL_WEEKS ('$grocode_all','$semestr',1) from dual),'$spring_autumnt','$semestr_year','$kod')";				
				//echo "$sql";
				$cur=ora_do($conn,$sql);
				//echo "Создал... Ищу запись.. <br/>";
				}

				$sql="SELECT NAGID FROM NAGRUZKA WHERE DIVID='$kafedra' AND KURS='$kurs' AND COUID='$kod' AND GROID='$groid[$i]'";
				$cur=ora_do($conn,$sql);
				//echo "nagids=".$nagids." num=";
				$num=ora_getcolumn($cur,0);
				if(isset($num))
				{
				echo "<input  TYPE='hidden' VALUE='$num' NAME='nag$nagids' ID='nag$nagids'>";
				//echo "input  TYPE='hidden' VALUE='$num' NAME='nag$nagids' ID='nag$nagids'</br>";
				$onenagid=$num;
				$nags[$nagids]=$num;
				//echo "Запись - есть: NAGID=$num GROID=$groid[$i] NAGNUM=$num<br />";
				$nagids++;
				}
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
	$sql="SELECT LEC,SEM,LAB,PRIM,V1,V2,V3,V4,V5,V7 FROM NAGRUZKA WHERE NAGID='$onenagid'";
	$cur=ora_do($conn,$sql);

		$lec=ora_getcolumn($cur,0);
		$sem=ora_getcolumn($cur,1);
		$lab=ora_getcolumn($cur,2);
		$prim=ora_getcolumn($cur,3);
		$v1=ora_getcolumn($cur,4);
		$v2=ora_getcolumn($cur,5);
		$v3=ora_getcolumn($cur,6);
		$v4=ora_getcolumn($cur,7);
		$v5=ora_getcolumn($cur,8);
		$v7=ora_getcolumn($cur,9);

		ora_fetch($cur);

	if($groupnum>1)
	{

		for($i=0;$i<sizeof($nags);$i++)
		{
			
			$sql="SELECT PREPID_LEC, ROOM_LEC FROM NAGRUZKA_LEC WHERE NAGID='$nags[$i]'";
			$cur2=ora_do($conn,$sql);
			$leciss[$i]=ora_getcolumn($cur2,0);
			$lecroomiss[$i]=ora_getcolumn($cur2,1);
			//echo "lecs $leciss[$i]";
	
			/*$sql="SELECT PREPID_SEM,ROOM_SEM FROM NAGRUZKA_SEM WHERE NAGID='$nags[$i]'";
			$cur2=ora_do($conn,$sql);
			$semiss[$i]=ora_getcolumn($cur2,0);
			$semroomiss[$i]=ora_getcolumn($cur2,1);*/
			//echo "sems $semiss[$i]";			
		}
		echo " <FONT FACE='Garamond' SIZE='3' color='red'>";

		for($i=1;$i<sizeof($leciss);$i++)
		{
			if($leciss[$i-1]==$leciss[$i])
			{
				$lecis=$leciss[$i];
			}
			else
			{
			 $lecis=0;
			 $lecroomis="";
			 echo "Выбранные групп имеют разного лектора";
			 break;
			 
			}
			if($lecroomiss[$i-1]==$lecroomiss[$i])
			{
					$lecroomis=$lecroomiss[$i];
			}
			else
			{
			 $lecis=0;
			 $lecroomis="";
			  echo "Выбранные групп имеют разного лектора";
			 break;
			
			}
		}
		/*for($i=1;$i<sizeof($semiss);$i++)
		{
			if($semiss[$i-1]==$semiss[$i])
			{
				$semis=$semiss[$i];
			}
			else
			{
			 $semis=0;
			 $semroomis="";
			  echo "Выбранные групп имеют разного семинариста";
			 break;
			}
			/*if($semroomiss[$i-1]==$semroomiss[$i])
			{
				$semroomis=$semroomiss[$i];
			}
			else
			{
			 $semis=0;
			 $semroomis="";
			  echo "Выбранные групп имеют разного семинариста";
			 break;
			}*/
		//}

		echo "<br/>Внимание. преподаватели назначаются для всех выбранных групп.</br>";
		echo "Внимание. Примечание запишится для всех выбранных групп.</br>";
		echo "<INPUT TYPE='checkbox' NAME='potok' id='potok' checked><font color='blue'>Отметьте, если выбранные группы являются потоком</br>";
		
	}
	else
	{
		
			$sql="SELECT PREPID_LEC, ROOM_LEC FROM NAGRUZKA_LEC WHERE NAGID='$onenagid'";
			$cur2=ora_do($conn,$sql);
			$lecis=ora_getcolumn($cur2,0);
			$lecroomis=ora_getcolumn($cur2,1);
			
			

			ora_fetch($cur2);
			}

				
			$sql="SELECT PREPID_SEM,ROOM_SEM,ID FROM NAGRUZKA_SEM WHERE NAGID='$onenagid'";
			$cur2=ora_do($conn,$sql);
			for ($i=0;$i<ora_numrows($cur2);$i++)
			{
			$semis[$i]=ora_getcolumn($cur2,0);
			$semroomis[$i]=ora_getcolumn($cur2,1);
			$semids[$i]=ora_getcolumn($cur2,2);
			ora_fetch($cur2);
			}
			
			$sql="SELECT PREPID_LAB,ROOM_LAB,ID FROM NAGRUZKA_LABS WHERE NAGID='$onenagid'";
			$cur2=ora_do($conn,$sql);
			for ($i=0;$i<ora_numrows($cur2);$i++)
			{
			$labis[$i]=ora_getcolumn($cur2,0);
			$labroomis[$i]=ora_getcolumn($cur2,1);
			$labids[$i]=ora_getcolumn($cur2,2);
			ora_fetch($cur2);
			}
			
			
			
			
			
			
		
	}
		
		$cur=0;	
	$colspan=0;
	echo "<FONT FACE='Garamond' SIZE='5' color='black'><table><tr><td width='150'></td>
	<td  align='center'><b>Преподаватель</td>
	<td  align='center'><b>Аудитория</td>";
	echo "<td></td></tr>";
	if($lec!=0){
	echo "<tr><td >Лекции($lec час.):</td><td><select name='lect' id='lect'>";
	echo "<option value='0'>--не выбрано--</option>";
	

	$sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
	$cur=ora_do($conn,$sql);			
	for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$manid=ora_getcolumnzero($cur,0);
			$fio=ora_getcolumnzero($cur,1);
			$zvan=ora_getcolumnzero($cur,2);
			
			if($lecis==$manid)
			{	
				$sel="selected";					
			}
			else
			{
				$sel="";
			}
			
			echo "<option value='$manid' $sel>$fio $zvan </option>";
			ora_fetch($cur);
		}
	echo "</select></td><td width=10><input type='text' id='lecroom' value='$lecroomis'></td>";
	echo "<td><input type='button' onClick='AddLec($nagids,$str)' value='Записать'>";
	echo "</td></tr>";
	}
	if($groupnum==1 && $sem!=0)
	{
		
		for($i=0;$i<sizeof($semis);$i++)
		{
			
			echo "<tr><td>Семинары($sem час.):</td><td><select name='sem$i' id='sem$i'>";
			echo "<option value='0'>--не выбрано--</option>";
			echo $sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
			$cur=ora_do($conn,$sql);
				for ($j=0;$j<ora_numrows($cur);$j++)
				{
					$manid=ora_getcolumnzero($cur,0);
					$fio=ora_getcolumnzero($cur,1);
					$zvan=ora_getcolumnzero($cur,2);					
					if($semis[$i]==$manid)
					{	
						$sel="selected";
						$sem2=$manid;					
					}
					else
					{
						$sel="";						
					}					
					echo "<option value='$manid' $sel>$fio $zvan </option>";
					ora_fetch($cur);
				}
			echo "</select></td><td width=10><input type='text' id='semroom$i' name='semroom$i' value='$semroomis[$i]'></td>";
			echo "<td><input type='button' onClick='AddSem2($onenagid,$str,$i,$semids[$i])' value='Записать'>";
			echo "</td></tr>";
		}
			$i++;
			echo "<tr><td>Семинары($sem час.):</td><td><select name='sem$i' id='sem$i'>";
			echo "<option value='0'>--не выбрано--</option>";
			echo $sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
			$cur=ora_do($conn,$sql);
				for ($j=0;$j<ora_numrows($cur);$j++)
				{
					$manid=ora_getcolumnzero($cur,0);
					$fio=ora_getcolumnzero($cur,1);
					$zvan=ora_getcolumnzero($cur,2);					
					if($semis[$i]==$manid)
					{	
						$sel="selected";
						$sem2=$manid;					
					}
					else
					{
						$sel="";						
					}					
					echo "<option value='$manid' $sel>$fio $zvan </option>";
					ora_fetch($cur);
				}
			echo "</select></td><td width=10><input type='text' id='semroom$i' name='semroom$i' value='$semroomis[$i]'></td>";
			echo "<td><input type='button' onClick='AddSem2($onenagid,$str,$i,0)' value='Записать'>";
			echo "</td></tr>";
	/*	if($sem2!=0)
		{
			echo "<tr><td>Семинары($sem час.):</td><td><select name='sem2' id='sem'>";
			echo "<option value='0'>--не выбрано--</option>";
			$sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' AND MANID!='$sem2' ORDER BY FIO";
			$cur=ora_do($conn,$sql);
				for ($i=0;$i<ora_numrows($cur);$i++)
				{
					$manid=ora_getcolumnzero($cur,0);
					$fio=ora_getcolumnzero($cur,1);
					$zvan=ora_getcolumnzero($cur,2);
					
					if($semis2==$manid)
					{	
						$sel="selected";					
					}
					else
					{
						$sel="";
					}
					
					echo "<option value='$manid' $sel>$fio $zvan </option>";
					ora_fetch($cur);
				}
			echo "</select></td><td width=10><input type='text' id='semroom2' name='semroom' value='$semroomis2'></td>";
			echo "<td><input type='button' onClick='AddSem2($onenagid,$str,2)' value='Записать'>";
			echo "</td></tr>";
		}*/
	}
	
	if($lab!=0 && $groupnum==1)
	{	//lab_make($labnum,$kafedra,$str,$lab,$nagids,$onenagid);
		for($i=0;$i<sizeof($labis);$i++)
		{
			
			echo "<tr><td>Лабораторные($lab час.):</td><td><select name='lab$i' id='lab$i'>";
			echo "<option value='0'>--не выбрано--</option>";
			echo $sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
			$cur=ora_do($conn,$sql);
				for ($j=0;$j<ora_numrows($cur);$j++)
				{
					$manid=ora_getcolumnzero($cur,0);
					$fio=ora_getcolumnzero($cur,1);
					$zvan=ora_getcolumnzero($cur,2);					
					if($labis[$i]==$manid)
					{	
						$sel="selected";
						$lab2=$manid;					
					}
					else
					{
						$sel="";						
					}					
					echo "<option value='$manid' $sel>$fio $zvan </option>";
					ora_fetch($cur);
				}
			echo "</select></td><td width=10><input type='text' id='labroom$i' name='labroom$i' value='$labroomis[$i]'></td>";
			echo "<td><input type='button' onClick='AddLab2($onenagid,$str,$i,$labids[$i])' value='Записать'>";
			echo "</td></tr>";
		}
			$i++;
			echo "<tr><td>Лабораторные($lab час.):</td><td><select name='lab$i' id='lab$i'>";
			echo "<option value='0'>--не выбрано--</option>";
			echo $sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
			$cur=ora_do($conn,$sql);
				for ($j=0;$j<ora_numrows($cur);$j++)
				{
					$manid=ora_getcolumnzero($cur,0);
					$fio=ora_getcolumnzero($cur,1);
					$zvan=ora_getcolumnzero($cur,2);					
					if($labis[$i]==$manid)
					{	
						$sel="selected";
						$lab2=$manid;					
					}
					else
					{
						$sel="";						
					}					
					echo "<option value='$manid' $sel>$fio $zvan </option>";
					ora_fetch($cur);
				}
			echo "</select></td><td width=10><input type='text' id='labroom$i' name='labroom$i' value='$labroomis[$i]'></td>";
			echo "<td><input type='button' onClick='AddLab2($onenagid,$str,$i,0)' value='Записать'>";
			echo "</td></tr>";
		
	}	
	
	if($groupnum==1){
	echo "<tr><td colspan='1'>Примечание: </td>";
	$ttt=2;
	echo "<td colspan='$ttt'><input type='text' id='prim' size='100%' name='prim' value='$prim'></td><td><input type='button' onClick='AddPrim($nagids,$str)' value='Записать'>";
	echo "</td></tr>";

	}
		$ttt=3;
	echo "<tr><td colspan='$ttt'>";
	echo "<div id=text5></div>";
	echo "</td></tr></table>";
	
	if($groupnum==1){

	echo "<center><h4>Распределение нагрузки по экзаменам/зачётам</h4>";
	echo "<table><tr>";
	echo "<td align='center'>Преподаватель</td>";
	if($v1>0){echo "<td align='center' width='50'><font size='2'><center><b>Экзамен</br> $v1 час.</td>";$colspan++;}
	if($v2>0){echo "<td align='center' width='50'><font size='2'><b>Диф.Зач</br>$v2 час.</td>";$colspan++;}
	if($v3>0){echo "<td align='center' width='50'><font size='2'><b>Зачет</br>$v3 час.</td>";$colspan++;}
	if($v4>0){echo "<td align='center' width='50'><font size='2'><b>Курсовой</br>проект</br>$v4 час.</td>";$colspan++;}
	if($v5>0){echo "<td align='center' width='50'><font size='2'><b>Курсовая</br>работа</br>$v5 час.</td>";$colspan++;}
	if($v7>0){echo "<td align='center' width='50'><font size='2'><b>ГОС</br>$v7 час.</td>";$colspan++;}
	
	echo "<td align='center'>";
	echo "<input type='hidden' id='v1' value='$v1'>";
	echo "<input type='hidden' id='v2' value='$v2'>";
	echo "<input type='hidden' id='v3' value='$v3'>";
	echo "<input type='hidden' id='v4' value='$v4'>";
	echo "<input type='hidden' id='v5' value='$v5'>";
	echo "<input type='hidden' id='v7' value='$v7'>";
	echo "</td>";
	
	$sql="SELECT COUNT(*) FROM NAGRUZKA_REP WHERE NAGID='$onenagid'";
	$cur2=ora_do($conn,$sql);
	$count=ora_getcolumn($cur2,0);
	
	if($count!=0)
	{
		$sql="SELECT PREPID,N1,N2,N3,N4,N5,N7 FROM NAGRUZKA_REP WHERE NAGID='$onenagid'";
		$cur2=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur2);$i++)
		{
			$prepid=ora_getcolumnzero($cur2,0);
				
			$n1 = number_format( ora_getcolumn($cur2,1), 1, '.', '');
			$n2 = number_format( ora_getcolumn($cur2,2), 1, '.', '');
			$n3 = number_format( ora_getcolumn($cur2,3), 1, '.', '');
			$n4 = number_format( ora_getcolumn($cur2,4), 1, '.', '');
			$n5 = number_format( ora_getcolumn($cur2,5), 1, '.', '');
			$n7 = number_format( ora_getcolumn($cur2,6), 1, '.', '');			
			
		echo "<tr><td><select name='prep$i' id='prep$i'>";
		echo "<option value='0'>--не выбрано--</option>";
		$sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
		$cur=ora_do($conn,$sql);
			for ($j=0;$j<ora_numrows($cur);$j++)
			{
				$manid=ora_getcolumnzero($cur,0);
				$fio=ora_getcolumnzero($cur,1);
				$zvan=ora_getcolumnzero($cur,2);
				
				if($prepid==$manid)
				{	
					$sel="selected";					
				}
				else
				{
					$sel="";
				}
			
				echo "<option value='$manid' $sel>$fio $zvan </option>";
				ora_fetch($cur);
			}
		echo "</select></td>";
		
		if($v1>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep1$i' value='$n1'></td>";}
		else{echo "<input type='hidden' id='rep1$i' name='semroom' value='0'>";}
		if($v2>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep2$i' value='$n2'></td>";}
		else{echo "<input type='hidden' id='rep2$i' name='semroom' value='0'>";}
		if($v3>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep3$i' value='$n3'></td>";}
		else{echo "<input type='hidden' id='rep3$i' name='semroom' value='0'>";}
		if($v4>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep4$i' value='$n4'></td>";}
		else{echo "<input type='hidden' id='rep4$i' name='semroom' value='0'>";}
		if($v5>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep5$i' value='$n5'></td>";}
		else{echo "<input type='hidden' id='rep5$i' name='semroom' value='0'>";}
		if($v7>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep7$i' value='$n7'></td>";}
		else{echo "<input type='hidden' id='rep7$i' name='semroom' value='0'>";}
		
		echo "<td width=10>";




		echo "<input type='button' id='brep$i' onClick='AddRep($onenagid,$i,$prepid,$str,$count)' value='Записать'>
		</td></tr>";
			ora_fetch($cur2);
		}
	
		}
	
	echo "<tr><td><select name='prep' id='prep'>";
		echo "<option value='0'>--не выбрано--</option>";
		$sql="SELECT MANID,FIO,DOL_SMALL FROM V_SPI_PREPOD_NAGRUZKA WHERE DIVID='$kafedra' ORDER BY FIO";
		$cur=ora_do($conn,$sql);
			for ($i=0;$i<ora_numrows($cur);$i++)
			{
				$manid=ora_getcolumnzero($cur,0);
				$fio=ora_getcolumnzero($cur,1);
				$zvan=ora_getcolumnzero($cur,2);

				echo "<option value='$manid'>$fio $zvan </option>";
				ora_fetch($cur);
			}
		echo "</select></td>";
		if($v1>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep1' name='semroom' value=''></td>";}
		else{echo "<input type='hidden' id='rep1' name='semroom' value='0'>";}
		if($v2>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep2' name='semroom' value=''></td>";}
		else{echo "<input type='hidden' id='rep2' name='semroom' value='0'>";}
		if($v3>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep3' name='semroom' value=''></td>";}
		else{echo "<input type='hidden' id='rep3' name='semroom' value='0'>";}
		if($v4>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep4' name='semroom' value=''></td>";}
		else{echo "<input type='hidden' id='rep4' name='semroom' value='0'>";}
		if($v5>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep5' name='semroom' value=''></td>";}
		else{echo "<input type='hidden' id='rep5' name='semroom' value='0'>";}
		if($v7>0){echo "<td align='center' width='50'><font size='2'><input type='text' id='rep7' name='semroom' value=''></td>";}
		else{echo "<input type='hidden' id='rep7' name='semroom' value='0'>";}
		
		echo "<td width=10>
		<input type='button' id='semroom' name='semroom' onClick='AddRep($onenagid,999,999,$str,$count)' value='Записать'>
		</td></tr>";
		echo "</table><div id='text6'></div>";
	}

?>

