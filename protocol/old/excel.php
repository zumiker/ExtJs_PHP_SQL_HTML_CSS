<?php
require_once 'Spreadsheet/Excel/Writer.php';

function ora_getcolumnnbsp($cur,$pos){
	if (ora_getcolumn($cur,$pos)==' ')
		return " "; 
	else
		return ora_getcolumn($cur,$pos);
}
$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
if(isset($_GET['id_fac'])){
	$id_fac=$_GET['id_fac'];
	$sql1="FACID='$id_fac' ";
}
if(isset($_GET['id_con'])){
	$id_con=$_GET['id_con'];
	$sql1.="CON_ID='$id_con' ";
}
if(isset($_GET['nabor'])){
	$nab = $_GET['nabor'];
	if($nab=='1'){
		$name='бюджетный набор';
		$sql3=" AND (TNABOR=1 OR TNABOR=8)";
	}
	if($nab=='2'){
		$name='целевой набор';
		$sql3=" AND TNABOR=2";
	}
	if($nab=='3'){
		$name='коммерческий набор';
		$sql3=" AND (TNABOR=3 OR TNABOR=8)";
	}
	if($nab=='4'){
		$name='контракт';
		$sql3=" AND TNABOR=4";
	}
	if ( ($nab=='5') || ($nab=='6') )
		$name='бюджетный набор';
}
if(isset($_GET['podl'])){
	$podl=$_GET['podl'];
	if ($podl==1){
		$sql3.=" AND DOC='Подл'";
		$doc="подлинники";
	}
	else 
		$doc="";
}	
if(isset($_GET['tur'])){
	$tur=$_GET['tur'];
	$sql4 = $sql3;
	$sql3 .=" AND TUR='$tur'";
}
$sql="SELECT CONGROUP,MEST_HOST, quaid FROM ABI_CONGROUP WHERE ID_CON=$id_con";
$cur=ora_do($conn,$sql);
for ($i=0;$i<ora_numrows($cur);$i++){
	$CONGROUP=ora_getcolumn($cur,0);
	$MEST=ora_getcolumn($cur,1);
	$quaid=ora_getcolumn($cur,2);
}


$sql="SELECT SPCNAME, SPCBRIFE, SPCCODENEW, ID_SPEC FROM ABIVIEW_CON_SPEC WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";
$cur=ora_do($conn,$sql);
$date = date("d.m.y H:i");

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// sending HTTP headers
$workbook->send('protokol.xls');

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('protokol');
$worksheet->setMargins_LR(0);
$worksheet->setMarginBottom(0.8);
$worksheet->setMarginTop(0);
$worksheet->setFooter('стр.&P');

$titleFormat =& $workbook->addFormat(); 
$titleFormat->setFontFamily('Helvetica'); 
$titleFormat->setSize('10'); 
$titleFormat->setColor('navy'); 
//$titleFormat->setTextRotation(270);
$titleFormat->setBottom(2); 
$titleFormat->setLeft(2); 
$titleFormat->setRight(2); 
$titleFormat->setBottomColor('navy'); 
$titleFormat->setAlign('merge'); 
$titleFormat->setTextWrap(1); 

$format =& $workbook->addFormat();
$format->setFontFamily('Helvetica'); 
$format->setAlign('center'); 
$format->setSize('10');
$format->setTop(1); 
$format->setBottom(1); 
$format->setLeft(1); 
$format->setRight(1);
$format->setTextWrap(1);

$format_bold_13 =& $workbook->addFormat();
$format_bold_13->setFontFamily('Helvetica'); 
$format_bold_13->setAlign('right'); 
$format_bold_13->setSize('10');
$format_bold_13->setBold();

$format_bold_12 =& $workbook->addFormat();
$format_bold_12->setFontFamily('Helvetica'); 
$format_bold_12->setAlign('center'); 
$format_bold_12->setSize('10');
$format_bold_12->setBold();

$format_bold =& $workbook->addFormat();
$format_bold->setFontFamily('Helvetica'); 
$format_bold->setAlign('left'); 
$format_bold->setSize('10');
$format_bold->setBold();

