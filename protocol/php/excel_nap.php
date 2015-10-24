<?
require_once("../include.php");



$fac=$_REQUEST['fac'];
$tur=$_REQUEST['tur'];
$id_con=$_REQUEST['group'];
$nab=$_REQUEST['rep'];
$vub=$_REQUEST['vub'];
$tur++;
$length=40;

$sql1.="CON_ID='$id_con' ";
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
		$name= 'бюджетный набор';
		$sql3 = " AND (TNABOR='3' OR TNABOR='8')";
	}


	$podl=$_REQUEST['podl'];
	if ( ( $podl == 1 ) || ( $podl == 2 ) ){
		$sql5=" AND DOC='Подл'";
		$doc=', подлинники';
	}
	else 
	{
		$doc="";
		
	}
		

	
	$sql4 = $sql3;
	$sql3 .=" AND TUR=$tur";
	
$sql= "SELECT CONGROUP,MEST_HOST FROM ABI_CONGROUP WHERE ID_CON=$id_con";

$cur=execq($sql);

foreach($cur as $k=>$row){
	$CONGROUP	= $row['CONGROUP'];
	$MEST		= $row['MEST_HOST'];
}

$sql="SELECT SPCNAME, SPCBRIFE, SPCCODENEW, ID_SPEC FROM ABIVIEW_CON_SPEC WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";
$cur=execq($sql);
$date = date("d.m.y ");
$time = strtotime( date('d.m.Y H.i.s') );
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition:attachment; name= Протокол $time.xml");
	
echo '
	<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>АСУЦБ</Author>
  <LastAuthor>АСУЦБ</LastAuthor>
  <Created>'.$date.'</Created>
  <LastSaved>'.$date.'</LastSaved>
  <Version>14.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>4860</WindowHeight>
  <WindowWidth>9360</WindowWidth>
  <WindowTopX>150</WindowTopX>
  <WindowTopY>480</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial" x:CharSet="204" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s62">
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s63">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s67">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s69">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s70">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Font ss:FontName="Helvetica" x:CharSet="204"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s71">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Helvetica" x:CharSet="204"/>
   <Protection ss:Protected="0"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Протокол по зачислению">';
 if($tur=='1')
		$ttuurr = '1 этап';
		else
		$ttuurr = '2 этап';
 
$str='<Row>
    <Cell ss:Index="2" ss:MergeAcross="5" ss:StyleID="s63"><Data ss:Type="String">Протокол рекомендованных к зачислению на 1 курс </Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="5" ss:StyleID="s63"><Data ss:Type="String">РГУ нефти и газа имени И. М. Губкина на '.$date.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="4" ss:StyleID="s63"><Data ss:Type="String">'.$ttuurr.'</Data></Cell>
   </Row>';
   $length+=3;
$sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest from ABI_SHAPKA_PROTOKOL where con_id = $id_con and nabor_13 = $nab";
$zach = 'Зачислено';
$str.='   <Row>
    <Cell ss:Index="2" ss:MergeAcross="4" ss:StyleID="s63"><Data ss:Type="String">'.$CONGROUP.'   ('.$name.' '. $doc.')</Data></Cell>
   </Row>';
    $length++;
if ( $id_con == '1' || $id_con == '3' ){
	$str.='  <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s63"><Data ss:Type="String">специальности: </Data></Cell>
   </Row>';
    $length++;}
else{
	$str.='   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s63"><Data ss:Type="String">направления: </Data></Cell>
   </Row>';
    $length++;
   }
   $str.='<Row></Row>';
   $length++;
foreach($cur as $k=>$row)	{
	$SPCNAME	= $row['SPCNAME'];
	$SPCBRIFE	= $row['SPCBRIFE'];
	$SPCCODE	= $row['SPCCODE'];
	$ID_SPEC	= $row['ID_SPEC'];
	if ($CONGROUP=='Конкурсная группа 13'){
		if ($ID_SPEC!=228 && $ID_SPEC!=229){
			$str .=  '<Row>
    <Cell><Data ss:Type="String">'.$SPCCODE.'</Data></Cell>
    <Cell><Data ss:Type="String">'.$SPCBRIFE.'</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s65"><Data ss:Type="String">'.$SPCNAME.'</Data></Cell>
   </Row>';
    $length++;
		} 
	}
	else{
		$str .=  '	<Row>
						<Cell><Data ss:Type="String">'.$SPCCODE.'</Data></Cell>
						<Cell><Data ss:Type="String">'.$SPCBRIFE.'</Data></Cell>
						<Cell ss:MergeAcross="2" ss:StyleID="s65"><Data ss:Type="String">'.$SPCNAME.'</Data></Cell>
					</Row>';
					 $length++;
	}		
	}
	$str.='<Row></Row>';
   $length++;
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
$str.='<Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего мест в конкурсной группе</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$mest.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего подано заявлений</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$vsego.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего мужчин</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$mmm.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего женщин</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$www.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Конкурс по заявлениям</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$konkurs_big.'</Data></Cell>
   </Row>
   <Row>
   </Row>
   <Row >
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">'.$zach.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">- Без вступительных испытаний</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$bez_ekzam.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">- Вне конкурса</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$vnekon.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">- Целевой набор</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$tcelevik.'</Data></Cell>
   </Row>
      <Row>
   </Row>
   <Row >
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Осталось мест в конкурсной группе</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$mest_rest.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Мест в общежитии</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$mest_host.'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Осталось мест в общежитии</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">'.$mest_host_rest.'</Data></Cell>
   </Row>';
