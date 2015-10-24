<?php
require_once 'Spreadsheet/Excel/Writer.php';

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('PRIKAZ.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('���');

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
	$tmp='�������� ��Ȩ���� �������� ����������� ���������������� ������������ ����� � ���� ����� �.�. ������� �� __.__.____ �. (�������� �__) ������������� � ���������� �� 1-�� ���� ������������ (��������� �����) ��';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}

if($orderid==9995)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'32\' AND a.TNABOR=\'2\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='�������� ��Ȩ���� �������� ����������� ���������������� ������������ ����� � ���� ����� �.�. ������� �� __.__.____ �. (�������� �__) ������������� � ���������� �� 1-�� ���� ������������ (������� �����) ��';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}

if($orderid==9998)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'27\' AND a.TNABOR=\'3\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='�������� ��Ȩ���� �������� ����������� ���������������� ������������ ����� � ���� ����� �.�. ������� �� __.__.____ �. (�������� �__) ������������� � ���������� �� 1-�� ���� ������������ (������������ �����)  ��';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}
if($orderid==9997)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'31\' AND a.TNABOR=\'1\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='������ (������������ �����)  ��';
	$worksheet->writeString($z, 1, $tmp, $format);$z++;
	
}

if($orderid==9996)
{
	$sql = 'SELECT SPCCODENEW || \' \' || SPCNAME as SPC, 
			LASTNAME, FIRSTNAME, PATRONYMIC,  
			FACNAME , CON_ID, NEEDHOSTEL
		FROM abiturient a, abi_spec s, faculty f 
		WHERE  f.FACID=a.FACID  AND a.SPECID=s.SPCID AND a.PROSHEL=\'31\' AND a.TNABOR=\'3\'  ORDER BY a.CON_ID, f.FACID, a.LASTNAME, s.SPCNAME';
	$tmp='������ (������������ �����)  ��';
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
		$tmp='���������� ������: ' . $cur_con;
		$worksheet->writeString($z, 1, $tmp, $format);$z++;$z++;
		$cur_fac = $row['FACNAME'];
		$cur_fac = strtoupper  ($cur_fac);
		$tmp='���������  "' . $cur_fac .'"';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		switch($cur_con)
		{
			case 1:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130304 "�������� ����� � ����";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130201 "������������� ������ ������� � �������� ������������� �������� ����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130202 "������������� ������ ������������ �������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 2:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130100 "�������� � �������� �������� ����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='020800 "�������� � ������������������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 3:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130401 "���������� �������� ������� ��� ������������� ������������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 4:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130503 "���������� � ������������ �������� � ������� �������������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130504 "������� �������� � ������� �������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 5:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130500 "������������ ����".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 6:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130501 "��������������, ���������� � ������������ ����������������� � �����������������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='150202 "������������ � ���������� ���������� ������������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 7:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130501 "��������������, ���������� � ������������ ����������������� � �����������������" ���: 641000 "������������ � ������ ����������� ������� ������ ��������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 8:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='150205 "������������ � ���������� ��������� ��������������� � �������������� ������� ����� � ���������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='151001 "���������� ��������������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='200503 "�������������� � ������������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='280102 "������������ �������������� ��������� � �����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130602 "������ � ������������ ������� � ������� ���������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130601 "������� ������������ ����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;			
				$tmp='130603 "������������ ��������������������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 9:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='220301 "������������� ��������������� ��������� � �����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='200106 "�������������-������������� ������� � ����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='140604 "������������� � ���������� ������������ ��������� � ��������������� ����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='230102 "������������������ ������� ��������� ���������� � ����������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 10:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='230401 "���������� ����������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 11:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='240401 "���������� ���������� ������������ �������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='240403 "���������� ���������� ��������� ��������������� � ���������� ����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='280201 "������ ���������� ����� � ������������ ������������� ��������� ��������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;					
			case 12:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='240403 "���������� ���������� ��������� ��������������� � ���������� ����������" ��� 240100 "����������� ����������� �������� �������� � �������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			
			case 13:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080502 "��������� � ���������� �� �����������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080507 "���������� �����������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 14:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080100 "���������";';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080500 "����������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 15:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='030501 "�������������".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 16:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='130500 "������������ ����".';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 17:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				$tmp='080100 "���������"(������������ �����).';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			
		}
		
		if($orderid==9999||$orderid==9998)
		{
		$z++;
		$tmp='��������� ������������ ����� ������������� ��� ����������� ���������� � ������ ������� �����������:';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		
		}
		if($orderid==9996||$orderid==9997)
		{
		$z++;
		$tmp='��������� � ������ �� ������ ���������� ������ ��������� ������������:';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		
		}
		$z++;
		$tmp='�.�.�.';
		$worksheet->writeString($z, 1, $tmp, $format);$z++;
		$counter = 1;
	}

	/*if ($row['FACNAME'] !== $cur_fac)
	{
		$cur_fac = $row['FACNAME'];
		$tmp='���������  "' . $cur_fac .'"';
		$worksheet->writeString($z, 0, $tmp, $format);$z++;
	}
	
	if ($row['SPC'] !== $cur_spc)
	{
		$cur_spc = $row['SPC'];
		$tmp= '�������������: ' . $cur_spc ;
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
			$tmp='c ����������';
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
