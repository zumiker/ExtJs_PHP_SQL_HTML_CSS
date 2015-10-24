<?
	header("Content-Type:application/vnd.ms-excel");
	$rand=rand(1,300);
	header('Content-Disposition:attachment;filename="spisok_'.$rand.'.xls"');
	include('../lib.php');
	$grocode=$_REQUEST['grocode'];
	$sql="SELECT initcap(fio) fio 
			from V_SPI_STUDENT_REPORT WHERE  
			GROCODE='$grocode' 
			ORDER BY  TSTID,FIO";
	$cur=array();
	$cur=execq($sql);
	$html="Группа: ".$grocode."<br/><table align='center' width='30%' border='1'>";
	$html.="<tr><td align='center' width='5%'>№</td>";
	$html.="<td align='center'>Фамилия Имя Отчество</td></tr>";
	for($i=0;$i<count($cur);$i++)
	{
		$html.="<tr><td align='center'>".($i+1)."</td>";
		$html.="<td align='left'>".$cur[$i]['FIO']."</td></tr>";
	}
	$html.='</table><br/>';
	echo $html;
?>