<?php


$ooo = isset($_GET['ooo']) ? 1 : 0;
echo $ooo;
exit();
/*
$divid = isset($_GET['divid']) ? $_GET['divid'] : 142;
$god = isset($_GET['god']) ? $_GET['god'] : '2008/2009';

header("Content-Type: application/excel;");
if($ooo==1)
{
	header("Content-Disposition: attachment; filename=file.xml");
}
else
{
	header("Content-Disposition: attachment; filename=file.xls");
}
		
include_once('OracleDB.php');

$sql = 'select DIVABBREVIATE from DIVISION where DIVID=' . $divid;
$divname = $db->fetchOne($sql);

echo '<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>';
?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>user</Author>
  <LastAuthor>user</LastAuthor>
  <LastPrinted>2009-01-28T06:56:26Z</LastPrinted>
  <Created>2009-01-28T06:19:31Z</Created>
  <LastSaved>2009-01-28T06:57:24Z</LastSaved>
  <Version>11.9999</Version>
 </DocumentProperties>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>13545</WindowHeight>
  <WindowWidth>21915</WindowWidth>
  <WindowTopX>120</WindowTopX>
  <WindowTopY>30</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial Cyr" x:CharSet="204"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="m24658452">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s21">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s23">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s24">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s25">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s26">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s28">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s31">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s33">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s34">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s35">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s36">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s37">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s38">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s39">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s40">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s41">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s42">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s43">
   <Alignment ss:Vertical="Top" ss:Horizontal="Center" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
	<Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s44">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Size="11"/>
  </Style>
  <Style ss:ID="s45">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
	<Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Size="11"/>
  </Style>
  <Style ss:ID="s46">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Size="10" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s47">
   <Alignment ss:Vertical="Top" />
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
	<Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Size="10" ss:Bold="1"/>
  </Style>
 </Styles>
<?php
$semestr = array('Осенний', 'Весенний');
	
foreach ($semestr as $sem)
{
	$sem_win = iconv('UTF-8','WINDOWS-1251', $sem);
	$sql = 'select PREDMET, GROCODE, LEKTOR, ROOM_LEC, SEMINAR, ROOM_SEM, 
	LABRAB, ROOM_LAB, PRIM, POTOK_LEK, LEC, LAB, SEM 
	from z_dispetch_nagruzka where divid=' . $divid . ' 
	AND (spring_autumn=\'' . $sem_win . '\') AND YEAR_GROCODE=\'' . $god . '\'
	ORDER BY POR_SORT, KURS, PREDMET, GROCODE, LEKTOR, SEMINAR, LABRAB';

	$data = $db->fetchAll($sql);
	printWorksheet();
}

?>
</Workbook>
<?php

function win2utf($string)
{
	return iconv('WINDOWS-1251', 'UTF-8', $string);
}

function printWorksheet()
{
	global $data, $divname, $sem, $god, $sem_win;
?>
 <Worksheet ss:Name="Распред. нагрузки. <?php echo $sem; ?>">
  <Names>
   <NamedRange ss:Name="Print_Titles" ss:RefersTo="='Распред. нагрузки. <?php echo $sem; ?>'!R8"/>
  </Names>
  <Table ss:ExpandedColumnCount="13"  x:FullColumns="1"
   x:FullRows="1">
   <Column ss:AutoFitWidth="0" ss:Width="17.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="102"/>
   <Column ss:AutoFitWidth="0" ss:Width="60"/>
   <Column ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:AutoFitWidth="0" ss:Width="117.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="30" ss:Span="1"/>
   <Column ss:Index="8" ss:AutoFitWidth="0" ss:Width="117.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:AutoFitWidth="0" ss:Width="29.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="117.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:AutoFitWidth="0" ss:Width="166.5"/>
   <Row>
    <Cell ss:Index="3" ss:MergeAcross="9" ss:StyleID="s21"><Data ss:Type="String">РАСПРЕДЕЛЕНИЕ НАГРУЗКИ НА <?php echo win2utf(strtoupper($sem_win)); ?> СЕМЕСТР <?php echo $god; ?> УЧ. ГОДА</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="3" ss:MergeAcross="9" ss:StyleID="s21"><Data ss:Type="String">ПО КАФЕДРЕ <?php echo win2utf($divname); ?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s23"/>
    <Cell ss:StyleID="s24"/>
   </Row>
   <Row ss:StyleID="s21">
    <Cell ss:StyleID="s25"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s26"><Data ss:Type="String">Дисциплина</Data></Cell>
    <Cell ss:StyleID="s25"><Data ss:Type="String">Поток или</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s28"><Data ss:Type="String">ЛЕКЦИИ</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s28"><Data ss:Type="String">ПРАКТИЧЕСКИЕ ЗАНЯТИЯ</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m24658452"><Data ss:Type="String">ЛАБОРАТОРНЫЕ РАБОТЫ</Data></Cell>
    <Cell ss:StyleID="s26"><Data ss:Type="String">ПРИМЕЧАНИЕ</Data></Cell>
   </Row>
   <Row ss:StyleID="s21">
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s34"/>
    <Cell ss:StyleID="s33"><Data ss:Type="String">группа</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">час/</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">час/</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">час/</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s34"/>
   </Row>
   <Row ss:StyleID="s21">
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s34"/>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"><Data ss:Type="String">нед.</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">лектора</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">спец.</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">нед.</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">лектора</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">спец.</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">нед.</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">лектора</Data></Cell>
    <Cell ss:StyleID="s33"><Data ss:Type="String">спец.</Data></Cell>
    <Cell ss:StyleID="s34"/>
   </Row>
   <Row ss:StyleID="s21">
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s34"/>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"><Data ss:Type="String">ауд.</Data></Cell>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"><Data ss:Type="String">ауд.</Data></Cell>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"/>
    <Cell ss:StyleID="s33"><Data ss:Type="String">ауд.</Data></Cell>
    <Cell ss:StyleID="s34"/>
   </Row>
   <Row ss:StyleID="s21">
    <Cell ss:StyleID="s35"><Data ss:Type="Number">1</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s31"><Data ss:Type="Number">2</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">3</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">4</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">5</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">6</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">7</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">8</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">9</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">10</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">11</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s35"><Data ss:Type="Number">12</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s31"><Data ss:Type="Number">13</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
   </Row>
<?php

$predmet_number = 0;
$cur_predmet = '';
$potok_lek = 0;

foreach ($data as $row)
{
	$row_index++;
	$cols = array(
		0 => 'NUMBER',
		1 => 'PREDMET',
		2 => 'GROCODE',
		3 => 'LEC',
		4 => 'LEKTOR',
		5 => 'ROOM_LEC',
		6 => 'SEM',
		7 => 'SEMINAR',
		8 => 'ROOM_SEM',
		9 => 'LAB',
		10 => 'LABRAB',
		11 => 'ROOM_LAB',
		12 => 'PRIM');
		
	$styles =               array(36, 37, 46, 36, 44, 41, 36, 44, 41, 36, 44, 41, 37); // default
	$styles_bottom_border = array(38, 39, 47, 43, 45, 42, 43, 45, 42, 43, 45, 42, 39);
	
	echo '<Row>' . "\r\n";
	
	if ($row['PREDMET'] != $cur_predmet)
	{
		$cur_predmet = $row['PREDMET'];
		$predmet_number++;
		$styles = $styles_bottom_border;
	}
	
	if ($row['POTOK_LEK'] != $potok_lek)
	{
		$potok_lek = $row['POTOK_LEK'];
		$styles = $styles_bottom_border;
	}
	
	$row['NUMBER'] = $predmet_number;
	foreach ($cols as $colnumber => $col)
	{
		if ($current[$col] != $row[$col])
		{
			if ($col == 'GROCODE')
			{
				$current['SEMINAR'] = '';
			}
			
			if ($col == 'SEMINAR')
			{
				$current['LABRAB'] = '';
			}
			
			if ($col == 'PREDMET')
			{
				$current['LEKTOR'] = '';
				$styles = $styles_bottom_border;
			}
			$style = 's' . $styles[$colnumber];
			$value = win2utf($row[$col]);
			echo '<Cell ss:StyleID="' . $style . '"><Data ss:Type="String">' . $value . '</Data></Cell>' . "\r\n";
			$current[$col] = $row[$col];
		}
		else
		{
			$style = 's' . $styles[$colnumber];
			echo '<Cell ss:StyleID="' . $style . '" />' . "\r\n";
		}
	}
	echo '</Row>' . "\r\n";
}

echo '<Row>';
foreach ($cols as $col)
{
	echo '<Cell ss:StyleID="s40" />';
}
echo '</Row>';
?>
   <Row />
   <Row />
   <Row>
    <Cell><Data ss:Type="String">      ЗАВ. КАФЕДРОЙ_________________________________  &quot;______&quot; __________________ <?php echo date('Y'); ?> г.</Data></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <Header x:Margin="0.51181102362204722"/>
    <Footer x:Margin="0.51181102362204722"/>
    <PageMargins x:Bottom="0.98425196850393704" x:Left="0.39370078740157483"
     x:Right="0.39370078740157483" x:Top="0.98425196850393704"/>
   </PageSetup>
   <Print>
    <ValidPrinterInfo/>
    <PaperSizeIndex>9</PaperSizeIndex>
    <Scale>83</Scale>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <Selected/>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
<?
}
*/
?>