<br/>
<table border="0" align="center">
  <tr  bgcolor='SkyBlue'>
    <td align='center'><b>№ приказа</td>
    <td align='center'><b>Дата приказа</td>
    <td align='center'><b>Комментарий</td>
    <td align='center'><b>Кол-во человек</td>
    <td align='center'><b>Печать</td>
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
				 "<a href=# onClick='PrintXls$p($ORDERID,0)'> Excel(кон.гр.) </a> |" .
				 "<a href=# onClick='PrintXls$p($ORDERID,1)'> Excel(спец.) </a>" .
	 			 "</td></tr>";
	  ora_fetch($cur);
	 }
 ?>
 <tr><td colspan=5 align='right'>
				 <hr>
<a href=# onClick='show2()'> Создать приказ</a>				 
<hr>

<div id="popup" style="position:relative; display:none;align: center; float: right;" >
	
	<div  style="position:static; 
	  width:500px; height:200px; background-color:#DDDDDD;align: center;" align='center'>
	</div > 
	<div style="position:absolute; 
	top:5; left:5;  width:490px; height:190px;float: right; background-color:#FFFFFF; align: center;" align='center' valign='middle'>
		<div style="width:100%; background-color:SkyBlue;">
		<b>Создать приказ:</b>		
		</div>
		<div style="position:relative; top: -20; width=100%; float: right;" align='right'>
		<b><a href=# onClick='hide2()'><h6>закрыть</h6></a></b>		
		</div>
		<table>
		<tr><td>Номер приказа:</td><td><input type='text' id='ordernum'/></td></tr>
		<tr><td>Дата приказа:</td><td><input type='text' id='orderdate'/></td></tr>
		<tr><td>Комментарий:</td><td><input type='text' id='ordercomment'/></td></tr>
		<tr><td>Набор:</td><td><SELECT id='tnabor'>
		<option value='1'>Бюджетный</option>
		<option value='2'>Целевой</option>
		<option value='3'>Коммерческий</option>
		<option value='4'>Внебюджетный</option>
		</SELECT>
		</td></tr>
		<tr><td colspan='2' align='right'><button onClick='SaveOrder()'>Создать</button></td></tr>
		</table>
	</div>
</div> 
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9999)'> Печатать рекомендованных к зачислению(бюд.) </a>
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9995)'> Печатать рекомендованных к зачислению(цел.) </a>
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9998)'> Печатать рекомендованных к зачислению(ком.) </a>
	 			 </td></tr>
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9997)'> Печатать резерв (бюд.) </a>
	 			 </td></tr>	 			 
  <tr><td colspan=5 align='right'>
				 <a href=# onClick='PrintXls(9996)'> Печать резерв(ком.) </a>
	 			 </td></tr>	 			 
	 			 
  </table>