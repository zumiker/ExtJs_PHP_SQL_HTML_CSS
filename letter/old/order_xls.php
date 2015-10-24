<?php
require_once 'Spreadsheet/Excel/Writer.php';

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('PRIKAZ.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('ЕГЭ');

// The actual data
$format =& $workbook->addFormat();
$format->setNumFormat('@');

$format->setHAlign('left');
$worksheet->setColumn(0,0,10);
$worksheet->setColumn(0,1,70);
$worksheet->setColumn(0,2,20);
$worksheet->setColumn(0,3,20);
include_once('OracleDB.php');
$orderid = $_GET['id'];
$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , pr.CON_ID, NEEDHOSTEL
		FROM abi_orders_man o, abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID AND o.ABI_ID=a.ABI_ID AND a.SPECID=s.SPCID AND o.ORDERID=' . $orderid . ' ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';

		
$z=0;

if($orderid==9999)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'29\' AND a.TNABOR=\'1\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='РЕШЕНИЕМ ПРИЁМНОЙ КОМИССИИ РОССИЙСКОГО ГОСУДАРСТВЕННОГО УНИВЕРСИТЕТА НЕФТИ И ГАЗА ИМЕНИ И.М. ГУБКИНА от __.__.____ г. (протокол №__) РЕКОМЕНДОВАТЬ К ЗАЧИСЛЕНИЮ НА 1-ый КУРС УНИВЕРСИТЕТА (БЮДЖЕТНЫЙ НАБОР) ПО';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}

if($orderid==9995)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'32\' AND a.TNABOR=\'2\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='РЕШЕНИЕМ ПРИЁМНОЙ КОМИССИИ РОССИЙСКОГО ГОСУДАРСТВЕННОГО УНИВЕРСИТЕТА НЕФТИ И ГАЗА ИМЕНИ И.М. ГУБКИНА от __.__.____ г. (протокол №__) РЕКОМЕНДОВАТЬ К ЗАЧИСЛЕНИЮ НА 1-ый КУРС УНИВЕРСИТЕТА (ЦЕЛЕВОЙ НАБОР) ПО';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}

if($orderid==9998)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'27\' AND a.TNABOR=\'3\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='РЕШЕНИЕМ ПРИЁМНОЙ КОМИССИИ РОССИЙСКОГО ГОСУДАРСТВЕННОГО УНИВЕРСИТЕТА НЕФТИ И ГАЗА ИМЕНИ И.М. ГУБКИНА от __.__.____ г. (протокол №__) РЕКОМЕНДОВАТЬ К ЗАЧИСЛЕНИЮ НА 1-ый КУРС УНИВЕРСИТЕТА (КОММЕРЧЕСКИЙ НАБОР)  ПО';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}
if($orderid==9997)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'31\' AND a.TNABOR=\'1\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='РЕЗЕРВ (КОММЕРЧЕСКИЙ НАБОР)  ПО';
	$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}

if($orderid==9996)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'31\' AND a.TNABOR=\'3\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='РЕЗЕРВ (КОММЕРЧЕСКИЙ НАБОР)  ПО';
	$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}					
$data = $db -> fetchAll($sql);
$cur_con = '';
$cur_fac = '';
$cur_spc = '';

$counter = 1;

foreach ($data as $row)
{
	if ($row['CON_ID'] !== $cur_con)
	{
		$cur_con = $row['CON_ID'];
		$tmp='Конкурсной группе: ' . $cur_con;
		$worksheet->writeString($z, 1, $tmp, $format);$z++;$z++;
		$cur_fac = $row['FACNAME'];
		$cur_fac = strtoupper  ($cur_fac);
		$tmp='Факультет  "' . $cur_fac .'"';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		switch($cur_con)
		{
			case 1:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130304 "Геология нефти и газа";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130201 "Геофизические методы поисков и разведки месторождений полезных ископаемых";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130202 "Геофизические методы исследования скважин".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 2:
				$tmp='направления подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130100 "Геология и разведка полезных ископаемых";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='020800 "Экология и природопользование".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 3:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130401 "Физические процессы горного или нефтегазового производства".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 4:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130503 "Разработка и эксплуатация нефтяных и газовых месторождений";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130504 "Бурение нефтяных и газовых скважин".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 5:
				$tmp='направления подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130500 "Нефтегазовое дело".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 6:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130501 "Проектирование, сооружение и эксплуатация газонефтепроводов и газонефтехранилищ";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='150202 "Оборудование и технология сварочного производства".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 7:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130501 "Проектирование, сооружение и эксплуатация газонефтепроводов и газонефтехранилищ" ВУС: 641000 "Эксплуатация и ремонт технических средств службы горючего".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 8:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='150205 "Оборудование и технология повышения износостойкости и восстановления деталей машин и аппаратов";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='151001 "Технология машиностроения";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='200503 "Стандартизация и сертификация";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='280102 "Безопасность технологичеких процессов и производств";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130602 "Машины и оборудование нефтных и газовых промыслов";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130601 "Морские нефтегазовые сооружения";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;			
				$tmp='130603 "Оборудование нефтегазопереработки".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 9:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='220301 "Автоматизация технологических процессов и производств";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='200106 "Информационно-измерительная техника и технологии";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='140604 "Электропривод и автоматика промышленных установок и технологических комплексов";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='230102 "Автоматизированные системы обработки информации и управления".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 10:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='230401 "Прикладная математика".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 11:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='240401 "Химическая технология органических веществ";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='240403 "Химическая технология природных энергоносителей и углеродных материалов";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='280201 "Охрана окружающей среды и рациональное использование природных ресурсов".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;					
			case 12:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='240403 "Химическая технология природных энергоносителей и углеродных материалов" ВУС 240100 "Организация обеспечения ракетным топливом и горючим".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			
			case 13:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080502 "Экономика и управление на предприятии";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080507 "Менеджмент организации".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 14:
				$tmp='специальности:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080100 "Экономика";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080500 "Менеджмент".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 15:
				$tmp='специальность:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='030501 "Юриспруденция".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 16:
				$tmp='направление подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130500 "Нефтегазовое дело".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 17:
				$tmp='направление подготовки бакалавров:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080100 "Экономика"(внебюджетный набор).';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			
		}
		
		if($orderid==9999||$orderid==9998)
		{
		$z++;
		$tmp='СЛЕДУЮЩИХ АБИТУРИЕНТОВ ПОСЛЕ ПРЕДСТАВЛЕНИЯ ИМИ ПОДЛИННИКОВ ДОКУМЕНТОВ О ПОЛНОМ СРЕДНЕМ ОБРАЗОВАНИИ:';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		
		}
		if($orderid==9996||$orderid==9997)
		{
		$z++;
		$tmp='ЗАЧИСЛИТЬ В РЕЗЕРВ ПО ДАННОЙ КОНКУРСНОЙ ГРУППЕ СЛЕДУЮЩИХ АБИТУРИЕНТОВ:';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		
		}
		$z++;
		$tmp='Ф.И.О.';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		$counter = 1;
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
	$tmp= $row['LASTNAME'].' '.$row['FIRSTNAME'].' '.$row['PATRONYMIC'];
	$worksheet->writeString($z, 1, $tmp, $format);
	$tmp= $row['NEEDHOSTEL'];
	switch ($tmp)
	{
		case 1:
			$tmp='c общежитием';
			break;
		default:
			$tmp='';
		 
	}
	$worksheet->writeString($z, 2, $tmp, $format);
	/*$tmp= $row['PATRONYMIC'];
	$worksheet->writeString($z, 3, $tmp, $format);*/
	$z++;
	$counter++;
}
$workbook->close();
?>
