<?php
//get the q parameter from URL
$fac=$_GET["fac"];
$god2=$god=$_GET["god"];
$semestr=$_GET["semestr"];

/*
<td width='300'>
<B>Выберите кафедру:
</td>

echo "<select id='kaf' onchange=''>";
//<td>
//<option value=''>--не выбрано--</option>	
	//echo "<option value='999'>--выбрать--</option>";
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
	$sql="SELECT DIVABBREVIATE,DIVID FROM V_SPI_KAFEDR WHERE FACID='$fac' ORDER BY DIVABBREVIATE";
	$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$DIVABBREVIATE=ora_getcolumn($cur,0);
			$DIVID=ora_getcolumn($cur,1);			

	//    		echo "<option value='$DIVID'>$DIVABBREVIATE</option>";
			ora_fetch($cur);
		}
	//	echo "</select>";
</td>	





<tr>

<td width='150'><input type='button' onClick='ShowRaspExcel()' value='Получить отчёт'></td>
</tr>
</table>
*/	
		
	
		
		


?>
<table>
<br/>
<center>
<table width='600'>
	<tr>
		<td>
			<b>Кафедра
		</td>
		<td>
			<b>Статус
		</td>
		<td>
			<b>Дата изменения
		</td>
		<td>
		</td>
	</tr>
<?php 

if($semestr=='01.09.')
$sem='Осенний';
else
$sem='Весенний';

$god=$god.'/'.($god+1);
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
	$sql = "select FACID, DIVID, FAC, DIVABBREVIATE, SS, TO_CHAR(KOGDA, 'DD-MM-YYYY HH:MI'),STATUS from Z_STATUS where FACID='$fac' AND YEAR_GROCODE='$god' AND SEMESTR='$sem' ORDER BY DIVABBREVIATE ";
	$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
		{
			$FACID=ora_getcolumn($cur,0);
			$DIVID=ora_getcolumn($cur,1);
			$FAC=ora_getcolumn($cur,2);
			$DIVABBREVIATE=ora_getcolumn($cur,3);
			$SS=ora_getcolumn($cur,4);
			$KOGDA=ora_getcolumn($cur,5);	
			$STATUS=ora_getcolumn($cur,6);
			
			switch($STATUS)
			{

				case 0:
				default:				
				$col='#AA0078';
				
				$form="";
				break;
				case 1:
				$col='#00ff00';
				
				$form="<br/><input type='button' size='100%' onClick='GetNag($DIVID)' style='background-color: #00ff00; color: #000000;' value='Принять'/>".
				"<input type='button' size='100%' onClick='OpenNag($DIVID)' style='background-color: #00ff00; color: #000000;' value='Открыть'/>";
				break;
				case 2:
				$col='#ffffff';
				$form="";
				$form="<input type='button' size='100%' onClick='BackNag($DIVID)' style='background-color: #ffffff; color: #000000;' value='Вернуть'/>";
				break;	
				
		
				default:				
				$col='#AA0078';
				$form="";
							
			
			}
			
	    	echo "<tr>" .
	    			"<td>$DIVABBREVIATE</td>" .
	    			"<td bgcolor='$col' align='center'>$SS $form</td>" .
	    			"<td>$KOGDA</td>" .
	    			"<td>
	    			| <a href='excel_prepod_stavki.php?fac=$FACID&kaf=$DIVID'>Преподаватели</a>
	    			| <a href='../nagruzka/excel_prepod_kaf.php?kaf=$DIVID'>Список преподавателей</a> 
	    			| <a href='../nagruzka/nagr.php?divid=$DIVID&god=$god2'>Диспетчерская</a> <a href='../nagruzka/nagr.php?divid=$DIVID&god=$god2&ooo=1'>(OpenOffice)</a>  
	    			|  <a href='../nagruzka/excel.php?kaf=$DIVID&god=$god2&sem=$semestr'>Отчёт в excel</a> | 
	    			</td>".
	    			 			
	    			"</tr>";
			ora_fetch($cur);
		}

	
		?>
<div id="text2"> </div>