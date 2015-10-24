<?php
/**
 * Created by PhpStorm.
 * User: userdr
 * Date: 26.12.14
 * Time: 12:30
 */
require_once("../include.php");
$fac = $_REQUEST['fac'];
$otch = $_REQUEST['otch'];
$studyid= $_REQUEST['studyid'];
$direct = $_REQUEST['direct'];
$GUID= $_REQUEST['GUID'];
$god = "SELECT yearname
        FROM v_study
        WHERE studyid = '$studyid'";
$god = execq($god);
$year = $god[0]['YEARNAME'];

$stud = "SELECT studyid
        FROM v_study
        WHERE yearname = '$year'
        ORDER BY periodid";
$study = execq($stud);
$studyid1 = $study[0]['STUDYID'];
$studyid2 = $study[1]['STUDYID'];


$time = strtotime(date('d.m.Y H.i.s'));
$time1= date('d.m.Y');
$god="";$k=0;
set_time_limit(0);
for($i=0;$i<strlen($year);$i++)
    if($year[$i]=="/")
       $k=1;
    else if($k)
        $god.=$year[$i];

$sl_god=$god+1;
$period=$god.'/'.$sl_god;



/*header("Content-Type: application/vnd.ms-excel");
switch ($otch) {
    case 1:
    {
        header("Content-Disposition: attachment; filename= \"Нагрузка по кафедрам $time.xml\"");
        break;
    }
    case 2:
    {
        header("Content-Disposition: attachment; filename= \"Нагрузка (итоговая, годовая) $time.xml\"");
        break;
    };
    case 3:
    {
        header("Content-Disposition: attachment; filename= \"Плановая численность $time.xml\"");
        break;
    };
    case 4:
    {
        header("Content-Disposition: attachment; filename= \"Преподаватели $time.xml\"");
        break;
    }
}*/


$main_string="";

$main_string.= '<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
          xmlns:o="urn:schemas-microsoft-com:office:office"
          xmlns:x="urn:schemas-microsoft-com:office:excel"
          xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
          xmlns:html="http://www.w3.org/TR/REC-html40">
<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
    <Author>УМУ</Author>
    <LastAuthor>УМУ</LastAuthor>
    <Created>' . $time1 . '</Created>
    <LastSaved>' . $time1 . '</LastSaved>
    <Version>14.00</Version>
</DocumentProperties>

';