$format_11 =& $workbook->addFormat();
$format_11->setFontFamily('Helvetica'); 
$format_11->setAlign('left'); 
$format_11->setSize('10');

$format_12 =& $workbook->addFormat();
$format_12->setFontFamily('Helvetica'); 
$format_12->setAlign('center'); 
$format_12->setSize('10');

$format_13 =& $workbook->addFormat();
$format_13->setFontFamily('Helvetica'); 
$format_13->setAlign('right'); 
$format_13->setSize('10');

if ( ($nab == 5) || ($nab == 6) || ( ( $nab == '1' ) && ( ( $podl == 1 ) || ( $podl == 777 ) ) ) ){
	$worksheet ->write($n,1, "Протокол по зачислению на 1 курс РГУ нефти и газа имени И. М. Губкина на $date",$format_bold);
	$n++;
	$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet
			from ABI_SHAPKA_PROTOKOL
			where con_id = $id_con
				and nabor_13 = 1";
	if ( $podl == 777 )
	{
		$zach = 'Зачислено';
		$worksheet ->write($n,1, "Списки участников конкурса для зачисления на оставшиеся бюджетные места",$format_bold);
		$n++;
	}
	else
		$zach = 'Подлежат зачислению';
}
else{
	$worksheet ->write($n,1, "Протокол рекомендованных к зачислению на 1 курс РГУ нефти и газа имени И. М. Губкина на $date",$format_bold);
	$n++;
	$worksheet ->write($n,3, $tur.' этап',$format_bold_12);
	$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet
			from ABI_SHAPKA_PROTOKOL
			where con_id = $id_con
				and nabor_13 = $nab";
	$zach = 'Зачислено';
}
$n++;
$worksheet ->write($n,1, "$CONGROUP   ($name $doc)",$format_bold);
$n++;
if ( $quaid == 1 )
	$worksheet ->write($n,1, 'специальности: ',$format_bold); 
else if ( $quaid == 2 )
	$worksheet ->write($n,1, 'направления: ',$format_bold);
$n++;
/*
//if ($id_con==251 || $id_con==252)
if ($id_con==251 || $id_con==250)
{
$worksheet ->write($n,5, 'очно-заочная',$format_bold); 
$n++;
$worksheet ->write($n,5, 'форма обучения',$format_bold);
}
else
	$worksheet ->write($n,5, 'очная форма обучения',$format_bold); 
$n++;
$worksheet ->write($n,5, $doc,$format_bold); 
$n++;
*/
$worksheet->setColumn(0,0,9);
$worksheet->setColumn(0,1,4);
$worksheet->setColumn(0,2,2);
$worksheet->setColumn(0,3,40);
$worksheet->setColumn(0,4,5);
$worksheet->setColumn(0,5,6);
$worksheet->setColumn(0,6,9);
$worksheet->setColumn(0,7,12);
$worksheet->setColumn(0,8,14);


