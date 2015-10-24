<?
header("Content-Type: text/html; charset=utf-8");

require_once('../include.php');
$time= strtotime(date('d.m.Y H.i.s'));
//$years=$_GET['value1'];
//$semestr=$_GET['value2'];
//$divid=$_GET['value3'];
$divid=$_REQUEST['divid'];
$studyid=$_REQUEST['studyid'];
$direct = $_REQUEST['direct'];
$GUID = $_REQUEST['GUID'];
//$divid	= 142;
//$studyid= 40;

$sql = "select upper(kaf) kaf
			from v_spi_kafedr
			where divid = $divid";
$cur = array();
$cur = execq($sql);

$nazv= $cur[0]['KAF'];
$sql = "select to_char( sysdate, 'dd.mm.yyyy' ) as data
			from dual";
$cur = execq($sql);
$sysdate=  $cur[0]['DATA'];
$cur = 0;

$sql = "SELECT DISTINCT studyid,
    (periodname|| ' ' || TYPENAME || ' ' || YEARNAME) as study,
    YEARNAME, periodname
    from V_STUDY
    where (ARHIV=0 or ARHIV=2) and studyid = $studyid
    order by YEARNAME desc,  periodname";
$cur = array();
$cur = execq($sql);
$yearname =  $cur[0]['YEARNAME'];
$periodname =  $cur[0]['PERIODNAME'];

define('FPDF_FONTPATH','/var/www/fpdf/font/');
require_once( "/var/www/fpdf/lib/pdftable.inc.php" );

$html = <<<EOD
<table border='0' width='100%'>
<tr>
<td colspan='4' align="center">
			<font size="11" style="bold">
		 Российский государственный университет нефти и газа имени И.М. Губкина
		</font>
		</td></tr>
<tr>
<td colspan='4' align="center">		
			<font size="14" style="bold"> <br>
		Выписка из семестрового учебного плана
		</font>
		</td></tr>
<tr>
<td colspan='4' align="center">		
	<font size="12"  style="bold"> <br>
	    для кафедры $nazv </font>
	    </td></tr>
<tr>
<td width='30%'></td>
<td align="right" width='30%'> <br> Учебный год: <font style="bold">&nbsp; {$yearname} </font></td>
<td align="left" width='30%'> <br> Семестр: <font style="bold">&nbsp; {$periodname} </font> </td>
<td align="right" width='35%'> <br>Дата формирования отчета: <font>&nbsp; {$sysdate} </font></td>
</tr>
</table>
EOD;

$sql = "begin
			form_nagruzka( $divid, $studyid, 1 );
		end;";
execq( $sql );

//$sql = "SELECT DISTINCT FACNAME FROM NAGRUZKA WHERE DIVID = $divid AND SPRING_AUTUMN ='$semestr' AND YEAR_GROCODE = '$years'";
$sql = "SELECT DISTINCT FACNAME, FACID
		FROM temp_nagruzka_main order by FACID";
$curF = array();
$curF = execq($sql);

