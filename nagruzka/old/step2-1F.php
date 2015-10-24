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
			}else
			{
				$sql="insert into NAGRUZKA_PREP ( MANID, DIVID, SPRING_AUTUMN, YEAR_GROCODE ) " .
						"VALUES('$manid','$kafedra','$sem','$year')";
				$cur=ora_do($conn,$sql);
			}
		}
		$sql="select F9, F10, F11, F12, F15, F16, F17, F18, F19, F20, F22, F23, F24,FPRIM,F2,F3,F4,F6,F8 from NAGRUZKA_PREP where MANID='$manid' and " .
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
  $N2=ora_getcolumn($cur,14);
  $N3=ora_getcolumn($cur,15);
  $N4=ora_getcolumn($cur,16);
  $N6=ora_getcolumn($cur,17);
  $N8=ora_getcolumn($cur,18);
echo "</br><center><table >
  <tr>
  <td rowspan='99' width='25%'></td>		
  <td colspan='2' align='center'>
  <h2><b>Фактическая нагрузка
  </td>
  <td rowspan='99' width='25%'></td>		
  </tr>
  <tr>
  <tr>
  <td align='center'>
  <b>Название
  </td>
  <td align='center'>
  <b>кол-во</br>часов
  </td>
  </tr>
  <tr>
  	<td colspan='2' align='center'>
  		<b>Аудиторная нагрузка
  	</td>
  </tr>
  
  <tr>
  	<td>
  		Лекции
  	</td>
  	<td>
  		<input type='text' size='3' id='n2' value='$N2'>
  	</td>
  </tr>		
  
  <tr>
  	<td>
  		Практические семинары
  	</td>
  	<td>
  		<input type='text' size='3' id='n3' value='$N3'>
  	</td>
  </tr>	
  
  <tr>
  	<td>
  		Лабораторные
  	</td>
  	<td>
  		<input type='text' size='3' id='n4' value='$N4'>
  	</td>
  </tr>			
  
  <tr>
  	<td>
  		Зачёты, экзамены
  	</td>
  	<td>
  		<input type='text' size='3' id='n6' value='$N6'>
  	</td>
  </tr>
    
  <tr>
  	<td>
  		Руководство курсовым проектом(работой)
  	</td>
  	<td>
  		<input type='text' size='3' id='n8' value='$N8'>
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
  		Проверка контрольных, домашних работ, рефератов
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
  <tr><td colspan='2' align='center'><input type='button' onClick='AddPrepF($manid,$kafedra)' value='Сохранить'></td></tr>	
  ";