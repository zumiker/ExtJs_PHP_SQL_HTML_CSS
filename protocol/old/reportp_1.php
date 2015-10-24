<?php
function ora_getcolumnnbsp($cur,$pos)
{
	if (ora_getcolumn($cur,$pos)==' ') return " "; 
	else return ora_getcolumn($cur,$pos);
}
session_start();
$header='';
$fac=$_GET['fac'];
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="SELECT FACID from ABI_FAC WHERE FACID=$fac ORDER BY FACNAME";
$cur=ora_do($conn,$sql);
$id_fac=ora_getcolumn($cur,0);
if(isset($_GET['id_con'])){
	$id_con=$_GET['id_con'];
	$sql1.="CON_ID='$id_con' ";
}
if(isset($_GET['nabor'])){
	$nab = $_GET['nabor'];
	$sql3=" AND TNABOR='$nab'";
	if($nab=='1'){
		$name='бюджетный набор';
		$sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
	}
	if($nab=='2')
		$name='целевой набор';
	if($nab=='3')	{
		$name='коммерческий набор';
		$sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
	}
	if($nab=='4')
		$name='контракт';
	if( ($nab=='5') || ($nab=='6') ){
		$name='бюджетный набор';
		$sql3 = " AND (TNABOR='3' OR TNABOR='8')";
	}
}
if(isset($_GET['podl'])){
	$podl=$_GET['podl'];
	if ( ( $podl == 1 ) || ( $podl == 2 ) ){
		$sql5=" AND DOC='Подл'";
		$doc=", подлинники";
	}
	else 
		$doc="";
}
if(isset($_GET['tur'])){
	$tur=$_GET['tur'];
	$sql4 = $sql3;
	$sql3 .=" AND TUR='$tur'";
}
$sql = "SELECT c.CONGROUP, c.MEST_HOST, decode( gorod, 1, lower( ' ' || frmabi || ' форма' ), null ) as frmabi, quaid, gorod
		FROM ABI_CONGROUP c
		inner join frmedu f
			on c.formaid = f.frmid
		WHERE c.ID_CON = $id_con";
$cur=ora_do($conn,$sql);
for ($i=0;$i<ora_numrows($cur);$i++){
	$CONGROUP	= ora_getcolumn($cur,0);
	$MEST		= ora_getcolumn($cur,1);
	$frmabi		= ora_getcolumn($cur,2);
	$quaid		= ora_getcolumn($cur,3);
	$gorod		= ora_getcolumn($cur,4);
}
$sql="SELECT SPCNAME, SPCBRIFE, SPCCODENEW, ID_SPEC FROM ABIVIEW_CON_SPEC WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";
$cur=ora_do($conn,$sql);
//$date = date("d.m.y H:i");
$date = date("05.08.2014");

$ttuurr = $opk = $podval = "";
if( $nab == '1' )
{
	$t = $tur;
	if ( $podl == 777 )
		$t = $t + 1;
	$ttuurr = "этап $t";
}

if( $podl == '34' )
	$opk = " для организаций оборонно-промышленного комплекса";
	
if( $podl == 777 )
	$podval = "	<tr>
					<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>Списки участников конкурса для зачисления на оставшиеся бюджетные места</td>
				</tr> ";

if( $quaid == 1 )
	$qua = "специальности";
if( $quaid == 2 )
	$qua = "направления";
