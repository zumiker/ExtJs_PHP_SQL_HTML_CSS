<script>
var item;
function menuOver(itemName,ocolor){
item=itemName;
itemName.style.backgroundColor = ocolor; //background color change on mouse over

}

function menuOut(itemName,ocolor){
if(item)
itemName.style.backgroundColor = ocolor;

}
</script>
<style>
table th, table td {
  font-size : 70%;
  font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
}
</style>
<?php
$kaf=$_GET['kaf'];
$god=$_GET['god'];
$sem=$_GET['sem'];

if($sem=='01.09.')
$sem='Осенний';
else
$sem='Весенний';

$god=$god.'/'.($god+1);
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT DIVNAME,KURS,GROCODE,EXAM,ZACH,PROEKT,PREDMET,LEKTOR,ROOM_LEC,SEMINAR,ROOM_SEM,LABRAB,ROOM_LAB,PRIM,NAGID,LEC,SEM,LAB from Z_DISPETCH_NAGRUZKA WHERE DIVID=$kaf AND SPRING_AUTUMN='$sem' AND YEAR_GROCODE='$god' ORDER BY KURS,POR_SORT, PREDMET,GROCODE ";
$cur=ora_do($conn,$sql);
$DIVNAME_OLD='12312';
$KURS_OLD='132';
$col="#FFFFFF";
echo "<table align='center'>";
$head = "<tr bgcolor='SkyBlue'>" .
			"<td rowspan=2 align='center'><b>Предмет</td>" .	 		
			"<td rowspan=2 align='center'><b>Группа</td>" .
	 		"<td rowspan=2 align='center'><b>Экзам</td>" .
	 		"<td rowspan=2 align='center'><b>Зач</td>" .
	 		"<td rowspan=2 align='center'><b>Проект</td>" .
	 		"<td colspan=3 align='center'><b>ЛЕКЦИИ</td>" .
	 		"<td colspan=3 align='center'><b>ПРАКТИЧЕСКИЕ ЗАНЯТИЯ</td>" .
	 		"<td colspan=3 align='center'><b>ЛАБОРАТОРНЫЕ РАБОТЫ</td>" .
	 		"<td rowspan=2 align='center'><b>Примечание</td>" .	 			 		
	 		"</tr><tr bgcolor='SkyBlue'>".
	 		"<td align='center'><b>час/нед</td>" .
	 		"<td align='center'><b>Ф.И.О. <br>преподавателя</td>" .
	 		"<td align='center'><b>Ауд.</td>" .
	 		"<td align='center'><b>час/нед</td>" .
	 		"<td align='center'><b>Ф.И.О. <br>преподавателя</td>" .
	 		"<td align='center'><b>Ауд.</td>" .
	 		"<td align='center'><b>час/нед</td>" .
	 		"<td align='center'><b>Ф.И.О. <br>преподавателя</td>" .
	 		"<td align='center'><b>Ауд.</td></tr>";
