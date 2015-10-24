<?

require_once("../include.php");
$div  = $_REQUEST['divid'];
$st = $_REQUEST['studyid'];
$direct = $_REQUEST['direct'];
$GUID= $_REQUEST['GUID'];

$query = "Select upper(DIVABBREVIATE) as DIVABBREVIATE 	FROM division WHERE divid='$div'";
$cur1 = execq($query);
$facname = $cur1[0]['DIVABBREVIATE'];

$time= strtotime(date('d.m.Y H.i.s'));
$time1= date('d.m.Y');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= \"Диспетчерская$time.xml\"");
$main_string="";
$sql = "select PREDMET, GROCODE, LEKTOR, ROOM_LEC, SEMINAR, ROOM_SEM,
    LABRAB, ROOM_LAB, PRIM, POTOK_LEK, POTOK_SEM, POTOK_LAB,  LEC, LAB, SEM, DATE_OF_SREZ
    from NAGRUZKA_DISPETCH_DWH where divid='$div'
    AND studyid='$st'
    ORDER BY POR_SORT, KURS, POTOK_LEK, POTOK_SEM, POTOK_LAB,  GROCODE";

//$main_string.= $sql.$st;

$cur=execq($sql);
$main_string.='<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>УМУ</Author>
  <LastAuthor>user</LastAuthor>
  <LastPrinted>' . $time1 . '</LastPrinted>
  <Created>' . $time1 . '</Created>
  <LastSaved>' . $time1 . '</LastSaved>
  <Version>14.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
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
  <Style ss:ID="m74912272">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="m74913616">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s62">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1" ss:Italic="1"/>
  </Style>
  <Style ss:ID="s63">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s64">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s66">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s67">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s69">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s70">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s71">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s72">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s73">
   <Alignment ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s74">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s75">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s76">
   <Alignment ss:Horizontal="Center" ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s77">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Size="11"/>
  </Style>
  <Style ss:ID="s78">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s79">
   <Alignment ss:Horizontal="Center" ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s80">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s81">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s82">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Size="11"/>
  </Style>
  <Style ss:ID="s83">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s84">
   <Alignment ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
  </Style>
  <Style ss:ID="s86">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Bold="1"/>
  </Style>
  <Style ss:ID="m90049600">
   <Alignment ss:Horizontal="Center" ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
     </Style>
 </Styles>
<Worksheet ss:Name="Распредедение нагрузки">
  <Names>
   <NamedRange ss:Name="Print_Titles"
    ss:RefersTo="=\'Распредедение нагрузки\'!R8"/>
  </Names>';
//expaded


$s=' <Column ss:AutoFitWidth="0" ss:Width="17.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="102"/>
   <Column ss:AutoFitWidth="0" ss:Width="60"/>
   <Column ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:AutoFitWidth="0" ss:Width="117.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="30" ss:Span="1"/>
   <Column ss:Index="8" ss:AutoFitWidth="0" ss:Width="117.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:AutoFitWidth="0" ss:Width="29.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="117.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:AutoFitWidth="0" ss:Width="166.5"/>
   <Row>
    <Cell ss:StyleID="s62"><Data ss:Type="String">УМУ,</Data></Cell>
    <Cell ss:Index="3" ss:MergeAcross="9" ss:StyleID="s63"><Data ss:Type="String">РАСПРЕДЕЛЕНИЕ НАГРУЗКИ НА ОСЕННИЙ СЕМЕСТР '.$god.'  УЧ. ГОДА</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s62"><Data ss:Type="String">отдел АСУ</Data></Cell>
    <Cell ss:Index="3" ss:MergeAcross="9" ss:StyleID="s63"><Data ss:Type="String">ПО КАФЕДРЕ '.$facname.'</Data></Cell>
   </Row>
   <Row>
   </Row>
   <Row>
    <Cell ss:Index="3" ss:MergeAcross="9" ss:StyleID="s63"><Data ss:Type="String">Дата среза ( '.$cur[0]['DATE_OF_SREZ'].' )</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s65"/>
   </Row>
   <Row ss:StyleID="s63">
    <Cell ss:StyleID="s66"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="String">Дисциплина</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Поток или</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s86"><Data ss:Type="String">ЛЕКЦИИ</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s86"><Data ss:Type="String">ПРАКТИЧЕСКИЕ ЗАНЯТИЯ</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m74912272"><Data ss:Type="String">ЛАБОРАТОРНЫЕ РАБОТЫ</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="String">ПРИМЕЧАНИЕ</Data></Cell>
   </Row>
   <Row ss:StyleID="s63">
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s71"/>
    <Cell ss:StyleID="s70"><Data ss:Type="String">группа</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">час/</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">час/</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">час/</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s71"/>
   </Row>
   <Row ss:StyleID="s63">
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s71"/>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"><Data ss:Type="String">нед.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">лектора</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">спец.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">нед.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">преп.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">спец.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">нед.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">преп.</Data></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String">спец.</Data></Cell>
    <Cell ss:StyleID="s71"/>
   </Row>
   <Row ss:StyleID="s63">
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s71"/>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"><Data ss:Type="String">ауд.</Data></Cell>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"><Data ss:Type="String">ауд.</Data></Cell>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"/>
    <Cell ss:StyleID="s70"><Data ss:Type="String">ауд.</Data></Cell>
    <Cell ss:StyleID="s71"/>
   </Row>
   <Row ss:StyleID="s63">
    <Cell ss:StyleID="s72"><Data ss:Type="Number">1</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="Number">2</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">3</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">4</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">5</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">6</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">7</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">8</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">9</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">10</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">11</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s72"><Data ss:Type="Number">12</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="Number">13</Data><NamedCell
      ss:Name="Print_Titles"/></Cell>
   </Row>';

