
<?php
define('DEFAULT_CHARSET', 'WINDOWS-1251');
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return "&nbsp"; 
else return ora_getcolumn($cur,$pos);
}


if(isset($_GET['id_con']))
{
	$id_con=$_GET['id_con'];
	$sql1=" CON_ID='$id_con' ";
}

if(isset($_GET['filter']))
{
	$filter=$_GET['filter'];
}
else
{
	$filter='0';
}

if(isset($_GET['sort']))
{
	$sort=$_GET['sort'];
}
else
{
	$sort='0';
}



$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


$html = "<input type='hidden' id='id_con' value='$id_con'/>" .
		"<input type='hidden' id='sort' value='$sort'/>" .
		"<input type='hidden' id='filter' value='$filter'/>";
		$sql="SELECT CONGROUP".
		" FROM ABI_CONGROUP" .
		" WHERE ID_CON='$id_con'";
		$cur=ora_do($conn,$sql);
		$CONGROUP= ora_getcolumnnbsp($cur,0); 
$d=date("d.m.Y H:i ");
		$hdate="Отчёт сформирован $d";	
//echo $pred;	
//echo $sql;		


switch($filter)
{
	case 1:
		$sql_filter='AND NABOR=1';
		$b1='background-color:Tomato;';
		break;
	case 2:
		$sql_filter='AND TNABOR=2';
		$b2='background-color:Tomato;';
		break;
	case 3:
		$sql_filter='AND NABOR=3';
		$b3='background-color:Tomato;';
		break;
	case 4:
		$sql_filter='AND NABOR=4';
		$b4='background-color:Tomato;';
		break;
	default:
		$b0='background-color:Tomato;';
		$sql_filter='';
		break;
}			

$html .= "<center>$CONGROUP" .
		"<table><tr><td colspan=99 align='center'><b>Фильтры</b></td></tr>" .
		"<tr><td><b>Набор:</td>" .
		"	  <td><button  onclick='ViewCongroup($id_con,1,$sort)'  style='background-color:SkyBlue;$b1 width: 100px;'>Бюджет</button></td>" .
		"	  <td><button  onclick='ViewCongroup($id_con,2,$sort)'  style='background-color:SkyBlue;$b2 width: 100px;'>Целевой</button></td>" .
		"	  <td><button  onclick='ViewCongroup($id_con,3,$sort)'  style='background-color:SkyBlue;$b3 width: 104px;'>Коммерческий</button></td>" .
		"	  <td><button  onclick='ViewCongroup($id_con,4,$sort)'  style='background-color:SkyBlue;$b4 width: 100px;'>Контракт</button></td></tr>".
		"<tr><td><b></td>" .
		"	  <td colspan='4'><button  onclick='ViewCongroup($id_con,0,$sort)' style='background-color:SkyBlue;$b0 width: 420px;'>Все</button></td>" .
		"	  </td></tr></table><br/>";

$html.=	"<form name='frm' id='frm' onsubmit=\"getFormAsHash('frm')\">".
		 "<table border='0' " .
 			"style='" .
 			"text-align:center; " .
 			"font-family: " .
 			"Verdana; " .
 			"font-size: 10px;'>";

$html .= 	"<tr bgcolor='SkyBlue'>" .
		"<td align='center'><b><input type=\"checkbox\" name=\"$ABI_ID\" onClick='toggle_all(this)' value=\"1\"></td>" .
		//"<td align='center'><b><input type=\"radio\" name=\"$ABI_ID\" onClick='toggle_all(this)' value=\"1\"></td>" .
		"<td align='center'><b>№</td>" .
		"<td align='center'><b><a href='#' onclick='ViewCongroup($id_con,$filter,1)'>№ л.д.</a></td>" .
		"<td align='center'><b><a href='#' onclick='ViewCongroup($id_con,$filter,2)'>ФИО</a></td>".
		"<td align='center'><b><a href='#' >Почтовый индекс</a></td>".
		"<td align='center'><b><a href='#' >Город</a></td>".
		"<td align='center'><b><a href='#' >Адрес</a></td>" ;
		
				
			
		$col = "#ffffff";
		$CON_ID_OLD="netu";
		$SPECID_OLD="netu";