$str1 = "Российский Государственный Университет нефти и газа имени И.М. Губкина";
$str2 = "Факультет";
$query = "Select FACNAME,fac  FROM FACULTY WHERE FACID='$fac'";
$cur1 = execq($query);
$facname = $cur1[0]['FACNAME'];
$facn = $cur1[0]['FAC'];
if($studyid%2==0){
    $zagod=1;
    $semestr="Весенний";
}
else{
    $zagod=0;
    $semestr="Осенний";
}
switch ($otch) {
    case 1:
    {
        $sql="begin temp_umu($fac,$studyid1); end;";
//echo $sql;
        execq($sql);

        $main_string.= '
        <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
  <Colors>
   <Color>
    <Index>4</Index>
    <RGB>#FFFF99</RGB>
   </Color>
   <Color>
    <Index>39</Index>
    <RGB>#E3E3E3</RGB>
   </Color>
  </Colors>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>5490</WindowHeight>
  <WindowWidth>9660</WindowWidth>
  <WindowTopX>0</WindowTopX>
  <WindowTopY>0</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial" x:CharSet="204"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s15">
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s57">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
    ss:WrapText="1"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Color="#000080"/>
    <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s58">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Center"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s59">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s60">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Interior ss:Color="#FFFF99" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s61">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Interior ss:Color="#FFFF99" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s63">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s66">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s67">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Штат">
        ';
        //expand
        $s='<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="11"/>
   <Column ss:Index="14" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Column ss:Index="16" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="3"/>
   <Column ss:Index="21" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">УМУ, отдел АСУ</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Российский Государственный Университет нефти и газа имени И.М. Губкина</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$time1.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="4">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  '.$semestr.'  семестр '.$year.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="6" ss:Height="104.25">
    <Cell ss:StyleID="s58"><Data ss:Type="String">Штатные</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего за семестр</Data></Cell>';
        if($zagod)
            $s.='<Cell ss:StyleID="s65"><Data ss:Type="String">Всего за год</Data></Cell>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="String">Штатные</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"/>';
        $s.='
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s58"><Data ss:Type="String">Штатные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s58"/>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"/>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">27</Data></Cell>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"><Data ss:Type="Number">28</Data></Cell>';
        $s.='
   </Row>';
        $n=0;
        $sum=array();
        $sum_f=array();
        //данные
        $sql123456="begin temp_umu($fac,$studyid1); end;";
//echo $sql;
        execq($sql123456);

        $sql="SELECT DIVID,DIVABBREVIATE FROM V_SPI_KAFEDR WHERE FACID='$fac' ORDER BY DIVABBREVIATE";
        $cur1=execq($sql);
        $sql228="select SUM(GOD) GOD,
		                SUM(F_GOD) F_GOD,
                        from temp_god
                        WHERE  DIVID='$kaf' AND FOR_SORT=1";

        $cur228=execq($sql228);
        $s .= '1'.$cur228;
        $vsegogod1=$cur228[0]['GOD'];
       // $sum[$j]+=$vsegogod;
        $fvsegogod1=$cur228[0]['F_GOD'];

        $schet=count($cur1);
        foreach($cur1 as $k=>$row){

            $kaf=$row['DIVID'];
            $kaf_name=$row['DIVABBREVIATE'];
           if($zagod){
                $sql2="select SUM(GOD) GOD,
		                SUM(F_GOD) F_GOD,
                        from temp_god
                        WHERE  DIVID='$kaf' AND FOR_SORT=1";
            }


            $sql="select
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME,
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH,
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR,
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12,
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15,
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20,
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim,
		  sum(vsego25)vsego25,
		  sum(SEMESTR)SEMESTR,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME,
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH,
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR,
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12,
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15,
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20,
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim,
		  sum(f_vsego25)  f_vsego25,
		  sum(f_SEMESTR)f_SEMESTR
		 from temp_semestr_kategor  WHERE DIVID='$kaf' AND studyid='$studyid' AND FOR_SORT=1";


          //  $cur=execq($sql);
            //


           /* foreach($cur as $k=>$row){
                $j=0;
                $LECTIME=$row['LECTIME'];
                $sum[$j]+=$LECTIME; $j++;
                $SEMTIME=$row['SEMTIME'];
                $sum[$j]+=$SEMTIME; $j++;
                $LABTIME=$row['LABTIME'];
                $sum[$j]+=$LABTIME; $j++;
                $VSEGO5=$row['VSEGO5'];
                $sum[$j]+=$VSEGO5; $j++;
                $EKZ_ZACH=$row['EKZ_ZACH'];
                $sum[$j]+=$EKZ_ZACH; $j++;
                $ITOGO7=$row['ITOGO7'];
                $sum[$j]+=$ITOGO7; $j++;
                $KPR=$row['KPR'];
                $sum[$j]+=$KPR; $j++;
                $N9=$row['N9'];
                $sum[$j]+=$N9; $j++;
                $N10=$row['N10'];
                $sum[$j]+=$N10; $j++;
                $N11=$row['N11'];
                $sum[$j]+=$N11; $j++;
                $N12=$row['N12'];
                $sum[$j]+=$N12; $j++;
                $VSEGO13=$row['VSEGO13'];
                $sum[$j]+=$VSEGO13; $j++;
                $VSEGOPLAN=$row['VSEGOPLAN'];
                $sum[$j]+=$VSEGOPLAN; $j++;
                $N15=$row['N15'];
                $sum[$j]+=$N15; $j++;
                $N16=$row['N16'];
                $sum[$j]+=$N16; $j++;
                $N17=$row['N17'];
                $sum[$j]+=$N17; $j++;
                $N18=$row['N18'];
                $sum[$j]+=$N18; $j++;
                $N19=$row['N19'];
                $sum[$j]+=$N19; $j++;
                $N20=$row['N20'];
                $sum[$j]+=$N20; $j++;
                $VSEGO21=$row['VSEGO21'];
                $sum[$j]+=$VSEGO21; $j++;
                $N22=$row['N22'];
                $sum[$j]+=$N22; $j++;
                $N23=$row['N23'];
                $sum[$j]+=$N23; $j++;
                $N24=$row['N24'];
                $sum[$j]+=$N24; $j++;
                $PRIM=$row['PRIM'];
                $sum[$j]+=$PRIM; $j++;
                $VSEGO25=$row['VSEGO25'];
                $sum[$j]+=$VSEGO25; $j++;
                $SEMESTR=$row['SEMESTR'];
                $sum[$j]+=$SEMESTR; $j=0;
                $F2=$row['F_LECTIME'];
                $sum_f[$j]+=$F2; $j++;
                $F3=$row['F_SEMTIME'];
                $sum_f[$j]+=$F3; $j++;
                $F4=$row['F_LABTIME'];
                $sum_f[$j]+=$F4; $j++;
                $F_VSEGO5=$row['F_VSEGO5'];
                $sum_f[$j]+=$F_VSEGO5; $j++;
                $F6=$row['F_EKZ_ZACH'];
                $sum_f[$j]+=$F6; $j++;
                $F_ITOGO7=$row['F_ITOGO7'];
                $sum_f[$j]+=$F_ITOGO7; $j++;
                $F8=$row['F_KPR'];
                $sum_f[$j]+=$F8; $j++;
                $F9=$row['F9'];
                $sum_f[$j]+=$F9; $j++;
                $F10=$row['F10'];
                $sum_f[$j]+=$F10; $j++;
                $F11=$row['F11'];
                $sum_f[$j]+=$F11; $j++;
                $F12=$row['F12'];
                $sum_f[$j]+=$F12; $j++;
                $F_VSEGO13=$row['F_VSEGO13'];
                $sum_f[$j]+=$F_VSEGO13; $j++;
                $F_VSEGOPLAN=$row['F_VSEGOPLAN'];
                $sum_f[$j]+=$F_VSEGOPLAN; $j++;
                $F15=$row['F15'];
                $sum_f[$j]+=$F15; $j++;
                $F16=$row['F16'];
                $sum_f[$j]+=$F16; $j++;
                $F17=$row['F17'];
                $sum_f[$j]+=$F17; $j++;
                $F18=$row['F18'];
                $sum_f[$j]+=$F18; $j++;
                $F19=$row['F19'];
                $sum_f[$j]+=$F19; $j++;
                $F20=$row['F20'];
                $sum_f[$j]+=$F20; $j++;
                $F_VSEGO21=$row['F_VSEGO21'];
                $sum_f[$j]+=$F_VSEGO21; $j++;
                $F22=$row['F22'];
                $sum_f[$j]+=$F22; $j++;
                $F23=$row['F23'];
                $sum_f[$j]+=$F23; $j++;
                $F24=$row['F24'];
                $sum_f[$j]+=$F24; $j++;
                $FPRIM=$row['FPRIM'];
                $sum_f[$j]+=$FPRIM; $j++;
                $F_VSEGO25=$row['F_VSEGO25'];
                $sum_f[$j]+=$F_VSEGO25; $j++;
                $F_SEMESTR=$row['F_SEMESTR'];
                $sum_f[$j]+=$F_SEMESTR; $j++;
//$s.=$zagod;
*/
            if($zagod){
                $j=26;
                $cur2=execq($sql2);
                $vsegogod=$cur2[0]['GOD'];
                $sum[$j]+=$vsegogod;
                $fvsegogod=$cur2[0]['F_GOD'];
                $sum_f[$j]+=$fvsegogod;
                //$s.=$zagod;

            }
          $s.='  <Row>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($kaf_name).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SEMESTR).'</Data></Cell>';
            if($zagod) $s.='<Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod1).'</Data></Cell>';$s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s67"><Data ss:Type="String">'.trim('').'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F2).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F3).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F4).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F6).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F8).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($FPRIM).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SEMESTR).'</Data></Cell>';
            if($zagod) $s.='<Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($fvsegogod1).'</Data></Cell>';$s.='

   </Row>';
            $n+=2;
              /* if($zagod){
                    $s.=$zagod;
                    $query = "SELECT DIVID,
                                YEAR_GROCODE,
                                SUM (LECTIME) LECTIME,
                                SUM (SEMTIME) SEMTIME,
                                SUM (LABTIME) LABTIME,
                                SUM (vsego5) vsego5,
                                SUM (EKZ_ZACH) EKZ_ZACH,
                                SUM (itogo7) itogo7,
                                SUM (KPR) KPR,
                                SUM (N9) n9,
                                SUM (N10) n10,
                                SUM (N11) n11,
                                SUM (N12) n12,
                                SUM ( vsego13) vsego13,
                                SUM ( vsegoplan) vsegoplan,
                                SUM (N15) n15,
                                SUM (N16) n16,
                                SUM (N17) n17,
                                SUM (N18) n18,
                                SUM (N19) n19,
                                SUM (N20) n20,
                                SUM (vsego21) vsego21,
                                SUM (N22) n22,
                                SUM (N23) n23,
                                SUM (N24) n24,
                                SUM (PRIM) prim,
                                SUM (vsego25) vsego25,
                                SUM ( god) god,
                                SUM (f_LECTIME) f_LECTIME,
                                SUM ( f_SEMTIME) f_SEMTIME,
                                SUM (f_LABTIME) f_LABTIME,
                                SUM ( f_vsego5) f_vsego5,
                                SUM (f_ekz_zaCH) f_ekz_zaCH ,
                                SUM (f_itogo7) f_itogo7,
                                SUM (F_KPR) F_KPR ,
                                SUM (f9) f9,
                                SUM (f10) f10,
                                SUM (f11) f11,
                                SUM (f12) f12,
                                SUM ( f_vsego13) f_vsego13,
                                SUM ( f_vsegoplan) f_vsegoplan,
                                SUM (f15) f15,
                                SUM (f16) f16,
                                SUM (f17) f17,
                                SUM (f18) f18,
                                SUM (f19) f19,
                                SUM (f20) f20,
                                SUM ( f_vsego21) f_vsego21,
                                SUM (f22) f22,
                                SUM (f23) f23,
                                SUM (f24) f24,
                                SUM (fPRIM) fprim,
                                SUM ( f_vsego25) f_vsego25,
                                SUM ( f_god) f_god,
                                facid,
                                fac,
                                DIVABBREVIATE,
                                for_sort,
                                for_sort_name
                                FROM temp_god
                                where divid='$kaf' and for_sort=1
                                GROUP BY DIVID,
                                DIVABBREVIATE,
                                YEAR_GROCODE,
                                facid,
                                fac,
                                for_sort,
                                for_sort_name;";
                    $data = execq($query);
                    //$s.=$data;
                    foreach($data as $k2=>$row2){
                        $s.=$zagod;
                        $LECTIME=$row2['LECTIME'];
                        $SEMTIME=$row2['SEMTIME'];
                        $LABTIME=$row2['LABTIME'];
                        $VSEGO5=$row2['VSEGO5'];
                        $EKZ_ZACH=$row2['EKZ_ZACH'];
                        $ITOGO7=$row2['ITOGO7'];
                        $KPR=$row2['KPR'];
                        $N9=$row2['N9'];
                        $N10=$row2['N10'];
                        $N11=$row2['N11'];
                        $N12=$row2['N12'];
                        $VSEGO13=$row2['VSEGO13'];
                        $VSEGOPLAN=$row2['VSEGOPLAN'];
                        $N15=$row2['N15'];
                        $N16=$row2['N16'];
                        $N17=$row2['N17'];
                        $N18=$row2['N18'];
                        $N19=$row2['N19'];
                        $N20=$row2['N20'];
                        $VSEGO21=$row2['VSEGO21'];
                        $N22=$row2['N22'];
                        $N23=$row2['N23'];
                        $N24=$row2['N24'];
                        $PRIM=$row2['PRIM'];
                        $VSEGO25=$row2['VSEGO25'];
                        $SEMESTR=$row2['SEMESTR'];
                        $F2=$row2['F_LECTIME'];
                        $F3=$row2['F_SEMTIME'];
                        $F4=$row2['F_LABTIME'];
                        $F_VSEGO5=$row2['F_VSEGO5'];
                        $F6=$row2['F_EKZ_ZACH'];
                        $F_ITOGO7=$row2['F_ITOGO7'];
                        $F8=$row2['F_KPR'];
                        $F9=$row2['F9'];
                        $F10=$row2['F10'];
                        $F11=$row2['F11'];
                        $F12=$row2['F12'];
                        $F_VSEGO13=$row2['F_VSEGO13'];
                        $F_VSEGOPLAN=$row2['F_VSEGOPLAN'];
                        $F15=$row2['F15'];
                        $F16=$row2['F16'];
                        $F17=$row2['F17'];
                        $F18=$row2['F18'];
                        $F19=$row2['F19'];
                        $F20=$row2['F20'];
                        $F_VSEGO21=$row2['F_VSEGO21'];
                        $F22=$row2['F22'];
                        $F23=$row2['F23'];
                        $F24=$row2['F24'];
                        $FPRIM=$row2['FPRIM'];
                        $F_VSEGO25=$row2['F_VSEGO25'];
                        $F_SEMESTR=$row2['F_SEMESTR'];
                        $s.='  <Row>
                                    <Cell ss:StyleID="s66"><Data ss:Type="String">'.'за год по плану'.'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
                                    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
                                    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
                                    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
                                    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
                                    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
                                    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
                                    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
                                    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SEMESTR).'</Data></Cell>
                                    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod).'</Data></Cell>
                                   </Row>
                                   <Row>
                                    <Cell ss:StyleID="s67"><Data ss:Type="String">'.trim('за год факт').'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F2).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F3).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F4).'</Data></Cell>
                                    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F6).'</Data></Cell>
                                    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F8).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
                                    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
                                    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
                                    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
                                    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($FPRIM).'</Data></Cell>
                                    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
                                    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SEMESTR).'</Data></Cell>
                                    <Cell ss:StyleID="s63"><Data ss:Type="String"></Data></Cell>
                                  </Row>';
                        $n+=2;
                    }


                }
            }*/}
  /* $s.='<Row>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Итого:</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[0]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[1]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[2]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[3]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[4]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[5]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[6]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[7]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[8]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[9]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[10]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[11]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[12]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[13]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[14]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[15]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[16]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[17]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[18]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[19]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[20]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[21]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[22]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[23]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[24]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[25]).'</Data></Cell>';
        if($zagod==1)
            $s.='<Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[26]).'</Data></Cell>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Итого (факт):</Data></Cell>
     <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[0]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[1]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[2]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[3]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[4]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[5]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[6]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[7]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[8]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[9]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[10]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[11]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[12]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[13]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[14]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[15]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[16]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[17]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[18]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[19]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[20]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[21]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[22]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[23]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[24]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[25]).'</Data></Cell>
    ';
        if($zagod==1)
            $s.='<Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[26]).'</Data></Cell>';
        $s.='
   </Row>';

*/
$n+=40;

        $main_string.= '  <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.$n.'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">';
        $main_string.=  $s;
        $main_string.=  '</Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <Selected/>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <Worksheet ss:Name="Совм.">';
        ///expan
        $s='<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="4"/>
   <Column ss:Index="7" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="8"/>
   <Column ss:Index="17" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"
    ss:Span="3"/>
   <Column ss:Index="21" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">УМУ, отдел АСУ</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Российский Государственный Университет нефти и газа имени И.М. Губкина</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$time1.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="4">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  '.$semestr.'  семестр '.$year.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="6" ss:Height="104.25">
    <Cell ss:StyleID="s58"><Data ss:Type="String">Совместители</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего за семестр</Data></Cell>';
        if($zagod)
            $s.='<Cell ss:StyleID="s65"><Data ss:Type="String">Всего за год</Data></Cell>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="String">Совместители</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"/>
    <Cell ss:Index="16" ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    ';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"/>';
        $s.='
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s58"><Data ss:Type="String">Совместители</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
   <Cell ss:StyleID="s58"/>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"/>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">27</Data></Cell>';
          if($zagod)
            $s.='<Cell ss:StyleID="s58"><Data ss:Type="Number">28</Data></Cell>';
        $s.='
   </Row>';
        $n=0;
        $sum=array();
        $sum_f=array();
        //данные
        $sql="SELECT DIVID,DIVABBREVIATE FROM V_SPI_KAFEDR WHERE FACID='$fac' ORDER BY DIVABBREVIATE";

        $cur1=execq($sql);
        foreach($cur1 as $k=>$row){

            $kaf=$row['DIVID'];
            $kaf_name=$row['DIVABBREVIATE'];
            $where = "WHERE DIVID='$kaf' AND studyid='$studyid' AND FOR_SORT=2";

            if($zagod==1)$sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
		   	sum(f_SEMESTR)f_SEMESTR
		 	from temp_semestr_kategor
		 	WHERE  DIVID='$kaf' AND YEAR_GROCODE='$year' AND FOR_SORT=2
		 	group  by  YEAR_GROCODE";


            $sql="select
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME,
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH,
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR,
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12,
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15,
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20,
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim,
		  sum(vsego25)vsego25,
		  sum(SEMESTR)SEMESTR,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME,
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH,
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR,
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12,
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15,
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20,
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim,
		  sum(f_vsego25)  f_vsego25,
		  sum(f_SEMESTR)f_SEMESTR
		 from temp_semestr_kategor  $where";


            $cur=execq($sql);
            //


            foreach($cur as $k=>$row){
                $j=0;
                $LECTIME=$row['LECTIME'];
                $sum[$j]+=$LECTIME; $j++;
                $SEMTIME=$row['SEMTIME'];
                $sum[$j]+=$SEMTIME; $j++;
                $LABTIME=$row['LABTIME'];
                $sum[$j]+=$LABTIME; $j++;
                $VSEGO5=$row['VSEGO5'];
                $sum[$j]+=$VSEGO5; $j++;
                $EKZ_ZACH=$row['EKZ_ZACH'];
                $sum[$j]+=$EKZ_ZACH; $j++;
                $ITOGO7=$row['ITOGO7'];
                $sum[$j]+=$ITOGO7; $j++;
                $KPR=$row['KPR'];
                $sum[$j]+=$KPR; $j++;
                $N9=$row['N9'];
                $sum[$j]+=$N9; $j++;
                $N10=$row['N10'];
                $sum[$j]+=$N10; $j++;
                $N11=$row['N11'];
                $sum[$j]+=$N11; $j++;
                $N12=$row['N12'];
                $sum[$j]+=$N12; $j++;
                $VSEGO13=$row['VSEGO13'];
                $sum[$j]+=$VSEGO13; $j++;
                $VSEGOPLAN=$row['VSEGOPLAN'];
                $sum[$j]+=$VSEGOPLAN; $j++;
                $N15=$row['N15'];
                $sum[$j]+=$N15; $j++;
                $N16=$row['N16'];
                $sum[$j]+=$N16; $j++;
                $N17=$row['N17'];
                $sum[$j]+=$N17; $j++;
                $N18=$row['N18'];
                $sum[$j]+=$N18; $j++;
                $N19=$row['N19'];
                $sum[$j]+=$N19; $j++;
                $N20=$row['N20'];
                $sum[$j]+=$N20; $j++;
                $VSEGO21=$row['VSEGO21'];
                $sum[$j]+=$VSEGO21; $j++;
                $N22=$row['N22'];
                $sum[$j]+=$N22; $j++;
                $N23=$row['N23'];
                $sum[$j]+=$N23; $j++;
                $N24=$row['N24'];
                $sum[$j]+=$N24; $j++;
                $PRIM=$row['PRIM'];
                $sum[$j]+=$PRIM; $j++;
                $VSEGO25=$row['VSEGO25'];
                $sum[$j]+=$VSEGO25; $j++;
                $SEMESTR=$row['SEMESTR'];
                $sum[$j]+=$SEMESTR; $j=0;
                $F2=$row['F_LECTIME'];
                $sum_f[$j]+=$F2; $j++;
                $F3=$row['F_SEMTIME'];
                $sum_f[$j]+=$F3; $j++;
                $F4=$row['F_LABTIME'];
                $sum_f[$j]+=$F4; $j++;
                $F_VSEGO5=$row['F_VSEGO5'];
                $sum_f[$j]+=$F_VSEGO5; $j++;
                $F6=$row['F_EKZ_ZACH'];
                $sum_f[$j]+=$F6; $j++;
                $F_ITOGO7=$row['F_ITOGO7'];
                $sum_f[$j]+=$F_ITOGO7; $j++;
                $F8=$row['F_KPR'];
                $sum_f[$j]+=$F8; $j++;
                $F9=$row['F9'];
                $sum_f[$j]+=$F9; $j++;
                $F10=$row['F10'];
                $sum_f[$j]+=$F10; $j++;
                $F11=$row['F11'];
                $sum_f[$j]+=$F11; $j++;
                $F12=$row['F12'];
                $sum_f[$j]+=$F12; $j++;
                $F_VSEGO13=$row['F_VSEGO13'];
                $sum_f[$j]+=$F_VSEGO13; $j++;
                $F_VSEGOPLAN=$row['F_VSEGOPLAN'];
                $sum_f[$j]+=$F_VSEGOPLAN; $j++;
                $F15=$row['F15'];
                $sum_f[$j]+=$F15; $j++;
                $F16=$row['F16'];
                $sum_f[$j]+=$F16; $j++;
                $F17=$row['F17'];
                $sum_f[$j]+=$F17; $j++;
                $F18=$row['F18'];
                $sum_f[$j]+=$F18; $j++;
                $F19=$row['F19'];
                $sum_f[$j]+=$F19; $j++;
                $F20=$row['F20'];
                $sum_f[$j]+=$F20; $j++;
                $F_VSEGO21=$row['F_VSEGO21'];
                $sum_f[$j]+=$F_VSEGO21; $j++;
                $F22=$row['F22'];
                $sum_f[$j]+=$F22; $j++;
                $F23=$row['F23'];
                $sum_f[$j]+=$F23; $j++;
                $F24=$row['F24'];
                $sum_f[$j]+=$F24; $j++;
                $FPRIM=$row['FPRIM'];
                $sum_f[$j]+=$FPRIM; $j++;
                $F_VSEGO25=$row['F_VSEGO25'];
                $sum_f[$j]+=$F_VSEGO25; $j++;
                $F_SEMESTR=$row['F_SEMESTR'];
                $sum_f[$j]+=$F_SEMESTR; $j++;


            if($zagod==1){
                $j=26;
                $cur2=execq($sql2);
                $vsegogod=$row['SEMESTR'];
                $sum[$j]+=$vsegogod;
                $fvsegogod=$row['F_SEMESTR'];
                $sum_f[$j]+=$fvsegogod;
            }
          $s.='  <Row>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($kaf_name).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SEMESTR).'</Data></Cell>';
            if($zagod==1) $s.='<Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod).'</Data></Cell>';$s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s67"><Data ss:Type="String">'.trim('').'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F2).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F3).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F4).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F6).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F8).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($FPRIM).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SEMESTR).'</Data></Cell>';
            if($zagod==1) $s.='<Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod).'</Data></Cell>';$s.='

   </Row>';

            $n+=2;
            }}
   $s.='<Row>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Итого:</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[0]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[1]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[2]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[3]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[4]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[5]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[6]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[7]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[8]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[9]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[10]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[11]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[12]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[13]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[14]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[15]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[16]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[17]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[18]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[19]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[20]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[21]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[22]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[23]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[24]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[25]).'</Data></Cell>';
        if($zagod==1)
            $s.='<Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[26]).'</Data></Cell>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Итого (факт):</Data></Cell>
     <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[0]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[1]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[2]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[3]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[4]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[5]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[6]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[7]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[8]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[9]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[10]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[11]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[12]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[13]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[14]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[15]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[16]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[17]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[18]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[19]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[20]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[21]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[22]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[23]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[24]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[25]).'</Data></Cell>
    ';
        if($zagod==1)
            $s.='<Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[26]).'</Data></Cell>';
        $s.='
   </Row>';


$n+=40;
        $main_string.=  '<Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.$n.'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">';
        $main_string.=  $s;
        $main_string.= '</Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <Worksheet ss:Name="Почас.">';
      $s='   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="4"/>
   <Column ss:Index="7" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="8"/>
   <Column ss:Index="17" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"
    ss:Span="3"/>
   <Column ss:Index="21" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">УМУ, отдел АСУ</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Российский Государственный Университет нефти и газа имени И.М. Губкина</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$time1.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="4">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  '.$semestr.'  семестр '.$year.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="6" ss:Height="104.25">
    <Cell ss:StyleID="s58"><Data ss:Type="String">Почасовики</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего за семестр</Data></Cell>
    ';
        if($zagod)
            $s.='<Cell ss:StyleID="s65"><Data ss:Type="String">Всего за год</Data></Cell>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="String">Почасовики</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"/>';
        $s.='
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s58"><Data ss:Type="String">Почасовики</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s58"/>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"/>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">27</Data></Cell>';
        if($zagod)
            $s.='<Cell ss:StyleID="s58"><Data ss:Type="Number">28</Data></Cell>';
        $s.='
   </Row>';
        //дынные
        $n=0;
        $sum=array();
        $sum_f=array();
        //данные
        $sql="SELECT DIVID,DIVABBREVIATE FROM V_SPI_KAFEDR WHERE FACID='$fac' ORDER BY DIVABBREVIATE";

        $cur1=execq($sql);
        foreach($cur1 as $k=>$row){

            $kaf=$row['DIVID'];
            $kaf_name=$row['DIVABBREVIATE'];
            $where = "WHERE DIVID='$kaf' AND studyid='$studyid' AND FOR_SORT=3";

            if($zagod==1)$sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
		   	sum(f_SEMESTR)f_SEMESTR
		 	from temp_semestr_kategor
		 	WHERE  DIVID='$kaf' AND YEAR_GROCODE='$year' AND FOR_SORT=3
		 	group  by  YEAR_GROCODE";


            $sql="select
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME,
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH,
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR,
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12,
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15,
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20,
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim,
		  sum(vsego25)vsego25,
		  sum(SEMESTR)SEMESTR,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME,
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH,
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR,
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12,
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15,
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20,
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim,
		  sum(f_vsego25)  f_vsego25,
		  sum(f_SEMESTR)f_SEMESTR
		 from temp_semestr_kategor  $where";


            $cur=execq($sql);
            //


            foreach($cur as $k=>$row){
                $j=0;
                $LECTIME=$row['LECTIME'];
                $sum[$j]+=$LECTIME; $j++;
                $SEMTIME=$row['SEMTIME'];
                $sum[$j]+=$SEMTIME; $j++;
                $LABTIME=$row['LABTIME'];
                $sum[$j]+=$LABTIME; $j++;
                $VSEGO5=$row['VSEGO5'];
                $sum[$j]+=$VSEGO5; $j++;
                $EKZ_ZACH=$row['EKZ_ZACH'];
                $sum[$j]+=$EKZ_ZACH; $j++;
                $ITOGO7=$row['ITOGO7'];
                $sum[$j]+=$ITOGO7; $j++;
                $KPR=$row['KPR'];
                $sum[$j]+=$KPR; $j++;
                $N9=$row['N9'];
                $sum[$j]+=$N9; $j++;
                $N10=$row['N10'];
                $sum[$j]+=$N10; $j++;
                $N11=$row['N11'];
                $sum[$j]+=$N11; $j++;
                $N12=$row['N12'];
                $sum[$j]+=$N12; $j++;
                $VSEGO13=$row['VSEGO13'];
                $sum[$j]+=$VSEGO13; $j++;
                $VSEGOPLAN=$row['VSEGOPLAN'];
                $sum[$j]+=$VSEGOPLAN; $j++;
                $N15=$row['N15'];
                $sum[$j]+=$N15; $j++;
                $N16=$row['N16'];
                $sum[$j]+=$N16; $j++;
                $N17=$row['N17'];
                $sum[$j]+=$N17; $j++;
                $N18=$row['N18'];
                $sum[$j]+=$N18; $j++;
                $N19=$row['N19'];
                $sum[$j]+=$N19; $j++;
                $N20=$row['N20'];
                $sum[$j]+=$N20; $j++;
                $VSEGO21=$row['VSEGO21'];
                $sum[$j]+=$VSEGO21; $j++;
                $N22=$row['N22'];
                $sum[$j]+=$N22; $j++;
                $N23=$row['N23'];
                $sum[$j]+=$N23; $j++;
                $N24=$row['N24'];
                $sum[$j]+=$N24; $j++;
                $PRIM=$row['PRIM'];
                $sum[$j]+=$PRIM; $j++;
                $VSEGO25=$row['VSEGO25'];
                $sum[$j]+=$VSEGO25; $j++;
                $SEMESTR=$row['SEMESTR'];
                $sum[$j]+=$SEMESTR; $j=0;
                $F2=$row['F_LECTIME'];
                $sum_f[$j]+=$F2; $j++;
                $F3=$row['F_SEMTIME'];
                $sum_f[$j]+=$F3; $j++;
                $F4=$row['F_LABTIME'];
                $sum_f[$j]+=$F4; $j++;
                $F_VSEGO5=$row['F_VSEGO5'];
                $sum_f[$j]+=$F_VSEGO5; $j++;
                $F6=$row['F_EKZ_ZACH'];
                $sum_f[$j]+=$F6; $j++;
                $F_ITOGO7=$row['F_ITOGO7'];
                $sum_f[$j]+=$F_ITOGO7; $j++;
                $F8=$row['F_KPR'];
                $sum_f[$j]+=$F8; $j++;
                $F9=$row['F9'];
                $sum_f[$j]+=$F9; $j++;
                $F10=$row['F10'];
                $sum_f[$j]+=$F10; $j++;
                $F11=$row['F11'];
                $sum_f[$j]+=$F11; $j++;
                $F12=$row['F12'];
                $sum_f[$j]+=$F12; $j++;
                $F_VSEGO13=$row['F_VSEGO13'];
                $sum_f[$j]+=$F_VSEGO13; $j++;
                $F_VSEGOPLAN=$row['F_VSEGOPLAN'];
                $sum_f[$j]+=$F_VSEGOPLAN; $j++;
                $F15=$row['F15'];
                $sum_f[$j]+=$F15; $j++;
                $F16=$row['F16'];
                $sum_f[$j]+=$F16; $j++;
                $F17=$row['F17'];
                $sum_f[$j]+=$F17; $j++;
                $F18=$row['F18'];
                $sum_f[$j]+=$F18; $j++;
                $F19=$row['F19'];
                $sum_f[$j]+=$F19; $j++;
                $F20=$row['F20'];
                $sum_f[$j]+=$F20; $j++;
                $F_VSEGO21=$row['F_VSEGO21'];
                $sum_f[$j]+=$F_VSEGO21; $j++;
                $F22=$row['F22'];
                $sum_f[$j]+=$F22; $j++;
                $F23=$row['F23'];
                $sum_f[$j]+=$F23; $j++;
                $F24=$row['F24'];
                $sum_f[$j]+=$F24; $j++;
                $FPRIM=$row['FPRIM'];
                $sum_f[$j]+=$FPRIM; $j++;
                $F_VSEGO25=$row['F_VSEGO25'];
                $sum_f[$j]+=$F_VSEGO25; $j++;
                $F_SEMESTR=$row['F_SEMESTR'];
                $sum_f[$j]+=$F_SEMESTR; $j++;


                if($zagod==1){
                    $j=26;
                    $cur2=execq($sql2);
                    $vsegogod=$row['SEMESTR'];
                    $sum[$j]+=$vsegogod;
                    $fvsegogod=$row['F_SEMESTR'];
                    $sum_f[$j]+=$fvsegogod;
                }
                $s.='  <Row>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($kaf_name).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SEMESTR).'</Data></Cell>';
                if($zagod==1) $s.='<Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod).'</Data></Cell>';$s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s67"><Data ss:Type="String">'.trim('').'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F2).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F3).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F4).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F6).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F8).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($FPRIM).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SEMESTR).'</Data></Cell>';
                if($zagod==1) $s.='<Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod).'</Data></Cell>';$s.='

   </Row>';

                $n+=2;
            }}
        $s.='<Row>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Итого:</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[0]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[1]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[2]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[3]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[4]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[5]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[6]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[7]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[8]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[9]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[10]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[11]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[12]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[13]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[14]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[15]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[16]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[17]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[18]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[19]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[20]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[21]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[22]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[23]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[24]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[25]).'</Data></Cell>';
        if($zagod==1)
            $s.='<Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum[26]).'</Data></Cell>';
        $s.='
   </Row>
   <Row>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Итого (факт):</Data></Cell>
     <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[0]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[1]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[2]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[3]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[4]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[5]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[6]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[7]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[8]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[9]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[10]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[11]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[12]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[13]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[14]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[15]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[16]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[17]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[18]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[19]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[20]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[21]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[22]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[23]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[24]).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[25]).'</Data></Cell>
    ';
        if($zagod==1)
            $s.='<Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($sum_f[26]).'</Data></Cell>';
        $s.='
   </Row>';


        $n+=40;

