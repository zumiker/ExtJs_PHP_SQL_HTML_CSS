<?php
require_once 'Spreadsheet/Excel/Writer.php';

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('PRIKAZ.xls');
//$workbook->setVersion(8);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('���');
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
		$month='����';
		break;
	case 8:
		$month='�������';
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

$tmp = '����������� ��������� �� �����������';
//$worksheet->merge_range( '$z', '0', '$z', '4', $tmp, $format_bold_m ); 
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = '��������������� ��������������� ���������� ������� ����������������� �����������';
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = '���������� ��������������� ����������� ����� � ���� ����� �. �. �������';
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = '� � � � � �';
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_bold_m);$z++;$z++;
$tmp = '"'.$day.'" '.$month.' 2009                      ������                        � '.$ORDERNUMBER;
$worksheet->setMerge($z, 0, $z, 3); 
$worksheet->writeString($z, 0, $tmp, $format_underline);
/*$tmp ='������';
$worksheet->writeString($z, 1, $tmp, $format_underline);
$tmp ='� 000';
$worksheet->writeString($z, 2, $tmp, $format_underline);*/
$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3); 
$tmp = '� ���������� � �����������';
$worksheet->writeString($z, 1, $tmp, $format);$z++;
$worksheet->setMerge($z, 1, $z, 3);
switch($TNABOR)
{
	case 1:
	$tmp = '       ��������� �����';
	$comm=0;
	break;
	case 2:
	$tmp = '       ������� �����';
	$comm=0;
	break;
	case 3:
	$tmp = '       ������������ �����';
	$comm=0;
	break;
	case 4:
	$tmp = '       ������������ �����';
	$comm=1;
	break;
	
}
$worksheet->writeString($z, 1, $tmp, $format);$z++;
$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3); 
$tmp = "� ������������ � �������� �������� ��������  �� $day $month 2009 ����";
$worksheet->writeString($z, 1, $tmp, $format);$z++;
$worksheet->setMerge($z, 1, $z, 3);
$tmp = '(�������� � 3)';
$worksheet->writeString($z, 1, $tmp, $format);$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3);
$tmp = '����������:';
$worksheet->writeString($z, 1, $tmp, $format_bold_l);$z++;$z++;
$worksheet->setMerge($z, 1, $z, 3);
switch($TNABOR)
{
	case 1:
	$tmp = '���������';
	break;
	case 2:
	$tmp = '�������';
	break;
	case 3:
	$tmp = '������������';
	break;
	case 4:
	$tmp = '������������';
	break;
	
}
$tmp2 = '�� 1-� ���� ������������ �������� ��������� �� '.$tmp.' ������ ���������:';
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
		//'���������� ������: ' . 
		$tmp=$cur_con;$z++;
		$worksheet->writeString($z, 1, $tmp, $format_bold);$z++;$z++;
		$cur_fac = $row['FACNAME'];
		$cur_fac = strtoupper  ($cur_fac);
		$tmp='���������  "' . $cur_fac .'"';
		$worksheet->writeString($z, 1, $tmp, $format_bold);$z++;$z++;
		switch($cur_con_num)
		{
			case 1:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130304 "�������� ����� � ����";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130201 "������������� ������ ������� � �������� ������������� �������� ����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130202 "������������� ������ ������������ �������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 2:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130100 "�������� � �������� �������� ����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='020800 "�������� � ������������������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 3:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130401 "���������� �������� ������� ��� ������������� ������������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 4:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130503 "���������� � ������������ �������� � ������� �������������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130504 "������� �������� � ������� �������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 5:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130500 "������������ ����".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 6:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130501 "��������������, ���������� � ������������ ����������������� � �����������������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='150202 "������������ � ���������� ���������� ������������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 7:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130501 "��������������, ���������� � ������������ ����������������� � �����������������" ���: 641000 "������������ � ������ ����������� ������� ������ ��������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;
			case 8:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='150205 "������������ � ���������� ��������� ��������������� � �������������� ������� ����� � ���������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='151001 "���������� ��������������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='200503 "�������������� � ������������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='280102 "������������ �������������� ��������� � �����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130602 "������ � ������������ ������� � ������� ���������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130601 "������� ������������ ����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;			
//				$tmp='130603 "������������ ��������������������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 9:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='220301 "������������� ��������������� ��������� � �����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='200106 "�������������-������������� ������� � ����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='140604 "������������� � ���������� ������������ ��������� � ��������������� ����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='230102 "������������������ ������� ��������� ���������� � ����������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 10:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='230401 "���������� ����������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 11:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='240401 "���������� ���������� ������������ �������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='240403 "���������� ���������� ��������� ��������������� � ���������� ����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='280201 "������ ���������� ����� � ������������ ������������� ��������� ��������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;					
			case 12:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='240403 "���������� ���������� ��������� ��������������� � ���������� ����������" ��� 240100 "����������� ����������� �������� �������� � �������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			
			case 13:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080502 "��������� � ���������� �� �����������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080507 "���������� �����������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 14:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080100 "���������";';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080500 "����������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;		
			case 15:
				$tmp='�������������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='030501 "�������������".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;			
			case 16:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='130500 "������������ ����".';
//				$worksheet->writeString($z, 1, $tmp, $format);$z++;
				break;				
			case 17:
				$tmp='����������� ���������� ����������:';
				$worksheet->writeString($z, 1, $tmp, $format);$z++;
//				$tmp='080100 "���������"(������������ �����).';
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
	 			$tmp='�.�.�.';
				$worksheet->writeString($z, 1, $tmp, $format_bold);
				$tmp='����';
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
				
			$tmp='�.�.�.';
			$worksheet->writeString($z, 1, $tmp, $format_bold);
			$tmp='����';
			if ($TNABOR!=3)
				$worksheet->writeString($z, 2, $tmp, $format_bold);$z++;	
		}
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
	$tmp= $row['NAME'];//.' '.$row['FIRSTNAME'].' '.$row['PATRONYMIC'];
	$worksheet->writeString($z, 1, $tmp, $format);
	$tmp= $row['BALL'];//.' '.$row['FIRSTNAME'].' '.$row['PATRONYMIC'];
	if ($TNABOR!=3)
		$worksheet->writeString($z, 2, $tmp, $format);
	$tmp= $row['NEEDHOSTEL'];
	switch ($tmp)
	{
		case 1:
			$tmp='c ����������';
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
