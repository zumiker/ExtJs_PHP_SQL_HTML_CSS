<?
	define('FPDF_FONTPATH','fpdf/font/');
	require_once 'fpdf/lib/pdftable.inc.php';
	include('../lib.php');
/**************************************************************************/
	$grocode=$_REQUEST['grocode'];
	$sql="SELECT initcap(fio) fio 
			from V_SPI_STUDENT_REPORT WHERE  
			GROCODE='$grocode' 
			ORDER BY  TSTID,FIO";
	$cur=array();
	$cur=execq($sql);
//************************************************************************//
	$pdf=new PDFTable('P','pt','A4');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->AddFont('Tahoma','','tahoma.php');
	$pdf->SetFont('Tahoma','',12);
	$pdf->Cell(0,10,DecodeStr('Группа: '.$grocode),0,0,'C');
	$pdf->Ln(20);
	
	//---------table------------------
	
	$html="<br/><table align='center' width='100%' border='1'>";
	$html.="<tr><td align='center' width='50px'>".DecodeStr('№')."</td>";
	$html.="<td align='center'>".DecodeStr('Фамилия Имя Отчество')."</td></tr>";
	for($i=0;$i<count($cur);$i++)
	{
		$html.="<tr><td align='center'>".($i+1)."</td>";
		$html.="<td align='left'>".DecodeStr($cur[$i]['FIO'])."</td></tr>";
	}
	$html.='</table><br/>';
	$pdf->htmltable($html);
	$pdf->Ln(30);
	$rand=rand(1,300);
	$pdf->Output('spisok_'.$rand.'.pdf','D');
?>