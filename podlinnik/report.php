<?php
	function ora_getcolumnnbsp($cur,$pos)
	{
		if (ora_getcolumn($cur,$pos)==' ') return " "; 
		else return ora_getcolumn($cur,$pos);
	}
	/*define('FPDF_FONTPATH','font/');
		require('lib/pdftable.inc.php');
		$p = new PDFTable();
		$p->AliasNbPages();  
		//$p->AddPage('L');
		$p->AddFont('TimesNewRomanPSMT','','times.php');  
		$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
		$p->SetFont('TimesNewRomanPSMT','',10);*/
	if(isset($_GET['pdf']))
	{
		$pdf=$_GET['pdf'];
	}

/*	if($pdf==1)
	{
		define('FPDF_FONTPATH','font/');
		require('lib/pdftable.inc.php');
		$p = new PDFTable();
/*		$p->AliasNbPages();  
		$p->AddPage('L');
		$p->AddFont('TimesNewRomanPSMT','','times.php');  
		$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
		$p->SetFont('TimesNewRomanPSMT','',10);
//	}
*/
	$header_date='';
	if(isset($_GET['start']))
	{
		$start=$_GET['start'];
		if(strlen($start)!=0)
		{
			$sql2="AND DATE_IN LIKE TO_DATE('$start', 'dd.mm.yyyy')";
			$header_date="$start.";
//			$header_date="���������� �� ���� $start.";
		}
		if(isset($_GET['end']))
		{
			$end=$_GET['end'];
			if(strlen($end)!=0)
			{
				$sql2=" AND DATE_IN >= TO_DATE('$start', 'dd.mm.yyyy') AND DATE_IN <= TO_DATE('$end', 'dd.mm.yyyy')+1 ";
				$header_date="� $start �� $end.";
//				$header_date="���������� �� ������ � $start �� $end.";
			}
		}
	}
/*	else
	{
//		$start=$_GET['start'];
		$qwe = date("d.m.Y");
//		if(strlen($start)!=0)
	//	{
			$sql2="AND DATE_IN LIKE TO_DATE($qwe, 'dd.mm.yyyy')";
//			$header_date=$qwe;
//		}
	}*/
	if(isset($_GET['nabor']))
	{
		$nab = $_GET['nabor'];
		$sql3=" AND NABOR='$nab'";
		if($nab=='1')			$sql3=" AND NABOR IN (1,4,8,10)";
		if($nab=='3')			$sql3=" AND NABOR IN (3,4,8,10)";
		if($nab=='undefined')	$sql3=" AND NABOR IN (1,3,4,8,10)";
		/*if($id_con=='253')
		{
			$sql3=" AND TNABOR='$nab'";
			if($nab=='1')			$sql3=" AND TNABOR IN (1,4,8)";
			if($nab=='3')			$sql3=" AND TNABOR IN (3,4,8)";
			if($nab=='undefined')	$sql3=" AND TNABOR IN (1,3,4,8)";
		}*/
	}
	if(isset($_GET['id_fac']))
	{
		$id_fac=$_GET['id_fac'];
		$sql1="FACID='$id_fac' ";
	}
	if(isset($_GET['id_spec']))
	{
		$id_spec=$_GET['id_spec'];
		$sql1="SPECID='$id_spec' ";
	}
	if(isset($_GET['id_con']))
	{
		$id_con=$_GET['id_con'];
		$sql1="CON_ID='$id_con' ";
	}
	if(isset($_GET['sort']))
	{
		$sort=$_GET['sort'];
	}
	
	if(isset($_GET['sort1']))
	{
		$sort1 = $_GET['sort1'];
		$sql4=" SORT1='$sort1'";
		if($sort1=='1')			$sql4=" ABI_ID";
		if($sort1=='2')			$sql4=" LASTNAME";
		if($sort1=='3')			$sql4=" PRIORITET, LASTNAME ";
		if($sort1=='4')			$sql4=" ABI_NUMBER";
		if($sort1=='5')			$sql4=" TO_CHAR(BIRTHDAY,'yyyy.mm.dd')";
		
	}