for ($i=0;$i<ora_numrows($cur);$i++){
	$SPCNAME = ora_getcolumnnbsp($cur,0);
	$SPCBRIFE = ora_getcolumnnbsp($cur,1);
	$SPCCODE = ora_getcolumn($cur,2);
	$ID_SPEC = ora_getcolumn($cur,3);
/*
	if ($CONGROUP=='Конкурсная группа 13'){
		if ($nab==1){
			if ($ID_SPEC!=228 && $ID_SPEC!=229){
				$n++;	
				$worksheet ->write($n,1, $SPCBRIFE,$frmt); 
				$worksheet ->write($n,2, $SPCNAME,$frmt); 
				$worksheet ->write($n,0, $SPCCODE,$frmt); 
			}
		}
		else{
			$n++;	
			$worksheet ->write($n,1, $SPCBRIFE,$frmt); 
			$worksheet ->write($n,2, $SPCNAME,$frmt); 
			$worksheet ->write($n,0, $SPCCODE,$frmt); 
		}
	}
	else{
		$n++;	
		$worksheet ->write($n,1, $SPCBRIFE,$frmt); 
		$worksheet ->write($n,2, $SPCNAME,$frmt); 
		$worksheet ->write($n,0, $SPCCODE,$frmt); 
	}
*/
	$worksheet ->write($n,1, $SPCBRIFE,$frmt); 
	$worksheet ->write($n,2, $SPCNAME,$frmt); 
	$worksheet ->write($n,0, $SPCCODE,$frmt); 
	ora_fetch($cur);		
}
$n = $n + 2;
/*
$worksheet ->write($n,1, 'следующих абитуриентов: ',$format_bold); 
$n++;

$sql="SELECT VSEGO, HOST FROM ABI_PODVAL_2 WHERE  CON_ID='$id_con' $sql3";
$cur=ora_do($conn,$sql);
$VSEGO2 = ora_getcolumnnbsp($cur,0);
$HOST = ora_getcolumnnbsp($cur,1);	

$sql="SELECT  NEUD FROM ABI_PODVAL_4 WHERE  CON_ID='$id_con' $sql3";
$cur=ora_do($conn,$sql);

$NEUD = ora_getcolumnnbsp($cur,0);	
$VIDERJALI=$VSEGO2-$NEUD;
$sql="SELECT MUJ,JEN FROM ABI_PODVAL_3 WHERE  CON_ID='$id_con' $sql3";
$cur=ora_do($conn,$sql);
$MUJ = ora_getcolumnnbsp($cur,0);
$JEN = ora_getcolumnnbsp($cur,1);	

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

//$viderjali = $VSEGO - $NEUD;
// $n++;
// $worksheet ->write($n,1, 'Всего мест в конкурсной группе',$titleFormat1);
// $worksheet ->write($n,5, $MEST_BUD,$titleFormat1);
// $n++;
// $worksheet ->write($n,1, 'Из них с общежитием',$titleFormat1);
// $worksheet ->write($n,5, $MEST_BUD_host,$titleFormat1);
// $n++;
// $worksheet ->write($n,1, 'Всего подано заявлений',$titleFormat1);
// $worksheet ->write($n,5, $VSEGO2,$titleFormat1);
// $n++;
// $worksheet ->write($n,1, 'Конкурс по заявлениям',$titleFormat1);
// $worksheet ->write($n,5, $tmp,$titleFormat1);

// $sql = "SELECT  VSEGO, HOST, SOBESED, 
// PODTV, OTL, VNEKON FROM ABI_PODVAL_1 WHERE CON_ID= '$id_con' $sql3";
// $cur=ora_do($conn,$sql);
// $VSEGO = ora_getcolumnnbsp($cur,0);
// $HOST= ora_getcolumnnbsp($cur,1);
// $SOBESED= ora_getcolumnnbsp($cur,2);
// $PODTV= ora_getcolumnnbsp($cur,3);
// $OTL= ora_getcolumnnbsp($cur,4);
// $VNEKON= ora_getcolumnnbsp($cur,5);

// $n++;
// $worksheet ->write($n,1, 'Подлежат обязательному зачислению',$titleFormat1);
// $worksheet ->write($n,5, $VSEGO,$titleFormat1);		
// $n++;
// $worksheet ->write($n,3, 'из них с общежитием',$titleFormat1);
// $worksheet ->write($n,5, $HOST,$titleFormat1);
// $n++;
// $worksheet ->write($n,3, 'победители олимпиад',$titleFormat1);
// $worksheet ->write($n,5, $HOST,$titleFormat1);		
// $n++;
// $worksheet ->write($n,3, 'вне конкурса',$titleFormat1);
// $worksheet ->write($n,5, $VNEKON,$titleFormat1);

// $n++;
// $worksheet ->write($n,1, 'Всего мужчин',$titleFormat1);
// $worksheet ->write($n,5, $MUJ,$titleFormat1);
// $n++;
// $worksheet ->write($n,1, 'Всего женщин',$titleFormat1);
// $worksheet ->write($n,5, $JEN,$titleFormat1);
// $n++;

// $KONK=($VIDERJALI/$MEST_BUD);
// $KONK =  number_format($KONK, 1, '.', '');
// $MEST=$MEST_BUD-$VSEGO;
// $KONK=($VIDERJALI-$SOBESED)/($MEST_BUD-$SOBESED);
// $KONK =  number_format($KONK, 1, '.', '');
//	$worksheet ->write($n,1, 'Без вступительных испытаний',$format_bold); 
//	$n++;
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
$worksheet ->write($n,1, 'Всего мест в конкурсной группе',$format_bold); 
$worksheet ->write($n++,4, $mest,$format_bold);
$worksheet ->write($n,1, 'Всего подано заявлений',$format_bold); 
$worksheet ->write($n++,4, $vsego,$format_bold); 
$worksheet ->write($n,1, 'Всего мужчин',$format_bold); 
$worksheet ->write($n++,4, $mmm,$format_bold);
$worksheet ->write($n,1, 'Всего женщин',$format_bold); 
$worksheet ->write($n++,4, $www,$format_bold); 
$worksheet ->write($n,1, 'Конкурс по заявлениям',$format_bold); 
$worksheet ->write($n++,4, $konkurs_big,$format_bold);
$n++;
$worksheet ->write($n++,1, "$zach",$format_bold);
$worksheet ->write($n,1, '- Без вступительных испытаний',$format_bold); 
$worksheet ->write($n++,4, $bez_ekzam,$format_bold);
$worksheet ->write($n,1, '- Особые права',$format_bold); 
$worksheet ->write($n++,4, $vnekon,$format_bold); 
$worksheet ->write($n,1, '- Целевой набор',$format_bold); 
$worksheet ->write($n++,4, $tcelevik,$format_bold); 
if ( ($nab != 5) && ($nab != 6) ){
	if( ( $tur == 2 ) || ( $podl == 777 ) ){
		$worksheet ->write($n,1, '- По конкурсу',$format_bold);
		$worksheet ->write($n++,4, $seli_budjet,$format_bold);
		$n++;
		$worksheet ->write($n,1, 'Осталось мест в конкурсной группе',$format_bold);
		$worksheet ->write($n++,4, $mest_rest_for_2tur,$format_bold);
		$worksheet ->write($n,1, 'Осталось мест в общежитии',$format_bold); 
		$worksheet ->write($n,4, $mest_host_rest_for_2tur,$format_bold); 
		$worksheet ->write($n++,5, '(предоставляется по факту зачисления)',$format_bold); 
	}
	else{
		$n++;
		$worksheet ->write($n,1, 'Осталось мест в конкурсной группе',$format_bold);
		$worksheet ->write($n++,4, $mest_rest,$format_bold);
		$worksheet ->write($n,1, 'Мест в общежитии',$format_bold); 
		$worksheet ->write($n++,4, $mest_host,$format_bold); 
		$worksheet ->write($n,1, 'Осталось мест в общежитии',$format_bold); 
		$worksheet ->write($n,4, $mest_host_rest,$format_bold); 
//		$worksheet ->write($n++,5, '(предоставляется по факту зачисления)',$format_bold); 
	}
	$n++;
}
}
if ( ( $nab == 5 ) || ( $nab == 6 ) ){
	if ( $nab == 5 )
		$kat = '21,23,32';
	else
		$kat = '21,23';
	$sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
			FROM ABIVIEW_PODVAL_24
			WHERE CON_ID='$id_con'
				AND KATEGOR IN ($kat)
				and tur_fix = $tur 
			ORDER BY KATEGOR,BALL DESC, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
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
			$n++;
			$worksheet ->write($n,1, $KATEGORIA,$format_bold);
			$n=$n+2;
			$worksheet ->write($n,1, '№',$format_bold);
			$worksheet ->write($n,3, 'ФИО',$format_bold);
			$worksheet ->write($n,5, 'Балл',$format_bold);
			$worksheet ->write($n,6, 'Аттестат',$format_bold_12);
			$worksheet ->write($n,7, 'Общежитие',$format_bold_13);
//			$worksheet ->write($n,8, 'Рекомендован',$format_bold_13);
			$n++;
			$KATEGORIA_OLD=$KATEGORIA;	
		}
		$worksheet ->write($n,1, $num,$titleFormat1);
		$worksheet ->write($n,3, "$LASTNAME $FIRSTNAME $PATRONYMIC",$titleFormat1);
		$worksheet ->write($n,5, $BALL,$format_11);
		$worksheet ->write($n,6, $DOC,$format_12);
//		if ( $HOST == 'Д' && $nab == 1 )
		if ( $OJID == 'Д' && $nab == 1 )
			$worksheet ->write($n,7, 'Общежитие',$format_12);
		else
			$worksheet ->write($n,7, '',$format_12);
//		$worksheet ->write($n,8, 'Рекомендован',$format_12);
		$n++;
		ora_fetch($cur);		
	}
}
/*
if ($podl==1){
$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR 
		FROM ABIVIEW_PODVAL_24 
		WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) AND DOC='Подл' and tur_fix = $tur 
		ORDER BY KATEGOR,BALL DESC, LASTNAME";
}
else{
$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR 
		FROM ABIVIEW_PODVAL_24 
		WHERE CON_ID='$id_con' AND (TNABOR='$nab') AND KATEGOR IN (21,23) and tur_fix = $tur 
		ORDER BY KATEGOR,BALL DESC, LASTNAME";
}
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
	//$KATEGORIA = substr($KATEGORIA,11);
	$DOC = ora_getcolumnnbsp($cur,7);
	$BALL = ora_getcolumnnbsp($cur,8);
	$KATEGOR = ora_getcolumnnbsp($cur,9);
	if($KATEGORIA_OLD!=$KATEGORIA){
		$n++;
		$worksheet ->write($n,1, $KATEGORIA,$format_bold);
		$n=$n+2;
		$worksheet ->write($n,1, '№',$format_bold);
		$worksheet ->write($n,3, 'ФИО',$format_bold);
		$worksheet ->write($n,5, 'Балл',$format_bold);
		$worksheet ->write($n,6, 'Аттестат',$format_bold_12);
		$worksheet ->write($n,7, 'Общежитие',$format_bold_13);
		$worksheet ->write($n,8, 'Рекомендован',$format_bold_13);
		$n=$n+2;
		$KATEGORIA_OLD=$KATEGORIA;	
	}	
	$col='#ffffff';
	$worksheet ->write($n,1, $num,$titleFormat1); 
	$worksheet ->write($n,3, $LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC,$titleFormat1); 
	if($KATEGOR!=21)
		$worksheet ->write($n,5, $BALL,$format_11);
	$worksheet ->write($n,6, $DOC,$format_12); 
	if ( $HOST == 'Д' && $nab == 1 )
		$worksheet ->write($n,7, 'Общежитие',$format_12);
	else
		$worksheet ->write($n,7, '',$format_12);
	$worksheet ->write($n,8, 'Рекомендован',$format_12);
	$n++;
	ora_fetch($cur);		
}
*/
/*
if ( $tur == 2 ) // для проверки подсчета на 2 этап
	$table = 'ABIVIEW_PODVAL_242TUR';
else
*/
/*
if ( $nab == 3 )
	$table = 'ABIVIEW_PODVAL_for_comm';
else*/
	$table = 'ABIVIEW_PODVAL_24';

