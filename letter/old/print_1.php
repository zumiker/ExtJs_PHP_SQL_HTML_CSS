<?php
//define('DEFAULT_CHARSET', 'WINDOWS-1251');
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return "&nbsp"; 
else return ora_getcolumn($cur,$pos);
}
	$ABI_ID = $_GET["ABI_ID"];
	$ABI_ID = explode(",", $ABI_ID);
for($i=0;$i<sizeof($ABI_ID);$i++)
{
	if($i>0)
		$sql1 .= " OR ";
		
	$sql1 .= " ABI_ID = '$ABI_ID[$i]'";
}
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT LASTNAME, FIRSTNAME, PATRONYMIC, POSTINDEX, PLANAME, ADDRESS ".
		"FROM ABITURIENT a, PLACEOFRESIDENCE r ".
		"WHERE ($sql1) ".
		"AND a.PLAID=r.PLAID ".
		"ORDER BY LASTNAME";
$cur=ora_do($conn,$sql);
				$LASTNAME	= Array(); 
				$FIRSTNAME	= Array(); 
				$PATRONYMIC	= Array(); 
				$PLANAME	= Array(); 
				$POSTINDEX	= Array(); 
				$ADDRESS	= Array(); 
			for ($i=0;$i<ora_numrows($cur);$i++)
			{	
				$LASTNAME[$i]	= ucfirst(strtolower(ora_getcolumnnbsp($cur,0))); 
				$FIRSTNAME[$i]	= ucfirst(strtolower(ora_getcolumnnbsp($cur,1)));
				$PATRONYMIC[$i]	= ucfirst(strtolower(ora_getcolumnnbsp($cur,2))); 
				$PLANAME[$i]	= ucfirst(strtolower(ora_getcolumnnbsp($cur,4)));
				$POSTINDEX[$i]	= ora_getcolumnnbsp($cur,3); 
				//$ADDRESS[$i] = ucwords(strtolower(ora_getcolumnnbsp($cur,5)));
				$ADDRESS[$i] = (ora_getcolumnnbsp($cur,5));
				ora_fetch($cur);
			}
			for ($i=0;$i<ora_numrows($cur);$i++)
			{	
				/*$html 	.=	" <div style='position:relative; top:50px; left:50px;'><div style='position: absolute; top:135px; left:360px; width:200px; background-color:gray; line-height:25px;'><font size='3'>$LASTNAME[$i] $FIRSTNAME[$i] $PATRONYMIC[$i] </font></div> " . 
							" <div style='position: absolute; top:185px; left:360px; width:200px; background-color:gray; line-height:25px;'><font size='3'>$PLANAME[$i] $ADDRESS[$i]</font></div>".
							" <div style='position: absolute; top:285px; left:340px; width:200px; background-color:gray;'><font size='3'>$POSTINDEX[$i]</font></div>".
							" <div style='position: absolute; top:0px; left:120px; width:200px; background-color:gray;'><font size='6'>091</font></div></div>";*/
							
							$html 	.=	" <div style='position: relative; top:50px; left:120px; width:50px; background-color:gray;'><font size='6'>091</font></div>".
							" <div style='position: relative; top:50px; left:360px; width:200px; background-color:yellow; line-height:25px;'><font size='3'>$LASTNAME[$i] $FIRSTNAME[$i] $PATRONYMIC[$i] </font></div> " . 
							" <div style='position: relative; top:50px; left:360px; width:200px; background-color:red; line-height:25px;'><font size='3'>$PLANAME[$i] $ADDRESS[$i]</font></div>".
							" <div style='position: relative; top:50px; left:340px; width:200px; background-color:green;'><font size='3'>$POSTINDEX[$i]</font></div>";
							
							//if($i>0)
							//$html .= "<div style='heigth:800px'></div>";
			ora_fetch($cur);	
			
		}
			
echo $html;
/*	define('FPDF_FONTPATH','font/');
	require('lib/pdftable.inc.php');
		
	$p = new PDFTable();
	$p->AddPage('P');
	$p->SetMargins(10,10,10);
	$p->AddFont('TimesNewRomanPSMT','','times.php');  
	$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
	$p->SetFont('TimesNewRomanPSMT','',14); 
	$p->htmltable($html);
	$p->output('','I');	*/

?>