/*	switch($sort)
	{
		case 1:
		$sorted="CONGROUP, SPECID, MUSOR, ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC";
		break;
		
		case 2:
		$sorted="CONGROUP, SPECID, MUSOR, LASTNAME, FIRSTNAME, PATRONYMIC, ABI_NUMBER ";
		break;
		
		case 3:
		$sorted="LASTNAME, FIRSTNAME, PATRONYMIC";
		break;
		
		default:
		$sorted="CONGROUP, SPECID, MUSOR, LASTNAME, FIRSTNAME";
		break;
	};*/
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
	/*if ($id_fac=='9')
		$sql="SELECT DISTINCT " .
				"FAC, " .
				"CONGROUP, " .
				"ABI_NUMBER, " .
				"LASTNAME, FIRSTNAME, PATRONYMIC, " .
				"SEX, TO_CHAR(BIRTHDAY, 'dd.mm.yyyy'), PASNUMBER, HOST, FACID, CON_ID," .
				"SPECID, TNABOR, MUSOR, PRIORITET, TCENAME, EDUDOCUMENT, DOCUMENT, EDUDOCUMENTNUMBER, " .
				"DOC, SIROTAID, ABITUR, AWARD, TAWNAME, DATE_IN, ABI_ID, SPCBRIFE, NN" .
				" FROM ABIVIEW_MAGISTR" .
				" WHERE $sql1 $sql2 $sql3 ORDER BY $sql4";
	else*/
		$sql="SELECT DISTINCT
				FAC, CONGROUP, ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, SEX, TO_CHAR(BIRTHDAY, 'dd.mm.yyyy'), PASNUMBER,
				HOST, FACID, CON_ID, SPECID, NABOR, MUSOR, PRIORITET, TCENAME, EDUDOCUMENT, DOCUMENT, EDUDOCUMENTNUMBER, DOC,
				SIROTAID, ABITUR, AWARD, TAWNAME, DATE_IN, ABI_ID, SPCBRIFE, NN, PHONE, PHONE2, EDUFINISH, POSTINDEX, ADDRESS,
				STAID, STANAME
				FROM ABIVIEW_AMBAR
				WHERE $sql1 $sql2 $sql3 AND PRIORITET in (1,4,7) ORDER BY $sql4";
 
	$d=date("d.m.Y H:i ");
//	$hdate="����� ����������� $d";
//	echo $sqlbal;
			#$p->AliasNbPages()
			#$p->AddPage('L');
	$html .= //"<center><h2>�������� ������<br/>$header_date<br/></h2>$hdate<br/><br/></center>".
			"<table border='1' " .
			"style='" .
			"text-align:center; " .
			"font-family: " .
			"Verdana; " .
			"font-size: 10px;' CELLPADDING='5'>";
//	$html .= "<tr><td colspan='99'><center><h2>�������� ������<br/>$header_date<br/></h2>$hdate<br/><br/></center></td></tr>"; 	
	$s1 .= 	"<tr>" .
			"<td family='TimesNewRomanPS-BoldMT' rowspan='2' align='center' valign='middle' width='7' size='8'><b>�</td>" .
			"<td align='center' valign='middle' width='15'><b>� <br/>�.�.</td>" .
			"<td align='center' valign='middle' width='80'><b>���</td>" .
			"<td align='center' valign='middle' width='9'><b>���</td>" .
			"<td align='center' valign='middle' width='12'><b>�����/</br>����-<br/>�����</td>" .
			"<td align='center' valign='middle' width='12'><b>�����.</td>" .
			"<td align='center' valign='middle' width='14'><b>������/</br>������.</td>" .
			"<td align='center' valign='middle' width='11'><b>���<br/>�����<br/>��</td>" .
			"<td align='center' valign='middle' width='16'><b>��������<br/>���/����</td>" .
			"<td align='center' valign='middle'><b>�������<br/>���-�</td>" .
