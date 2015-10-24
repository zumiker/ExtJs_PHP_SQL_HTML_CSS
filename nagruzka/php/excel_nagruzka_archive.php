<?
/*ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);*/
set_time_limit(0);

require_once("../include.php");
$time= strtotime(date('d.m.Y H.i.s'));

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"Нагрузка-архив$time.xml\"");

$divid=$_REQUEST["divid"];
$studyid=$_REQUEST["studyid"];
$direct = $_REQUEST["direct"];
$name = $_REQUEST["GUID"];

/*ОПРЕДЕЛЯЕМ ПАРАМТРЫ ЗАГОЛОВКОВ*/

$divabbreviate = " SELECT divabbreviate
    FROM v_spi_kafedr
    WHERE divid = '$divid'";
$divabbreviate = execq($divabbreviate, true);
$divabbreviate = $divabbreviate[0]['DIVABBREVIATE'];

$god = "SELECT yearname
        FROM v_study
        WHERE studyid = '$studyid'
        ORDER BY studyid";
$god = execq($god, true);
$god = $god[0]['YEARNAME'];

$studyid = "SELECT studyid
        FROM v_study
        WHERE yearname = '$god'
        ORDER BY periodid";
$studyid = execq($studyid, true);
$studyid1 = $studyid[0]['STUDYID'];
$studyid2 = $studyid[1]['STUDYID'];

$cutdate1 = "select distinct DATE_OF_SREZ from NAGRUZKA_prepod_dwh where DIVID='$divid' AND studyid='$studyid1'";
$cutdate1 = execq($cutdate1, true);
$cutdate1 = $cutdate1[0]['DATE_OF_SREZ'];

$cutdate2 = "select distinct DATE_OF_SREZ from NAGRUZKA_prepod_dwh where DIVID='$divid' AND studyid='$studyid2'";
$cutdate2 = execq($cutdate2, true);
$cutdate2 = $cutdate2[0]['DATE_OF_SREZ'];

$date = date("d.m.Y");
$dateh = date("d.m.Y H:i ");
$main_string="";

$main_string .=  '<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>Larisa</Author>
  <Version>14.00</Version>
 </DocumentProperties>
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
  <Style ss:ID="m46542888">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m44252528">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m80964244">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m80964264">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m80963796">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m80963816">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m46543172">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m46543192">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m44251632">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m44251652">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000080"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8"/>
   <Protection ss:Protected="0"/>
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
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="8" ss:Color="#FF0000"
    ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s66">
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
  <Style ss:ID="s67">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Helvetica" x:CharSet="204" ss:Size="9" ss:Color="#000080"
    ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s68">
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
  <Style ss:ID="s74">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Arial" x:CharSet="204" x:Family="Swiss" ss:Bold="1"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s76">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
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
  <Style ss:ID="s78">
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
 </Styles>';






$sql = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
    N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
    F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, STAT_ID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
    FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid1' AND STAT_ID=1 
    ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql = execq($sql, true);

$sql1 = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
  N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
  F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, STAT_ID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
  FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid1' AND STAT_ID=2 
  ORDER BY STAT_ID, DOL_ID DESC, FIO";
  $test = $sql1;
$sql1 = execq($sql1, true);


$sql2 = "SELECT  
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid1' AND FOR_SORT = 1";
$sql2 = execq($sql2, true);



$sql3 = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
  N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
  F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, STAT_ID, PREPID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
  FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid2' AND STAT_ID=1 
  ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql3 = execq($sql3, true);

$sql4 = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
  N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
  F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, STAT_ID, PREPID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
  FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid2' AND STAT_ID=2 
  ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql4 = execq($sql4, true);

$sql5 = "SELECT  
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid2' AND FOR_SORT=1";
$sql5 = execq($sql5, true);

$sql6 = "SELECT  
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=1";
$sql6 = execq($sql6, true);

if (count($sql1)>0){
  $sovm1=1;
} else {
  $sovm1=0;
}
if (count($sql4)>0){
  $sovm2=1;
} else {
  $sovm2=0;
}

