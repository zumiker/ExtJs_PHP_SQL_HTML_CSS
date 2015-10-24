<?php
define('FPDF_FONTPATH','../../../../lib/fpdf/font/');
require('../../../../lib/pdftable/lib/pdftable.inc.php');
require_once("../include.php");


function strtolower_utf8( $text){
  return mb_convert_case($text, MB_CASE_LOWER, "UTF-8");

}
$zaoch=$_REQUEST['zaoch'];

if($zaoch=='1'){
$sql="select distinct
						initcap(lastname) || ' ' || initcap(firstname) || ' ' || initcap(patronymic) as fio,
						ball100,
						spccodenew || ' ' || ' ' || spcname as spcname,
						abi_id, con_id, lastname, spccodenew
						from ABIVIEW_zaochnoe
						order by con_id, spccodenew, ball100 DESC, lastname";
	$cur=execq($sql);
	$text = DecodeStr('Отчёт сформирован');
	$text1 = DecodeStr('Протокол по рекомендации к зачислению на 1-ый курс<br/>РГУ нефти и газа имени И. М. Губкина');
	$text2 = DecodeStr('Заочная форма обучения<br>Коммерческий набор');
	$text3 = DecodeStr('№');
	$text4 = DecodeStr('ФИО');
	$text5 = DecodeStr('Балл');
	$text6 = DecodeStr('н/я');

	$html	= "<table border='1' align='center' style='text-align:center; font-family: Verdana; font-size: 7px;'>";
	$d		= date( "d.m.Y" );
	$hdate	= "$text $d";
	$html	.= "<tr>
					<td colspan='99' align='center' family='TimesNewRomanPSMT' size='14'>
						$text1							
					</td>
				</tr>
				<tr>
					<td colspan='99' align='center' family='TimesNewRomanPSMT' size='14'>
						$text2 $hdate
					</td>
				</tr>";
	$s1		=  "<tr>
					<td align='center' width='10'><b>$text3</td>
					<td align='center' width='90%'><b>$text4</td>
					<td align='center' width='30'><b>$text5</td>
				</tr>";
	$html .= $s1;							
	$col		= "#ffffff";
	$spcname1	= '';
	foreach($cur as $k=>$row ){			
		$num++;
		$LASTNAME	= DecodeStr($row['FIO']);
		$BALL100	= DecodeStr($row['BALL100']);
		$spcname	= DecodeStr($row['SPCNAME']);
		$ABI_ID		= DecodeStr($row['ABI_ID']);
		
		if ( $spcname1	!= $spcname ){
			$num		= 1;
			$spcname1	= $spcname;
			$html .= "<tr>
						<td colspan='99' align='center'>$spcname1</td>
					</tr>";
		}
		if ($col=='#ffffff')	$col='#dddddd';
		else					$col='#ffffff';
		
		$html .= "<tr >
					<td align='center'>$num</td>
					<td align='left' >$LASTNAME</td>";
		if ( $BALL100 == '-1' )
			$html .= "<td align='center' >$text6</td>";
		else
			$html .= "<td align='center' >$BALL100</td>";
		$html .= "</tr>";
	}
	$html	.= "</table>";
}
else if($zaoch == '-1'){

$text6 = DecodeStr('н/я');
$check = $_REQUEST['check'];
$nabor = $_REQUEST['nabor'];
$formaid = $_REQUEST['formaid'];
if($check=='1')
	$order = "order by napravlen,tur,ball100 DESC,lastname";
else
	$order = "order by napravlen,tur,programma,ball100 DESC,lastname";
if($nabor=='1' && $formaid=='1'){
	$archiv=" 	and arhiv = 0
				and tur not in 33 ";
	$ball100=" ball100,";
}
if($nabor=='3' && $formaid=='1'){
	if($check=='1')
		$ball100=" 	decode(ball100,'-1',$text6,ball100) as ball100, ";
	else
		$ball100=" ball100,";
	$archiv  = "";
	
}
if($nabor=='3' && $formaid=='2'){
	if($check=='1')
		$ball100=" 	decode(ball100,'-1',$text6,ball100) as ball100, ";
	else
		$ball100=" ball100,";
	$archiv  = "and tur not in 33 ";
}
if($nabor=='1' && $formaid=='2'){
	if($check=='1')
		$ball100=" 	decode(ball100,'-1',$text6,ball100) as ball100, ";
	else
		$ball100=" ball100,";
	$archiv  = "";
}
if($nabor=='4'){
	$nabor   = '1';
	$formaid = '1';
	$archiv  = "and arhiv = 1";
	$ball100=" ball100,";
}




$sql="select 
							initcap(lastname) as lastname,
							tur,
							$ball100
							napravlen,
							nabor,
							forma,
							abi_id,
							kategor,
							obshaga,
							formaid,
							programma,
							podl
							from abi_magi_recom2011 
							where nabor='$nabor'
								and formaid='$formaid'
								$archiv
							$order
";

$cur=execq($sql);


	$text = DecodeStr('Отчёт сформирован');
	$text1 = DecodeStr('Протокол по зачислению на 1-ый курс магистратуры<br/>РГУ нефти и газа имени И. М. Губкина');
	$text3 = DecodeStr('№');
	$text4 = DecodeStr('ФИО');
	$text5 = DecodeStr('Балл');
	$text18 = DecodeStr('Общежитие');
	$text20 = DecodeStr('Направление:');
	$text23 = DecodeStr('Категория:');
	$text24 = DecodeStr('Подлинник:');
	
	if($nabor=='3')
		$text22 = DecodeStr('Коммерческий набор');
	if($nabor=='1')
		$text22 = DecodeStr('Бюджетный набор');
	if($formaid=='2')
		$text21 = DecodeStr('Вечерняя форма обучения');
	if($formaid=='1')
		$text21 = DecodeStr('Очная форма обучения');

	$html	= "<table border='1' align='center' style='text-align:center; font-family: Verdana; font-size: 7px;'>";
	$d		= date( "d.m.Y" );
	$hdate	= "$text $d";
$html	.= "<tr>
					<td colspan='99' align='center' family='TimesNewRomanPSMT' size='14'>
						$text1							
					</td>
				</tr>";
$html	.= "<tr>
<td colspan='99' align='center' family='TimesNewRomanPSMT' size='14'> $text21
<br> $text22 <br>$hdate
</td>

</tr>";

$s1		= "<tr>
					<td align='center' width='10'><b>$text3</td>
					<td align='center' width='90'><b>$text4</td>
					<td align='center' width='30'><b>$text5</td>";
if($nabor=='1' && $formaid=='1'){
					$s1.="<td align='center' width='30'><b>$text18</td>";
					}
					$s1.="<td align='center' width='30'><b>$text24</td>					
				</tr>";
				
									
		$col = "#ffffff";
		$num=0;
		$tmp='';
		$SPECID_OLD=array();
		$SPECID_OLD[0]="022000";
		$nums=1;
		$TURMASS=array();
		$TURMASS[0]=500;
		$PROGRAM=array();
		$PROGRAM[0]='12';
		foreach($cur as $k=>$row )
		{			
			$num=$num+1;
			$nums=$nums+1;
			$LASTNAME	=  DecodeStr($row['LASTNAME']);
			$TUR		= DecodeStr($row['TUR']);
			$BALL100	= DecodeStr($row['BALL100']);
			$NAPRAVLEN	= DecodeStr($row['NAPRAVLEN']);
			$NABOR		= DecodeStr($row['NABOR']);
			$FORMA		= DecodeStr($row['FORMA']);
			$ABI_ID		= DecodeStr($row['ABI_ID']);
			if( $TUR == 33 )
				$KATEGOR= DecodeStr('Участники конкурса на оставшиеся бюджетные места');
			else
				$KATEGOR	= DecodeStr($row['KATEGOR']);
			$OBSHAGA	= DecodeStr($row['OBSHAGA']);
			$FORMAID	= DecodeStr($row['FORMAID']);
			$PROGRAMMA	= DecodeStr($row['PROGRAMMA']);
			$PODL 		= DecodeStr($row['PODL']);

			$SPECID_OLD[$num]=$NAPRAVLEN;
			$TURMASS[$num]=$TUR;
			$PROGRAM[$num]=$PROGRAMMA;
			
			
			if ($col=='#ffffff')	$col='#dddddd';
			else					$col='#ffffff';
			
			if($SPECID_OLD[$num] != $SPECID_OLD[$num-1])
			{
				$sql777 = "select mest_bud_den, mest_bud_vech, mest_com_den, mest_com_vech from abi_con_magi where napravlen like '$SPECID_OLD[$num]'";
				$cur777	= execq( $sql777 );
				foreach($cur777 as $k777=>$row777 )
				{	
					if($nabor=='1' && $formaid=='1'){$mest_bud_den	= DecodeStr($row777['MEST_BUD_DEN']);}
					if($nabor=='1' && $formaid=='2'){$mest_bud_den	= DecodeStr($row777['MEST_BUD_VECH']);}
					if($nabor=='3' && $formaid=='1'){$mest_bud_den	= DecodeStr($row777['MEST_COM_DEN']);}
					if($nabor=='3' && $formaid=='2'){$mest_bud_den	=  DecodeStr($row777['MEST_COM_VECH']);}
				}
				$likvor			= DecodeStr('Всего мест:');
				$nums=1;
				$html	.= "<tr>
								<td colspan='99' align='left' family='TimesNewRomanPSMT' size='14'>
									$text20  $SPECID_OLD[$num] <br>$likvor $mest_bud_den
								</td>
							</tr>";
				
								
			}

			if($TURMASS[$num]!=$TURMASS[$num-1]||$SPECID_OLD[$num] != $SPECID_OLD[$num-1])
			{
				$nums=1;
				$html	.= "<tr>
								<td colspan='99' align='left' family='TimesNewRomanPSMT' size='14'>
									$text23 $KATEGOR
								</td>
							</tr>";
							if($check!='1')	
								$html .=$s1;
			}
			
			if($check == '1')
			{
				if($PROGRAM[$num]!=$PROGRAM[$num-1])
				{
					$nums=1;
					$html	.= "<tr><td colspan='99' align='center' family='TimesNewRomanPSMT' size='16'>$PROGRAMMA </td></tr>";
				}
			}
			
			
			$html .= "<tr>
						<td align='center'>$nums</td>
						<td align='left'>$LASTNAME</td>";
						if ( $BALL100 == '-1' )
						{
							$html .= "<td align='center' > $text6</td>";
							if($nabor=='1' && $formaid=='1'){$html .= "<td align='center'></td>";}
						}
						else
						{
							$html .= "<td align='center' >$BALL100</td>";
							if($nabor=='1' && $formaid=='1'){$html .="<td align='center'>$OBSHAGA</td>";}
						}
			$html .= "<td align='center' >$PODL</td></tr>";

		}
		$html .="</table>";
}
else{
$header='';
$fac=$_REQUEST['fac'];
$tur=$_REQUEST['tur'];
$id_con=$_REQUEST['group'];
$nab=$_REQUEST['rep'];
$vub=$_REQUEST['vub'];
$phone=$_REQUEST['phone'];

$sql1.="CON_ID='$id_con' ";
	$sql3=" AND TNABOR='$nab'";
	if($nab=='1'){
		$name=DecodeStr('бюджетный набор');
		$sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
	}
	if($nab=='2')
		$name=DecodeStr('целевой набор');
	if($nab=='3')	{
		$name=DecodeStr('коммерческий набор');
		$sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
	}
	if($nab=='4')
		$name=DecodeStr('контракт');
	if( ($nab=='5') || ($nab=='6') ){
		$name=DecodeStr('бюджетный набор');
		$sql3 = " AND (TNABOR='3' OR TNABOR='8')";
	}


	$podl=$_REQUEST['podl'];
	if ( ( $podl == 1 ) || ( $podl == 2 ) ){
		$sql5=" AND DOC='Подл'";
		$doc=DecodeStr(', подлинники');
	}
	else 
	{
		$doc="";
		
	}
		

	
	$sql4 = $sql3;
	$sql3 .=" AND TUR='$tur'";
	
$sql = "SELECT c.CONGROUP, c.MEST_HOST, decode( gorod, 1, lower( ' ' || frmabi || ' форма' ), null ) as frmabi, quaid, gorod
		FROM ABI_CONGROUP c
		inner join frmedu f
			on c.formaid = f.frmid
		WHERE c.ID_CON = $id_con";
		

	
	
$cur=execq($sql);
foreach($cur as $k=>$row){
	$CONGROUP	= DecodeStr($row['CONGROUP']);
	$MEST		= $row['MEST'];
	$FRMABI		= $row['FRMABI'];
	$QUAID		=  $row['QUAID'];
	$GOROD		=  $row['GOROD'];
}
//echo $CONGROUP.$MEST.$FRMABI.$QUAID.$GOROD;



$sql="SELECT SPCNAME, SPCBRIFE, SPCCODENEW, ID_SPEC FROM ABIVIEW_CON_SPEC WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";


$cur=execq($sql);
$date = date("d.m.y");

//$date = date("05.08.2014");

$ttuurr = $opk = $podval = "";
if( $nab == '1' )
{
	$t = $tur;
	if ( $podl == 777 )
		$t = $t + 1;
	
	if($t=='0')
		$ttuurr = DecodeStr('этап 1');
		else
		$ttuurr = DecodeStr('этап 2');
		
}
$RET=DecodeStr('Списки участников конкурса для зачисления на оставшиеся бюджетные места');
if( $podl == 34 )
	$opk = DecodeStr('для организаций оборонно-промышленного комплекса');
	
if( $podl == 777 )
	$podval = "	<tr>
					<td colspan='99'  size=17 align='center'>$RET</td>
				</tr> ";

if( $QUAID == 1 )
	$qua = DecodeStr('специальности');
if( $QUAID == 2 )
	$qua = DecodeStr('направления');
	
	
	$qwerty= DecodeStr( 'Протокол по зачислению на 1 курс' );
	$qwerty1= DecodeStr( 'РГУ нефти и газа имени И. М. Губкина на ' );
	$qwerty2=DecodeStr('на следующие');
	$qwerty3= DecodeStr( 'Протокол рекомендованных к зачислению на 1 курс' );
if ( ( $nab == '2' ) || ( $nab == '5' ) || ( $nab == '6' ) || ( ( $nab == '1' ) && ( ( $podl == 1 ) || ( $podl == 2 ) || ( $podl == 777 ) ) ) )
{
	if ( ( $nab == '5' ) || ( $nab == '6' ) )
		$zach =DecodeStr('Подлежат зачислению');
	else
		$zach = DecodeStr('Зачислено');
	//	$html .="<table border='1' align='center'  style='text-align:left; font-family: Verdana; font-size: 14px;>";
	
	$html ="<table border='0' width='180' >
			<tr>
				<td colspan='99'  size=17 align='center' >$qwerty</td>
			</tr>
			<tr>
				<td colspan='99' size=17 align='center'>$qwerty1 $date</td>
			</tr>
			$podval
			<tr>
				<td colspan='99'  size=17 align='center'>$qwerty2 $qua</td>
			</tr><tr>
				<td colspan='99' size=14 align='left' >$CONGROUP   ($name".$doc.$opk.$frmabi.") $ttuurr</td>
			</tr>";
	$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet 
			from ABI_SHAPKA_PROTOKOL 
			where con_id = $id_con 
				and nabor_13 = 1";
}
else
{
	$html ="<table border='0' width='180' >
			<tr>
				<td colspan='99'  size=17 align='center'>$qwerty</td>
			</tr>
			<tr>
				<td colspan='99'  size=17 align='center'>$qwerty1 $date</td>
			</tr>
			<tr>
				<td colspan='99'  size=17 align='center'>$qwerty2 $qua</td>
			</tr>
			<tr>
				<td colspan='99' align='left' size=14 >$CONGROUP   ($name".$doc.$opk.$frmabi.") $ttuurr</td>
			</tr>";
	$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet 
			from ABI_SHAPKA_PROTOKOL 
			where con_id = $id_con 
				and nabor_13 = $nab";
	$zach = DecodeStr('Зачислено');
}
if( $gorod == 1 )
	$html .= "<tr><td colspan='99'></td></tr>";
foreach($cur as $k=>$row)	{
	$SPCNAME	= DecodeStr($row['SPCNAME']);
	$SPCBRIFE	= DecodeStr($row['SPCBRIFE']);
	$SPCCODE	= $row['SPCCODE'];
	$ID_SPEC	= $row['ID_SPEC'];

	$html.= "<tr><td colspan='99' size='14' align='left'>$SPCBRIFE    $SPCNAME</td></tr>";	
		if( strlen( "$SPCBRIFE    $SPCNAME" ) >= 70 )
			$html.= "<tr><td>";		
}


$cur =execq($sql,false);


foreach($cur as $k =>$row){
$con_id					= $row['CON_ID'];
$mest					= $row['MEST'];
$host					= $row['HOST'];
$vsego					= $row['VSEGO'];
$konkurs_big			= $row['KONKURS_BIG'];
$bez_ekzam				= $row['BEZ_EKZAM'];
$vnekon					= $row['VNEKON'];
$tcelevik				= $row['TCELEVIK'];
$mmm					= $row['MMM'];
$www					= $row['WWW'];
$mest_rest				= $row['MEST_REST'];
$mest_host				= $row['MEST_HOST'];
$mest_host_rest			= $row['MEST_HOST_REST'];
$mest_rest_for_2tur		= $row['MEST_REST_FOR_2TUR'];
$mest_host_rest_for_2tur= $row['MEST_HOST_REST_FOR_2TUR'];
$seli_budjet			= $row['SELI_BUDJET'];;
}

$qwery=DecodeStr('Всего мест в конкурсной группе');
$qwery1=DecodeStr('Всего подано заявлений');
$qwery2=DecodeStr('Всего мужчин');
$qwery3=DecodeStr('Всего женщин');
$qwery4=DecodeStr('Конкурс по заявлениям');
$qwery5=DecodeStr('Без вступительных испытаний');
$qwery6=DecodeStr('Особые права');
$qwery7=DecodeStr('Целевой набор');
$qwery8=DecodeStr('По конкурсу');
$qwery9=DecodeStr('Мест в общежитии');
$qwery10=DecodeStr('Осталось мест в конкурсной группе');
$qwery11=DecodeStr('Осталось мест в общежитии');

if( $nab != 3 ){
$html.= "<tr >
			<td colspan='5' size='15' align='left' >$qwery</td>
			<td size='15' width='15'  > $mest</td>
		</tr>
		<tr >
			<td colspan='5' size='15' align='left' height='10'>$qwery1</td>
			<td size='15' width='15'  >$vsego</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>$qwery2</td>
			<td size='15' width='15'  >$mmm</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>$qwery3</td>
			<td size='15' width='15'  >$www</td>
		</tr>
		<tr>
			<td colspan='5' size='15' align='left'>$qwery4</td>
			<td size='15' width='15'  >$konkurs_big</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td colspan='5' size='15' align='left'>$zach</td>
			<td></td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>- $qwery5</td>
			<td size='15' width='15'  >$bez_ekzam</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>- $qwery6</td>
			<td size='15' width='15'  >$vnekon</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>- $qwery7</td>
			<td size='15' width='15'  >$tcelevik</td>
		</tr>";

if ( ( $nab != 5 ) && ( $nab != 6 ) ){
	if( ( $tur == 2 ) || ( $podl == 777 ) )
		$html.= "<tr>
					<td colspan='5' size='15' align='left'>- $qwery8</td>
					<td  size='15' width='15'  > $seli_budjet</td>
				</tr>
				<tr>
					<td colspan='5' size='15' align='left'>$qwery9</td>
					<td  size='15' width='15'  > $mest_host_rest_for_2tur</td>
				</tr>
				<tr>
					<td colspan='5' size='15' align='left'>$qwery10</td>
					<td  size='15' width='15'  > $mest_rest_for_2tur</td>
				</tr>";
	else 
		$html.= "<tr>
				<td>
				</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>$qwery10</td>
				<td  size='15' width='15'  > $mest_rest</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>$qwery9</td>
				<td  size='15' width='15'  > $mest_host</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>$qwery11</td>
				<td  size='15' width='15'  > $mest_host_rest</td>
			</tr>";
}
}
$etxt=DecodeStr('№<br> п/п');
$etxt1=DecodeStr('ФИО');
$etxt2=DecodeStr('Сумма<br>баллов');
$etxt3=DecodeStr('Приоритет');
$etxt4=DecodeStr('Медаль');
$etxt5=DecodeStr('Документ');
$etxt6=DecodeStr('Общежитие');
$etxt7=DecodeStr('№ л.д.');
$etxt8=DecodeStr('Требуется');
$etxt9=DecodeStr('Выделено');
$etxt19=DecodeStr('Телефон');
$etxt10=DecodeStr('СПИСОК РЕКОМЕНДОВАННЫХ');


$html .= "</table><br><table border='1' style='text-align:center; font-family: Verdana; font-size: 7px;'>";
if( $podl == 0 )
$html .= "<tr>
			<td colspan='10' align=center  size='7'>$etxt10</td>
		</tr>";
$html .= "<tr>
	<td rowspan='2' align='center' width='9'>$etxt</td>
	<td rowspan='2' align='center' width='30'>$etxt1</td>";
	if($phone=='1')
		$html.="<td rowspan='2' align='center' width='10'>$etxt19</td>";
	$html.="<td rowspan='2' align='center' width='10'>$etxt2</td>
	<td rowspan='2' align='center' width='15'>$etxt3</td>
	<td rowspan='2' align='center' width='11'>$etxt4</td>
	<td rowspan='2' align='center'>$etxt5</td>
	<td colspan='2' align='center' width='27'>$etxt6</td>
	<td rowspan='2' align='center' width='10' >$etxt7</td>
</tr>
<tr>
	<td align='center'>$etxt8</td>
	<td align='center'>$etxt9</td>
</tr>";

if ( ( $nab == 5 ) || ( $nab == 6 ) ){
	if ( $nab == 5 )
		$kat = '21,23,32';
	else
		$kat = '21,23';
	$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3) as PRIORITET,PHONE, BALL, PRIKAZ, OJID, abi_id, kategor, spccodenew, spcname
			FROM ABIVIEW_PODVAL_24
			WHERE CON_ID='$id_con' AND KATEGOR IN ($kat) and tur_fix = $tur 
			ORDER BY KATEGOR, decode( kategor, 32, spccodenew, null ), BALL DESC, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
//	$html .= "<tr><td colspan=9>$sql</td></tr>";
	$cur=execq($sql);
	$num=0;	
	$KATEGORIA_OLD='ned';
	$addspc = '';
	foreach($cur as $k=> $row){
		$num=$num+1;
		$ABI_NUMBER		= DecodeStr($row['ABI_NUMBER']);
		$LASTNAME		= DecodeStr($row['LASTNAME']);
		$FIRSTNAME		= DecodeStr($row['FIRSTNAME']);
		$PATRONYMIC		= DecodeStr($row['PATRONYMIC']);
		$HOST			= DecodeStr($row['HOST']);
		$TAWNAME_SMALL	= DecodeStr($row['TAWNAME_SMALL']);
		$KATEGORIA		= DecodeStr($row['KATEGORIA']);
		$DOC			= DecodeStr($row['DOC']);
		$PRIORITET		= DecodeStr($row['PRIORITET']);
		$BALL			= DecodeStr($row['BALL']);
		$PRIKAZ			= DecodeStr($row['PRIKAZ']);
		$OJID			= DecodeStr($row['OJID']);
		$abi_id			= DecodeStr($row['ABI_ID']);
		$kategor		= DecodeStr($row['KATEGOR']);
		$spccodenew		= DecodeStr($row['SPCCODENEW']);
		$spcname		= DecodeStr($row['SPCNAME']);
		$phonne			= DecodeStr($row['PHONE']);
		if($KATEGORIA_OLD!=$KATEGORIA){
			$html.= "<tr><td colspan='99'  size='12' align='left'>$KATEGORIA</td></tr>";
			$KATEGORIA_OLD=$KATEGORIA;	
		}
		if( ( $spccodenew != $addspc ) && ( $kategor == 32 ) )
		{
			$addspc = $spccodenew;
			if( strlen( "$spccodenew $spcname" ) >= 90 )
				$null = '.';
			$html.= "<tr>
						<td colspan='99'  size=12 align='left'>$spccodenew $spcname</br>$null</td>
					</tr>";
		}
		$col='#ffffff';
		$html .= "<tr bgcolor='$col'>
						<td align='center' width='10' size='10'>$num</td>
						<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>";
		if($phone=='1')
			$html.="<td align='left'  valign='middle'>$phonne</td>";
			$html.="
						<td align='center' >$BALL</td>
						<td align='center' >$PRIORITET </td>
						<td align='center'>$TAWNAME_SMALL</td>
						<td align='center'>$DOC</td>
						<td align='center'>$HOST</td>
						<td align='center' size='9'>$OJID</td>";
		if ( $PRIORITET != 1 )
			$html .= "<td align='center' size='9'>$ABI_NUMBER</td>";
		else
			$html .= "<td align='center'></td>";
		$html .="</tr>";
				
	}
}

	$table	= 'ABIVIEW_PODVAL_24';
	$ufao	= '';
	
	
 
	
	
	
	