// Данные по первой вкладке

$potok_lec_old="";
$potok_sem_old="";
$potok_lab_old="";
$predmet="";
$predmet_old = "";
$group="";
$lektor="";
$lektor_old = "";
$lec="";
$lec_room="";
$sem="";
$seminar="";
$seminar_old = "";
$sem_room="";
$lab="";
$labrab="";
$labrab_old = "";
$lab_room = "";
$prim="";
$prim_old="";
$schet=0;
$num=0;
foreach($cur as $k=>$row){
    if($potok_lec_old!=$row['POTOK_LEK'] ||  $row['POTOK_LEK']=="" ){
        $num++;
        $schet++;
        $potok_lec_old=$row['POTOK_LEK'];
        $sc='<Cell ss:StyleID="s73"><Data ss:Type="String">'.$schet.'</Data></Cell>';
        $predmet='<Cell ss:StyleID="s74"><Data ss:Type="String">'.$row['PREDMET'].'</Data></Cell>';
        $predmet_old = $row['PREDMET'];
        $lec='<Cell ss:StyleID="s76"><Data ss:Type="String">'.$row['LEC'].'</Data></Cell>';
        $lektor='<Cell ss:StyleID="s77"><Data ss:Type="String">'.$row['LEKTOR'].'</Data></Cell>';
        $lektor_old = $row['LEKTOR'];
        $lec_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_LEC'].'</Data></Cell>';
        $sem='<Cell ss:StyleID="s76"><Data ss:Type="String">'.$row['SEM'].'</Data></Cell>';
        $seminar='<Cell ss:StyleID="s77"><Data ss:Type="String">'.$row['SEMINAR'].'</Data></Cell>';
        $seminar_old = $row['SEMINAR'];
        $sem_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_SEM'].'</Data></Cell>';
        $lab=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['LAB'].'</Data></Cell>';
        $labrab=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['LABRAB'].'</Data></Cell>';
        $labrab_old = $row['LABRAB'];
        $lab_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_LAB'].'</Data></Cell>';
        $prim='<Cell ss:StyleID="s74"><Data ss:Type="String">'.$row['PRIM'].'</Data></Cell>';
        $prim_old = $row['PRIM'];
        if($row['POTOK_SEM']==$potok_sem_old && $potok_sem_old!=""){
            $schet--;
            $sc='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $predmet='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $sem='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $seminar='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $sem_room='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $prim='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
        }
        if($row['POTOK_LAB']==$potok_lab_old && $potok_lab_old!=""){
            $schet--;
            $sc='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $predmet='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $lab='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $labrab='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $lab_room='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $prim='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
        }


        if($row['POTOK_SEM']!=$potok_sem_old)
            $potok_sem_old =  $row['POTOK_SEM'];
        if($row['POTOK_LAB'] != $potok_lab_old)
            $potok_lab_old =  $row['POTOK_LAB'];

    }
    else {
        $num++;
        if($predmet_old != $row['PREDMET']){
            $predmet_old = $row['PREDMET'];
            $predmet='<Cell ss:StyleID="s74"><Data ss:Type="String">'.$row['PREDMET'].'</Data></Cell>';
        }
        else
            $predmet='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
        $sc='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
        if($prim_old != $row['PRIM']){
            $prim='<Cell ss:StyleID="s74"><Data ss:Type="String">'.$row['PRIM'].'</Data></Cell>';
            $prim_old = $row['PRIM'];
        }
        else
            $prim='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
        //$main_string.= $lektor.$row['LEKTOR'];
        if($lektor_old != $row['LEKTOR']){
            $lec='<Cell ss:StyleID="s76"><Data ss:Type="String">'.$row['LEC'].'</Data></Cell>';
            $lektor='<Cell ss:StyleID="s77"><Data ss:Type="String">'.$row['LEKTOR'].'</Data></Cell>';
            $lec_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_LEC'].'</Data></Cell>';
            $lektor_old = $row['LEKTOR'];
        }
        else{
            $lec='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $lektor='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            $lec_room='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
        }
        if($row['POTOK_SEM']!=$potok_sem_old || $row['POTOK_SEM']==""){
            $potok_sem_old = $row['POTOK_SEM'];
            //if($seminar_old != $row['SEMINAR']){
            $sem='<Cell ss:StyleID="s76"><Data ss:Type="String">'.$row['SEM'].'</Data></Cell>';
            $seminar='<Cell ss:StyleID="s77"><Data ss:Type="String">'.$row['SEMINAR'].'</Data></Cell>';
            $sem_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_SEM'].'</Data></Cell>';
            $seminar_old = $row['SEMINAR'];
        }
        else{
            if($seminar_old != $row['SEMINAR']){
                $sem='<Cell ss:StyleID="s76"><Data ss:Type="String">'.$row['SEM'].'</Data></Cell>';
                $seminar='<Cell ss:StyleID="s77"><Data ss:Type="String">'.$row['SEMINAR'].'</Data></Cell>';
                $sem_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_SEM'].'</Data></Cell>';
                $seminar_old = $row['SEMINAR'];
            }
            else{
                $sem='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
                $seminar='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
                $sem_room='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            }
        }

        if($row['POTOK_LAB']!=$potok_lab_old || $row['POTOK_LAB']==""){
            $potok_lab_old = $row['POTOK_LAB'];
            $lab=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['LAB'].'</Data></Cell>';
            $labrab=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['LABRAB'].'</Data></Cell>';
            $lab_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_LAB'].'</Data></Cell>';
            $labrab_old = $row['LABRAB'];
        }
        else{
            if($labrab_old != $row['LABRAB']){
                $lab=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['LAB'].'</Data></Cell>';
                $labrab=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['LABRAB'].'</Data></Cell>';
                $lab_room=' <Cell ss:StyleID="s78"><Data ss:Type="String">'.$row['ROOM_LAB'].'</Data></Cell>';
                $labrab_old = $row['LABRAB'];
            }
            else{
                $lab='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
                $labrab='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
                $lab_room='<Cell ss:StyleID="m90049600"><Data ss:Type="String"></Data></Cell>';
            }
        }

    }



    $s.='<Row>
            '.$sc.$predmet.
        '<Cell ss:StyleID="s75"><Data ss:Type="String">'.$row['GROCODE'].' </Data></Cell>'.
        $lec.$lektor.$lec_room.$sem.$seminar.$sem_room.$lab.$labrab.$lab_room.
        $prim.'
        </Row>';

}
$num+=100;
$main_string.=   '<Table ss:ExpandedColumnCount="13" ss:ExpandedRowCount="'.$num.'" x:FullColumns="1"
   x:FullRows="1">';
$main_string.= $s;
$main_string.='   <Row>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
    <Cell ss:StyleID="s84"/>
   </Row>
   <Row>
   </Row>
   <Row>
   </Row>
   <Row>
    <Cell><Data ss:Type="String">      ЗАВ. КАФЕДРОЙ_________________________________  &quot;______&quot; __________________ 2015 г.</Data></Cell>
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
   <TopRowVisible>0</TopRowVisible>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>';
//file_put_contents($direct.$GUID.".xml", $main_string);
echo $main_string;
?>