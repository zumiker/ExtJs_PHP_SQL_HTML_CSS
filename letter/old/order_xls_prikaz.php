<?php
require_once 'Spreadsheet/Excel/Writer.php';

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('PRIKAZ.xls');
//$workbook->setVersion(8);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('ЕГЭ');
// $worksheet->setOutputEncoding('UTF8');
// The actual data

$worksheet->setMarginRight('0.75');
$worksheet->hideGridlines();

$format =& $workbook->addFormat();
$format->setNumFormat('@');
$format->setHAlign('left');
$format->settextwrap('yes');

$format_bold_l =& $workbook->addFormat();
$format_bold_l->setBold();
$format_bold_l->setHAlign('left');

$format_bold =& $workbook->addFormat();
$format_bold->setBold();
$format_bold->setHAlign('center');

$format_bold_m =& $workbook->addFormat();
$format_bold_m->setBold();
$format_bold_m->setHAlign('center');
//$format_bold_m->setMerge(0, 0, 0, 9); 

$format_underline =& $workbook->addFormat();
$format_underline->setHAlign('center');
$format_underline->setUnderline(1);

$worksheet->setColumn(0,0,5);
$worksheet->setColumn(0,1,62);
$worksheet->setColumn(0,2,5);
$worksheet->setColumn(0,3,13);
include_once('OracleDB.php');
$orderid = $_GET['id'];
$excel = $_GET['excel'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql = "SELECT ORDERNUMBER,TNABOR,TO_CHAR(orderdate,'DD') as day,TO_CHAR(orderdate,'MM') as day  FROM ABI_ORDERS WHERE ORDERID = $orderid";
$cur=ora_do($conn,$sql);
$ORDERNUMBER=ora_getcolumn($cur,0);
$TNABOR=ora_getcolumn($cur,1);
$day=ora_getcolumn($cur,2);
$month=ora_getcolumn($cur,3);
switch($month)				
{
	case 7:
		$month='июля';
		break;
	case 8:
		$month='августа';
		break;		
}


$sql =  'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
	initcap(LASTNAME) || \' \' || initcap(FIRSTNAME) || \' \' || initcap(PATRONYMIC) as NAME, 
	FACNAME  , con.congroup AS CONGR, NEEDHOSTEL, pr.SUMBALL as BALL, con.id_con AS CONID
	FROM abi_orders_man o, abiturient a, abi_spec s, faculty f, abi_prior pr, abi_congroup con
	WHERE  f.FACID=s.FACID AND o.ABI_ID=a.ABI_ID AND pr.CON_ID=con.ID_CON AND a.ABI_ID=pr.abi_id AND pr.nabor='.$TNABOR.' AND pr.SPECID=s.SPCID 
	AND o.ORDERID=' . $orderid . ' and pr.proshel=30 ORDER BY pr.CON_ID, s.SPCNAME, pr.SUMBALL desc';
	
$sql =  'SELECT SPC, 
	initcap(LASTNAME) || \' \' || initcap(FIRSTNAME) || \' \' || initcap(PATRONYMIC) as NAME, 
	FACNAME  , congroup AS CONGR, NEEDHOSTRL as NEEDHOSTEL, BALL, CON_ID
	FROM ABI_REPORT_PRIKAZ 
  	WHERE TNABOR='.$TNABOR.' AND ORDERID=' . $orderid . '  AND PROSHEL=30 ORDER BY CON_ID, BALL desc';
	
if ($TNABOR==3)
	$sql =  'SELECT SPC, 
	initcap(LASTNAME) || \' \' || initcap(FIRSTNAME) || \' \' || initcap(PATRONYMIC) as NAME, 
	FACNAME  , congroup AS CONGR, NEEDHOSTRL as NEEDHOSTEL, BALL, CON_ID
	FROM ABI_REPORT_PRIKAZ 
  	WHERE TNABOR='.$TNABOR.' AND ORDERID=' . $orderid . '  AND PROSHEL=30 ORDER BY CON_ID,SPC, LASTNAME,FIRSTNAME,PATRONYMIC';

$z=0;

$tmp = 'ФЕДЕРАЛЬНОЕ АГЕНТСТВО ПО ОБРАЗОВАНИЮ';
//$worksheet->merge_range( '$z', '0', '$z', '4', $tmp, $format_bold_m ); 
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = 'Государственное образовательное учреждение высшего профессионального образования';
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = 'РОССИЙСКИЙ ГОСУДАРСТВЕННЫЙ УНИВЕРСИТЕТ НЕФТИ И ГАЗА имени И. М. ГУБКИНА';
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = 'П Р И К А З';
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = '"'.$day.'" '.$month.' 2009                      Москва                        № '.$ORDERNUMBER;
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_underline);
/*$tmp ='Москва';
$worksheet->writeString($z, 1, $tmp, $format_underline);
$tmp ='№ 000';
$worksheet->writeString($z, 2, $tmp, $format_underline);*/
$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3); 
$tmp = 'О зачислении в университет';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
$worksheet->setMerge($z, 1, $z, 3);
switch($TNABOR)
{
	case 1:
	$tmp = '       бюджетный набор';
	$comm=0;
	break;
	case 2:
	$tmp = '       целевой набор';
	$comm=0;
	break;
	case 3:
	$tmp = '       внебюджетный набор';
	$comm=0;
	break;
	case 4:
	$tmp = '       коммерческий набор';
	$comm=1;
	break;
	
}
$worksheet->writeString($z, 1, $tmp, $format);$z++;
$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3); 
$tmp = "В соответствии с решением приемной комиссии  от $day $month 2009 года";
$worksheet->writeString($z, 1, $tmp, $format);$z++;
$worksheet->setMerge($z, 1, $z, 3);
$tmp = '(протокол № 3)';
$worksheet->writeString($z, 1, $tmp, $format);$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3);
$tmp = 'ПРИКАЗЫВАЮ:';
$worksheet->writeString($z, 1, $tmp, $format_bold_l);$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3);
switch($TNABOR)
{
	case 1:
	$tmp = 'бюджетной';
	break;
	case 2:
	$tmp = 'целевой';
	break;
	case 3:
	$tmp = 'внебюджетной';
	break;
	case 4:
	$tmp = 'коммерческой';
	break;
	
}
$tmp2 = 'на 1-й курс университета дневного отделения на '.$tmp.' основе зачислить:';
$worksheet->writeString($z, 1, $tmp2, $format);$z++;
$z++; 	
$data = $db -> fetchAll($sql);

