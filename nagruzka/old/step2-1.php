<?php
function ora_getcolumnzero($cur,$i)
{
	$a=ora_getcolumn($cur,$i);
	if ($a=='0') $a='&nbsp';
	return $a;
}
//get the q parameter from URL
$manid=$_GET["manid"];
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
//echo "<font color='blue'>Debug info: $semestr $god $kafedra $kurs <br></font>";
if($semestr=='01.09.')
$sem='Осенний';
else
{
$sem='Весенний';
}
$year=$god."/".($god+1);
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $sql="select count(*) from NAGRUZKA_PREP where MANID='$manid' and " .
		"DIVID='$kafedra' and SPRING_AUTUMN='$sem' and YEAR_GROCODE='$year'";
		$cur=ora_do($conn,$sql);
		$count=ora_getcolumn($cur,0);
		if($count==0 || $count > 1)
		{
			if ($count > 1)
			{
			echo "<center><h1>Обратитесь в лабораторию обнаружена дублирующая запись!";
			exit(1);
			}
			else
			{
				$sql="insert into NAGRUZKA_PREP ( MANID, DIVID, SPRING_AUTUMN, YEAR_GROCODE ) " .
						"VALUES('$manid','$kafedra','$sem','$year')";
				$cur=ora_do($conn,$sql);
			}
		}
		$sql="select N9, N10, N11, N12, N15, N16, N17, N18, N19, N20, N22, N23, N24,PRIM from NAGRUZKA_PREP where MANID='$manid' and " .
		"DIVID='$kafedra' and SPRING_AUTUMN='$sem' and YEAR_GROCODE='$year'";
		$cur=ora_do($conn,$sql);
  $N9=ora_getcolumn($cur,0);
  $N10=ora_getcolumn($cur,1);
  $N11=ora_getcolumn($cur,2);
  $N12=ora_getcolumn($cur,3);
  $N15=ora_getcolumn($cur,4);
  $N16=ora_getcolumn($cur,5);
  $N17=ora_getcolumn($cur,6);
  $N18=ora_getcolumn($cur,7);
  $N19=ora_getcolumn($cur,8);
  $N20=ora_getcolumn($cur,9);
  $N22=ora_getcolumn($cur,10);
  $N23=ora_getcolumn($cur,11);
  $N24=ora_getcolumn($cur,12);
  $PRIM=ora_getcolumn($cur,13);
  
echo "</br><center><table >
  <tr>
  <td rowspan='99' width='25%'></td>		
  <td colspan='2' align='center'>
  <h2><b>Планируемая нагрузка
  </td>
  <td rowspan='99' width='25%'></td>		
  </tr>
  <tr>
  <tr>
  <td align='center'>
  <b>Название
  </td>
  <td align='center'>
  <b>кол-во часов
  </td>
  </tr>
  <tr>
  	<td colspan='2' align='center'>
  		<b>Внеаудиторная нагрузка
  	</td>
  </tr>
  
  <tr>
  	<td>
  		Руководство дипломным проектированием
  	</td>
  	<td>
  		<input type='text' size='3' id='n9' value='$N9'>
  	</td>
  </tr>
  
  <tr>
  	<td>
  		УНИРС
  	</td>
  	<td>
  		<input type='text' size='3' id='n10' value='$N10'>
  	</td>
  </tr>

  <tr>
  	<td>
  		Учебная практика
  	</td>
  	<td>
  		<input type='text' size='3' id='n11' value='$N11'>
  	</td>
  </tr>
  
  <tr>
  	<td>
  		Производственная практика
  	</td>
  	<td>
  		<input type='text' size='3' id='n12' value='$N12'>
  	</td>
  </tr>
		
  <tr>
  	<td colspan='2' align='center'>
  		<b>Другие виды учебной нагрузки 
  	</td>
  </tr>
  
  <tr>
  	<td>
  		Консультации
  	</td>
  	<td>
  		<input type='text' size='3' id='n15' value='$N15'>
  	</td>
  </tr>
  
  <tr>
  	<td>
  		Проверка контрольных, домашних работ. Рефератов
  	</td>
  	<td>
  		<input type='text' size='3' id='n16' value='$N16'>
  	</td>
  </tr>  
  
  <tr>
  	<td>
  		Работа в ГАК
  	</td>
  	<td>
  		<input type='text' size='3' id='n17' value='$N17'>
  	</td>
  </tr>  
  		
  <tr>
  	<td>
  		Приём вступительных экзаменов
  	</td>
  	<td>
  		<input type='text' size='3' id='n18' value='$N18'>
  	</td>
  </tr>  
  
  <tr>
  	<td>
  		Руководство аспирантами
  	</td>
  	<td>
  		<input type='text' size='3' id='n19' value='$N19'>
  	</td>
  </tr>
  
  <tr>
  	<td>
  		Руководство магистрами
  	</td>
  	<td>
  		<input type='text' size='3' id='n20' value='$N20'>
  	</td>
  </tr>    
  
  <tr>
  	<td colspan='2' align='center'>
  		<b>Прочие виды работ
  	</td>
  </tr>  
    
  <tr>
  	<td>
  		Факультативы
  	</td>
  	<td>
  		<input type='text' size='3' id='n22' value='$N22'>
  	</td>
  </tr>  
  
  <tr>
  	<td>
  		Кураторство, руководство СНО
  	</td>
  	<td>
  		<input type='text' size='3' id='n23' value='$N23'>
  	</td>
  </tr>
  
 <tr>
  	<td>
  		ФПК преподавателей
  	</td>
  	<td>
  		<input type='text' size='3' id='n24' value='$N24'>
  	</td>
  </tr>
  <tr>
  	<td>
  		Прочее
  	</td>
  	<td>
  		<input type='text' size='3' id='prim' value='$PRIM'>
  	</td>
  </tr>		
  <tr><td colspan='2' align='center'><input type='button' onClick='AddPrep($manid,$kafedra)' value='Сохранить'></td></tr>	
  ";