$main_string.='<Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.$n.'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">';
        $main_string.= $s;
        $main_string.= '</Table>';
        break;
    }
    case 2:
    {

        $sql="begin temp_umu($fac,$studyid1); end;";
//echo $sql;
        execq($sql);

        $main_string.='
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
  <Colors>
   <Color>
    <Index>4</Index>
    <RGB>#FFFF99</RGB>
   </Color>
  </Colors>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>5490</WindowHeight>
  <WindowWidth>9660</WindowWidth>
  <WindowTopX>0</WindowTopX>
  <WindowTopY>0</WindowTopY>
  <ActiveSheet>1</ActiveSheet>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial" x:CharSet="204"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s15">
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s57">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
    ss:WrapText="1"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Color="#000080"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s58">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Color="#000080"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s59">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s60">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Interior ss:Color="#FFFF99" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s61">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s62">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Interior ss:Color="#FFFF99" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s63">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s70">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Color="#000080"/>
   <Protection ss:Protected="0"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Итог.">';

        $s='<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="4"/>
   <Column ss:Index="7" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="8"/>
   <Column ss:Index="17" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"
    ss:Span="3"/>
   <Column ss:Index="21" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">УМУ, отдел АСУ</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Российский Государственный Университет нефти и газа имени И.М. Губкина</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$time1.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="4">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Осенний  семестр '.$year.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="6">
    <Cell ss:MergeDown="1" ss:StyleID="s70"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s70"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s70"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2"/>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s58"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s65"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">27</Data></Cell>
   </Row>';
        //данные
        $n=0;
        $sort="";
            for($j=1;$j<5;$j++)
        {

          if($j==4)
              $sort="";
            else
                $sort="AND FOR_SORT='$j'";



            $sql="select YEAR_GROCODE,
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME,
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH,
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR,
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12,
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15,
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20,
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim,
		  sum(vsego25)vsego25,
		  sum(SEMESTR)SEMESTR,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME,
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH,
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR,
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12,
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15,
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20,
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim,
		  sum(f_vsego25)  f_vsego25,
		  sum(f_SEMESTR)f_SEMESTR
		 from temp_semestr_kategor
		 WHERE studyid='$studyid1'  AND FACID='$fac'  $sort
			                   group  by FACID, SPRING_AUTUMN,YEAR_GROCODE";
            //$main_string.= $sql;
            $cur=execq($sql);
            foreach($cur as $k=>$row)
            {
                $vsegozagod=0;
                $fvsegozagod=0;

                $LECTIME=$row['LECTIME'];
                $SEMTIME=$row['SEMTIME'];
                $LABTIME=$row['LABTIME'];
                $VSEGO5=$row['VSEGO5'];
                $EKZ_ZACH=$row['EKZ_ZACH'];
                $ITOGO7=$row['ITOGO7'];
                $KPR=$row['KPR'];
                $N9=$row['N9'];
                $N10=$row['N10'];;
                $N11=$row['N11'];
                $N12=$row['N12'];
                $VSEGO13=$row['VSEGO13'];
                $vsegozagod+=$VSEGOPLAN=$row['VSEGOPLAN'];
                $N15=$row['N15'];;
                $N16=$row['N16'];
                $N17=$row['N17'];
                $N18=$row['N18'];
                $N19=$row['N19'];
                $N20=$row['N20'];
                $vsegozagod+=$VSEGO21=$row['VSEGO21'];
                $N22=$row['N22'];
                $N23=$row['N23'];
                $N24=$row['N24'];
                $PRIM=$row['PRIM'];
                $VSEGO25=$row['VSEGO25'];
                $SEMESTR=$row['SEMESTR'];
                $F_LECTIME=$row['F_LECTIME'];
                $F_SEMTIME=$row['F_SEMTIME'];
                $F_LABTIME=$row['F_LABTIME'];
                $F_VSEGO5=$row['F_VSEGO5'];
                $F_EKZ_ZACH=$row['F_EKZ_ZACH'];
                $F_ITOGO7=$row['F_ITOGO7'];
                $F_KPR=$row['F_KPR'];
                $F9=$row['F9'];
                $F10=$row['F10'];
                $F11=$row['F11'];
                $F12=$row['F12'];
                $F_VSEGO13=$row['F_VSEGO13'];
                $F_VSEGOPLAN=$row['F_VSEGOPLAN'];
                $F15=$row['F15'];
                $F16=$row['F16'];
                $F17=$row['F17'];
                $F18=$row['F18'];
                $F19=$row['F19'];
                $F20=$row['F20'];
                $F_VSEGO21=$row['F_VSEGO21'];
                $F22=$row['F22'];
                $F23=$row['F23'];
                $F24=$row['F24'];
                $FPRIM=$row['FPRIM'];
                $F_VSEGO25=$row['F_VSEGO25'];
                $F_SEMESTR=$row['F_SEMESTR'];

                switch($j)
                {
                    case 1:
                        $ttt='Всего штат.';
                        break;
                    case 2:
                        $ttt='Всего совм.';
                        break;
                    case 3:
                        $ttt='Всего почас.';
                        break;
                    case 4:
                        $ttt='Всего по факультету';
                        break;
                }
                $s.=' <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.trim($ttt).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SEMESTR).'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.trim($F_LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_KPR).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SEMESTR).'</Data></Cell>
   </Row>';


          $n+=2;

        }
        }
        $s.= '<Row></Row><Row></Row><Row></Row>';
        $s.=  '   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Весенний  семестр '.$year.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>

   </Row><Row>

    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:Index="15" ss:StyleID="s58"><Data ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String"> </Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">  </Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего за год</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">27</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">28</Data></Cell>
   </Row>';
        for($j=1;$j<6;$j++)
        {

            switch($j)
            {
                case 1:

                    $where="WHERE studyid='$studyid2' AND FACID='$fac' AND FOR_SORT='$j'
			 group  by  FACID, SPRING_AUTUMN,YEAR_GROCODE";
                    $sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
                                sum(f_SEMESTR)f_SEMESTR
                                from temp_semestr_kategor
                                WHERE YEAR_GROCODE='$year' AND FACID='$fac'  AND FOR_SORT='$j'
                                group  by  YEAR_GROCODE";
                    break;

                case 2:

                    $where="WHERE studyid='$studyid2' AND FACID='$fac' AND FOR_SORT='$j'
			 group  by FACID,  SPRING_AUTUMN,YEAR_GROCODE";
                    $sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
                                 sum(f_SEMESTR)f_SEMESTR
                                 from temp_semestr_kategor
                                 WHERE YEAR_GROCODE='$year' AND FACID='$fac'  AND FOR_SORT='$j'
                                 group  by  YEAR_GROCODE";
                    break;

                case 3:

                    $where="WHERE studyid='$studyid2' AND FACID='$fac' AND FOR_SORT='$j'
			 group  by  FACID,  SPRING_AUTUMN,YEAR_GROCODE";
                         $sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
                                 sum(f_SEMESTR)f_SEMESTR
                                 from temp_semestr_kategor
                                 WHERE YEAR_GROCODE='$year' AND FACID='$fac'  AND FOR_SORT='$j'
                                 group  by  YEAR_GROCODE";
                    break;

                case 4:

                    $where="WHERE studyid='$studyid2' AND FACID='$fac'
			 group  by FACID,  SPRING_AUTUMN,YEAR_GROCODE";
                    $sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
                                        sum(f_SEMESTR)f_SEMESTR
                                        from temp_semestr_kategor
                                        WHERE YEAR_GROCODE='$year' AND FACID='$fac'
                                        group  by  YEAR_GROCODE";
                    break;

                  case 5:

                          $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac'
               group by FACID,YEAR_GROCODE";
                          $sql2="select YEAR_GROCODE, sum(SEMESTR)SEMESTR,
                 sum(f_SEMESTR)f_SEMESTR
               from temp_semestr_kategor
               WHERE YEAR_GROCODE='$year' AND FACID='$fac'
               group  by  YEAR_GROCODE";


                      break;
            }

            $sql="select YEAR_GROCODE,
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME,
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH,
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR,
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12,
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15,
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20,
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim,
		  sum(vsego25)vsego25,
		  sum(SEMESTR)SEMESTR,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME,
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH,
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR,
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12,
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15,
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20,
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim,
		  sum(f_vsego25)  f_vsego25,
		  sum(f_SEMESTR)f_SEMESTR
		 from temp_semestr_kategor
		 $where";

            $cur=execq($sql);
            foreach($cur as $k=>$row)
            {
                $vsegozagod=0;
                $fvsegozagod=0;

                $LECTIME=$row['LECTIME'];
                $SEMTIME=$row['SEMTIME'];
                $LABTIME=$row['LABTIME'];
                $VSEGO5=$row['VSEGO5'];
                $EKZ_ZACH=$row['EKZ_ZACH'];
                $ITOGO7=$row['ITOGO7'];
                $KPR=$row['KPR'];
                $N9=$row['N9'];
                $N10=$row['N10'];;
                $N11=$row['N11'];
                $N12=$row['N12'];
                $VSEGO13=$row['VSEGO13'];
                $vsegozagod+=$VSEGOPLAN=$row['VSEGOPLAN'];
                $N15=$row['N15'];;
                $N16=$row['N16'];
                $N17=$row['N17'];
                $N18=$row['N18'];
                $N19=$row['N19'];
                $N20=$row['N20'];
                $vsegozagod+=$VSEGO21=$row['VSEGO21'];
                $N22=$row['N22'];
                $N23=$row['N23'];
                $N24=$row['N24'];
                $PRIM=$row['PRIM'];
                $VSEGO25=$row['VSEGO25'];
                $SEMESTR=$row['SEMESTR'];
                $F_LECTIME=$row['F_LECTIME'];
                $F_SEMTIME=$row['F_SEMTIME'];
                $F_LABTIME=$row['F_LABTIME'];
                $F_VSEGO5=$row['F_VSEGO5'];
                $F_EKZ_ZACH=$row['F_EKZ_ZACH'];
                $F_ITOGO7=$row['F_ITOGO7'];
                $F_KPR=$row['F_KPR'];
                $F9=$row['F9'];
                $F10=$row['F10'];
                $F11=$row['F11'];
                $F12=$row['F12'];
                $F_VSEGO13=$row['F_VSEGO13'];
                $F_VSEGOPLAN=$row['F_VSEGOPLAN'];
                $F15=$row['F15'];
                $F16=$row['F16'];
                $F17=$row['F17'];
                $F18=$row['F18'];
                $F19=$row['F19'];
                $F20=$row['F20'];
                $F_VSEGO21=$row['F_VSEGO21'];
                $F22=$row['F22'];
                $F23=$row['F23'];
                $F24=$row['F24'];
                $FPRIM=$row['FPRIM'];
                $F_VSEGO25=$row['F_VSEGO25'];
                $F_SEMESTR=$row['F_SEMESTR'];

                    $cur2=execq($sql2);
                     $vsegogod=$cur2[0]['SEMESTR'];
                     $fvsegogod=$cur2[0]['F_SEMESTR'];

                switch($j)
                {
                    case '1':
                        $ttt='Всего штат.';
                        break;
                    case '2':
                        $ttt='Всего совм.';
                        break;
                    case '3':
                        $ttt='Всего почас.';
                        break;
                    case '4':
                            $ttt='Всего по факультету';
                        break;
                    case '5':

                        $ttt='Всего по факультету за год';
                        break;
                }

                $s.=' <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.trim($ttt).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SEMESTR).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($vsegogod).'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.trim($F_LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_KPR).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SEMESTR).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($fvsegogod).'</Data></Cell>
   </Row>';


                $n+=2;

            }
        }

