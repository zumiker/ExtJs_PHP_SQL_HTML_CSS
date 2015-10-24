<?
	define('FPDF_FONTPATH','fpdf/font/');
	require_once 'fpdf/lib/pdftable.inc.php';
	/**************************************************************************/
	
	include("../xml/connection.php");
	
	//$facid = $_REQUEST['facid'];// id факультета
	$divid = $_REQUEST['divid'];// id факультета
	
	$sql = " select count(manid) from v_spi_prepod where divid = '$divid' and dol_id != 6";
	$cur = execq($sql, false);
	
	//************************************************************************//

	$header = array('№','ФИО','Дата и место рождения','Паспортные данные','Адрес прописки','Средний балл','Наличие рабочей профессии','Наличие допусков к ведению конкретных работ на объекте для данной профессии');
	
	$pdf = new PDFTable('L','pt','A4');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->AddFont('TimesNewRomanPSMT','','times.php');
	$pdf->SetFont('TimesNewRomanPSMT','',12);
	$pdf->Cell(0,10,DecodeStr('НИС'),0,0,'C');
	$pdf->Ln(20);
	$pdf->MultiCell(0,10,DecodeStr('на прохождение '.$couname.' студентов РГУ нефти и газа имени И.М.Губкина'),0,'C');
	$pdf->Ln(5);
	$pdf->MultiCell(0,10,DecodeStr('на/в \''.$companyname.'\' с '.$from.' по '.$till.' года,'),0,'C');
	$pdf->Ln(5);
	$pdf->MultiCell(0,10,DecodeStr('обучающихся на факультете \''.$facname.'\' по специальности(направлению) \''.$spcname.'\'.'),0,'C');
	
	
	$pdf->Ln(30);
	
	//---------table------------------
	
	
	$html = '<table width = "100%" border = "1"  align = "center" cols = "8">';
	$html.= '<tr><td align = "left" valign = "middle" width = "20">'.DecodeStr($header[0]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "120">'.DecodeStr($header[1]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "165">'.DecodeStr($header[2]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "150">'.DecodeStr($header[3]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "115">'.DecodeStr($header[4]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "55">'.DecodeStr($header[5]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "80">'.DecodeStr($header[6]).'</td>';
	$html.= '<td align = "center" valign = "middle" width = "80">'.DecodeStr($header[7]).'</td>';
	$html.= '</tr>';
	
	for($i = 0; $i < count($cur); $i++)
	{
		passport_data($cur[$i]['MANID'],$passport_data);
		$sredball = sred_ball($cur[$i]['MANID']);
		
		$html.= '<tr><td align = "left" valign = "middle">'.($i+1).'</td>';
		$html.= '<td align = "left" valign = "middle">'.DecodeStr($cur[$i]['FIO']).'</td>';
		$html.= '<td align = "left" valign = "middle">'.date('d.m.Y',strtotime($passport_data[0]['MANBIRTHDAY'])).'<br/>'.DecodeStr($passport_data[0]['MANBIRTHPLACE']).'</td>';
		$html.= '<td align = "left" valign = "middle">'.DecodeStr('Серия,№: '.$passport_data[0]['MANPASNUMBER']).'<br/>'.DecodeStr('Выдан: ').DecodeStr($passport_data[0]['MANPASPLACE']).' <br/>'.DecodeStr('Когда: ').date('d.m.Y',strtotime($passport_data[0]['MANPASDATE'])).' </td>';
		$html.= '<td align = "left" valign = "middle">'.DecodeStr($passport_data[0]['MARESIDENCE']).'</td>';
		$html.= '<td align = "center" valign = "middle">'.$sredball.'</td>';
		$html.= '<td align = "left" valign = "middle"></td>';
		$html.= '<td align = "left" valign = "middle"></td>';
		$html.= '</tr>';
	}
	$html.= '</table>';
	$pdf->htmltable($html);
	
	$pdf->Ln(30);
	$pdf->Cell(0,10,DecodeStr('Руководитель практики _________________________________'),0,0,'L');

	
	
	/*--------------------------------*/
	$rand = rand(1,300);
	$pdf->Output('contract_'.$rand.'.pdf','D');
	
?>