if ( ( $nab == 2 ) || ( $nab == 5 ) || ( $nab == 6 ) || ( ( $nab == '1' ) && ( ( $podl == 1 ) || ( $podl == 2 ) || ( $podl == 777 ) ) ) )
{
	if ( ( $nab == 5 ) || ( $nab == 6 ) )
		$zach = 'Подлежат зачислению';
	else
		$zach = 'Зачислено';
	$html ="<table border='0' width='180'>
			<tr>
				<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>Протокол по зачислению на 1 курс</td>
			</tr>
			<tr>
				<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>РГУ нефти и газа имени И. М. Губкина на $date</td>
			</tr>
			$podval
			<tr>
				<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>на следующие $qua</td>
			</tr><tr>
				<td colspan='99' align='left'>$CONGROUP   ($name".$doc.$opk.$frmabi.") $ttuurr</td>
			</tr>";
	$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet 
			from ABI_SHAPKA_PROTOKOL 
			where con_id = $id_con 
				and nabor_13 = 1";
}
else
{
	$html ="<table border='0' width='180'>
			<tr>
				<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>Протокол рекомендованных к зачислению на 1 курс</td>
			</tr>
			<tr>
				<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>РГУ нефти и газа имени И. М. Губкина на $date</td>
			</tr>
			<tr>
				<td colspan='99' family='TimesNewRomanPS-BoldMT' size=17 align='center'>на следующие $qua</td>
			</tr>
			<tr>
				<td colspan='99' align='left'>$CONGROUP   ($name".$doc.$opk.$frmabi.") $ttuurr</td>
			</tr>";
	$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet 
			from ABI_SHAPKA_PROTOKOL 
			where con_id = $id_con 
				and nabor_13 = $nab";
	$zach = 'Зачислено';
}
if( $gorod == 1 )
	$html .= "<tr><td colspan='99'></td></tr>";
