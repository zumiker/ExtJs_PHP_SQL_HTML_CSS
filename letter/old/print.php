
<?php
//define('DEFAULT_CHARSET', 'WINDOWS-1251');
function ora_getcolumnnbsp($cur,$pos)
{
if (ora_getcolumn($cur,$pos)==' ') return "&nbsp"; 
else return ora_getcolumn($cur,$pos);
}

/*if(isset($_GET['ABI_ID']))
{
	$id_con=$_GET['ABI_ID'];
	echo '1';
	for(i=0;i=ABI_ID.length;i++)
		$sql1 .= " ABI_ID='$ABI_ID[i]' ";
}*/

	$ABI_ID = $_GET["ABI_ID"];
	$ABI_ID = explode(",", $ABI_ID);
/*$html .= 	"<style type='text/css'>		".
			"table.sample {					".
			"	border-width: 1px;			".
			"	border-spacing: 5px;		".
			"	border-style: none;		".
			"	border-color: white;			".
			"	border-collapse: separate;	".
			"	background-color: white;	".
			"}								".
			"table.sample th {				".
			"	border-width: 1px;			".
			"	padding: 5px;				".
			"	border-style: solid;		".
			"	border-color: white;			".
			"	background-color: white;	".
			"	-moz-border-radius: 6px 6px 6px 6px;".
			"}								".
			"table.sample td {				".
			"	border-width: 1px;			".
			"	padding: 5px;				".
			"	border-style: solid;		".
			"	border-color: white;			".
			"	background-color: white;	".
//			"	-moz-border-radius: 6px 6px 6px 6px;".
			"}								".
			" prob{border-style:none;border-width:0px;padding: 5px;background-color: red;}".
			"</style>						";*/

//echo sizeof($ABI_ID);
for($i=0;$i<sizeof($ABI_ID);$i++)
{
	if($i>0)
		$sql1 .= " OR ";
		
	$sql1 .= " ABI_ID = '$ABI_ID[$i]'";
}
//echo $sql1;
//echo $ABI_ID[$i] . " ";
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");


//$d=date("d.m.Y H:i ");
//		$hdate="Отчёт сформирован $d";	
/*
$sql = "SELECT LASTNAME, FIRSTNAME, PATRONYMIC, POSTINDEX, PLANAME, ADDRESS
		FROM ABITURIENT a, PLACEOFRESIDENCE r
		WHERE ( $sql1 )
		AND a.PLAID = r.PLAID
		ORDER BY LASTNAME";
*/
$sql = "SELECT LASTNAME, FIRSTNAME, PATRONYMIC, POSTINDEX, null as PLANAME, replace( replace( ADDRESS, POSTINDEX || ',' ),  'Российская Федерация,' ) as address
        FROM ABITURIENT
        WHERE $sql1
        ORDER BY LASTNAME";
		