//			"<td align='center' valign='middle'><b>������ ��<br/>���/<br/>����.</td>" .
			"<td align='center' valign='middle'><b>������ ��<br/>����.</td>" .
			"<td colspan='2' align='center' valign='middle'><b>���� ����.</td>" .
			"<td align='center' valign='middle'><b>�������<br/>(�����<br/>�����)</td></tr>" .
			"<tr><td colspan='8' align='center' valign='middle'><b>�����</td>" .
			"<td align='center' valign='middle' width='19'><b>������� 1</td>" .
			"<td align='center' valign='middle' width='18'><b>������� 2</td>" .
			"<td align='center' valign='middle' width='10'><b>���. ����<br>���.</td>" .
			"<td align='center' valign='middle' width='10'><b>���-� �����.</td>" .
			"<td align='center' valign='middle'><b>����.</td></tr>";

	$col = "#ffffff";
	$CON_ID_OLD="netu";
	$SPECID_OLD="netu";
	$cur=ora_do($conn,$sql);

	for ($i=0;$i<ora_numrows($cur);$i++)
	{
//		$pdf=pdf_begin_page;
//		pdf_begin_page (int pdf object, float width, float height)
		$num=++$num;
		
		$FAC = ora_getcolumnnbsp($cur,0);
		$CONGROUP = ora_getcolumnnbsp($cur,1);
		$ABI_NUMBER = ora_getcolumnnbsp($cur,2);
		$LASTNAME = ora_getcolumnnbsp($cur,3);
		$FIRSTNAME = ora_getcolumnnbsp($cur,4);
		$PATRONYMIC = ora_getcolumnnbsp($cur,5);
		$SEX = ora_getcolumnnbsp($cur,6);
		$BIRTHDAY = ora_getcolumnnbsp($cur,7);
		$PASNUMBER = ora_getcolumnnbsp($cur,8);
		$HOST = ora_getcolumnnbsp($cur,9);
		$FACID = ora_getcolumnnbsp($cur,10);
		$CON_ID= ora_getcolumnnbsp($cur,11);
		$SPECID = ora_getcolumnnbsp($cur,12);
		$TNABOR = ora_getcolumnnbsp($cur,13);
		$MUSOR = ora_getcolumnnbsp($cur,14);
		$PRIORITET = ora_getcolumnnbsp($cur,15);
		$TCENAME = ora_getcolumnnbsp($cur,16);
		$EDUDOCUMENT = ora_getcolumnnbsp($cur,17);
		$DOCUMENT = ora_getcolumnnbsp($cur,18);
		$EDUDOCUMENTNUMBER = ora_getcolumnnbsp($cur,19);
		$DOC = ora_getcolumnnbsp($cur,20);
		$SIROTAID = ora_getcolumnnbsp($cur,21);
		$ABITUR = ora_getcolumnnbsp($cur,22);
		$AWARD = ora_getcolumnnbsp($cur,23);
		$TAWNAME= ora_getcolumnnbsp($cur,24);
		$DATE_IN= ora_getcolumnnbsp($cur,25);
		$ABI_ID= ora_getcolumnnbsp($cur,26);
		$SPCBRIFE = ora_getcolumnnbsp($cur,27);
		$NN = ora_getcolumnnbsp($cur,28);
		//if(!($id_fac=='9'))
		//{
			$PHONE = ora_getcolumnnbsp($cur,29);
			$PHONE2 = ora_getcolumnnbsp($cur,30);
			$EDUFINISH = ora_getcolumnnbsp($cur,31);
			$POSTINDEX = ora_getcolumnnbsp($cur,32);
			$ADDRESS = ora_getcolumnnbsp($cur,33);
			$STAID = ora_getcolumnnbsp($cur,34);
			$STANAME = ora_getcolumnnbsp($cur,35);
		//}
		
//		$PP = ora_getcolumnnbsp($cur1,0);
		if( $SPECID_OLD != $SPECID )
		{
/*			$tmp = "<b>$CONGROUP <br/>���������: $FAC <br/>�������������: $SPCBRIFE</b>";
			$html.= "<tr><td colspan='99' >$tmp</td></tr>";
			$html.=$s1;*/
			$konec = 0;
			$num = 1;
			$SPECID_OLD = $SPECID;	
//			$p->AddPage('L');
		}	
		if( /*( $i ) && */( !(($i)%5) ) )
		{
//			$p->htmltable($html);
//			$p->output('','I');	
//			$p->AliasNbPages()
			//$p->AddPage('L');
//			$p->SetAutoPageBreak(0);
			$html .= "<tr><td colspan='99' size='8'>������ ������������, �������� ��������� $header_date" .
						"<br/>���������: $FAC" .
//"                                                                                                                                              $d" .
						"<br/>$CONGROUP" .
						"<br/>�������������: $SPCBRIFE</b></td></tr>"; 	
//						"<br/>$header_date<br/></h2>$hdate<br/><br/></center></td></tr>"; 	
//			$tmp = "<b>$CONGROUP <br/>���������: $FAC <br/>�������������: $SPCBRIFE</b>";
//			$html.= "<tr><td colspan='99' >$tmp</td></tr>";
			$html.=$s1;
			$SPECID_OLD=$SPECID;	
			$col = "#ffffff";
		}
		if ($col=='#ffffff')
		{
			$col='#dddddd';
		}
		else
		{
			$col='#ffffff';
		}
		$k=$i;
		$k=$k+1;
		$html .= "<tr bgcolor='$col'>" .
					"<td rowspan='2' align='center' valign='middle' size='10'>$k</td>" .
					//"<td rowspan='2' align='center' valign='middle' size='10'>$num</td>" .
					"<td align='center' valign='middle' height='12'>$ABI_NUMBER</td>" .
					"<td align='left' valign='middle' size='8'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>" .
					"<td align='center' valign='middle' size='8'>$SEX</td>" .
					"<td align='center' valign='middle' size='8'>$MUSOR/$PRIORITET</td>" .
					"<td align='center' valign='middle' size='8'>$HOST</td>";
		if ( !$TAWNAME && !$ABITUR )
			$html .= "<td align='center'></td>";
		else
			$html .= "<td align='center' valign='middle' size='8'>$TAWNAME/<br/>$ABITUR</td>";
		$html .= "<td align='center' valign='middle' size='8'>$EDUFINISH</td>" .
					"<td align='center' valign='middle' size='8'>$DOCUMENT/$DOC</td>";
//		$sqlpr="SELECT DISTINCT a.ID_PR, a.PREDMET, BAL, r.ID_PR, a.SPECID, r.ID_SPEC FROM ABI_BAL a, ABIVIEW_RASPISANIE r WHERE ABI_ID='$ABI_ID' AND CON_ID=$CON_ID AND a.ID_PR=r.ID_PR AND a.SPECID=r.ID_SPEC ORDER BY a.ID_PR";
		$sqlpr="SELECT DISTINCT a.ID_PR, a.PREDMET, BALL100, r.ID_PR FROM ABI_MINI_EXAM a, ABIVIEW_RASPISANIE r WHERE ABI_ID='$ABI_ID' AND CON_ID=$CON_ID AND a.ID_PR=r.ID_PR ORDER BY a.ID_PR";
		$cur2 = ora_do($conn,$sqlpr);
		$tmp="";
		//������ �� ���
		for ($k=0;$k<ora_numrows($cur2);$k++)
		{
			$ID_PR = ora_getcolumn($cur2,0);
			$PREDMET = ora_getcolumn($cur2,1);
			$PREDMET = substr($PREDMET ,0, 1);
			$BALL=ora_getcolumn($cur2,2);	
			$tmp .="$PREDMET($BALL) ";
			ora_fetch($cur2);
		}
		$html .= "<td align='center'>$tmp</td>";
		//���������� �������� ���
/*		$sqlpr1="SELECT PP FROM ABI_MINI_NAEGE WHERE ABI_ID='$ABI_ID' ORDER BY ID_PR";
		$cur3 = ora_do($conn,$sqlpr1);
		$tmp1="";
		for ($k=0;$k<ora_numrows($cur3);$k++)
		{
			$PP = ora_getcolumn($cur3,0);
			$tmp1 .="$PP ";
			ora_fetch($cur3);
		}*/
		//���������� ������������ ��������
//		$sqlpr2="SELECT PP FROM ABI09_TRADITION WHERE ABI_ID='$ABI_ID' AND CON_ID=$CON_ID ORDER BY ID_PR";
		$sqlpr2="SELECT predmet FROM ABI_NA_TRAD tr, abi_predmet pr WHERE ABI_ID='$ABI_ID' AND  tr.id_predmet = pr.id_pr ORDER BY pr.ID_PR";
		$cur4 = ora_do($conn,$sqlpr2);
		$tmp2="";
		for ($k=0;$k<ora_numrows($cur4);$k++)
		{
			$PP1 = SUBSTR (ora_getcolumn($cur4,0), 0, 1);
			$tmp2 .="$PP1 ";
			ora_fetch($cur4);
		}
/*		if ( !$tmp1 && !$tmp2 )
			$html .= "<td align='center'></td>";
		else
			$html .= "<td align='center'>$tmp1 /<br>$tmp2</td>";*/
		$html .= "<td align='center'>$tmp2</td>";
		$html .= "<td colspan='2' align='center' valign='middle'>$BIRTHDAY </td>" .
					"<td align='center' valign='middle' size='8'>$PASNUMBER</td>" .
					"<tr bgcolor='$col'><td colspan='8' align='center' valign='middle' height='12'>$POSTINDEX $ADDRESS</td>" .
					"<td align='center' valign='middle' size='8'>$PHONE</td>" .
					"<td align='center' valign='middle' size='8'>$PHONE2</td>" .
					"<td align='center' valign='middle' size='8'></td>" .
					"<td align='center' valign='middle' size='8'></td>";
		if ( $STAID != 148 )
			$html .= "<td align='center' valign='middle'></td>$STANAME</tr>";
		else
		
	$html .= "<td align='center' valign='middle'></td></tr>";
		ora_fetch($cur);
	}
	//$p->htmltable($html);
	if ( $header_date )
	{
		$html .= "<tr><td colspan='99' size='8'>$header_date";
	}
	else
	{
		$html .= "<tr><td colspan='99' size='8'>�� $d";
	}
	
	$sqlpodval="SELECT * FROM ABI_MINI_PODVAL WHERE $sql1";//CON_ID = '$id_con' AND SPECID = '$id_spec'";
	$cur11 = ora_do($conn,$sqlpodval);
	$VSEGO = ora_getcolumnnbsp($cur11,2);
	$P1 = ora_getcolumnnbsp($cur11,3);
	$P2 = ora_getcolumnnbsp($cur11,4);
	$P3 = ora_getcolumnnbsp($cur11,5);
	$PODL = ora_getcolumnnbsp($cur11,6);
	$MEDAL = ora_getcolumnnbsp($cur11,7);
	$VNEKON = ora_getcolumnnbsp($cur11,8);
	$BUD = ora_getcolumnnbsp($cur11,9);
	$COM = ora_getcolumnnbsp($cur11,10);
	$KONTR = ora_getcolumnnbsp($cur11,11);
	$html .= "<br/>$CONGROUP ����� ������: $VSEGO.      �� ���:</td></tr>" .
				"<tr><td rowspan='2' colspan='3'><br/>1 ��������� - $P1" .
				"<br/>2 ��������� - $P2" .
				"<br/>3 ��������� - $P3</td>" .
				"<td colspan='99'>�� 1 ����������:</td></tr>" .
				"<tr><td colspan='6'><br/>�����������             - $PODL" .
				"<br/>������� / �������� - $MEDAL" .
				"<br/>�����                            - $VNEKON</td>" .
				"<td colspan='5'></td></tr>";
/*	if($pdf==1)
	{
		$p->htmltable($html);
		$p->output('','I');	
	}
	else
	{	
		echo $html;
	}
*/
/*				"<td colspan='5'><br/>������    - $BUD" .
				"<br/>��������� - $COM" .
				"<br/>��������  - $KONTR</td></tr>";*/
				
//	if($pdf==1)
//	{
		define('FPDF_FONTPATH','font/');
		require('lib/pdftable.inc.php');
		$p = new PDFTable();
		$p->AliasNbPages();  
		$p->AddPage('L');
		$p->AddFont('TimesNewRomanPSMT','','times.php');  
		$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
		$p->SetFont('TimesNewRomanPSMT','',10);
		$p->htmltable($html);
		$p->output('','I');	
//$p->Output('doc123.pdf','D');
/*	}
	else
	{	
		echo $html;
	}*/
	//$p->output('','I');	
?>