for ($i=0;$i<ora_numrows($cur);$i++){		
	$SPCNAME	= ora_getcolumnnbsp($cur,0);
	$SPCBRIFE	= ora_getcolumnnbsp($cur,1);
	$SPCCODE	= ora_getcolumn($cur,2);
	$ID_SPEC	= ora_getcolumn($cur,3);
/*
	if ( $CONGROUP == 'Конкурсная группа 13' ){
		if ( $nab == 1 ){
			if ( $ID_SPEC != 228 && $ID_SPEC != 229 ){
				$html.= "<tr><td colspan='99' size='14' align='left'>$SPCBRIFE    $SPCNAME</td></tr>";	
//				if( strlen( $SPCNAME ) >= 55 )
				if( strlen( "$SPCBRIFE    $SPCNAME" ) >= 70 )
					$html.= "<tr><td>";
			}
		}
		else{
			$html.= "<tr><td colspan='99' size='14' align='left'>$SPCBRIFE    $SPCNAME</td></tr>";	
			if( strlen( "$SPCBRIFE    $SPCNAME" ) >= 70 )
				$html.= "<tr><td>";
		}
	}
	else{
		$html.= "<tr><td colspan='99' size='14' align='left'>$SPCBRIFE    $SPCNAME</td></tr>";	
			if( strlen( "$SPCBRIFE    $SPCNAME" ) >= 70 )
				$html.= "<tr><td>";
	}
*/
	$html.= "<tr><td colspan='99' size='14' align='left'>$SPCBRIFE    $SPCNAME</td></tr>";	
		if( strlen( "$SPCBRIFE    $SPCNAME" ) >= 70 )
			$html.= "<tr><td>";
	ora_fetch($cur);		
}
/*
$sql="SELECT sum(VSEGO), sum(HOST) ,sum(OSTATKI) FROM ABI_PODVAL_2 WHERE  CON_ID='$id_con' $sql4";
$cur=ora_do($conn,$sql);
$VSEGO2	= ora_getcolumnnbsp($cur,0);
$HOST	= ora_getcolumnnbsp($cur,1);
$OSTATKI= ora_getcolumn($cur,2);

$sql="SELECT  sum(NEUD) FROM ABI_PODVAL_4 WHERE  CON_ID='$id_con' $sql4";
$cur=ora_do($conn,$sql);
$NEUD = ora_getcolumnnbsp($cur,0);	
$VIDERJALI=$VSEGO2-$NEUD;

$sql="SELECT sum(MUJ),sum(JEN) FROM ABI_PODVAL_3 WHERE  CON_ID='$id_con' $sql4";
$cur=ora_do($conn,$sql);
$MUJ = ora_getcolumnnbsp($cur,0);
$JEN = ora_getcolumnnbsp($cur,1);	

$sql="SELECT OSTATKI_HOST FROM ABI_PODVAL_5 WHERE  CON_ID='$id_con'";
$cur=ora_do($conn,$sql);
$OSTATKI_HOST = ora_getcolumnnbsp($cur,0);

if($nab==3){
	$sql="SELECT SUM(MEST_COM) FROM ABI_CON_SPEC WHERE ID_CON='$id_con'";
	$cur=ora_do($conn,$sql);
	$MEST_BUD = ora_getcolumnnbsp($cur,0);
	$MEST_BUD_host=0;
}
else{
	$sql="SELECT SUM(MEST_BUD) FROM ABI_CON_SPEC WHERE ID_CON='$id_con'";
	$cur=ora_do($conn,$sql);
	$MEST_BUD = ora_getcolumnnbsp($cur,0);
	$MEST_BUD_host=$MEST_BUD;
}
$tmp = $VSEGO2/$MEST_BUD;
$tmp =  number_format($tmp, 1, '.', '');;

$html.= "<tr>
			<td colspan='5' size='15' align='left'>Всего мест в конкурсной группе</td>
			<td  width='15' > $MEST_BUD</td>
		</tr>";	
if($tur==2){
	$html.= "<tr>
				<td colspan='5' size='15' align='left'>Осталось мест в конкурсной группе</td>
				<td  width='15' > $OSTATKI</td>
			</tr>";	
}
if ($nab!='3'){
	$html.= "<td><tr><td><tr><td colspan='5' size='15' align='left'>" .
		"Мест в общежитии</td><td  width='15' > $MEST</td></tr>";
	if($tur==2){
		$html.= "<tr>
					<td colspan='5' size='15' align='left'>Осталось мест в общежитии</td>
					<td  width='15' > $OSTATKI_HOST</td>
				</tr>";	
	}
}
else{
	$html.= "<tr>
				<td colspan='5' size='15' align='left'>Мест в общежитии</td>
				<td  width='15' > 0</td>
			</tr>";	
}
if ( $podl != '1' && $tur != '3' ){
	$html.= "<tr>
				<td colspan='5' size='15' align='left'>Всего подано заявлений</td>
				<td width='15' >$VSEGO2</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>Конкурс по заявлениям</td>
				<td width='15' >$tmp</td>
			</tr>";
	$sql = "SELECT  sum(VSEGO), sum(HOST), sum(SOBESED), sum(PODTV), sum(OTL), sum(VNEKON) FROM ABI_PODVAL_1 WHERE CON_ID= '$id_con' $sql4";
	$cur=ora_do($conn,$sql);
	$VSEGO = ora_getcolumnnbsp($cur,0);
	$HOST= ora_getcolumnnbsp($cur,1);
	$SOBESED= ora_getcolumnnbsp($cur,2);
	$PODTV= ora_getcolumnnbsp($cur,3);
	$OTL= ora_getcolumnnbsp($cur,4);
	$VNEKON= ora_getcolumnnbsp($cur,5);
	if ($nab!='3' || $tur!='2'){
		$html.= "<tr>
					<td colspan='5' size='15' align='left'>Подлежат обязательному зачислению</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td colspan='4' size='15'  align='left'>            (победители олимпиад)</td>
					<td width='15' >$PODTV</td>
				</tr>
				<tr>
					<td colspan='5' size='15'  align='left'>Вне конкурса</td>
					<td width='15' >$VNEKON</td>
				</tr>";
	}	
	$html.= "<tr>
				<td colspan='5' size='15'  align='left'>Всего мужчин</td>
				<td width='15' >$MUJ</td>
			</tr>
			<tr>
				<td colspan='5' size='15'  align='left'>Всего женщин</td>
				<td width='15' >$JEN</td>
			</tr>";
	$KONK	= ($VIDERJALI/$MEST_BUD);
	$KONK	= number_format($KONK, 1, '.', '');
	$MEST	= $MEST_BUD-$VSEGO;
	$KONK	= ($VIDERJALI-$SOBESED)/($MEST_BUD-$SOBESED);
	$KONK	= number_format($KONK, 1, '.', '');
}
*/
/*
всего мест в кг - оставить, но УЬРАТЬ осталось мест...
убрать осталось мет в общежитии
убрать слово "обязательному", будет Подледат зачислениею:
следом идет расшифровка по категориям:
- без вступительных испытаний
- вне конкурса
- целевой набор
мужчин и женщин оставляе, так же как и конкур
*/
$cur =ora_do($conn,$sql);
$con_id					= ora_getcolumnnbsp($cur,0);
$mest					= ora_getcolumnnbsp($cur,1);
$host					= ora_getcolumnnbsp($cur,2);
$vsego					= ora_getcolumnnbsp($cur,3);
$konkurs_big			= ora_getcolumnnbsp($cur,4);
$bez_ekzam				= ora_getcolumnnbsp($cur,5);
$vnekon					= ora_getcolumnnbsp($cur,6);
$tcelevik				= ora_getcolumnnbsp($cur,7);
$mmm					= ora_getcolumnnbsp($cur,8);
$www					= ora_getcolumnnbsp($cur,9);
$mest_rest				= ora_getcolumnnbsp($cur,10);
$mest_host				= ora_getcolumnnbsp($cur,11);
$mest_host_rest			= ora_getcolumnnbsp($cur,12);
$mest_rest_for_2tur		= ora_getcolumnnbsp($cur,13);
$mest_host_rest_for_2tur= ora_getcolumnnbsp($cur,14);
$seli_budjet			= ora_getcolumnnbsp($cur,15);
if( $nab != 3 ){
$html.= "<tr>
			<td colspan='5' size='15' align='left'>Всего мест в конкурсной группе</td>
			<td  width='15' > $mest</td>
		</tr>
		<tr>
			<td colspan='5' size='15' align='left'>Всего подано заявлений</td>
			<td width='15' >$vsego</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>Всего мужчин</td>
			<td width='15' >$mmm</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>Всего женщин</td>
			<td width='15' >$www</td>
		</tr>
		<tr>
			<td colspan='5' size='15' align='left'>Конкурс по заявлениям</td>
			<td width='15' >$konkurs_big</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td colspan='5' size='15' align='left'>$zach</td>
			<td></td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>- Без вступительных испытаний</td>
			<td width='15' >$bez_ekzam</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>- Особые права</td>
			<td width='15' >$vnekon</td>
		</tr>
		<tr>
			<td colspan='5' size='15'  align='left'>- Целевой набор</td>
			<td width='15' >$tcelevik</td>
		</tr>";
if ( ( $nab != 5 ) && ( $nab != 6 ) ){
	if( ( $tur == 2 ) || ( $podl == 777 ) )
		$html.= "<tr>
					<td colspan='5' size='15' align='left'>- По конкурсу</td>
					<td  width='15' > $seli_budjet</td>
				</tr>
				<tr>
					<td colspan='5' size='15' align='left'>Мест в общежитии</td>
					<td  width='15' > $mest_host_rest_for_2tur</td>
				</tr>
				<tr>
					<td colspan='5' size='15' align='left'>Осталось мест в конкурсной группе</td>
					<td  width='15' > $mest_rest_for_2tur</td>
				</tr>";
	else 
		$html.= "<tr>
				<td>
				</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>Осталось мест в конкурсной группе</td>
				<td  width='15' > $mest_rest</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>Мест в общежитии</td>
				<td  width='15' > $mest_host</td>
			</tr>
			<tr>
				<td colspan='5' size='15' align='left'>Осталось мест в общежитии</td>
				<td  width='15' > $mest_host_rest</td>
			</tr>";
}
}
$html .= "</table><table border='1' style='text-align:center; font-family: Verdana; font-size: 7px;'>";
if( $podl == 0 )
$html .= "<tr>
			<td colspan='9' align=center family='TimesNewRomanPSMT' size='7'><b>СПИСОК РЕКОМЕНДОВАННЫХ</b></td>
		</tr>";
