<html>
<head>
	<title>Список магистрантов</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER"></B>
<?php
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$cur=ora_do($conn,"select 
							lastname,
							tur,
							ball100,
							napravlen,
							nabor,
							forma,
							abi_id,
							kategor,
							obshaga,
							formaid
							from abi_magi_recom2011 
							where formaid=1 and nabor=1
							order by napravlen,tur,lastname");
					
function ora_getcolumnnbsp($cur,$pos)
{
	if ( ora_getcolumn( $cur, $pos )==' ')	return "&nbsp"; 
	else										return ora_getcolumn( $cur, $pos );
}
$html .= "<table width='800' border='1' style='text-align:center; font-family: Verdana; font-size: 10px;'>";
$d=date("d.m.Y");
$hdate	 = "Отчёт сформирован $d";
$html	.= "<tr><td colspan='500' align='center' family='TimesNewRomanPS-BoldMT' size='14'><h2>Протокол по зачислению на 1-ый курс магистратуры<br/>РГУ нефти и газа им.И.М.Губкина</br></td></tr>";
$html	.= "<tr><td colspan='500' align='center' family='TimesNewRomanPS-BoldMT' size='12'><h2>Очная форма обучения<br>Бюджетный набор</h2>$hdate</td></tr>";
$s1		.=  "<tr>" .
			"<td align='center' width='6%'><b>№</td>" .
			"<td align='center' width='55%'><b>ФИО</td>" .
			"<td align='center' width='10%'><b>Балл</td>" .
			"<td align='center' width='20%'><b>Общежитие</td>";
$html .=$s1;							
		$col = "#ffffff";
		$num=0;
		$tmp='';
		$SPECID_OLD=array();
		$SPECID_OLD[0]="022000";
		$nums=1;
		$TURMASS=array();
		$TURMASS[0]=500;
		for ($i=0;$i<ora_numrows($cur);$i++)
		{			
			$num=$num+1;
			$nums=$nums+1;
			$LASTNAME	= ora_getcolumnnbsp($cur,0);
			$TUR		= ora_getcolumnnbsp($cur,1);
			$BALL100	= ora_getcolumnnbsp($cur,2);
			$NAPRAVLEN	= ora_getcolumnnbsp($cur,3);
			$NABOR		= ora_getcolumnnbsp($cur,4);
			$FORMA		= ora_getcolumnnbsp($cur,5);
			$ABI_ID		= ora_getcolumnnbsp($cur,6);
			$KATEGOR	= ora_getcolumnnbsp($cur,7);
			$OBSHAGA	= ora_getcolumnnbsp($cur,8);
			$FORMAID	= ora_getcolumnnbsp($cur,9);

			$SPECID_OLD[$num]=$NAPRAVLEN;
			$TURMASS[$num]=$TUR;
			
			if ($col=='#ffffff')	$col='#dddddd';
			else					$col='#ffffff';
			if($SPECID_OLD[$num] != $SPECID_OLD[$num-1])
			{
				$nums=1;
				$html	.= "<tr><td colspan='400' align='left' family='TimesNewRomanPS-BoldMT' size='16'><br/><b>Направление: $SPECID_OLD[$num] <b><br/><br/></td></tr>";
			}
			if($TURMASS[$num]!=$TURMASS[$num-1]||$SPECID_OLD[$num] != $SPECID_OLD[$num-1])
			{
				$nums=1;
				$html	.= "<tr><td colspan='400' align='center' family='TimesNewRomanPS-BoldMT' size='16'><br/><b>Категория: $KATEGOR <b><br/><br/></td></tr>";
			}
			$html .= "<tr OnMouseOver=\"style.backgroundColor='#54FF9F'\" OnMouseOut=\"style.backgroundColor='#FFFFFF'\"><td align='center' nowrap> $nums </td>".
						"<td align='left' nowrap> &nbsp &nbsp $LASTNAME </td>".
						"<td align='center' nowrap> &nbsp $BALL100</td>".
						"<td align='center'> &nbsp $OBSHAGA</td>";
			ora_fetch($cur);		
		}
		$html .="</table></center>";
		echo $html;
?>   
</body>
</html>