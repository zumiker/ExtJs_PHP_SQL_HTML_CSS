<?php
	include('../lib.php');
	$grocode=$_REQUEST['grocode'];
	$sql="SELECT initcap(fio) fio 
			from V_SPI_STUDENT_REPORT WHERE  
			GROCODE='$grocode' 
			ORDER BY  TSTID,FIO";
	$cur=execq($sql);
	$table="<br/><table style='border-color:#c0c0c0;' align='center' width='50%' border='1'>";
	$table.="<tr style='background-color:#ffdead;font-weight:bold;'><td align='center' width='10%'>№</td><td align='center' width='90%'>Фамилия,Имя,Отчество</td></tr>";
	for($i=0;$i<count($cur);$i++)
	{
		$table.="<tr><td align='center' width='10%'>".($i+1)."</td><td align='left' width='90%' style='padding-left:5px;'>$nbsp".$cur[$i]['FIO']."</td></tr>";
	}
	$table.="</table><br/>";
	echo $table;  
?>