$html .= "<tr>
	<td rowspan='2' align='center' width='9'><b>№<br> п/п</b></td>
	<td rowspan='2' align='center' width='30'><b>ФИО</b></td>
	<td rowspan='2' align='center' width='10'><b>Сумма<br>баллов</b></td>
	<td rowspan='2' align='center' width='15'><b>Приоритет</b></td>
	<td rowspan='2' align='center' width='11'><b>Медаль</b></td>
	<td rowspan='2' align='center'><b>Документ</b></td>
	<td colspan='2' align='center' width='27'><b>Общежитие</b></td>
	<td rowspan='2' align='center' width='10' ><b>№ л.д.</b></td>
</tr>
<tr>
	<td align='center'><b>Требуется</b></td>
	<td align='center'><b>Выделено</b></td>
</tr>";
if ( ( $nab == 5 ) || ( $nab == 6 ) ){
	if ( $nab == 5 )
		$kat = '21,23,32';
	else
		$kat = '21,23';
	$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID, abi_id, kategor, spccodenew, spcname
			FROM ABIVIEW_PODVAL_24
			WHERE CON_ID='$id_con' AND KATEGOR IN ($kat) and tur_fix = $tur 
			ORDER BY KATEGOR, decode( kategor, 32, spccodenew, null ), BALL DESC, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
//	$html .= "<tr><td colspan=9>$sql</td></tr>";
	$cur=ora_do($conn,$sql);
	$num=0;	
	$KATEGORIA_OLD='ned';
	$addspc = '';
	for ($i=0;$i<ora_numrows($cur);$i++){
		$num=$num+1;
		$ABI_NUMBER		= ora_getcolumnnbsp($cur,0);
		$LASTNAME		= ora_getcolumnnbsp($cur,1);
		$FIRSTNAME		= ora_getcolumnnbsp($cur,2);
		$PATRONYMIC		= ora_getcolumnnbsp($cur,3);
		$HOST			= ora_getcolumnnbsp($cur,4);
		$TAWNAME_SMALL	= ora_getcolumnnbsp($cur,5);
		$KATEGORIA		= ora_getcolumnnbsp($cur,6);
		$DOC			= ora_getcolumnnbsp($cur,7);
		$PRIORITET		= ora_getcolumnnbsp($cur,8);
		$BALL			= ora_getcolumnnbsp($cur,9);
		$PRIKAZ			= ora_getcolumnnbsp($cur,10);
		$OJID			= ora_getcolumnnbsp($cur,11);
		$abi_id			= ora_getcolumnnbsp($cur,12);
		$kategor		= ora_getcolumnnbsp($cur,13);
		$spccodenew		= ora_getcolumnnbsp($cur,14);
		$spcname		= ora_getcolumnnbsp($cur,15);
		if($KATEGORIA_OLD!=$KATEGORIA){
			$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA</td></tr>";
			$KATEGORIA_OLD=$KATEGORIA;	
		}
		if( ( $spccodenew != $addspc ) && ( $kategor == 32 ) )
		{
			$addspc = $spccodenew;
			if( strlen( "$spccodenew $spcname" ) >= 90 )
				$null = '.';
			$html.= "<tr>
						<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>$spccodenew $spcname</br>$null</td>
					</tr>";
		}
		$col='#ffffff';
		$html .= "<tr bgcolor='$col'>
						<td align='center' family='TimesNewRomanPSMT' width='10' size='10'>$num</td>
						<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>
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
		ora_fetch($cur);		
	}
}
/*
else if ($nab!='3'){
	if ($podl==1){
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
				FROM ABIVIEW_PODVAL_24
				WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) AND DOC='Подл' and tur_fix = $tur 
				ORDER BY KATEGOR,BALL DESC, LASTNAME";
	}
	else{
		$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
				FROM ABIVIEW_PODVAL_24
				WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) and tur_fix = $tur 
				ORDER BY KATEGOR,BALL DESC, LASTNAME";
	}
//	$html .= "<tr><td colspan=9>$sql</td></tr>";
	$cur=ora_do($conn,$sql);
	$num=0;	
	$KATEGORIA_OLD='ned';
	for ($i=0;$i<ora_numrows($cur);$i++){
		$num=$num+1;
		$ABI_NUMBER = ora_getcolumnnbsp($cur,0);
		$LASTNAME = ora_getcolumnnbsp($cur,1);
		$FIRSTNAME = ora_getcolumnnbsp($cur,2);
		$PATRONYMIC = ora_getcolumnnbsp($cur,3);
		$HOST = ora_getcolumnnbsp($cur,4);
		$TAWNAME_SMALL = ora_getcolumnnbsp($cur,5);
		$KATEGORIA = ora_getcolumnnbsp($cur,6);
		$DOC = ora_getcolumnnbsp($cur,7);
		$PRIORITET = ora_getcolumnnbsp($cur,8);
		$BALL = ora_getcolumnnbsp($cur,9);
		$PRIKAZ = ora_getcolumnnbsp($cur,10);
		$OJID = ora_getcolumnnbsp($cur,11);
		if($KATEGORIA_OLD!=$KATEGORIA){
			$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA</td></tr>";
			$KATEGORIA_OLD=$KATEGORIA;	
		}	
		$col='#ffffff';
		$html .= "<tr bgcolor='$col'>
						<td align='center' family='TimesNewRomanPSMT' width='10' size='10'>$num</td>
						<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>
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
		ora_fetch($cur);		
	}
}
else if ($nab=='3'){
	if ($podl==1){
	$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
			FROM ABIVIEW_PODVAL_24
			WHERE CON_ID='$id_con' AND (TNABOR=3) AND KATEGOR IN (21,23) AND DOC='Подл' and tur_fix = $tur 
			ORDER BY KATEGOR,BALL DESC, LASTNAME";
	}
	else{
	$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
			FROM ABIVIEW_PODVAL_24
			WHERE CON_ID='$id_con' AND (TNABOR=3) AND KATEGOR IN (21,23) and tur_fix = $tur 
			ORDER BY KATEGOR,BALL DESC, LASTNAME";
	}
//	$html .= "<tr><td colspan=9>$sql</td></tr>";
	$cur=ora_do($conn,$sql);
	$num=0;	
	$KATEGORIA_OLD='ned';
	for ($i=0;$i<ora_numrows($cur);$i++){			
		$num=$num+1;
		$ABI_NUMBER = ora_getcolumnnbsp($cur,0);
		$LASTNAME = ora_getcolumnnbsp($cur,1);
		$FIRSTNAME = ora_getcolumnnbsp($cur,2);
		$PATRONYMIC = ora_getcolumnnbsp($cur,3);
		$HOST = ora_getcolumnnbsp($cur,4);
		$TAWNAME_SMALL = ora_getcolumnnbsp($cur,5);
		$KATEGORIA = ora_getcolumnnbsp($cur,6);
		$DOC = ora_getcolumnnbsp($cur,7);
		$PRIORITET = ora_getcolumnnbsp($cur,8);
		$BALL = ora_getcolumnnbsp($cur,9);
		$PRIKAZ = ora_getcolumnnbsp($cur,10);
		$OJID = ora_getcolumnnbsp($cur,11);
		if($KATEGORIA_OLD!=$KATEGORIA){
			$html.= "<tr><td colspan='99' family='TimesNewRomanPS-BoldMT' size='12' align='left'>$KATEGORIA</td></tr>";
			$KATEGORIA_OLD=$KATEGORIA;	
		}	
		$col='#ffffff';
		$html .= "<tr bgcolor='$col'>
						<td align='center' family='TimesNewRomanPSMT' width='10' size='10'>$num</td>
						<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>
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
		ora_fetch($cur);		
	}
}
*/
/*
if ( $tur == 2 ) // для проверки подсчета на 2 тур
	$table = 'ABIVIEW_PODVAL_242TUR';
else
*/
/*
if ( $nab == 3 )
	$table = 'ABIVIEW_PODVAL_for_comm';
else*/
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
			$sql = "select abi_number, lastname, firstname, patronymic, host, tawname_small, kategoria, doc, ball, kategor, 
						color, decode(prioritet,1,1,4,2,7,3), prikaz, ojid, spccodenew, spcname, proname, ufao, abi_id
					from $table 
					where con_id = '$id_con' 
						and tnabor = '$nab'
						and kategor in ( $kat ) 
						and doc = 'Подл' 
						and tur_fix = $tur 
						$ufao 
					$orderby";
		else
			$sql = "select abi_number, lastname, firstname, patronymic, host, tawname_small, kategoria, doc, ball, kategor, 
						color, decode(prioritet,1,1,4,2,7,3), prikaz, ojid, spccodenew, spcname, proname, ufao, abi_id
					from $table 
					where con_id = '$id_con' 
						and tnabor = '$nab'
						and kategor in ( $kat ) 
						and tur_fix = $tur 
						$ufao 
					$orderby";
	}
	else
		$sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0), KATEGOR, OJID 
				FROM ABIVIEW_PODVAL_26 
				WHERE CON_ID='$id_con' 
					AND (TNABOR='$nab') 
				ORDER BY KATEGOR, NVL(BALL,0) desc, LASTNAME";		