for ( $j=0; $j<=0; $j++ )
{
	
	if( $j == 0 )
	{
		$orderby = " order by kategor, to_number( ball ) desc, to_number( p1 ) desc, to_number( p2 ) desc, to_number( p3 ) desc, to_number( p4 ) desc, priv desc, lastname";
		if ( $nab == 2 )
		{
			$kat = 32;
			$orderby = " order by kategor, spccodenew, to_number( ball ) desc, to_number( p1 ) desc, to_number( p2 ) desc, to_number( p3 ) desc, to_number( p4 ) desc, priv desc, lastname";
			if( $podl == 34 || $podl == 51 )
				$ufao = " and ufao = $podl ";
			else
				$ufao = " and ufao is null ";
		}
		else if ( $nab == 3 )
			$kat = '23, 29, 33';
		else if ( ( $tur == 1 ) && ( $podl == 2 ) )
			$kat = '29, 31';
		else if ( ( $tur == 2 ) && ( $podl == 2 ) )
			$kat = '29, 31, 33, 35';
		else if ( $podl == 777 )
			$kat = '33';
		else
//			$kat = 29;
			$kat = '29,33';
		
		if ( ( $podl == 1 ) || ( $podl == 2 ) )
			$sql = "select abi_number, lastname, firstname, patronymic, host, tawname_small, kategoria, doc, ball as BALL16, kategor, phone, 
						color, decode(prioritet,1,1,4,2,7,3) as PRIORITET, prikaz, ojid, spccodenew, spcname, proname, ufao, abi_id
					from $table 
					where con_id = '$id_con' 
						and tnabor = '$nab'
						and kategor in ( $kat )
						and doc = 'Подл' 
						and tur_fix = $tur 
						$ufao 
					$orderby";
		else
			$sql = "select abi_number, lastname, firstname, patronymic, host, tawname_small, kategoria, doc, ball as BALL16, kategor,phone, 
			
						color, decode(prioritet,1,1,4,2,7,3) as PRIORITET, prikaz, ojid, spccodenew, spcname, proname, ufao, abi_id
					from $table 
					where con_id = '$id_con' 
						and tnabor = '$nab'
						and kategor in ( $kat ) 
						and tur_fix = $tur 
						$ufao 
					$orderby";
	}
	else
		$sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0) as BALL16, KATEGOR, OJID 
				FROM ABIVIEW_PODVAL_26 
				WHERE CON_ID='$id_con' 
					AND (TNABOR='$nab') 
				ORDER BY KATEGOR, NVL(BALL,0) desc, LASTNAME";		