$length+=12;
   if ($podl==1){
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, PRIORITET, substr(KOD,1,2) as KOD 
					FROM ABIVIEW_PODVAL_24 
					WHERE  CON_ID='$id_con' AND (TNABOR='$nab')  AND KATEGOR IN (29,31)  AND DOC='Подл' and tur_fix = $tur 
					ORDER BY KATEGOR, BALL desc, LASTNAME";
		}
		else{
			$sql="SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, OJID, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, PRIORITET, substr(KOD,1,2) as KOD
					FROM ABIVIEW_PODVAL_24 
					WHERE  CON_ID='$id_con' AND (TNABOR='$nab')  AND KATEGOR IN (29,31) and tur_fix = $tur 
					ORDER BY KATEGOR, BALL desc, LASTNAME";
		}
	$cur=execq($sql,false);
	$BALL16_OLD='ned';
	$KATEGOR_OLD='ned';
	$switchhh = 0;
	$num = 0;


	
  
	foreach($cur as $k=> $row){
		$num = $num + 1;
		$ABI_NUMBER		= $row['ABI_NUMBER'];
		$LASTNAME		= $row['LASTNAME'];
		$FIRSTNAME		= $row['FIRSTNAME'];
		$PATRONYMIC		= $row['PATRONYMIC'];
		$HOST			= $row['HOST'];
		$TAWNAME_SMALL	= $row['TAWNAME_SMALL'];
		$KATEGORIA		= $row['KATEGORIA'];
		$DOC			= $row['DOC'];
		$PRIORITET		= $row['PRIORITET'];
		$BALL			= $row['BALL'];
		$PRIKAZ			= $row['PRIKAZ'];
		$OJID			= $row['OJID'];
		$abi_id			= $row['ABI_ID'];
		$kategor		= $row['KATEGOR'];
		$spccodenew		= $row['SPCCODENEW'];
		$spcname		= $row['SPCNAME'];
		$KOD			= $row['KOD'];		
	if($KATEGOR!=$KATEGOR_OLD){
	$KATEGOR_OLD=$KATEGOR;
	switch($KATEGOR)
	{
	case 29:{

	$str.= '		<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63">Прошедшие по конкурсу<Data ss:Type="String"></Data></Cell>
					</Row>';
					$length++;
		break;
	}	
	case 31;{
		$str.='		<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Выдержавшие вступительные испытания и претендующие на поступление</Data></Cell>
					</Row>';
					$length++;
		if ($tur=='1'){
			$str.= '		<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места после 1 этапа</Data></Cell>
					</Row>';
					$length++;}
		else{
			$str.='		<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места после 2 этапа</Data></Cell>
					</Row>';
					$length++;}
			break;
		
		}
		
		
		
		}
		 $str.= '<Row></Row><Row></Row>
		 <Row>
    <Cell ss:Index="2" ss:StyleID="s67"><Data ss:Type="String">№</Data></Cell>
	<Cell><Data ss:Type="String"></Data></Cell>
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:Index="6" ss:StyleID="s67"><Data ss:Type="String">Балл</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">Аттестат</Data></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="String">Общежитие</Data></Cell>
   </Row>';
   $length+=2;
		}
		if ($COLOR==1)
	$col='#eeeeee';
else
	$col='#ffffff';
		$str.= '
   <Row >
    <Cell ss:Index="2" ss:StyleID="s65"><Data ss:Type="Number">'.$num.'</Data></Cell>
	<Cell  ss:StyleID="s62"><Data ss:Type="String">'.$KOD.'</Data></Cell>
    <Cell><Data ss:Type="String">'.$LASTNAME.' '.$FIRSTNAME.' '.$PATRONYMIC.'</Data></Cell>
    <Cell ss:Index="6" ss:StyleID="s70"><Data ss:Type="Number">'.$BALL.'</Data></Cell>
    <Cell ss:StyleID="s71"><Data ss:Type="String">'.$DOC.'</Data></Cell>';
	if ( $OJID == 'Д' && $nab == 1 )
		$str.='
		<Cell ss:StyleID="s71"><Data ss:Type="String">Предоставл</Data></Cell>';
	else
		$str.='
		<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>';
$str.='
   </Row>';
	$length++;	
		
		}
		echo   '<Table ss:ExpandedColumnCount="9" ss:ExpandedRowCount="'.$length.'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s62">
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="51"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="38.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="18.55"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="213.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="35.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="51"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="66.75"/>
   <Column ss:StyleID="s62" ss:Width="78.75"/>';
   echo $str;
		echo '</Table>
		<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Footer x:Data="стр.&amp;P"/>
    <PageMargins x:Bottom="0.8" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>'.$length.'</ActiveRow>
     <ActiveCol>7</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>'; 
?>