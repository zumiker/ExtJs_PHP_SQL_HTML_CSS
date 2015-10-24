 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  font-size : 100%;
  font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
}
</style>

<?php

function random_color(){
    mt_srand((double)microtime()*1000000);
    $c = '';
    while(strlen($c)<6){
        $c .= sprintf("%02X", mt_rand(0, 255));
    }
    return $c;
}

$fac=$_GET['fac'];

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

if($fac==999)
{$sql="SELECT STAT_ID,STAT,BEZ,SUM(SUM_STAVKA),SUM(PROF),SUM(DOC),SUM(STAR),SUM(PREP),SUM(ASS),SUM(VSEGO),SUM(STAVKA) 
	      from Z_PREPOD_UMU 
	      group by stat_id,stat,bez 
	      order by stat_id,stat";
	      echo "<Center>Уровень университета";
	      
	      }
else
{$sql="SELECT STAT_ID,STAT,BEZ,SUM(SUM_STAVKA),SUM(PROF),SUM(DOC),SUM(STAR),SUM(PREP),SUM(ASS),SUM(VSEGO),STAVKA
	      from Z_PREPOD_UMU WHERE FACID='$fac'
	      group by stat_id,stat,bez,stavka 
	      order by stat_id,stat";
$sql2="SELECT FAC ".
	 "FROM FACULTY WHERE FACID='$fac'";
$cur=ora_do($conn,$sql2);
$FACULTY=ora_getcolumn($cur,0);
echo "<Center>Факультет: $FACULTY";	    
}

$cur=ora_do($conn,$sql);

$col="#FFFFFF";
echo "<table align='center'>";
echo "<tr bgcolor='SkyBlue'>" .
	"<td rowspan=1 align='center'><b> </td>" .
	"<td rowspan=1 align='center'><b>Категория</td>" .
	"<td rowspan=1 align='center'><b>Ставка</td>" .	
	"<td rowspan=1 align='center'><b>Всего ставок</td>" .
	"<td rowspan=1 align='center'><b>Всего физ. лиц</td>" .
	"<td rowspan=1 align='center'><b>Профессора</td>" .
	"<td rowspan=1 align='center'><b>Доценты</td>" .
	"<td rowspan=1 align='center'><b>Ст.Преп.</td>" .
	"<td rowspan=1 align='center'><b>Преп.</td>" .
	"<td rowspan=1 align='center'><b>Ассистент</td>" .
	"<td rowspan=1 align='center'><b>Примечание</td>" .	
	"<td rowspan=1 align='center'><b> </td>" .	 			 			 		
	"</tr>";




$color=random_color();


$aSTAVKA=0;
$aPROF=0;
$aDOC=0;
$aSTAR=0;
$aPREP=0;
$aASS=0;

$aVSEGO=0;
for ($i=0;$i<ora_numrows($cur);$i++)
 {
	 
	$STAT=ora_getcolumn($cur,1);
 	$aSTAVKA+=$STAVKA=ora_getcolumn($cur,3);
 	$aPROF+=$PROF=ora_getcolumn($cur,4);
 	$aDOC+=$DOC=ora_getcolumn($cur,5);
 	$aSTAR+=$STAR=ora_getcolumn($cur,6);
 	$aPREP+=$PREP=ora_getcolumn($cur,7);
 	$aASS+=$ASS=ora_getcolumn($cur,8);
 	$PRIM=ora_getcolumn($cur,2);
 	$aVSEGO+=$VSEGO=ora_getcolumn($cur,9); 	
	$aSTAVKACAT+=$STAVKACAT=ora_getcolumn($cur,10);
	 
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
				
	 		echo "<tr $col $bgcol>" .
	 		"<td align='center' bgcolor='$color' width='10'>  </td>" .
	 		"<td align='center'>$STAT</td>" .
			"<td align='center'>$STAVKACAT</td>" .
	 		"<td align='center'>$STAVKA</td>" .
	 		"<td align='center'>$VSEGO</td>" .
	 		"<td align='center'>$PROF</td>" .
	 		"<td align='center'>$DOC</td>" .
	 		"<td align='center'>$STAR</td>" .
	 		"<td align='center'>$PREP</td>" .
	 		"<td align='center'>$ASS</td>" .
	 		"<td align='center'>$PRIM</td>" .	 		
 			"<td align='center' bgcolor='$color' width='10'>  </td>" .
	 		"</tr>";
	 ora_fetch($cur);
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
 $color=random_color();
 
 
  		echo "<tr><td colspan='11' align='center'></td></tr><tr $col $bgcol>" .
	 		"<td align='center' bgcolor='$color' width='10'>  </td>" .
	 		"<td align='center'><b>Итого</td>" .
			"<td align='center'><b>$aSTAVKACAT</td>" .
	 		"<td align='center'><b>$aSTAVKA</td>" .
	 		"<td align='center'><b>$aVSEGO</td>" .
	 		"<td align='center'><b>$aPROF</td>" .
	 		"<td align='center'><b>$aDOC</td>" .
	 		"<td align='center'><b>$aSTAR</td>" .
	 		"<td align='center'><b>$aPREP</td>" .
	 		"<td align='center'><b>$aASS</td>" .
	 		"<td align='center'></td>" .	 		
 			"<td align='center' bgcolor='$color' width='10'>  </td>" .
	 		"</tr>";

?>
