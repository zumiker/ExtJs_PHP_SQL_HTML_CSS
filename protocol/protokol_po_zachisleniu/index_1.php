<html>
<head>
<title>�������� �� ����������</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script.js"></script>
</head>

<body>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER">�������� </B>
<center>
<?php
 session_start();
 $year=date('Y');
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

 ?>
 <!--<br/>
 <table border="1" align="center"><tr><td><b>�����</b></td>
 <td><select id='nab'>
<OPTION VALUE=99 selected>--��������--</option>
<OPTION VALUE=1>��������� �����</option>
<OPTION VALUE=3>������������ �����</option>
</select></td>
 <td rowspan='2'><input type='button' onClick='Recalculate()' value='�����������'>
 <br />
 <input type='button' onClick='FixTour()' disabled value='�������������'> <div id='fix'></div>
</center>
<div id='calc'></div></td></tr>

 <!--<tr><td><b>��������</b></td> 					- ��������� ��� ���������
 <td><select id='podl'>
<OPTION VALUE=99 selected>--��������--</option>
<!--<OPTION VALUE=1>������ ����������</option>
<OPTION VALUE=0>���</option>
</select></td>
 <td></td> </tr>

<tr>
	<td><b>���</b></td>
	<td><select id='fix_tur'>
<OPTION VALUE=99 >--��������--</option>
<OPTION selected VALUE=1>������</option>
<OPTION VALUE=2>������</option>
<OPTION VALUE=3>������</option>
</select></td>
	<td></td>
</tr>
  </table>-->


<table border="1" align="center">

  <tr>
	<td><b>���</b></td>
	<td><select  id='id_tur'>
<!--<OPTION disabled VALUE=99 >--��������--</option>-->
<OPTION selected VALUE=1>������</option>
<OPTION VALUE=2>������</option>
<!--<OPTION VALUE=3>������</option>-->
</select></td>
	<td></td>
 </tr>

  <tr> 
    <td><B>���������:</B></td>
    <td><SELECT id="fac" onChange="FacChange_1(this.value);">
<?php
 //$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC ORDER BY FACNAME");
 echo "<OPTION VALUE=''>--��������--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
			if ($FACID!=9)
			{
	 		echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
			}
	  ora_fetch($cur);
	 }
 ?>
      </SELECT><div id='facs'></div></td>
  </tr>

  <tr> 
  <td rowspan='2'><B>���������� ������:</td>
  <td><div id='congr'>�������� ���������</div></td>
  </tr>
  <tr><td colspan='2' align='center'><!-- ��� ���������:--><INPUT TYPE=HIDDEN NAME="pdf" id='pdf' checked>
  </td></tr>
  </table>
  
 
</body>
</html>
