<?
require_once('../roles.php');
?>
<html>
<head>
<title>�������� ���� ������ �� ����������� ("�������� �����")</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="script.js"></script>
</head>

<body>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER">�������� ���� ������ �� ����������� </br>("�������� ����� ��� ���������")</B>

<table border="1" align="center">
  <tr> 
    <td><B>���������:</B></td>
    <td>
<SELECT id="fac" onChange="FacChange(this.value);">
<?php

 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");

if ( $role == 'vip' )
	$cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC ORDER BY FACNAME");
else if ( $clientdivid != 349 )
	$cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC where facid <> 15 ORDER BY FACNAME");
else
	$cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC where facid = 15 ORDER BY FACNAME");

 echo "<OPTION VALUE=''>--��������--</option>";
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
		
	 		$FACID=ora_getcolumn($cur,0);
	 		$FACNAME=ora_getcolumn($cur,1);
			if(!($FACID=='9'))
			{
				echo "<OPTION VALUE='$FACID'>$FACNAME</option>";
			}	
/*			else
			{
				echo "<OPTION disabled VALUE='$FACID'>$FACNAME</option>";
			}*/
	  ora_fetch($cur);
	 }
	 $d1=date("d.m.Y");
 ?>
      </SELECT><div id='facs'></div></td>
  </tr>
<!--  <tr> 
  <td><B>���������� ������:</td>
  <td><div id='congr'>�������� ���������</div></td>
  </tr>
    <tr> 
  <td><B>�������������:</td>
  <td><div id='spec'>�������� ���������� ������</div></td>
  </tr>-->
  <tr>
  <td colspan='2' align='center'><!-- ����������:
  <select id='sort'>
  <option value=1 selected>���������� ������, �������������, �����, ����� �.�.</option>
  <option value=2>���������� ������, �������������, �����, �������, ���, ��������</option>
  <option value=3>�������, ���, ��������</option>
  </select>
  <br/>����� � PDF:<INPUT TYPE=CHECKBOX checked id='pdf'>
   <br/>����� � PDF:--><INPUT TYPE=HIDDEN NAME="pdf" checked id='pdf'>
 <p align="left">  ����������:<br>
 <select id="sort1">
 <option value="1">�� ���������</option>
 <option value="2">�� �������</option>
 <option value="3">�� ����������</option>
 <option value="4" disabled>�� ������ ������� ����</option>
 <option value="5" disabled>�� ���� ��������</option>
<!--<input type="radio"  name="sort1" value="0"> �� ���������<Br>
<input type="radio"  name="sort1" value="1"> �� �������<Br>
<input type="radio"  name="sort1" value="2"> �� ����������<Br>
<input type="radio"  name="sort1" value="3"> �� ������ ������� ����<Br>-->
</select>
</p>
 </td></tr>
  </table>
  
  <table><tr><td colspan='6' align='center'>��� ����, ����� �������� ����� �� ����������<br/> ���������� �������, ������� ����</td></tr>
<tr><td>�� ���������� c:</td>
<!--<textarea rows="1" cols="10" name="date1"><?php echo $d1; ?></textarea>:<br /> 
	<td> <?php //echo '<input type="text" id="start" value="dd.mm.yyyy">'; ?> </td><td>��:</td>//-->
	<td> <?php echo '<input type="text" id="start" value='.$d1.'>'; ?> </td><td>��:</td>

	<td><?php echo '<input type="text" id="end" >'; ?></td></tr>
</table>
<?php $d=date("d.m.Y H:i ");
//echo $d;
//	echo "������� ������� ���� � ������ ����, �������� 03.03.2010";?>
<!-- <textarea rows="1" cols="20" name="date2"> <?php echo $d1; ?></textarea>:<br /> //-->
</body>
</html>