for ($j=0;$j<=0;$j++){
	if($j==0){
		if ( $nab == 2 )
			$kat = 32;
		else if ( $nab == 3 )
			$kat = '23, 29, 31';
		else if ( $podl == 777 )
			$kat = '33';
		else// if ( $tur == 2 )
			$kat = '29, 33';
//			$kat = '29, 31';
/*		else
			$kat = '29, 31';*/
		if ($podl==1){
			$sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, decode(PRIORITET,1,1,4,2,7,3), PRIKAZ, OJID 
					FROM $table 
					WHERE  CON_ID='$id_con'
						AND TNABOR='$nab'
						AND KATEGOR in ( $kat )
						AND DOC='Подл'
						and tur_fix = $tur 
					ORDER BY KATEGOR, BALL desc, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
		}
		else{
			$sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, decode(PRIORITET,1,1,4,2,7,3), PRIKAZ, OJID 
					FROM $table 
					WHERE  CON_ID='$id_con'
						AND TNABOR='$nab'
						AND KATEGOR in ( $kat )
						and tur_fix = $tur 
					ORDER BY KATEGOR, BALL desc, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
		}
	}
	else{
		$sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0), KATEGOR, OJID 
				FROM ABIVIEW_PODVAL_26 
				WHERE  CON_ID='$id_con'
					AND TNABOR='$nab'
				ORDER BY KATEGOR, NVL(BALL,0) desc, LASTNAME";		
	}
	$cur=ora_do($conn,$sql);
	$BALL16_OLD='ned';
	$KATEGOR_OLD='ned';
	$switchhh=0;
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
		$BALL16 = ora_getcolumnnbsp($cur,8);
		$KATEGOR = ora_getcolumnnbsp($cur,9);
		$COLOR= ora_getcolumnnbsp($cur,10);
		$PRIORITET= ora_getcolumnnbsp($cur,11);
		$PRIKAZ= ora_getcolumnnbsp($cur,12);
		$OJID=ora_getcolumnnbsp($cur,13);
		if($KATEGOR!=$KATEGOR_OLD){
			$KATEGOR_OLD=$KATEGOR;
			switch($KATEGOR)
			{
				case 23:
					$worksheet ->write($n,1, 'Вне конкурса',$format_bold); 
					$n++;
					break;
				case 29:
					$n++;
					if ($tur!='3'){
						$worksheet ->write($n,1, 'Прошедшие по конкурсу',$format_bold); 
						$n++;
					}
					else{
						$worksheet ->write($n,1, 'Участники конкурса на оставшиеся бюджетные места',$format_bold); 
						$n++;
						$worksheet ->write($n,1, 'Завершение предоставления Документов - 20 августа, 17.00',$format_bold); 
						$n++;
						$worksheet ->write($n,1, 'Зачисление - 21 августа по сумме набранных баллов',$format_bold); 
						$n++;
					}
					break;
				case 31:
					$n++;
					if ($tur!='3'){
						$worksheet ->write($n,1, 'Выдержавшие вступительные испытания и претендующие на поступление',$format_bold); 
						$n++;
						if ($tur=='1')
						{
							if ( $nab == 3 )
								$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места (внебюджетный набор)',$format_bold); 
							else
								$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места после 1 этапа',$format_bold); 
						}
						else
							$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места после 2 этапа',$format_bold); 
						$n=$n+2;
					}
					else
						$worksheet ->write($n,1, 'Участники конкурса на оставшиеся бюджетные места',$format_bold); 
					break;
				case 33:
					$n++;
					$worksheet ->write($n,1, 'Выдержавшие вступительные испытания и претендующие на поступление',$format_bold); 
					$n++;
					if ($tur=='1')
						$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места после 1 этапа',$format_bold); 
					else
						$worksheet ->write($n,1, 'на 1-й курс университета на вакантные места после 2 этапа',$format_bold); 
					$n=$n+2;
					break;
			}
			$n++;
			$worksheet ->write($n,1, '№',$format_bold);
			$worksheet ->write($n,3, 'ФИО',$format_bold);
			$worksheet ->write($n,5, 'Балл',$format_bold);
			$worksheet ->write($n,6, 'Аттестат',$format_bold_12);
			$worksheet ->write($n,7, 'Общежитие',$format_bold_13);
			$worksheet ->write($n,8, 'Рекомендован',$format_bold_13);
			$n=$n+2;
		}
		if ($COLOR==1)
			$col='#eeeeee';
		else
			$col='#ffffff';
		$worksheet ->write($n,1, $num,$titleFormat1); 
		$worksheet ->write($n,3, $LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC,$titleFormat1); 
		$worksheet ->write($n,5, $BALL16,$format_11); 
		$worksheet ->write($n,6, $DOC,$format_12); 
//		if ( $HOST == 'Д' && $nab == 1 )
		if ( $OJID == 'Д' && $nab == 1 )
			$worksheet ->write($n,7, 'Общежитие',$format_12);
		else
			$worksheet ->write($n,7, '',$format_12);
		if ( ( $KATEGOR != 31 ) && ( $KATEGOR != 33 ) )
			$worksheet ->write($n,8, 'Рекомендован',$format_12);
		$n++;
		ora_fetch($cur);		
	}
}
//$worksheet->hideGridLines();
$workbook->close();
?>