$switch=0;
for ($i=0;$i<ora_numrows($cur);$i++)
 {
	 
	 $DIVNAME=ora_getcolumn($cur,0);
	 $KURS=ora_getcolumn($cur,1);
	 $GROCODE=ora_getcolumn($cur,2);
	 $EXAM=ora_getcolumn($cur,3);
	 $ZACH=ora_getcolumn($cur,4);
	 $PROEKT=ora_getcolumn($cur,5);
	 $PREDMET=ora_getcolumn($cur,6);
	 $LEKTOR=ora_getcolumn($cur,7);
	 $ROOM_LEC=ora_getcolumn($cur,8);
	 $SEMINAR=ora_getcolumn($cur,9);
	 $ROOM_SEM=ora_getcolumn($cur,10);
	 $LABRAB=ora_getcolumn($cur,11);
	 $ROOM_LAB=ora_getcolumn($cur,12);
	 $PRIM=ora_getcolumn($cur,13);
	 $NAGID=ora_getcolumn($cur,14);
	 $LEC=ora_getcolumn($cur,15);
	 $SEM=ora_getcolumn($cur,16);
	 $LAB=ora_getcolumn($cur,17);
	 
	 if($DIVNAME!=$DIVNAME_OLD)
	 {
	 	echo "<tr><td colspan='12' align='center'><h2>Нагрузка</h2><h3>Семестр: $sem. Учебный год: $god</h3></td></tr>";
	 	echo "<tr><td colspan='12' align='center'><h3>$DIVNAME</h3></td></tr>";
	 	$DIVNAME_OLD=$DIVNAME;
	 }
	 if($KURS!=$KURS_OLD)
	 {
	 	echo "<tr><td colspan='12' align='center'><h4>Курс $KURS</h4></td></tr>";
	 	$KURS_OLD=$KURS;
	 	echo $head;
	 }
	 
	 if ($col=="bgcolor='#eeeeee'")
		{
			
			$col="bgcolor='#ffffff'";
			$bgcol="onmouseout=menuOut(this,'#ffffff') onmouseover=menuOver(this,'#ef8740')";
		}
		else
		{
			$col="bgcolor='#eeeeee'";
			$bgcol="onmouseout=menuOut(this,'#eeeeee') onmouseover=menuOver(this,'#ef8740')";
		}
	 /*
	 if($switch==0)
	 {
	 $sql="SELECT COUNT(*) from Z_COUNT_NAGRUZKA WHERE NAGID=$NAGID";
	 $cur2=ora_do($conn,$sql);
	 $COUNT=ora_getcolumn($cur2,0);
	 if($COUNT>=1)
	 $switch=2;
	 }
	 
	if($switch==1)
	{
	 echo "<tr $col $bgcol>" . 		
			"<td>$GROCODE</td>" .
	 		"<td>$EXAM</td>" .
	 		"<td>$ZACH</td>" .
	 		"<td>$PROEKT</td>" .
	 		"<td>$LEKTOR</td>" .
	 		"<td>$ROOM_LEC</td>" .
	 		"<td>$SEMINAR</td>" .
	 		"<td>$ROOM_SEM</td>" .
	 		"<td>$LABRAB</td>" .
	 		"<td>$ROOM_LAB</td>" .
	 		"<td>$PRIM</td>" .	 			 		
	 		"</tr>";
	 			$COUNT--;
	 		if($COUNT==0)
	 		$switch=0;
	 	
	}	 
	if($switch==2)
	 {
	 		echo "<tr $col $bgcol>" .
			"<td rowspan='$COUNT'>$PREDMET</td>" .	 		
			"<td>$GROCODE</td>" .
	 		"<td>$EXAM</td>" .
	 		"<td>$ZACH</td>" .
	 		"<td>$PROEKT</td>" .
	 		"<td>$LEKTOR</td>" .
	 		"<td>$ROOM_LEC</td>" .
	 		"<td>$SEMINAR</td>" .
	 		"<td>$ROOM_SEM</td>" .
	 		"<td>$LABRAB</td>" .
	 		"<td>$ROOM_LAB</td>" .
	 		"<td>$PRIM</td>" .	 			 		
	 		"</tr>";
	 		$COUNT--;
	 		$switch=1;
	 }	 		*/
	 		echo "<tr $col $bgcol>" .
			"<td>$PREDMET</td>" .	 		
			"<td>$GROCODE</td>" .
	 		"<td align='center'>$EXAM</td>" .
	 		"<td align='center'>$ZACH</td>" .
	 		"<td align='center'>$PROEKT</td>" .
	 		"<td align='center'>$LEC</td>" .
	 		"<td>$LEKTOR</td>" .
	 		"<td>$ROOM_LEC</td>" .
	 		"<td align='center'>$SEM</td>" .
	 		"<td>$SEMINAR</td>" .
	 		"<td align='center'>$ROOM_SEM</td>" .
	 		"<td align='center'>$LAB</td>" .
	 		"<td>$LABRAB</td>" .
	 		"<td align='center'>$ROOM_LAB</td>" .
	 		"<td>$PRIM</td>" .	 			 		
	 		"</tr>";
	 ora_fetch($cur);
 }
?>
