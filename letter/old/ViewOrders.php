<br/>
<table border="0" align="center">
  <tr  bgcolor='SkyBlue'>
    <td align='center'><b>� �������</td>
    <td align='center'><b>���� �������</td>
    <td align='center'><b>�����������</td>
    <td align='center'><b>���-�� �������</td>
    <td align='center'><b>������</td>
    </tr>

<?php
 $year=date('Y');
 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $sql="SELECT to_char(ORDERDATE, 'DD.MM.YYYY') AS ORDERDATE, ordernumber,comments, ORDERID, TNABOR
		FROM abi_orders WHERE year=$year";
 $cur=ora_do($conn,$sql);
//
	 for ($i=0;$i<ora_numrows($cur);$i++)
	 {
	 	if ($col=="bgcolor='#eeeeee'")
		{
			
			$col="bgcolor='#dddddd'";
			$bgcol="onmouseout=menuOut(this,'#dddddd') onmouseover=menuOver(this,'#ef8740')";
		}
		else
		{
			$col="bgcolor='#eeeeee'";
			$bgcol="onmouseout=menuOut(this,'#eeeeee') onmouseover=menuOver(this,'#ef8740')";
		}
	 		$ORDERDATE=ora_getcolumn($cur,0);
	 		$ORDERNUMBER=ora_getcolumn($cur,1);
	 		$COMMENT=ora_getcolumn($cur,2);
	 		$ORDERID=ora_getcolumn($cur,3);
	 		$TNABOR=ora_getcolumn($cur,4);
	 		if($TNABOR==3 || $TNABOR==2)
	 		{
	 			$p='2';
	 		}
	 		else
	 		{
	 			$p='2';
	 		}
	 		 $sql="SELECT COUNT(*) FROM ABIVIEW_PRIKAZ WHERE ORDERID='$ORDERID'";
	 		 $cur2=ora_do($conn,$sql);
	 		 $COUNT=ora_getcolumn($cur2,0);
	 		 
	 		 echo "<tr $col $bgcol><td>$ORDERNUMBER</td><td>$ORDERDATE</td><td>$COMMENT</td><td>$COUNT</td><td>" .
				 "<a href=# onClick='PrintHtml($ORDERID)'> html </a>  | " .	 				
				 "<a href=# onClick='PrintXls$p($ORDERID,0)'> Excel(���.��.) </a> |" .
				 "<a href=# onClick='PrintXls$p($ORDERID,1)'> Excel(����.) </a>" .
	 			 "</td></tr>";
	  ora_fetch($cur);
	 }
 ?>
 <tr><td colspan=5 align='right'>
				 <hr>
<a href=# onClick='show2()'> ������� ������</a>				 
<hr>

<div id="popup" style="position:relative; display:none;align: center; float: right;" >
	
	<div  style="position:static; 
	  width:500px; height:200px; background-color:#DDDDDD;align: center;" align='center'>
	</div > 
	<div style="position:absolute; 
	top:5; left:5;  width:490px; height:190px;float: right; background-color:#FFFFFF; align: center;" align='center' valign='middle'>
		<div style="width:100%; background-color:SkyBlue;">
		<b>������� ������:</b>		
		</div>
		<div style="position:relative; top: -20; width=100%; float: right;" align='right'>
		<b><a href=# onClick='hide2()'><h6>�������</h6></a></b>		
		</div>
		<table>
		<tr><td>����� �������:</td><td><input type='text' id='ordernum'/></td></tr>
		<tr><td>���� �������:</td><td><input type='text' id='orderdate'/></td></tr>
		<tr><td>�����������:</td><td><input type='text' id='ordercomment'/></td></tr>
		<tr><td>�����:</td><td><SELECT id='tnabor'>
		<option value='1'>���������</option>
		<option value='2'>�������</option>
		<option value='3'>������������</option>
		<option value='4'>������������</option>
		</SELECT>
		</td></tr>
		<tr><td colspan='2' align='right'><button onClick='SaveOrder()'>�������</button></td></tr>
		</table>
	</div>
</div> 
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9999)'> �������� ��������������� � ����������(���.) </a>
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9995)'> �������� ��������������� � ����������(���.) </a>
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9998)'> �������� ��������������� � ����������(���.) </a>
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9997)'> �������� ������ (���.) </a>
	 			 </td></tr>	 			 
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9996)'> ������ ������(���.) </a>
	 			 </td></tr>	 			 
	 			 
  </table>