//	$html .= "<tr><td colspan=9>$sql</td></tr>";
	$cur		= ora_do( $conn, $sql );
	$BALL16_OLD	= 'ned';
	$KATEGOR_OLD= 'ned';
	$switchhh	= 0;
	$addspc		= '';
	for ( $i = 0; $i < ora_numrows( $cur ); $i++ )
	{			
		$null = '';
		$num = $num + 1;
		$ABI_NUMBER		= ora_getcolumnnbsp($cur,0);
		$LASTNAME		= ora_getcolumnnbsp($cur,1);
		$FIRSTNAME		= ora_getcolumnnbsp($cur,2);
		$PATRONYMIC		= ora_getcolumnnbsp($cur,3);
		$HOST			= ora_getcolumnnbsp($cur,4);
		$TAWNAME_SMALL	= ora_getcolumnnbsp($cur,5);
		$KATEGORIA		= ora_getcolumnnbsp($cur,6);
		$DOC			= ora_getcolumnnbsp($cur,7);
		$BALL16			= ora_getcolumnnbsp($cur,8);
		$KATEGOR		= ora_getcolumnnbsp($cur,9);
		$COLOR			= ora_getcolumnnbsp($cur,10);
		$PRIORITET		= ora_getcolumnnbsp($cur,11);
		$PRIKAZ			= ora_getcolumnnbsp($cur,12);
		$OJID			= ora_getcolumnnbsp($cur,13);
		$spccodenew		= ora_getcolumnnbsp($cur,14);
		$spcname		= ora_getcolumnnbsp($cur,15);
		$proname		= ora_getcolumnnbsp($cur,16);
		$ufao			= ora_getcolumnnbsp($cur,17);
		$abi_id			= ora_getcolumnnbsp($cur,18);
		if ($nab=='3')
		{
			if($KATEGOR!=$KATEGOR_OLD)
			{
				$KATEGOR_OLD=$KATEGOR;
				switch($KATEGOR)
				{
					case 23:
						$html.= "<tr>
									<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Вне конкурса</td>
								</tr>";
						break;
					case 29:
						if ($tur!='3')
							$html.= "<tr>
										<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Рекомендованные к зачислению</td>
									</tr>";
						else
							$html.= "<tr>
										<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td>
									</tr>";
						break;
					case 31:
						$html.= "<tr>
									<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td>
								</tr>";
						break;
					case 33:
						$html.= "<tr>
									<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся коммерческие места</td>
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
										<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Рекомендованные к зачислению</td>
									</tr>";
						else
							$html.= "<tr>
										<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td>
									</tr>";
						break;
					case 31:
						$html.= "<tr>
									<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td>
								</tr>";
						break;
					case 33:
						$html.= "<tr>
									<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td>
								</tr>";
						break;
					case 35:
						$html.= "<tr>
									<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>Участники конкурса на оставшиеся бюджетные места</td>
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
						<td colspan='99' family='TimesNewRomanPS-BoldMT' size=12 align='left'>$spccodenew $spcname</br>$null</td>
					</tr>";
		}
/*		if ($COLOR==1)
			$col='#eeeeee';
		else*/
			$col='#ffffff';
		$html .= "<tr bgcolor='$col'>
					<td align='center' family='TimesNewRomanPSMT' size='10'>$num</td>
					<td align='left' width='90'>$LASTNAME $FIRSTNAME $PATRONYMIC</td>
					<td align='center'>$BALL16</td>
					<td align='center'>$PRIORITET</td>
					<td align='center'>$TAWNAME_SMALL</td>
					<td align='center'>$DOC</td>
					<td align='center'>$HOST</td>
					<td align='center' size='9'>$OJID</td>";
		if ( $PRIORITET != 1 )
			$html .= "<td align='center' valign='bottom' size='7'>$ABI_NUMBER</td>";
		else
			$html .= "<td align='center'></td>";
		$html .="</tr>";
		ora_fetch($cur);		
	}	
}
$html .= "</table>";
define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');

$p = new PDFTable();
$p->AddPage('P');
$p->SetMargins(10,10,10);
$p->AddFont('TimesNewRomanPSMT','','times.php');  
$p->AddFont('TimesNewRomanPS-BoldMT','','timesbd.php');
$p->SetFont('TimesNewRomanPSMT','',14); 
$p->htmltable($html);
$p->output('','I');
?>