$cur=ora_do($conn,$sql);

				
			
	//	$col = "#ffffff";
	//	$CON_ID_OLD="netu";
	//	$SPECID_OLD="netu";

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
		
		/*	for ($i=0;$i<ora_numrows($cur);$i++)
			{		
				echo $LASTNAME[$i];
				echo $LASTNAME[$i+1];
				$i++;
				ora_fetch($cur);
			}*/
			//$LASTNAME[3] = 0000;
			//$html .= "<table border='1' cellpadding='5' cellspacing='5' style='empty-cells:hide' width='100%'>";
			//$html .= "<div style='position: absolute; top:120px; left:340px;'><table class='sample' style='empty-cells:hide' width='250px'>";
			for ($i=0;$i<ora_numrows($cur);$i++)
			{	//$num=$num+1;
			//echo '1';
		//echo $LASTNAME[$i]; echo $FIRSTNAME[$i]; echo $PATRONYMIC[$i]; echo $LASTNAME[$i+1]; echo $FIRSTNAME[$i+1]; echo $PATRONYMIC[$i+1];
			//echo $i;
			//if(!(($i)%2 == 0))
			//$html .= "<tr>";
			//$k=$i+1;
			/*if(isset($LASTNAME[$k]))
			{
				$html 	.=	" <tr><td align='left' width='10%' style='table.border'><font size='3'><b>Кому:</td> " .
							" <td align='left' width='40%'><font size='3'>$LASTNAME[$i] $FIRSTNAME[$i] $PATRONYMIC[$i]</font></td> " . 
							" <td width='50px' rowspan='2' style='prob'>&nbsp&nbsp&nbsp&nbsp</td>".
							//" <td align='left'width='10%'><font size='3'><b>Кому:</td> " .
							//" <td align='left' width='40%'><font size='3'>$LASTNAME[$k] $FIRSTNAME[$k] $PATRONYMIC[$k]</font></td> " .
							" <tr><td align='left' width='10%'><font size='3'><b>Куда:</td> " .
							" <td align='left' width='40%'><font size='3'>$POSTINDEX[$i] $PLANAME[$i] $ADDRESS[$i]</font></td> " ;
							//" <td align='left' width='10%'><font size='3'><b>Куда:</td> " .
							//" <td align='left' width='40%'><font size='3'>$POSTINDEX[$k] $PLANAME[$k] $ADDRESS[$k]</font></td> " ;
							//if(!($num==7))
							//$html .= "<tr><td colspan='99' style='prob'>&nbsp</td>";
			}
			else
			{*/
			//if($i==1)
			//{
				$html 	.=	//" <tr><td align='left' width='10%'><font size='3'><b>Кому:</td> " .
							//" <td align='left' width='40%'><font size='3'>$LASTNAME[$i] $FIRSTNAME[$i] $PATRONYMIC[$i] &nbsp&nbsp&nbsp&nbsp</font></td> " . 
							" <div style='position: absolute; top:135px; left:360px; width:200px; background-color:gray; line-height:25px;'><font size='3'>$LASTNAME[$i] $FIRSTNAME[$i] $PATRONYMIC[$i] </font></div> " . 
							//" <tr><td align='left' width='10%'><font size='3'><b>Адрес:</td> " .
							" <div style='position: absolute; top:185px; left:360px; width:200px; background-color:gray; line-height:25px;'><font size='3'>$PLANAME[$i] $ADDRESS[$i]</font></div>".
							" <div style='position: absolute; top:285px; left:340px; width:200px; background-color:gray;'><font size='3'>$POSTINDEX[$i]</font></div>".
							" <div style='position: absolute; top:0px; left:120px; width:200px; background-color:gray;'><font size='6'>091</font></div>";
							//" <tr><td align='left' width='40%'><font size='3'>$POSTINDEX[$i] $PLANAME[$i] $ADDRESS[$i]</font></td>".
							//" <tr><td align='left' width='40%'><font size='3'>$POSTINDEX[$i] $PLANAME[$i] $ADDRESS[$i]</font></td>";
		//	}
			
		//	else
		//	{
			
		///		$html 	.=	"<div style='position: relative; top:13px; left:36px; width:200px; background-color:gray; line-height:25px;'><font size='3'>$LASTNAME[$i] $FIRSTNAME[$i] $PATRONYMIC[$i] </font></div> " . 
		//					" <div style='position: relative; top:18px; left:36px; width:200px; background-color:gray; line-height:25px;'><font size='3'>$PLANAME[$i] $ADDRESS[$i]</font></div>".
		//					" <div style='position: relative; top:28px; left:34px; width:200px; background-color:gray;'><font size='3'>$POSTINDEX[$i]</font></div>";
							
		//	}
			
			//}			
		//if(($num) == 7)
		//{
		//$html .= "</table></center><div style='page-break-before:always'> &nbsp</div><center><table class='sample' style='empty-cells:hide' width='100%'>";
		//$html .= "</table></div><div style='page-break-after:always'> </div><table class='sample' style='empty-cells:hide' width='100px'>";
		//$html .= " 111&nbsp";
		
		//	$i=$i+1;
			ora_fetch($cur);	
			
		}
			/*$html .= "</table>";
			$array = Array();
			$array[0] = 'а';
			$array[1] = 'б';
			$array[2] = 'в';
			$array[3] = 'г';
			$array[4] = 'д';
			$array[5] = 'е';
			$array[6] = 'ж';
			$array[7] = 'з';
			$array[8] = 'и';
			$array[9] = 'к';
			$array[10] = 'л';
			$array[11] = 'м';
			for($i=0;$i<11;$i++)
			{
				$k=$i+1;
				echo "<table>$array[$k]</table>";
			}*/
			
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

//echo "<table border='1' cols='2'><td>1</td><td>2</td><tr><td>3</td><td>4</td></table>";//</tr></table><table border='1'><tr><td>5</td><td>6</td></tr><tr><td>7</td><td>8</td></tr></table>";
	
?>