foreach ($curF as $i =>$data)
{
$html .=<<<EOD
<table valign='middle' border='0' width='100%'>
<tr><td align='center'>	
</td></tr>
</table>


<table border='1' width='100%'>
<tr bgcolor="#F0FFFF">
<td colspan='15' align='center' > <font size="11" style="bold"> Факультет: {$data['FACNAME']} <br>
</font> </td>
</tr>
<tr bgcolor="#fffff5">
<td align='center' rowspan='3' valign='middle' >Шифр <br>группы</td>
<td align='center' rowspan='3' valign='middle'>Число <br>студ.</td>
<td align='center' rowspan='3' valign='middle'>Часов в <br>семестре</td>
<td align='center' colspan='6' valign='middle'>Из них</td>
<td align='center' rowspan='3' valign='middle'>Кол-во <br>недель</td>
<td align='center' rowspan='3' valign='middle' width='22%'>Продолж. <br>сем</td>
<td align='center' rowspan='3' valign='middle' width='9%'>Экз.</td>
<td align='center' rowspan='3' valign='middle' width='9%'>Зач.</td>
<td align='center' rowspan='3' valign='middle' width='9%'>КР <br>КП</td>
<td align='center' rowspan='3' valign='middle' width='120%'> Название дисциплины</td>

</tr>
<tr bgcolor="#F0FFFF">

<td align='center' colspan='2' align='center' ><b>Лекции</b></td>
<td align='center' colspan='2' align='center' ><b>Лаб.</b></td>
<td align='center' colspan='2' align='center' ><b>Практ.</b></td>

 </tr>	
<tr bgcolor="#fffff5">

<td align='center' width='2%'><b>в<br>нед</b></td>
<td align='center' width='2%'><b>в<br>сем</b></td>
<td align='center' width='2%'><b>в<br>нед</b></td>
<td align='center' width='2%'><b>в<br>сем</b></td>
<td align='center' width='2%'><b>в<br>нед</b></td>
<td align='center' width='2%'><b>в<br>сем</b></td>
 </tr>
EOD;

$fac = $data['FACNAME'];
/*$sql = "SELECT DISTINCT GROCODE
		FROM NAGRUZKA
		WHERE DIVID = $divid
			AND SPRING_AUTUMN ='$semestr'
			AND YEAR_GROCODE = '$years'
			AND FACNAME = '$fac'
		ORDER BY GROCODE";*/
$sql = "SELECT DISTINCT GROCODE, QUAID
		FROM temp_nagruzka_main WHERE FACNAME = '$fac' ORDER BY QUAID, GROCODE";
$curG = array();
$curG = execq($sql);


foreach ($curG as $i =>$data)
{	
	$grocode = $data['GROCODE'];
/*	$sql = "SELECT GROCODE, KOLVO, LEC, SEM, LAB,KOLWEEKS, SROK, EXAM, ZACH, PROEKT, PREDMET, VSEGO
			FROM NAGRUZKA
			WHERE DIVID = $divid
				AND SPRING_AUTUMN ='$semestr'
				AND YEAR_GROCODE = '$years'
				AND FACNAME = '$fac'
				AND GROCODE = '$grocode'";*/
	$sql = "SELECT GROCODE, KOLVO, LEC, SEM, LAB,KOLWEEKS, SROK, EXAM, ZACH, PROEKT, PREDMET, VSEGO, LEC_UREZ, SEM_UREZ, LAB_UREZ, QUAID
			FROM temp_nagruzka_main WHERE FACNAME = '$fac'
				AND GROCODE = '$grocode'";
	$cur = array();
	$cur = execq($sql);
	foreach ($cur as $i =>$data)
	{	
	  if ($data['QUAID'] == 3)
	  {
	  	$lec = '';
	  	$sem = '';
	  	$lab = '';
	  	$lec_sem = $data['LEC_UREZ'];
	  	$sem_sem = $data['SEM_UREZ'];
	  	$lab_sem = $data['LAB_UREZ'];
	  	if ($lec_sem == 0) $lec_sem= ' ';
	  	if ($sem_sem == 0) $sem_sem = ' ';
	  	if ($lab_sem == 0) $lab_sem= ' ';
	    $chasov_sem = $lec_sem + $sem_sem + $lab_sem;	
	  }
	  else
	  {
	  	$lec_sem = $data['LEC']*$data['KOLWEEKS'];
	    $sem_sem = $data['SEM']*$data['KOLWEEKS'];
	    $lab_sem = $data['LAB']*$data['KOLWEEKS'];
	    $chasov_sem = $data['VSEGO']*$data['KOLWEEKS'];
	    if ($data['LEC'] == 0) $data['LEC']= ' ';
	    if ($lec_sem == 0) $lec_sem= ' ';
	    $lec = $data['LEC'];
	    if ($data['SEM'] == 0) $data['SEM']= ' ';
	    if ($sem_sem == 0) $sem_sem = ' ';
	    $sem = $data['SEM'];
	    if ($data['LAB'] == 0) $data['LAB']= ' ';
	    if ($lab_sem == 0) $lab_sem= ' ';
	    $lab = $data['LAB'];
	  };

	  $html .=<<<EOD
	  <tr>
		<td align='center'> {$data['GROCODE']} </td>
		<td align='center'> {$data['KOLVO']} </td>
		<td align='center'> {$chasov_sem} </td>
		<td align='center'> {$lec} </td>
		<td align='center'> {$lec_sem} </td>
		<td align='center'> {$lab} </td>
		<td align='center'> {$lab_sem} </td>
		<td align='center'> {$sem} </td>
		<td align='center'> {$sem_sem} </td>
		<td align='center'> {$data['KOLWEEKS']} </td>
		<td align='center'> {$data['SROK']} </td>
		<td align='center'> {$data['EXAM']} </td>
		<td align='center'> {$data['ZACH']} </td>
		<td align='center'> {$data['PROEKT']} </td>
		<td> {$data['PREDMET']}</td>
	  </tr>
EOD;

		//logstring(print_r($data['ZACH'],true));
	}
}
}
    $p = new PDFTable('L');
    $p->AliasNbPages();
  $p->AddFont('TimesNewRomanPSMT','','times.php');
  $p->AddFont('TimesNewRomanPSMT','B','times_b.php');
  $p->setfont('TimesNewRomanPSMT','',10);
    $p->SetMargins(10, 10, 10);
    $p->AddPage();
    $p->htmltable(iconv('UTF-8','windows-1251',$html));
    $p->output("Выписка из семестрового плана$time.pdf",'D');
  //$main_string =  $p->Output('отчет_'.md5(microtime(true)).'.pdf','S');
  //file_put_contents($direct.$GUID.".pdf", $main_string);
?>