switch($sort)
{
	case 1:
		$sql_sort='ABI_NUMBER,';
		break;
	case 2:
		$sql_sort='LASTNAME,';
		break;
	default:
		$sql_sort='';
		break;
}	

/*
$sql = "SELECT p.CON_ID, p.ABI_ID, p.ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, NABOR, POSTINDEX, PLANAME, ADDRESS
		FROM ABITURIENT a, ABI_PRIOR p, PLACEOFRESIDENCE r
		WHERE a.ABI_ID = p.ABI_ID
			AND a.PLAID = r.PLAID
			AND p.PROSHEL = 30
			$sql_filter
			AND p.CON_ID = '$id_con'
		ORDER BY LASTNAME";
*/
$sql = "SELECT p.CON_ID, p.ABI_ID, p.ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, NABOR, POSTINDEX, null as PLANAME, ADDRESS
		FROM ABITURIENT a, ABI_PRIOR p
		WHERE a.ABI_ID = p.ABI_ID
			AND p.PROSHEL = 30
			$sql_filter
			AND p.CON_ID = '$id_con'
		ORDER BY LASTNAME";

		/*$sql="SELECT FACID, CON_ID, SPECID, 
		 ABI_ID, ABI_NUMBER, LASTNAME, FIRSTNAME, 
		 PATRONYMIC, NABOR, POSTINDEX, ADDRESS".
		" FROM ABIVIEW_AMBAR" .
		" WHERE CON_ID='$id_con' AND PRIORITET=1 AND PROSHEL=30 $sql_filter ORDER BY $sql_sort FIRSTNAME";*/
		//echo $sql;
		$cur=ora_do($conn,$sql);
		$num=0;
		for ($i=0;$i<ora_numrows($cur);$i++)
		{			
			
		$num++;
		$CON_ID= ora_getcolumnnbsp($cur,0); 
		$ABI_ID= ora_getcolumnnbsp($cur,1); 
		$ABI_NUMBER= ora_getcolumnnbsp($cur,2); 
		$LASTNAME= ora_getcolumnnbsp($cur,3); 
		$FIRSTNAME= ora_getcolumnnbsp($cur,4); 
		$PATRONYMIC= ora_getcolumnnbsp($cur,5); 
		$PLANAME= ora_getcolumnnbsp($cur,8); 
		$NABOR= ora_getcolumnnbsp($cur,6); 
		$POSTINDEX= ora_getcolumnnbsp($cur,7); 
		$ADDRESS= ora_getcolumnnbsp($cur,9); 
		


	
		if ($col=='#eeeeee')
		{
			
			$col="#dddddd";
			$bgcol="onmouseout=menuOut(this,'#dddddd') onmouseover=menuOver(this,'#ef8740')";
		}
		else
		{
			$col="#eeeeee";
			$bgcol="onmouseout=menuOut(this,'#eeeeee') onmouseover=menuOver(this,'#ef8740')";
		}

		
		
		//if(strlen($ORDERNUMBER)==0||empty($ORDERDATE))
		//{
			$check = "<input type=\"checkbox\" name=\"$ABI_ID\" value=\"1\">";
			//$check = "<input type=\"radio\" name=\"$ABI_ID\" value=\"1\">";
		//}
		//else
		//{
		//	$check = "<a href=\"#\" onclick=\"if (confirm('Вы уверены что хотите удалить абитуриента из приказа?')) { OrderRemove($ABI_ID,$id_con,$filter,$sort); } return false;\">X</a>";
		//}
		
		$html .= "<tr bgcolor='$col' $bgcol>" .
		"<td align='center'>$check</td>" .
		"<td align='center'>$num</td>" .
		"<td align='center'>$ABI_NUMBER</td>" .		
		"<td align='left'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
		"<td align='center'>$POSTINDEX</td>".
		"<td align='center'>$PLANAME</td>".
		"<td align='left'>$ADDRESS</td>";
		$html .="</tr>";
			ora_fetch($cur);		
		}
	$html .="<tr><td colspan='99'><input type='button' id='sbtn' onClick=\"getFormAsHash('frm',$id_con)\" value='Печать'/></td></tr><table></form>";
echo $html;
?>