$main_string .=  '<Worksheet ss:Name="Штат">
  <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.(34+$sovm1+$sovm2+2*count($sql)+2*count($sql1)+2*count($sql2)+2*count($sql3)+2*count($sql4)+2*count($sql5)+2*count($sql6)).'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="82.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="2"/>
   <Column ss:Index="5" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="13" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Column ss:Index="15" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"
    ss:Span="4"/>
   <Column ss:Index="20" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="5"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">на осенний семестр '.$god.' учебный год (дата среза: '.$cutdate1.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:MergeDown="1" ss:StyleID="s76"><Data ss:Type="String">Фамилия, Имя, Отчество</Data></Cell>
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
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m46542888"><Data ss:Type="String">Всего за семестр</Data></Cell>
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
    <Cell ss:StyleID="s58"><Data ss:Type="String">Штатные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
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
  foreach ($sql as $key => $value) {
    if ($value['STAVKA']!='1'){
      $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
    }
    $main_string .=  '<Row>
      <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
      if ($value['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      }
     $main_string .= '
     </Row><Row>
      <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  if ($sovm1==1){
    $main_string .=  '<Row>
      <Cell ss:MergeAcross="26" ss:StyleID="s74"><Data ss:Type="String">Совместители</Data></Cell>
    </Row>';
  }
  if (count($sql1)>0){
    foreach ($sql1 as $key => $value) {
      if ($value['STAVKA']!='1'){
        $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
      }
      $main_string .=  '<Row>
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
        if ($value['SEMESTR']>900){
          $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
        } else {
          $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
        }
       $main_string .= '
       </Row><Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        </Row>';
    }
  }
  foreach ($sql2 as $key => $value) {
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        </Row>';
  }
   $main_string .=  '<Row ss:Index="'.(15+$sovm1+2*count($sql)+2*count($sql1)+2*count($sql2)).'">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
   <Row ss:Index="'.(20+$sovm1+2*count($sql)+2*count($sql1)+2*count($sql2)).'">
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="'.(23+$sovm1+2*count($sql)+2*count($sql1)+2*count($sql2)).'">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на весенний семестр '.$god.' учебный год (дата среза: '.$cutdate2.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="'.(25+$sovm1+2*count($sql)+2*count($sql1)+2*count($sql2)).'">
    <Cell ss:MergeDown="1" ss:StyleID="s76"><Data ss:Type="String">Фамилия, Имя, Отчество</Data></Cell>
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
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m44252528"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за год</Data></Cell>
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
    <Cell ss:StyleID="s58"><Data ss:Type="String">Штатные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
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
  foreach ($sql3 as $key => $value) {
    if ($value['STAVKA']!='1'){
      $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
    }
    $cur_sql = "SELECT sum(SEMESTR) SEMESTR, 
        sum(f_SEMESTR) f_SEMESTR 
      FROM NAGRUZKA_prepod_dwh
      WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND STAT_ID = 1 AND PREPID='".$value['PREPID']."'";
    $cur_sql = execq($cur_sql, true);
    $main_string .=  '<Row>
      <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
      if ($value['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      }
      if ($cur_sql[0]['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
      }
     $main_string .= '
     </Row><Row>
      <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }  
  if ($sovm2==1){
    $main_string .=  '<Row>
      <Cell ss:MergeAcross="26" ss:StyleID="s74"><Data ss:Type="String">Совместители</Data></Cell>
     </Row>';
  }
  if (count($sql4)>0){
    foreach ($sql4 as $key => $value) {
      if ($value['STAVKA']!='1'){
        $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
      }
      $cur_sql = "SELECT sum(SEMESTR) SEMESTR, 
          sum(f_SEMESTR) f_SEMESTR 
        FROM NAGRUZKA_prepod_dwh
        WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND STAT_ID = 2 AND PREPID='".$value['PREPID']."'";
      $cur_sql = execq($cur_sql, true);
      $main_string .=  '<Row>
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
        if ($value['SEMESTR']>900){
          $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
        } else {
          $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
        }
        if ($cur_sql[0]['SEMESTR']>900){
          $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
        } else {
          $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
        }
       $main_string .= '
       </Row><Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
    }
  }
  foreach ($sql5 as $key => $value) {
    $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
        sum(f_SEMESTR) f_SEMESTR
      FROM dwh_SEMESTR_KATEGOR
      WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=1";
    $cur_sql = execq($cur_sql, true);
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
  }
  foreach ($sql6 as $key => $value) {
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО ЗА ГОД:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
  };
   $main_string .=  '<Row ss:Index="'.(34+$sovm1+$sovm2+2*count($sql)+2*count($sql1)+2*count($sql2)+2*count($sql3)+2*count($sql4)+2*count($sql5)+2*count($sql6)).'">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <Scale>91</Scale>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <Selected/>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>';








$sql = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
    N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
    F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, DOL_SMALL, STAT_ID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
    FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid1' AND STAT_ID=4 
    ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql = execq($sql, true);

$sql2 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid1' AND FOR_SORT = 2";
$sql2 = execq($sql2, true);



$sql3 = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
  N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
  F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, DOL_SMALL, STAT_ID, PREPID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
  FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid2' AND STAT_ID=4 
  ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql3 = execq($sql3, true);

$sql5 = "SELECT 
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid2' AND FOR_SORT=2";
$sql5 = execq($sql5, true);

$sql6 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=2";
$sql6 = execq($sql6, true);


  $main_string .=  '
<Worksheet ss:Name="Совм.">
  <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.(36+2*count($sql)+2*count($sql2)+2*count($sql3)+2*count($sql5)+2*count($sql6)).'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="82.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="2"/>
   <Column ss:Index="5" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="13" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="6"/>
   <Column ss:Index="20" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="5"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Осенний  семестр '.$god.' учебный год (дата среза: '.$cutdate1.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:MergeDown="1" ss:StyleID="s76"><Data ss:Type="String">Фамилия, Имя, Отчество</Data></Cell>
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
    <Cell ss:MergeDown="2" ss:StyleID="m80964244"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m80964264"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2"/>
   </Row>
   <Row ss:Height="22.5">
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
    <Cell ss:StyleID="s58"><Data ss:Type="String">Совместители</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
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
  foreach ($sql as $key => $value) {
    if ($value['STAVKA']!='1'){
      $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
    }
    $main_string .=  '<Row>
      <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
      if ($value['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      }
     $main_string .= '
     </Row><Row>
      <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  foreach ($sql2 as $key => $value) {
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
      </Row>
      <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  $main_string .=  '<Row ss:Index="'.(16+2*count($sql)+2*count($sql2)).'">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
   <Row ss:Index="'.(21+2*count($sql)+2*count($sql2)).'">
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="'.(24+2*count($sql)+2*count($sql2)).'">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Весенний  семестр '.$god.' учебный год (дата среза: '.$cutdate2.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="'.(26+2*count($sql)+2*count($sql2)).'">
    <Cell ss:MergeDown="1" ss:StyleID="s76"><Data ss:Type="String">Фамилия, Имя, Отчество</Data></Cell>
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
    <Cell ss:MergeDown="2" ss:StyleID="m80963796"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m80963816"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за год</Data></Cell>
   </Row>
   <Row ss:Height="22.5">
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
    <Cell ss:StyleID="s58"><Data ss:Type="String">Совместители</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
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
  foreach ($sql3 as $key => $value) {
    if ($value['STAVKA']!='1'){
      $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
    }
    $cur_sql = "SELECT sum(SEMESTR) SEMESTR, 
        sum(f_SEMESTR) f_SEMESTR 
      FROM NAGRUZKA_prepod_dwh 
      WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND STAT_ID=4 AND PREPID='".$value['PREPID']."'";
    $cur_sql = execq($cur_sql, true);
    $main_string .=  '<Row>
      <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
      if ($value['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      }
      if ($cur_sql[0]['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
      }
     $main_string .= '
     </Row><Row>
      <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  foreach ($sql5 as $key => $value) {
    $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
        sum(f_SEMESTR) f_SEMESTR
      FROM dwh_SEMESTR_KATEGOR
      WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=2";
    $cur_sql = execq($cur_sql, true);
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
  }
  foreach ($sql6 as $key => $value) {
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО ЗА ГОД:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
  };
  $main_string .=  '<Row ss:Index="'.(36+2*count($sql)+2*count($sql2)+2*count($sql3)+2*count($sql5)+2*count($sql6)).'">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <Scale>91</Scale>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>';










$sql = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
    N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
    F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, DOL_SMALL, STAT_ID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
    FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid1' AND STAT_ID IN (3,5) 
    ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql = execq($sql, true);

$sql2 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid1' AND FOR_SORT = 3";
$sql2 = execq($sql2, true);



$sql3 = "SELECT FIO||' '||DOL_SMALL as FIO, LECTIME, SEMTIME, LABTIME, VSEGO5, EKZ_ZACH, ITOGO7, KPR, N9, N10, N11, N12, VSEGO13, VSEGOPLAN, N15, N16, 
  N17, N18, N19, N20, VSEGO21, N22, N23, N24,  PRIM, VSEGO25, SEMESTR, F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9, F10, F11, F12, F_VSEGO13, 
  F_VSEGOPLAN, F15, F16, F17, F18, F19, F20, F_VSEGO21, F22, F23, F24, FPRIM, F_VSEGO25, F_SEMESTR, DOL_SMALL, STAT_ID, PREPID, DECODE(trunc(STAVKA), STAVKA, TO_CHAR(STAVKA), TO_CHAR(STAVKA, 'FM999999999990D999999999999')) as STAVKA
  FROM NAGRUZKA_prepod_dwh WHERE DIVID='$divid' AND studyid='$studyid2' AND STAT_ID IN (3,5)
  ORDER BY STAT_ID, DOL_ID DESC, FIO";
$sql3 = execq($sql3, true);

$sql5 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid2' AND FOR_SORT=3";
$sql5 = execq($sql5, true);

$sql6 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR)f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=3";
$sql6 = execq($sql6, true);

  $main_string .=  '
  <Worksheet ss:Name="Почас.">
  <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="'.(36+2*count($sql)+2*count($sql2)+2*count($sql3)+2*count($sql5)+2*count($sql6)).'" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="82.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="2"/>
   <Column ss:Index="5" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5" ss:Span="4"/>
   <Column ss:Index="13" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"
    ss:Span="6"/>
   <Column ss:Index="20" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="5"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="35.25"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Осенний  семестр  '.$god.' учебный год (дата среза: '.$cutdate1.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:MergeDown="1" ss:StyleID="s76"><Data ss:Type="String">Фамилия, Имя, Отчество</Data></Cell>
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
    <Cell ss:MergeDown="2" ss:StyleID="m46543172"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m46543192"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2"/>
   </Row>
   <Row ss:Height="22.5">
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
    <Cell ss:StyleID="s58"><Data ss:Type="String">Почасовики</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
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
  foreach ($sql as $key => $value) {
    if ($value['STAVKA']!='1'){
      $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
    }
    $main_string .=  '<Row>
      <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
      if ($value['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      }
     $main_string .= '
     </Row><Row>
      <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  foreach ($sql2 as $key => $value) {
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
      </Row>
      <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  $main_string .=  '
   <Row ss:Index="'.(16+2*count($sql)+2*count($sql2)).'">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
   <Row ss:Index="'.(21+2*count($sql)+2*count($sql2)).'">
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="'.(24+2*count($sql)+2*count($sql2)).'">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Весенний  семестр '.$god.' учебный год (дата среза: '.$cutdate2.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="'.(26+2*count($sql)+2*count($sql2)).'">
    <Cell ss:MergeDown="1" ss:StyleID="s76"><Data ss:Type="String">Фамилия, Имя, Отчество</Data></Cell>
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
    <Cell ss:MergeDown="2" ss:StyleID="m44251632"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s76"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m44251652"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за год</Data></Cell>
   </Row>
   <Row ss:Height="22.5">
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
    <Cell ss:StyleID="s58"><Data ss:Type="String">Почасовики</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
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
  foreach ($sql3 as $key => $value) {
    if ($value['STAVKA']!='1'){
      $value['FIO'].=" ".str_replace('.', ',', $value['STAVKA']);
    }
    $cur_sql = "SELECT sum(SEMESTR) SEMESTR, 
        sum(f_SEMESTR) f_SEMESTR 
      FROM NAGRUZKA_prepod_dwh 
      WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND STAT_ID IN (3,5) AND PREPID='".$value['PREPID']."'";
    $cur_sql = execq($cur_sql, true);
    $main_string .=  '<Row>
      <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$value['FIO'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
      <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
      <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>';
      if ($value['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>';
      }
      if ($cur_sql[0]['SEMESTR']>900){
        $main_string .=  '<Cell ss:StyleID="s65"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
      } else {
        $main_string .=  '<Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>';
      }
     $main_string .= '
     </Row><Row>
      <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
      <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
      <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
      <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
      </Row>';
  }
  foreach ($sql5 as $key => $value) {
    $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
        sum(f_SEMESTR) f_SEMESTR
      FROM dwh_SEMESTR_KATEGOR
      WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=3";
    $cur_sql = execq($cur_sql, true);
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
  }
  foreach ($sql6 as $key => $value) {
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">ИТОГО ЗА ГОД:</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
        </Row>';
  };
  $main_string .=  '<Row ss:Index="'.(36+2*count($sql)+2*count($sql2)+2*count($sql3)+2*count($sql5)+2*count($sql6)).'">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <Scale>91</Scale>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>';





$sql = "SELECT
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
    sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
    sum(f_vsego5)f_vsego5,
    sum( f_ekz_zaCH ) f6, 
    sum(f_itogo7)f_itogo7,
    sum(F_KPR)  f8, 
    sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
    sum(f_vsego13) f_vsego13,
    sum(f_vsegoplan )f_vsegoplan,
    sum(f15) f15, 
    sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
    sum( f_vsego21)  f_vsego21,
    sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
    sum(f_vsego25)  f_vsego25,
    sum(f_SEMESTR) f_SEMESTR
    FROM dwh_SEMESTR_KATEGOR
    WHERE DIVID='$divid' AND studyid='$studyid1' AND FOR_SORT = 1";
$sql = execq($sql, true);

$sql1 = "SELECT  
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid1' AND FOR_SORT = 2";
$sql1 = execq($sql1, true);

$sql2 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid1' AND FOR_SORT = 3";
$sql2 = execq($sql2, true);

$sql3 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid1'";
$sql3 = execq($sql3, true);



$sql4 = "SELECT
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
    sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
    sum(f_vsego5)f_vsego5,
    sum( f_ekz_zaCH ) f6, 
    sum(f_itogo7)f_itogo7,
    sum(F_KPR)  f8, 
    sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
    sum(f_vsego13) f_vsego13,
    sum(f_vsegoplan )f_vsegoplan,
    sum(f15) f15, 
    sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
    sum( f_vsego21)  f_vsego21,
    sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
    sum(f_vsego25)  f_vsego25,
    sum(f_SEMESTR) f_SEMESTR
    FROM dwh_SEMESTR_KATEGOR
    WHERE DIVID='$divid' AND studyid='$studyid2' AND FOR_SORT = 1";
$sql4 = execq($sql4, true);

$sql5 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid2' AND FOR_SORT = 2";
$sql5 = execq($sql5, true);

$sql6 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid2' AND FOR_SORT = 3";
$sql6 = execq($sql6, true);

$sql7 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND studyid='$studyid2'";
$sql7 = execq($sql7, true);

$sql8 = "SELECT   
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
  sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
  sum(f_vsego5)f_vsego5,
  sum( f_ekz_zaCH ) f6, 
  sum(f_itogo7)f_itogo7,
  sum(F_KPR)  f8, 
  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
  sum(f_vsego13) f_vsego13,
  sum(f_vsegoplan )f_vsegoplan,
  sum(f15) f15, 
  sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
  sum( f_vsego21)  f_vsego21,
  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
  sum(f_vsego25)  f_vsego25,
  sum(f_SEMESTR) f_SEMESTR
  FROM dwh_SEMESTR_KATEGOR WHERE DIVID='$divid' AND YEAR_GROCODE='$god'";
$sql8 = execq($sql8, true);

 $main_string .=  '
 <Worksheet ss:Name="Итоговая">
 <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="48" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="45.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="4"/>
   <Column ss:Index="7" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="18"/>
   <Column ss:Index="27" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"
    ss:Span="1"/>
   <Row ss:Height="25.5">
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Осенний  семестр '.$god.' учебный год (дата среза: '.$cutdate1.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:MergeDown="1" ss:StyleID="s78"/>
    <Cell ss:StyleID="s68"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s78"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s78"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за семестр</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s68"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">27</Data></Cell>
  </Row>';
  $value = $sql[0];
  $main_string .=  '<Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего штат.</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $value = $sql1[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего совм.</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $value = $sql2[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего почас.</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $value = $sql3[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего по кафедре</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
   </Row>
   <Row ss:Index="21">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
   <Row ss:Index="26" ss:Height="25.5">
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
    <Cell ss:StyleID="s57"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="29">
    <Cell ss:StyleID="s57"><Data ss:Type="String">на  Весенний  семестр '.$god.' учебный год (дата среза: '.$cutdate2.')</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
   <Row ss:Index="31">
    <Cell ss:MergeDown="1" ss:StyleID="s78"/>
    <Cell ss:StyleID="s68"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s78"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s78"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за семестр</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за год</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s68"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
   </Row>
   <Row ss:Height="132">
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="15" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">27</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">28</Data></Cell>
   </Row>';
  $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
      sum(f_SEMESTR) f_SEMESTR
    FROM dwh_SEMESTR_KATEGOR
    WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=1";
  $cur_sql = execq($cur_sql, true);
  $value = $sql4[0];
  $main_string .=  '<Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего штат.</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
      sum(f_SEMESTR) f_SEMESTR
    FROM dwh_SEMESTR_KATEGOR
    WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=2";
  $cur_sql = execq($cur_sql, true);
  $value = $sql5[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего совм.</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
      sum(f_SEMESTR) f_SEMESTR
    FROM dwh_SEMESTR_KATEGOR
    WHERE  DIVID='$divid' AND YEAR_GROCODE='$god' AND FOR_SORT=3";
  $cur_sql = execq($cur_sql, true);
  $value = $sql6[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего почас.</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $cur_sql = "SELECT sum(SEMESTR) SEMESTR,
      sum(f_SEMESTR) f_SEMESTR
    FROM dwh_SEMESTR_KATEGOR
    WHERE  DIVID='$divid' AND YEAR_GROCODE='$god'";
  $cur_sql = execq($cur_sql, true);
  $value = $sql7[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего по кафедре</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
   </Row>';
  $value = $sql8[0];
  $main_string .=  '
   <Row>
    <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">Всего по кафедре за год</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
    <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">'.$cur_sql[0]['SEMESTR'].'</Data></Cell>
  </Row>
  <Row>
    <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
    <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_SEMESTR'].'</Data></Cell>
    <Cell ss:StyleID="s64"><Data ss:Type="String">'.$cur_sql[0]['F_SEMESTR'].'</Data></Cell>
   </Row>
   <Row ss:Index="48">
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">Зав. кафедрой</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s67"><Data ss:Type="String">'.$dateh.'</Data></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <Scale>91</Scale>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <TopRowVisible>11</TopRowVisible>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>';



$main_string .=  '<Worksheet ss:Name="Годовая">
  <Table ss:ExpandedColumnCount="28" ss:ExpandedRowCount="23" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s15">
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="108.75"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="3"/>
   <Column ss:Index="7" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="2"/>
   <Column ss:Index="11" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"
    ss:Span="2"/>
   <Column ss:Index="14" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75"
    ss:Span="4"/>
   <Column ss:Index="19" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="2"/>
   <Column ss:Index="23" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="3"/>
   <Column ss:Index="28" ss:StyleID="s15" ss:AutoFitWidth="0" ss:Width="30"/>
   <Row ss:Height="25.5">
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">'.$date.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"><Data ss:Type="String">Учебная нагрузка преподавателей кафедры '.$divabbreviate.'</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:StyleID="s57"><Data ss:Type="String">Объем выполненой работы за '.$god.' учебный год</Data></Cell>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
    <Cell ss:StyleID="s57"/>
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
    <Cell ss:MergeDown="2" ss:StyleID="s78"/>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">ППС(в ставках/физ.лицах)</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="String">НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего по учебному плану</Data></Cell>
    <Cell ss:MergeAcross="6" ss:MergeDown="1" ss:StyleID="s78"><Data
      ss:Type="String">ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ</Data></Cell>
    <Cell ss:MergeAcross="4" ss:MergeDown="1" ss:StyleID="s78"><Data
      ss:Type="String">ПРОЧИЕ ВИДЫ РАБОТ</Data></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s66"><Data ss:Type="String">Всего за год</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="3" ss:StyleID="s68"><Data ss:Type="String">АУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"><Data ss:Type="String">ВНЕАУДИТОРНАЯ НАГРУЗКА</Data></Cell>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
    <Cell ss:StyleID="s68"/>
   </Row>
   <Row ss:Height="132">
    <Cell ss:Index="3" ss:StyleID="s66"><Data ss:Type="String">Лекции</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Практические</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Лабораторные</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Зачёты, экзамены</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Итого</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Курсовой проект (раб.)</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Дипломное проектирование</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">УНИРС</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Учебная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Производственная практика</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:Index="16" ss:StyleID="s66"><Data ss:Type="String">Консультации</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Проверка контр. работ</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Работа в ГАК</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Приём вступит. экзаменов</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство аспирантами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Руководство магистрами</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Факультативы</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Кураторство, руководство СНО</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">ФПК преподавателей</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Прочее</Data></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Всего</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">1</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">2</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">3</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">4</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">5</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">6</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">7</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">8</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">9</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">10</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">11</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">12</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">13</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">14</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">15</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">16</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">17</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">18</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">19</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">20</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">21</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">22</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">23</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">24</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">25</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">26</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">27</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">28</Data></Cell>
   </Row>';
  for ($i = 1; $i <= 7; $i ++){
    switch ($i){
      case 1: $text = "Проф. и зав. каф. проф."; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' AND FOR_SORT = '1' AND GRUPPA = '$i' group by DIVID,YEAR_GROCODE"; break;
      case 2: $text = "Доценты и зав. каф. доц."; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' AND FOR_SORT = '1' AND GRUPPA = '$i' group by DIVID,YEAR_GROCODE"; break;
      case 3: $text = "Ст.преп. и зав.каф. ст. преп."; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' AND FOR_SORT = '1' AND GRUPPA = '$i' group by DIVID,YEAR_GROCODE"; break;
      case 4: $text = "Ассистенты и преподаватели"; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' AND FOR_SORT = '1' AND GRUPPA = '$i' group by DIVID,YEAR_GROCODE"; break;
      case 5: $text = "Совместители"; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' AND FOR_SORT = '2' group by DIVID,YEAR_GROCODE"; break;
      case 6: $text = "Почасовики"; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' AND FOR_SORT = '3' group by DIVID,YEAR_GROCODE"; break;
      case 7: $text = "Всего"; $where = "YEAR_GROCODE='$god' AND DIVID='$divid' group by DIVID,YEAR_GROCODE"; break;
    }
    $sql="select DIVID, YEAR_GROCODE, sum(LECTIME) LECTIME,
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
      sum(f_LECTIME) f2, sum(f_SEMTIME) f3,  sum( f_LABTIME) f4, 
      sum(f_vsego5)f_vsego5,
      sum( f_ekz_zaCH ) f6, 
      sum(f_itogo7)f_itogo7,
      sum(F_KPR)  f8, 
      sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
      sum(f_vsego13) f_vsego13,
      sum(f_vsegoplan )f_vsegoplan,
      sum(f15) f15, 
      sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
      sum( f_vsego21)  f_vsego21,
      sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
      sum(f_vsego25)  f_vsego25,
      sum(f_GOD)f_GOD, sum(KOL_PREPOD) KOL_PREPOD, sum(KOL_STAVKI) KOL_STAVKI FROM dwh_god WHERE ".$where;
      $sql = execq($sql, true);
      $value = $sql[0];
      $main_string .=  '<Row ss:Height="22.5">
        <Cell ss:MergeDown="1" ss:StyleID="s59"><Data ss:Type="String">'.$text.'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KOL_STAVKI'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LECTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['SEMTIME'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['LABTIME'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['EKZ_ZACH'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['KPR'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N9'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N10'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N11'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N12'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N15'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N16'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N17'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N18'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N19'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N20'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N22'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N23'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['N24'].'</Data></Cell>
        <Cell ss:StyleID="s59"><Data ss:Type="String">'.$value['PRIM'].'</Data></Cell>
        <Cell ss:StyleID="s60"><Data ss:Type="String">'.$value['VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s63"><Data ss:Type="String">'.$value['GOD'].'</Data></Cell>
       </Row>
       <Row>
        <Cell ss:Index="2" ss:StyleID="s61"><Data ss:Type="String">'.$value['KOL_PREPOD'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F2'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F3'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F4'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO5'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F6'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_ITOGO7'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F8'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F9'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F10'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F11'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F12'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO13'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_VSEGOPLAN'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F15'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F16'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F17'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F18'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F19'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F20'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO21'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F22'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F23'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['F24'].'</Data></Cell>
        <Cell ss:StyleID="s61"><Data ss:Type="String">'.$value['FPRIM'].'</Data></Cell>
        <Cell ss:StyleID="s62"><Data ss:Type="String">'.$value['F_VSEGO25'].'</Data></Cell>
        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$value['F_GOD'].'</Data></Cell>
       </Row>';

  }
  $main_string .=  '</Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <PageMargins x:Bottom="0" x:Left="0" x:Right="0" x:Top="0"/>
   </PageSetup>
   <Print>
    <FitWidth>0</FitWidth>
    <FitHeight>0</FitHeight>
    <ValidPrinterInfo/>
    <Scale>91</Scale>
    <PaperSizeIndex>0</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
    <Gridlines/>
   </Print>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
';
$main_string .=  '</Workbook>';
//file_put_contents($direct.$name.".xml", $main_string);
 echo $main_string;
 ?>