//	$html .= "<tr><td colspan=9>$sql</td></tr>";

//echo $sql;

	$cur		= 		execq($sql,false );
	//echo json_encode($cur);
	
	$BALL16_OLD	= 'ned';
	$KATEGOR_OLD= 'ned';
	$switchhh	= 0;
	$addspc		= '';
	$terror = DecodeStr('Вне конкурса');
	$terror1 = DecodeStr('Рекомендованные к зачислению');
	$terror2 = DecodeStr('Участники конкурса на оставшиеся бюджетные места');
	$terror4 = DecodeStr('Участники конкурса на оставшиеся коммерческие места');
	
	$terrorist = DecodeStr('Телефон');
	foreach ($cur as $k=>$row)
	{			
		$null = '';
		$num = $num + 1;
		$ufao			= DecodeStr($row['UFAO']);
		$ABI_NUMBER		= DecodeStr($row['ABI_NUMBER']);
		$LASTNAME		= DecodeStr($row['LASTNAME']);
		$FIRSTNAME		= DecodeStr($row['FIRSTNAME']);
		$PATRONYMIC		= DecodeStr($row['PATRONYMIC']);
		$HOST			= DecodeStr($row['HOST']);
		$TAWNAME_SMALL	= DecodeStr($row['TAWNAME_SMALL']);
		$KATEGORIA		= DecodeStr($row['KATEGORIA']);
		$BALL16			= DecodeStr($row['BALL16']);
		$DOC			= DecodeStr($row['DOC']);
		$PRIORITET		= DecodeStr($row['PRIORITET']);
		$COLOR			= DecodeStr($row['COLOR']);
		$BALL			= DecodeStr($row['BALL']);
		$PRIKAZ			= DecodeStr($row['PRIKAZ']);
		$OJID			= DecodeStr($row['OJID']);
		$abi_id			= DecodeStr($row['ABI_ID']);
		$KATEGOR		= DecodeStr($row['KATEGOR']);
		$spccodenew		= DecodeStr($row['SPCCODENEW']);
		$spcname		= DecodeStr($row['SPCNAME']);
		$proname		= DecodeStr($row['PRONAME']);	
		$phonne			= DecodeStr($row['PHONE']);
		if ($nab=='3')
		{
			if($KATEGOR!=$KATEGOR_OLD)
			{
				$KATEGOR_OLD=$KATEGOR;
				switch($KATEGOR)
				{
					case 23:
						$html.= "<tr>
									<td colspan='99'  size=12 align='left'>$terror</td>
								</tr>";
						break;
					case 29:
						if ($tur!='3')
							$html.= "<tr>
										<td colspan='99'  size=12 align='left'>$terror1</td>
									</tr>";
						else
							$html.= "<tr>
										<td colspan='99'  size=12 align='left'>$terror2</td>
									</tr>";
						break;
					case 31:
						$html.= "<tr>
									<td colspan='99'  size=12 align='left'>$terror2</td>
								</tr>";
						break;
					case 33:
						$html.= "<tr>
									<td colspan='99'  size=12 align='left'>$terror4</td>
								</tr>";
						break;
				}
			}
		}
		else
		{
			if($KATEGOR!=$KATEGOR_OLD)
			{
				$KATEGOR_OLD=$KATEGOR;
				switch($KATEGOR)
				{
					case 29:
						if ($tur!='3')
							$html.= "<tr>
										<td colspan='99'  size=12 align='left'>$terror1</td>
									</tr>";
						else
							$html.= "<tr>
										<td colspan='99' size=12 align='left'>$terror2</td>
									</tr>";
						break;
					case 31:
						$html.= "<tr>
									<td colspan='99' size=12 align='left'>$terror2</td>
								</tr>";
						break;
					case 33:
						$html.= "<tr>
									<td colspan='99' size=12 align='left'>$terror2</td>
								</tr>";
						break;
					case 35:
						$html.= "<tr>
									<td colspan='99'size=12 align='left'>$terror2</td>
								</tr>";
						break;
				}
			}
		}
		if( ( $spccodenew != $addspc ) && ( $nab == 2 ) )
		{
			$addspc = $spccodenew;
			if( strlen( "$spccodenew $spcname" ) >= 90 )
				$null = '.';
			$html.= "<tr>
						<td colspan='99' size=12 align='left'>$spccodenew $spcname</br>$null</td>
					</tr>";
		}
/*		if ($COLOR==1)
			$col='#eeeeee';
		else*/
			$col='#ffffff';
		$html .= "<tr bgcolor='$col'>
					<td align='center'  size='10' valign='middle'>$num</td>";
		if($phone=='1')
			$html.="<td align='left' width='50'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>
			<td align='left'  valign='middle'>$phonne</td>";
		else
			$html.="<td align='left' width='70'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>";
			$html.="
					<td align='center' valign='middle'>$BALL16</td>
					<td align='center' valign='middle'>$PRIORITET</td>
					<td align='center' valign='middle'>$TAWNAME_SMALL</td>
					<td align='center' valign='middle'>$DOC</td>
					<td align='center' valign='middle'>$HOST</td>
					<td align='center' size='9' valign='middle'>$OJID</td>";
		if ( $PRIORITET != 1 )
			$html .= "<td align='center' valign='middle' size='7'>$ABI_NUMBER</td>";
		else
			$html .= "<td align='center' valign='middle'></td>";
		$html .="</tr>";		
	}	
}
$html	.= "</table>";	
}
//echo $html;		
$p = new PDFTable();
$p->AliasNbPages();
$p->AddFont( 'TimesNewRomanPSMT', '', 'times.php' );
$p->SetFont( 'TimesNewRomanPSMT', '', 10 );
$p->SetMargins( 10, 10, 10, 10 );

$p->AddPage();

$p->htmltable( $html );
$time = strtotime( date('d.m.Y H.i.s') );// время в секундах, чтобы название файла было уникальным при повторном сохранении документа
//$exit = EncodeStr( "$grocode" );  // кодирует название, чтобы читался русский язык при сохранении
ob_get_contents();
ob_clean();
flush();
$p->Output("Протокол по зачислению $time.pdf",'I');     // сохраняет в Документы

?>