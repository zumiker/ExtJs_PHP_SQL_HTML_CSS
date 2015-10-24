<style type="text/css">
<!--

table {

  width:100%;
  border-collapse:collapse;
    border:1px solid black;
}

/* the border will be defined by the td tags */
td.BorderMeRed {
  background-color:#DEDFDE;
  border:1px solid black;

}

/* let's do a blue... */
td.last {

  border:1px solid black;

}

/* and of course a default one */
td {

  border:1px solid black;
}

-->
</style>
<?php
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return "&nbsp"; 
else return ora_getcolumn($cur,$pos);
}

if(isset($_GET['id_fac']))
{
	$id_fac=$_GET['id_fac'];
	$sql1=" FACID='$id_fac' ";
}

if(isset($_GET['id_spec']))
{
	$id_spec=$_GET['id_spec'];
	$sql1="SPECID='$id_spec' ";
}

if(isset($_GET['id_con']))
{
	$id_con=$_GET['id_con'];
	$sql1=" CON_ID='$id_con' ";
}

if(isset($_GET['id_pr']))
{
	$pred=$_GET['id_pr'];
	$sql1=" ID_PR='$pred' ";
}

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


$sql="SELECT FACNAME, FACID, CON_ID, SPECID, SPCNAME, LASTNAME, FIRSTNAME, PATRONYMIC, " .
		"PREDMET, BALL16".
		" FROM ABIVIEW_LISTOFEXAM" .
		" WHERE $sql1 AND BALL16 is null ORDER BY FACID, CON_ID, SPECID, LASTNAME, FIRSTNAME";
		


$d=date("d.m.Y H:i ");
		$hdate="Отчёт сформирован $d";	
//echo $pred;	
//echo $sql;		
$html .= "<center><h2>Список абитуриентов на экзамен<br/>$header_date<br/>$hdate<br/><br/></center>".
		 "<table border='1' " .
 			"style='" .
 			"text-align:center; " .
 			"font-family: " .
 			"Verdana; " .
 			"font-size: 10px;'>";
$s1 .= 	"<tr>" .
		"<td align='center'><b>№</td>" .
		"<td align='center'><b>ФИО</td>" .
		"<td align='center'><b>Предмет</td>";
				
			
		$col = "#ffffff";
		$CON_ID_OLD="netu";
		$SPECID_OLD="netu";
		$cur=ora_do($conn,$sql);
		$num=1;
		for ($i=0;$i<ora_numrows($cur);$i++)
		{			
			
		$num=$num+1;
		$FACNAME = ora_getcolumnnbsp($cur,0);
		$FACID = ora_getcolumnnbsp($cur,1);
		$CON_ID = ora_getcolumnnbsp($cur,2);
		$SPECID = ora_getcolumnnbsp($cur,3);
		$SPCNAME = ora_getcolumnnbsp($cur,4);
		$LASTNAME = ora_getcolumnnbsp($cur,5);
		$FIRSTNAME = ora_getcolumnnbsp($cur,6);
		$PATRONYMIC = ora_getcolumnnbsp($cur,7);
		$PREDMET = ora_getcolumnnbsp($cur,8);
		$BALL16 = ora_getcolumnnbsp($cur,9);
				
		if($SPECID_OLD!=$SPECID)
		{
			$html.= "<tr><td colspan='99' align='left'><b></b>Факультет: <b>$FACNAME</b> <br/>Специальность: <b>$SPCNAME</td></tr>";
			$html.=$s1;
				$num=1;
			$SPECID_OLD=$SPECID;	
		}	
		
		if ($col=='#ffffff')
		{
			$col='#dddddd';
		}
		else
		{
			$col='#ffffff';
		}
		$html .= "<tr bgcolor='$col'>" .
		"<td align='center'>$num</td>" .
		"<td align='center'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
		"<td align='center'>$PREDMET</td>";
		
			  
		
		$html .="</tr>";
		
		
			ora_fetch($cur);		
		}
		
	
echo $html;
	
?>
