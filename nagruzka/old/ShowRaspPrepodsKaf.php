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

$fac=$_GET['kaf'];

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


$sql="SELECT STAT_ID,STAT,BEZ,SUM_STAVKA,PROF,DOC,STAR,PREP,ASS,STAVKA,VSEGO
	      from Z_PREPOD_UMU WHERE DIVID='$fac'
	      order by stat_id,stavka desc";
$sql2="SELECT DIVABBREVIATE ".
	 "FROM DIVISION WHERE DIVID='$fac'";
$cur=ora_do($conn,$sql2);
$FACULTY=ora_getcolumn($cur,0);
echo "<Center>Кафедра: $FACULTY";	    


$cur=ora_do($conn,$sql);

$col="#FFFFFF";
echo "<table align='center'>";
echo "<tr bgcolor='SkyBlue'>" .
	"<td rowspan=1 align='center'><b> </td>" .
	"<td rowspan=1 align='center'><b>Категория</td>" .	 		
	"<td colspan=1 align='center'><b>Ставки</td>" .
	"<td colspan=1 align='center'><b>Всего ставок</td>" .
	"<td colspan=1 align='center'><b>Всего физ.лиц</td>" .
	"<td rowspan=1 align='center'><b>Профессора</td>" .
	"<td rowspan=1 align='center'><b>Доценты</td>" .
	"<td rowspan=1 align='center'><b>Ст.Преп.</td>" .
	"<td rowspan=1 align='center'><b>Преп.</td>" .
	"<td rowspan=1 align='center'><b>Ассистент</td>" .
	"<td rowspan=1 align='center'><b>Примечание</td>" .	
	"<td rowspan=1 align='center'><b> </td>" .	 			 			 		
	"</tr>";




$color=random_color();
for ($i=0;$i<ora_numrows($cur);$i++)
 {
	 
	$STAT=ora_getcolumn($cur,1);
 	$STAVKA=ora_getcolumn($cur,3);
 	$PROF=ora_getcolumn($cur,4);
 	$DOC=ora_getcolumn($cur,5);
 	$STAR=ora_getcolumn($cur,6);
 	$PREP=ora_getcolumn($cur,7);
 	$ASS=ora_getcolumn($cur,8);
 	$PRIM=ora_getcolumn($cur,2);
 	$STAVKA2=ora_getcolumn($cur,9); 
	$VSEGO=ora_getcolumn($cur,10);	

	 
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
	 		"<td align='center'>$STAVKA2</td>" .
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

?>
