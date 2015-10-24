
<?php
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return "&nbsp"; 
else return ora_getcolumn($cur,$pos);
}

$header='';

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");



if($_GET['id_fac']!=0)
{
	$id_fac=$_GET['id_fac'];
	$sql1="AND FACID='$id_fac' ";
}

if(isset($_GET['id_spec']))
{
	$id_spec=$_GET['id_spec'];
	$sql1.="AND SPECID='$id_spec' ";
}

if(isset($_GET['id_con']))
{
	$id_con=$_GET['id_con'];
	$sql1.="AND CON_ID='$id_con' ";
}

if(isset($_GET['id_pr']))
{
	$pred=$_GET['id_pr'];
	$sql1.="AND ID_PR='$pred' ";
	
	$sql="SELECT DISTINCT ID_PR, PREDMET FROM ABIVIEW_LISTOFEXAM WHERE ID_PR=$pred";
	$cur=ora_do($conn,$sql);
	$header = ora_getcolumnnbsp($cur,1);
	
}






$sql="SELECT FACNAME, FACID, CON_ID, SPECID, SPCNAME, LASTNAME, FIRSTNAME, PATRONYMIC, " .
		"PREDMET, BALL16".
		" FROM ABIVIEW_LISTOFEXAM" .
		" WHERE  BALL16 is null $sql1  ORDER BY FACID, CON_ID, SPECID, LASTNAME, FIRSTNAME";
		



//echo $sqlbal;		
$html .= 
		 "<table border='1' " .
 			"style='" .
 			"text-align:center; " .
 			"font-family: " .
 			"Verdana; " .
 			"font-size: 10px;'>";
 			
$d=date("d.m.Y H:i ");
$hdate="Отчёт сформирован $d";
$html .= "<tr><td colspan='99' align='center' family='TimesNewRomanPS-BoldMT' size='14'><h2>Список абитуриентов на экзамен<br/>$header<br/><br/></td></tr>";
$html .= "<tr><td colspan='99' align='right' family='TimesNewRomanPS-BoldMT' size='8'>$hdate<br/></td></tr>";

$s1 .= 	"<tr>" .
		"<td align='center' width='15'><b>№</td>" .
		"<td align='center' width='85'><b>ФИО</td>" .
		"<td align='center' width='70'><b>Предмет</td>";
							
	
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
			$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' align='left'>Факультет: $FACNAME <br/>Специальность: $SPCNAME</td></tr>";
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
		"<td align='left'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>".
		"<td align='center'>$PREDMET</td>";

		
		$html .="</tr>";
		
		
			ora_fetch($cur);		
		}
		
	
	define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');
	
$p = new PDFTable();
$p->AddPage('P');
$p->SetMargins(10,10,10);
$p->AddFont('TimesNewRomanPSMT','','times.php');  
$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',8); 
$p->htmltable($html);

$p->output('','I');	

	
?>