$n+=40;

        $main_string.= ' <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.$n.'" x:FullColumns="1"
        x:FullRows="1" ss:StyleID="s15">';
        $main_string.= $s;


        //данные по первой вкладке 2
        $main_string.='     </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <TopRowVisible>8</TopRowVisible>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <Worksheet ss:Name="Годовая">';
        //данные
       $s='<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="82.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="3"/>
   <Column ss:Index="6" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="4"/>
   <Column ss:Index="14" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Column ss:Index="16" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="22" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="3"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Column ss:Index="29" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="40.5"
    ss:Span="1"/>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">УМУ, отдел АСУ</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Российский Государственный Университет нефти и газа имени И.М. Губкина</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$time1.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">преподавателей факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="4">
    <Cell ss:StyleID="s57"><Data ss:Type="String">Объем выполненой работы за  '.$year.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:Index="29" ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row ss:Index="6">
    <Cell ss:MergeDown="1" ss:StyleID="s70"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s70"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s70"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Всего за год</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Средняя ауд. нагрузка</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s65"><Data ss:Type="String">Средняя нагрузка общ.</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s58"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s58"/>
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s58"/>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ППС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s65"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="String">Прочее</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">27</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">28</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">29</Data></Cell>
    <Cell ss:StyleID="s58"><Data ss:Type="Number">30</Data></Cell>
   </Row>';


        for($j=1;$j<8;$j++)
        {

                $FACUL="";
                $FACUL_GROUP_BY="";

            switch($j)
            {

                case '1':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT='1' AND GRUPPA='$j' group by FACID, YEAR_GROCODE";
                    break;

                case '2':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT='1' AND GRUPPA='$j' group by FACID, YEAR_GROCODE";
                    break;

                case '3':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT='1' AND GRUPPA='$j' group by  FACID, YEAR_GROCODE";
                    break;

                case '4':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT='1' AND GRUPPA='$j' group by FACID, YEAR_GROCODE";
                    break;

                case '5':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT='2' group by FACID, YEAR_GROCODE";
                    break;

                case '6':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT='3' group by FACID, YEAR_GROCODE";
                    break;

                case '7':
                    $where="WHERE YEAR_GROCODE='$year' AND FACID='$fac' AND FOR_SORT!=3 group by FACID, YEAR_GROCODE";
                    break;
            }



            $sql="select sum(LECTIME) LECTIME,
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME,
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH,
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR,
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12,
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15,
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20,
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim,
		  sum(vsego25)vsego25,
		  sum(GOD)GOD,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME,
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH,
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR,
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12,
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15,
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20,
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim,
		  sum(f_vsego25)  f_vsego25,
		  sum(f_GOD)f_GOD, sum(KOL_PREPOD) KOL_PREPOD, sum(KOL_STAVKI) KOL_STAVKI FROM temp_GOD $where";
            echo $sql;
            $cur=execq($sql);
            foreach($cur as $k=>$row)
            {
                $vsegozagod=0;
                $fvsegozagod=0;
                $LECTIME=$row['LECTIME'];
                $SEMTIME=$row['SEMTIME'];
                $LABTIME=$row['LABTIME'];
                $VSEGO5=$row['VSEGO5'];
                $EKZ_ZACH=$row['EKZ_ZACH'];
                $ITOGO7=$row['ITOGO7'];
                $KPR=$row['KPR'];
                $N9=$row['N9'];
                $N10=$row['N10'];
                $N11=$row['N11'];
                $N12=$row['N12'];
                $VSEGO13=$row['VSEGO13'];
                $VSEGOPLAN=$row['VSEGOPLAN'];
                $N15=$row['N15'];
                $N16=$row['N16'];
                $N17=$row['N17'];
                $N18=$row['N18'];
                $N19=$row['N19'];
                $N20=$row['N20'];
                $VSEGO21=$row['VSEGO21'];
                $N22=$row['N22'];
                $N23=$row['N23'];
                $N24=$row['N24'];
                $PRIM=$row['PRIM'];
                $VSEGO25=$row['VSEGO25'];
                $GOD=$row['GOD'];
                $F_LECTIME=$row['F_LECTIME'];
                $F_SEMTIME=$row['F_SEMTIME'];
                $F_LABTIME=$row['F_LABTIME'];
                $F_VSEGO5=$row['F_VSEGO5'];
                $F_EKZ_ZACH=$row['F_EKZ_ZACH'];
                $F_ITOGO7=$row['F_ITOGO7'];
                $F_KPR=$row['F_KPR'];
                $F9=$row['F9'];
                $F10=$row['F10'];
                $F11=$row['F11'];
                $F12=$row['F12'];
                $F_VSEGO13=$row['F_VSEGO13'];
                $F_VSEGOPLAN=$row['F_VSEGOPLAN'];
                $F15=$row['F15'];
                $F16=$row['F16'];
                $F17=$row['F17'];
                $F18=$row['F18'];
                $F19=$row['F19'];
                $F20=$row['F20'];
                $F_VSEGO21=$row['F_VSEGO21'];
                $F22=$row['F22'];
                $F23=$row['F23'];
                $F24=$row['F24'];
                $FPRIM=$row['FPRIM'];
                $F_VSEGO25=$row['F_VSEGO25'];
                $F_GOD=$row['F_GOD'];
                $KOL_PREPOD=$row['KOL_PREPOD'];
                $KOL_STAVKI=$row['KOL_STAVKI'];
                $SR_AUD = round($ITOGO7/$KOL_STAVKI,0);
                $SR_OB = round($GOD/$KOL_STAVKI,0);
                $F_SR_AUD = round($F_ITOGO7/$KOL_PREPOD,0);
                $F_SR_OB = round($F_GOD/$KOL_PREPOD,0);



                switch($j)
                {
                    case '1':
                        $ttt='Проф. и зав. каф. проф';
                        break;
                    case '2':
                        $ttt='Доценты и зав. каф.-доц.';
                        break;
                    case '3':
                        $ttt='Ст.преп. и зав.каф. ст. преп.';
                        break;
                    case '4':
                        $ttt='Ассистенты и преподаватели';
                        break;
                    case '5':
                        $ttt='Совместители';
                        break;
                    case '6':
                        $ttt='Почасовики';
                        break;
                    case '7':
                        $ttt='Всего';
                        break;
                }

                if($KOL_STAVKI!=1)
                {
                    $KOL_STAVKI = str_replace(".", ",", $KOL_STAVKI);
                }
                $s.=' <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.trim($ttt).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KOL_STAVKI).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($KPR).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N9).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N10).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N11).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N12).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N15).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N16).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N17).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N18).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N19).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N20).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N22).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N23).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($N24).'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.trim($VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($GOD).'</Data></Cell>
                  <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SR_AUD).'</Data></Cell>
                    <Cell ss:StyleID="s63"><Data ss:Type="String">'.trim($SR_OB).'</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.trim($KOL_PREPOD).'</Data></Cell>
    <Cell  ss:StyleID="s61"><Data ss:Type="String">'.trim($F_LECTIME).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_SEMTIME).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_LABTIME).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO5).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_EKZ_ZACH).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_ITOGO7).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F_KPR).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F9).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F10).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F11).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F12).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO13).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_VSEGOPLAN).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F15).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F16).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F17).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F18).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F19).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F20).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO21).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F22).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F23).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($F24).'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.trim($PRIM).'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.trim($F_VSEGO25).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_GOD).'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SR_AUD).'</Data></Cell>
                    <Cell ss:StyleID="s64"><Data ss:Type="String">'.trim($F_SR_OB).'</Data></Cell>
   </Row>';

$n+=2;
            }
        }

        //expan
        $main_string.= '  <Table ss:ExpandedColumnCount="30" ss:ExpandedRowCount="'.$n.'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">';
        $main_string.= $s;

        $main_string.= '</Table>';
        break;
    }
    case 3:
    {
        $sql="begin temp_umu($fac,$studyid1); end;";
//echo $sql;
        execq($sql);
        $main_string.= '<OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
    <AllowPNG/>
</OfficeDocumentSettings>
<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
    <WindowHeight>5490</WindowHeight>
    <WindowWidth>9660</WindowWidth>
    <WindowTopX>0</WindowTopX>
    <WindowTopY>0</WindowTopY>
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
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
    ss:WrapText="1"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Color="#000080"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Center"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Color="#000080"
    ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s66">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
 </Styles>';
        $s="";
        $s1=' <Row ss:Index="25">
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"><Data ss:Type="String">Предложение по плановой численности ППС (c почасовиками) факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
   </Row>
    <Row ss:Index="27">
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"><Data ss:Type="String">на  '.$period.' учебный год</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
   </Row>';
        $number=10;
        $number_poch=30;
        $itog1=$itog2=$itog3=$itog4=$itog5=$itog6=$itog7=$itog8=$itog9=$itog10=0;
        if ($fac!=9 && $fac!=11)	{
        $sum=array();
        $sum_f=array();
        $itog1=$itog2=$itog3=$itog4=$itog5=$itog6=$itog7=$itog8=$itog9=$itog10=0;


        $sql="select divid,divabbreviate from v_spi_kafedr where facid='$fac' order by divabbreviate";
        $cur=execq($sql);
        foreach ($cur as $k => $row) {
            $kaf		= $row['DIVID'];
            $kaf_name	= $row['DIVABBREVIATE'];

            $sql1="SELECT A.SEM as SEM1, B.SEM as SEM2, A.ITOG as ITOG1, B.ITOG as ITOG2, C.STAVKA_ST as STAVKA_ST, C.VSEGO_ST as VSEGO_ST FROM
							(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from temp_semestr_kategor where  divid='$kaf' and year_grocode='$year' and for_sort<>3) A,
							(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from temp_semestr_kategor where divid='$kaf' and year_grocode='$period'  and for_sort<>3) B,
							(SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_ST,SUM(VSEGO) AS VSEGO_ST
						from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 1 group by stat_id,stat) C";
            $cur1=execq($sql1);

            $sql21="SELECT A.SEM as SEM1, B.SEM as SEM2, A.ITOG as ITOG1, B.ITOG as ITOG2, C.STAVKA_ST as STAVKA_ST, C.VSEGO_ST as VSEGO_ST FROM
							(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from temp_semestr_kategor where  divid='$kaf' and year_grocode='$year' ) A,
							(select SUM(semestr) AS SEM, SUM(itogo7) AS ITOG from temp_semestr_kategor where divid='$kaf' and year_grocode='$period' ) B,
							(SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_ST,SUM(VSEGO) AS VSEGO_ST
						from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 1 group by stat_id,stat) C";
            $cur21=execq($sql21);

            $sql3="SELECT D.STAVKA_SOVM as STAVKA_SOVM, D.VSEGO_SOVM as VSEGO_SOVM FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_SOVM,SUM(VSEGO) AS VSEGO_SOVM from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 2 group by stat_id,stat) D";
            $cur3=execq($sql3);

            $sql2="select E.STAVKA_SOVM2 as STAVKA_SOVM2, E.VSEGO_SOVM2 as VSEGO_SOVM2 FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_SOVM2,SUM(VSEGO) AS VSEGO_SOVM2 from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 4 group by stat_id,stat) E";
            $cur2=execq($sql2);

            $sql6="select F.STAVKA_POCH as STAVKA_POCH, F.VSEGO_POCH as VSEGO_POCH FROM (SELECT STAT_ID,STAT,SUM(SUM_STAVKA) AS STAVKA_POCH,SUM(VSEGO) AS VSEGO_POCH from Z_PREPOD_UMU WHERE DIVID='$kaf' AND STAT_ID = 3 group by stat_id,stat) F";
            $cur6=execq($sql6);

            $sql4="SELECT NOMRMATIV FROM DIVISION WHERE DIVID='$kaf'";
            $cur4=execq($sql4);

            $sql7="SELECT PPS FROM DIVISION_PPS WHERE DIVID='$kaf' AND YEAR_GROCODE='$year'";
            $cur7=execq($sql7);

            $plan_chisl=$cur7[0]['PPS'];

            $f_sem=$cur1[0]['SEM1'];
            $sem=$cur1[0]['SEM2'];
            $f_itog=$cur1[0]['ITOG1'];
            $itog=$cur1[0]['ITOG2'];
            $stavka_st=$cur1[0]['STAVKA_ST'];
            $vsego_st=$cur1[0]['VSEGO_ST'];

            $stavka_sovm=$cur3[0]['STAVKA_SOVM'];
            $vsego_sovm=$cur3[0]['VSEGO_SOVM'];

            $stavka_st += $stavka_sovm;
            $vsego_st += $vsego_sovm;

            $stavka_sovm2=$cur2[0]['STAVKA_SOVM2'];
            $vsego_sovm2=$cur2[0]['VSEGO_SOVM2'];

            //$stavka_sovm = $stavka_sovm2;
            //$vsego_sovm = $vsego_sovm2;

            $stavka_vsego = $stavka_st + $stavka_sovm2 ;//+ $stavka_pochas;
            $vsego_vsego = $vsego_st + $vsego_sovm2;// + $vsego_pochas;


            $normativ=$cur4[0]['NOMRMATIV'];
            $chisl_obsch=round(trim($sem/900));
            $chisl_aud=round(trim($itog/(35*$normativ)));

            $stavka_pochas=$cur6[0]['STAVKA_POCH'];
            $vsego_pochas=$cur6[0]['VSEGO_POCH'];

            $stavka_vsego_poch = $stavka_st + $stavka_sovm2 + $stavka_pochas;
            $vsego_vsego_poch = $vsego_st + $vsego_sovm2 + $vsego_pochas;

            $f_sem2=$cur21[0]['SEM1'];
            $sem2=$cur21[0]['SEM2'];
            $f_itog2=$cur21[0]['ITOG1'];
            $itog2=$cur21[0]['ITOG2'];
            $stavka_st2=$cur21[0]['STAVKA_ST'];
            $vsego_st2=$cur21[0]['VSEGO_ST'];

            $chisl_obsch2=round(trim($sem2/900));
            $chisl_aud2=round(trim($itog2/(35*$normativ)));

            ///////////////////////////////////////////////////////////////////////////
            $sql0 = "SELECT DECODE(trunc(sum( SUM_STAVKA )), sum( SUM_STAVKA ), TO_CHAR(sum( SUM_STAVKA )), TO_CHAR(sum( SUM_STAVKA ), 'FM999999999990D999999999999')) as SUM_STAVKA FROM  Z_PREPOD_UMU where DIVID = '$kaf' AND STAT_ID in ( 1, 2 )";
            $cur0 = execq($sql0);
            $stavka_shtat			= $cur0[0]['SUM_STAVKA'];

            $sql0 = "SELECT  DECODE(trunc(sum( SUM_STAVKA )), sum( SUM_STAVKA ), TO_CHAR(sum( SUM_STAVKA )), TO_CHAR(sum( SUM_STAVKA ), 'FM999999999990D999999999999')) as SUM_STAVKA FROM  Z_PREPOD_UMU where DIVID = '$kaf' AND STAT_ID in ( 4 )";
            $cur0 = execq($sql0);
            $stavka_sovmest			= $cur0[0]['SUM_STAVKA'];

            $sql0 = "SELECT DECODE(trunc(sum( SUM_STAVKA )), sum( SUM_STAVKA ), TO_CHAR(sum( SUM_STAVKA )), TO_CHAR(sum( SUM_STAVKA ), 'FM999999999990D999999999999')) as SUM_STAVKA FROM  Z_PREPOD_UMU where DIVID   = '$kaf' AND   STAT_ID in ( 1, 2, 4 )";
            $cur0 = execq($sql0);
            $stavka_sht_vsego		= $cur0[0]['SUM_STAVKA'];

            $sql0 = "SELECT DECODE(trunc(sum( SUM_STAVKA )), sum( SUM_STAVKA ), TO_CHAR(sum( SUM_STAVKA )), TO_CHAR(sum( SUM_STAVKA ), 'FM999999999990D999999999999')) as SUM_STAVKA FROM  Z_PREPOD_UMU where DIVID = '$kaf' AND STAT_ID in ( 1, 2, 3, 4 )";
            $cur0 = execq($sql0);
            $stavka_sht_vsego_poch	= $cur0[0]['SUM_STAVKA'];

            ///////////////////////////////////////////////////////////////////////////
            $s.= '
                <Row ss:Index="'.$number.'">
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($kaf_name).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($plan_chisl).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($stavka_shtat).' / '.trim($stavka_sovmest).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($stavka_sht_vsego).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($f_sem).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($sem).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($f_itog).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($itog).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($normativ).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.$chisl_obsch.'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.$chisl_aud.'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.' '.'</Data></Cell>
               </Row>';
            $s1.='
               <Row ss:Index="'.$number_poch.'">
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($kaf_name).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($plan_chisl).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($stavka_shtat).' / '.trim($stavka_sovmest).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($stavka_sht_vsego_poch).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($f_sem2).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($sem2).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($f_itog2).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($itog2).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.trim($normativ).'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.$chisl_obsch2.'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.$chisl_aud2.'</Data></Cell>
                <Cell ss:StyleID="s65"><Data ss:Type="String">'.' '.'</Data></Cell>
               </Row>
            ';
            //			$itog0	=$itog0+$plan_chisl;
            //			$itog1	=$itog1+$stavka_shtat;
            //			$itog2	=$itog2+$stavka_sovmest;
            //			$itog3	=$itog3+$stavka_sht_vsego;
            $itog4	=$itog4+$f_sem;
            $itog5	=$itog5+$sem;
            $itog6	=$itog6+$f_itog;
            $itog7	=$itog7+$itog;
            $itog8	=$itog8+$chisl_obsch;
            $itog9	=$itog9+$chisl_aud;

            //			$itog_0	=$itog_0+$plan_chisl;
            //			$itog_1	=$itog_1+$stavka_shtat;
            //			$itog_2	=$itog_2+$stavka_sovmest;
            //			$itog_3	=$itog_3+$stavka_sht_vsego_poch;
            $itog_4	=$itog_4+$f_sem2;
            $itog_5	=$itog_5+$sem2;
            $itog_6	=$itog_6+$f_itog2;
            $itog_7	=$itog_7+$itog2;
            $itog_8	=$itog_8+$chisl_obsch2;
            $itog_9	=$itog_9+$chisl_aud2;

            ///////////////////////////////////////////////////////////////////////////
            $sql77="SELECT sum( nvl( PPS, 0 ) ) as PPS FROM DIVISION_PPS WHERE DIVID in ( select divid from v_spi_kafedr where facid = '$fac') AND YEAR_GROCODE='$year'";
            $cur77=execq($sql77);
            $itog0=$cur77[0]['PPS'];

            $sql0 = "SELECT sum( nvl( SUM_STAVKA, 0 ) ) as SUM_STAVKA FROM Z_PREPOD_UMU where facid = '$fac' AND STAT_ID in ( 1, 2 )";
            $cur0 = execq($sql0);
            $itog1		=  $cur0[0]['SUM_STAVKA'];

            $sql0 = "SELECT sum( nvl( SUM_STAVKA, 0 ) ) as SUM_STAVKA FROM Z_PREPOD_UMU where facid = '$fac' AND STAT_ID in ( 4 )";
            $cur0 = execq($sql0);
            $itog2=  $cur0[0]['SUM_STAVKA'];

            $sql0 = "SELECT sum( nvl( SUM_STAVKA, 0 ) ) as SUM_STAVKA FROM Z_PREPOD_UMU where facid = '$fac' AND STAT_ID in ( 1, 2, 4 )";
            $cur0 = execq($sql0);
            $itog3=  $cur0[0]['SUM_STAVKA'];

            $sql0 = "SELECT sum( nvl( SUM_STAVKA, 0 ) ) as SUM_STAVKA FROM Z_PREPOD_UMU where facid = '$fac' AND STAT_ID in ( 1, 2, 3, 4 )";
            $cur0 = execq($sql0);
            $itog_3	=  $cur0[0]['SUM_STAVKA'];
            ///////////////////////////////////////////////////////////////////////////


            $number++;
            $number_poch++;



        }
            $s.='
<Row ss:Index="'.$number.'">
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого:</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog0).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog1).' / '.trim($itog2).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog3).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog4).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog5).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog6).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog7).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.' '.'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.round(trim($itog8)).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.round(trim($itog9)).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.' '.'</Data></Cell>
   </Row>';
   $s1.='
  <Row ss:Index="'.$number_poch.'">
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого:</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog0).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog1).' / '.trim($itog2).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog_3).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog_4).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog_5).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog_6).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.trim($itog_7).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.' '.'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.round(trim($itog_8)).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.round(trim($itog_9)).'</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">'.' '.'</Data></Cell>
   </Row>

   ';
        }
        $number_poch+=32;
        $main_string.='
 <Worksheet ss:Name="Плановая численность">
  <Table ss:ExpandedColumnCount="13" ss:ExpandedRowCount="'.$number_poch.'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s62">
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="108.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="56.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="77.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="45.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="56.25" ss:Span="3"/>
   <Column ss:Index="9" ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="45.75"
    ss:Span="1"/>
   <Column ss:Index="11" ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="56.25"
    ss:Span="1"/>
   <Row>
    <Cell ss:StyleID="s63"><Data ss:Type="String">УМУ, отдел АСУ</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"><Data ss:Type="String">Российский Государственный Университет нефти и газа имени И. М. Губкина</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$time1.'</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"><Data ss:Type="String">Предложение по плановой численности ППС (без почасовиков) факультета '.$facn.'</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
   </Row>
   <Row ss:Index="4">
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"><Data ss:Type="String">на  '.$period.' учебный год</Data></Cell>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
   </Row>
   <Row ss:Index="6">
    <Cell ss:Index="4" ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
    <Cell ss:StyleID="s63"/>
   </Row>
   <Row ss:Height="13.5"/>
   <Row ss:AutoFitHeight="0" ss:Height="33.75">
    <Cell ss:StyleID="s64"><Data ss:Type="String">Кафедры</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Планов. числ. ППС '.$year.' г.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Факт. числ. ППС '.$year.' г. (в ставках)</Data></Cell>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Общая нагр. (план) '.$year.' г.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Общая нагр. (план) '.$period.' г.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Аудит. нагр. (план) '.$year.' г.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Аудит. нагр. (план) '.$period.' г.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Норматив нед. ауд. нагрузки</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Расчёт численности</Data></Cell>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"><Data ss:Type="String">Предл. по штатам ППС '.$period.' г.</Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="22.5">
    <Cell ss:StyleID="s64"><Data ss:Type="String">Кафедры</Data></Cell>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"><Data ss:Type="String">шт./совм.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">всего</Data></Cell>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"/>
    <Cell ss:StyleID="s64"><Data ss:Type="String">по общ. нагр.</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">по ауд. нагр.</Data></Cell>
    <Cell ss:StyleID="s64"/>
   </Row>';
        $main_string.= $s;
        $main_string.= $s1;

        $main_string.= '</Table>';
        break;
    }
    case 4:
    {


        $s = '<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="82.5"/>
<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25"/>
<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="40.5" ss:Span="1"/>
<Column ss:Index="6" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25"
        ss:Span="1"/>
<Column ss:Index="8" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="40.5"/>
<Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25" ss:Span="1"/>
<Column ss:Index="11" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="45.75"/>
<Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">' . $str1 . '</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
</Row>
<Row ss:Index="3">
    <Cell ss:StyleID="s57"><Data ss:Type="String">' . $str2 . ' ' . $facname . '</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
</Row>
  <Row ss:Index="5">
    <Cell ss:StyleID="s57"><Data ss:Type="String"> Отчет сформирован на '.$time1.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
   </Row>

<Row ss:Index="7" >
    <Cell ss:StyleID="s60"/>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Категория</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Ставки</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Всего ставок</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Всего физ.лиц</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Проф.</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Доц.</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Ст.Преп.</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Преп.</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Асс.</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">Примеч.</Data></Cell>
</Row>';
        $sql = "SELECT STAT_ID,STAT,BEZ,DECODE(trunc(SUM(SUM_STAVKA)), SUM(SUM_STAVKA), TO_CHAR(SUM(SUM_STAVKA)), TO_CHAR(SUM(SUM_STAVKA), 'FM999999999990D999999999999')) as SUM_STAVKA,SUM(PROF) as PROF,SUM(DOC) as DOC,
			SUM(STAR) as STAR,SUM(PREP) as PREP,SUM(ASS) as ASS,SUM(VSEGO) as VSEGO,DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
	      from Z_PREPOD_UMU
		  WHERE FACID='$fac'
	      group by stat_id,stat,bez,stavka 
	      order by stat_id,stat, stavka DESC";
        $cur = execq($sql);
        $ret = 0;
        foreach ($cur as $k => $row) {
            $ret++;
            $STAT_ID = $row['STAT_ID'];
            $STAT = $row['STAT'];
            $BEZ = $row['BEZ'];
            $SUM_STAVKA = $row['SUM_STAVKA'];
            $PROF = $row['PROF'];
            $DOC = $row['DOC'];
            $STAR = $row['STAR'];
            $PREP = $row['PREP'];
            $VSEGO = $row['VSEGO'];
            $ASS = $row['ASS'];
            $STAVKA = $row['STAVKA'];


            $s .= '


<Row>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $ret . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $STAT . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $STAVKA . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $SUM_STAVKA . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $VSEGO . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $PROF . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $DOC . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $STAR . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $PREP . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $ASS . '</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">' . $BEZ . '</Data></Cell>
</Row>

';
        }


        $ret += 27;
        $main_string.= '
        <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
    <AllowPNG/>
</OfficeDocumentSettings>
<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
    <WindowHeight>5490</WindowHeight>
    <WindowWidth>9660</WindowWidth>
    <WindowTopX>0</WindowTopX>
    <WindowTopY>0</WindowTopY>
    <ProtectStructure>False</ProtectStructure>
    <ProtectWindows>False</ProtectWindows>
</ExcelWorkbook>
<Styles>
    <Style ss:ID="Default" ss:Name="Normal">
        <Alignment ss:Vertical="Bottom"/>
        <Borders/>
        <Font ss:FontName="Arial" x:CharSet="204"/>
        <Interior/>
        <NumberFormat/>
        <Protection/>
    </Style>
    <Style ss:ID="s15">
        <Protection ss:Protected="0"/>
    </Style>
    <Style ss:ID="s57">
        <Alignment ss:Horizontal="CenterAcrossSelection" ss:Vertical="Bottom"
        ss:WrapText="1"/>
        <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Color="#000080"/>
        <Protection ss:Protected="0"/>
    </Style>
    <Style ss:ID="s58">
        <Alignment ss:Horizontal="Left" ss:Vertical="Bottom" ss:WrapText="1"/>
        <Borders>
        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
        </Borders>
          <Font ss:FontName="Arial" x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
        <NumberFormat ss:Format="@"/>
        <Protection ss:Protected="0"/>
    </Style>
    <Style ss:ID="s59">
        <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
        <Borders>
        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
        </Borders>
          <Font ss:FontName="Arial" x:CharSet="204" x:Family="Swiss" ss:Size="8"/>
        <NumberFormat ss:Format="@"/>
        <Protection ss:Protected="0"/>
    </Style>
    <Style ss:ID="s60">
        <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
        <Borders>
        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
        </Borders>
          <Font ss:FontName="Arial" x:CharSet="204" x:Family="Swiss" ss:Size="8"
        ss:Bold="1"/>
        <NumberFormat ss:Format="@"/>
        <Protection ss:Protected="0"/>
    </Style>
</Styles>
<Worksheet ss:Name="Преподаватели кафедры">
<Table ss:ExpandedColumnCount="20" ss:ExpandedRowCount="' . $ret . '" x:FullColumns="1"
       x:FullRows="1" ss:StyleID="s15">';
        $main_string.= $s;
        $main_string.= '</Table>';
        break;
    }
}
$main_string.= '

<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
    <Print>
        <FitWidth>0</FitWidth>
        <FitHeight>0</FitHeight>
        <ValidPrinterInfo/>
        <PaperSizeIndex>0</PaperSizeIndex>
        <HorizontalResolution>600</HorizontalResolution>
        <VerticalResolution>600</VerticalResolution>
        <Gridlines/>
    </Print>
    <Selected/>
    <Panes>
        <Pane>
            <Number>3</Number>
            <ActiveRow>200</ActiveRow>
            <ActiveCol>20</ActiveCol>
        </Pane>
    </Panes>
    <ProtectObjects>False</ProtectObjects>
    <ProtectScenarios>False</ProtectScenarios>
</WorksheetOptions>
</Worksheet>
</Workbook>';
//echo $main_string;
file_put_contents($direct.$GUID.".xml", $main_string);

?>