$cur_con = '';
$cur_fac = '';
$cur_spc = '';

$counter = 1;

foreach ($data as $row)
{
	if ($row['CONGR'] !== $cur_con)
	{
		$cur_con = $row['CONGR'];
		$cur_con_id = $row['CON_ID'];
		$cur_spc="none";
		$cur_con_num=$cur_con_id -236; 
		//'Конкурсной группе: ' . 
		$tmp=$cur_con;$z++;
		$worksheet->writeString($z, 1, $tmp, $format_bold);$z++;$z++;
		$cur_fac = $row['FACNAME'];
		$cur_fac = strtoupper  ($cur_fac);
		$tmp='Факультет  "' . $cur_fac .'"';
		$worksheet->writeString($z, 1, $tmp, $format_bold);$z++;$z++;
		switch($cur_con_num)
		{
			case 1:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130304 "Геология нефти и газа";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130201 "Геофизические методы поисков и разведки месторождений полезных ископаемых";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130202 "Геофизические методы исследования скважин".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 2:
				$tmp='направления подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130100 "Геология и разведка полезных ископаемых";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='020800 "Экология и природопользование".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 3:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130401 "Физические процессы горного или нефтегазового производства".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 4:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130503 "Разработка и эксплуатация нефтяных и газовых месторождений";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130504 "Бурение нефтяных и газовых скважин".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 5:
				$tmp='направления подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130500 "Нефтегазовое дело".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 6:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130501 "Проектирование, сооружение и эксплуатация газонефтепроводов и газонефтехранилищ";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='150202 "Оборудование и технология сварочного производства".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 7:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130501 "Проектирование, сооружение и эксплуатация газонефтепроводов и газонефтехранилищ" ВУС: 641000 "Эксплуатация и ремонт технических средств службы горючего".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 8:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='150205 "Оборудование и технология повышения износостойкости и восстановления деталей машин и аппаратов";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='151001 "Технология машиностроения";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='200503 "Стандартизация и сертификация";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='280102 "Безопасность технологичеких процессов и производств";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130602 "Машины и оборудование нефтных и газовых промыслов";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130601 "Морские нефтегазовые сооружения";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;			
//				$tmp='130603 "Оборудование нефтегазопереработки".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 9:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='220301 "Автоматизация технологических процессов и производств";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='200106 "Информационно-измерительная техника и технологии";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='140604 "Электропривод и автоматика промышленных установок и технологических комплексов";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='230102 "Автоматизированные системы обработки информации и управления".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 10:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='230401 "Прикладная математика".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 11:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='240401 "Химическая технология органических веществ";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='240403 "Химическая технология природных энергоносителей и углеродных материалов";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='280201 "Охрана окружающей среды и рациональное использование природных ресурсов".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;					
			case 12:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='240403 "Химическая технология природных энергоносителей и углеродных материалов" ВУС 240100 "Организация обеспечения ракетным топливом и горючим".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			
			case 13:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080502 "Экономика и управление на предприятии";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080507 "Менеджмент организации".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 14:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080100 "Экономика";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080500 "Менеджмент".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 15:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='030501 "Юриспруденция".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 16:
				$tmp='направление подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130500 "Нефтегазовое дело".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 17:
				$tmp='направление подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080100 "Экономика"(внебюджетный набор).';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
				 
			
		}
	
			
					
			if($excel!=1)
			{	
				$sql="select s.spccodenew || ' ' || s.spcname as SPC from abi_spec s, abi_con_spec cs where s.spcid=cs.id_spec AND cs.id_con=".$row['CON_ID'];
				$cur=ora_do($conn,$sql);
	 			for ($j=0;$j<ora_numrows($cur);$j++)
	 			{
	 				
	 				$tmp=ora_getcolumn($cur,0);
					
					$worksheet->writeString($z, 1, $tmp, $format);$z++;
					ora_fetch($cur);
					//$counter = 1;
	 			}
	 			$z++;
	 			$tmp='Ф.И.О.';
				$worksheet->writeString($z, 1, $tmp, $format_bold);
				$tmp='Балл';
				if ($TNABOR!=3)
					$worksheet->writeString($z, 2, $tmp, $format_bold);$z++;	
				$counter=1;
			}
		
	}
	if($excel==1)
	{	
		if ($row['SPC'] != $cur_spc)
		{
			
			$cur_spc = $row['SPC'];
			$tmp=$cur_spc;
				$z++;
			$worksheet->writeString($z, 1, $tmp, $format_bold_l);$z++;
				$z++;
				$counter = 1;
				
			$tmp='Ф.И.О.';
			$worksheet->writeString($z, 1, $tmp, $format_bold);
			$tmp='Балл';
			if ($TNABOR!=3)
				$worksheet->writeString($z, 2, $tmp, $format_bold);$z++;	
		}
	}
	/*if ($row['FACNAME'] !== $cur_fac)
	{
		$cur_fac = $row['FACNAME'];
		$tmp='Факультет  "' . $cur_fac .'"';
		$worksheet->writeString($z, 0, $tmp, $format);$z++;
	}
	
	if ($row['SPC'] !== $cur_spc)
	{
		$cur_spc = $row['SPC'];
		$tmp= 'СПЕЦИАЛЬНОСТЬ: ' . $cur_spc ;
		$worksheet->writeString($z, 0, $tmp, $format);$z++;
		$counter = 1;
	}
	*/
	
	$tmp=  $counter;
	$worksheet->write($z, 0, $tmp, $format);
	$tmp= $row['NAME'];//.' '.$row['FIRSTNAME'].' '.$row['PATRONYMIC'];
	$worksheet->writeString($z, 1, $tmp, $format);
	$tmp= $row['BALL'];//.' '.$row['FIRSTNAME'].' '.$row['PATRONYMIC'];
	if ($TNABOR!=3)
		$worksheet->writeString($z, 2, $tmp, $format);
	$tmp= $row['NEEDHOSTEL'];
	switch ($tmp)
	{
		case 1:
			$tmp='c общежитием';
			break;
		default:
			$tmp='';
		 
	}
	if ($TNABOR!=3)
		$worksheet->writeString($z, 3, $tmp, $format);
	/*$tmp= $row['PATRONYMIC'];
	$worksheet->writeString($z, 3, $tmp, $format);*/
	$z++;
	$counter++;
}
$workbook->close();
?>
