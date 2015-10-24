<?
require_once("../include.php");


$fac = $_REQUEST['fac'];
$tur = $_REQUEST['tur'];
$id_con = $_REQUEST['group'];
$nab = $_REQUEST['rep'];
$vub = $_REQUEST['vub'];
$length = 40;

$sql1 = "FACID='$id_fac' ";
$sql1 .= "CON_ID='$id_con' ";

$sql3 = " AND TNABOR='$nab'";
if ($nab == '1') {
    $name = 'бюджетный набор';
    $sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
}
if ($nab == '2')
    $name = 'целевой набор';
if ($nab == '3') {
    $name = 'коммерческий набор';
    $sql3 = " AND (TNABOR='$nab' OR TNABOR='8')";
}
if ($nab == '4')
    $name = 'контракт';
if (($nab == '5') || ($nab == '6')) {
    $name = 'бюджетный набор';
    $sql3 = " AND (TNABOR='3' OR TNABOR='8')";
}


$podl = $_REQUEST['podl'];
if (($podl == 1) || ($podl == 2)) {
    $sql5 = " AND DOC='Подл'";
    $doc = ', подлинники';
} else {
    $doc = "";

}


$sql4 = $sql3;
$sql3 .= " AND TUR=$tur";

$sql = "SELECT CONGROUP,MEST_HOST, quaid FROM ABI_CONGROUP WHERE ID_CON=$id_con";

$cur = execq($sql);

foreach ($cur as $k => $row) {
    $CONGROUP = $row['CONGROUP'];
    $MEST = $row['MEST_HOST'];
    $quaid = $row['quaid'];
}

$sql = "SELECT SPCNAME, SPCBRIFE, SPCCODENEW, ID_SPEC FROM ABIVIEW_CON_SPEC WHERE  ID_CON='$id_con' ORDER BY SPCBRIFE";
$cur = execq($sql);
$date = date("d.m.y");
$time = strtotime(date('d.m.Y H.i.s'));
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
  <Created>' . $date . '</Created>
  <LastSaved>' . $date . '</LastSaved>
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

$ttur = $tur + 1;

if (($nab == '5') || ($nab == '6') || (($nab == '1') && (($podl == 1) || ($podl == 777)))) {
    $length++;
    $str = '<Row>
    <Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Протокол по зачислению на 1 курс РГУ нефти и газа имени И. М. Губкина на ' . $date . '</Data></Cell>
   </Row>';
    $sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet
			from ABI_SHAPKA_PROTOKOL
			where con_id = $id_con
				and nabor_13 = 1";
    if ($podl == 777) {
        $length++;
        $zach = 'Зачислено';
        $str .= '<Row>
    <Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Списки участников конкурса для зачисления на оставшиеся бюджетные места</Data></Cell>
   </Row>';
    } else
        $zach = 'Подлежат зачислению';
} else {
    $length++;
    $length++;
    $str = '<Row>
    <Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Протокол по зачислению на 1 курс РГУ нефти и газа имени И. М. Губкина на ' . $date . '</Data></Cell>
   </Row>
	   <Row>
    <Cell ss:Index="4" ss:StyleID="s63"><Data ss:Type="String">' . $ttur . ' этап</Data></Cell>
   </Row>';
    $sql = "select con_id, mest, host, vsego, konkurs_big, bez_ekzam, vnekon, tcelevik, mmm, www, mest_rest, mest_host, mest_host_rest, mest_rest_for_2tur, mest_host_rest_for_2tur, seli_budjet
			from ABI_SHAPKA_PROTOKOL
			where con_id = $id_con
				and nabor_13 = $nab";
    $zach = 'Зачислено';
}
$str .= '   <Row>
    <Cell ss:Index="2" ss:MergeAcross="4" ss:StyleID="s63"><Data ss:Type="String">' . $CONGROUP . '   (' . $name . ' ' . $doc . ')</Data></Cell>
   </Row>';
$length++;
if ($id_con == '1' || $id_con == '3') {
    $str .= '  <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s63"><Data ss:Type="String">специальности: </Data></Cell>
   </Row>';
    $length++;
} else {
    $str .= '   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s63"><Data ss:Type="String">направления: </Data></Cell>
   </Row>';
    $length++;
}
foreach ($cur as $k => $row) {
    $SPCNAME = $row['SPCNAME'];
    $SPCBRIFE = $row['SPCBRIFE'];
    $SPCCODE = $row['SPCCODE'];
    $ID_SPEC = $row['ID_SPEC'];
    $str .= '	<Row></Row><Row>
					<Cell><Data ss:Type="String">' . $SPCCODE . '</Data></Cell>
					<Cell><Data ss:Type="String">' . $SPCBRIFE . '</Data></Cell>
					<Cell ss:MergeAcross="2" ss:StyleID="s65"><Data ss:Type="String">' . $SPCNAME . '</Data></Cell>
				</Row>
				<Row></Row>';
    $length++;
}
$cur = execq($sql, false);


foreach ($cur as $k => $row) {
    $con_id = $row['CON_ID'];
    $mest = $row['MEST'];
    $host = $row['HOST'];
    $vsego = $row['VSEGO'];
    $konkurs_big = $row['KONKURS_BIG'];
    $bez_ekzam = $row['BEZ_EKZAM'];
    $vnekon = $row['VNEKON'];
    $tcelevik = $row['TCELEVIK'];
    $mmm = $row['MMM'];
    $www = $row['WWW'];
    $mest_rest = $row['MEST_REST'];
    $mest_host = $row['MEST_HOST'];
    $mest_host_rest = $row['MEST_HOST_REST'];
    $mest_rest_for_2tur = $row['MEST_REST_FOR_2TUR'];
    $mest_host_rest_for_2tur = $row['MEST_HOST_REST_FOR_2TUR'];
    $seli_budjet = $row['SELI_BUDJET'];;
}

if ($nab != 3) {
    $str .= '<Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего мест в конкурсной группе</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $mest . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего подано заявлений</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $vsego . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего мужчин</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $mmm . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Всего женщин</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $www . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Конкурс по заявлениям</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $konkurs_big . '</Data></Cell>
   </Row>
   <Row ss:Index="13">
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">' . $zach . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">- Без вступительных испытаний</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $bez_ekzam . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">- Особые права</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $vnekon . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">- Целевой набор</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $tcelevik . '</Data></Cell>
   </Row>';
    $length += 9;
    if (($nab != 5) && ($nab != 6)) {
        if (($tur == 2) || ($podl == 777)) {
            $str .= '
	<Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String"> - По конкурсу</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $seli_budjet . '</Data></Cell>
   </Row>
	<Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Осталось мест в конкурсной группе</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $mest_rest . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">(предоставляется по факту зачисления)</Data></Cell>
   </Row>';
            $length += 3;
        } else {
            $str .= '
	<Row></Row><Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Осталось мест в конкурсной группе</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $mest_rest . '</Data></Cell>
   </Row>
	<Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Мест в общежитии</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $mest_host . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s67"><Data ss:Type="String">Осталось мест в общежитии</Data></Cell>
    <Cell ss:StyleID="s67"><Data ss:Type="Number">' . $mest_host_rest . '</Data></Cell>
   </Row>';
            $length += 3;
        }
    }
}

if (($nab == 5) || ($nab == 6)) {
    if ($nab == 5)
        $kat = '21,23,32';
    else
        $kat = '21,23';
    $sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, decode(PRIORITET,1,1,4,2,7,3), BALL, PRIKAZ, OJID
			FROM ABIVIEW_PODVAL_24
			WHERE CON_ID='$id_con'
				AND KATEGOR IN ($kat)
				and tur_fix = $tur 
			ORDER BY KATEGOR,BALL DESC, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
    $cur = execq($sql);
    $num = 0;
    $KATEGORIA_OLD = 'ned';
    foreach ($cur as $k => $row) {
        $num++;
        $ABI_NUMBER = $row['ABI_NUMBER'];
        $LASTNAME = $row['LASTNAME'];
        $FIRSTNAME = $row['FIRSTNAME'];
        $PATRONYMIC = $row['PATRONYMIC'];
        $HOST = $row['HOST'];
        $TAWNAME_SMALL = $row['TAWNAME_SMALL'];
        $KATEGORIA = $row['KATEGORIA'];
        $DOC = $row['DOC'];
        $PRIORITET = $row['PRIORITET'];
        $BALL = $row['BALL'];
        $PRIKAZ = $row['PRIKAZ'];
        $OJID = $row['OJID'];
        if ($KATEGORIA_OLD != $KATEGORIA) {
            $str .= '<Row></Row><Row></Row><Row>
    <Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">' . $KATEGORIA . '</Data></Cell>
   </Row>
   <Row>
    <Cell ss:Index="2" ss:StyleID="s67"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:Index="6" ss:StyleID="s67"><Data ss:Type="String">Балл</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">Аттестат</Data></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="String">Общежитие</Data></Cell>
	</Row>';
            $length += 2;
            $KATEGORIA_OLD = $KATEGORIA;
        }
        $str .= ' <Row>
    <Cell ss:Index="2" ss:StyleID="s65"><Data ss:Type="Number">' . $num . '</Data></Cell>
    <Cell ss:Index="4"><Data ss:Type="String">' . $LASTNAME . ' ' . $FIRSTNAME . ' ' . $PATRONYMIC . '</Data></Cell>
    <Cell ss:Index="6" ss:StyleID="s70"><Data ss:Type="Number">' . $BALL . '</Data></Cell>
    <Cell ss:StyleID="s71"><Data ss:Type="String">' . $DOC . '</Data></Cell>';
        if ($OJID == 'Д' && $nab == 1)
            echo '
		<Cell ss:StyleID="s71"><Data ss:Type="String">Общежитие</Data></Cell></Row>';
        else
            echo '
		<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell></Row>';
        $length++;
    }

}
$table = 'ABIVIEW_PODVAL_24';

for ($j = 0; $j <= 0; $j++) {
    if ($j == 0) {
        if ($nab == '2')
            $kat = 32;
        else if ($nab == '3')
            $kat = '23, 29, 31';
        else if ($podl == '777')
            $kat = '33';
        else
            $kat = '29, 33';
        if ($podl == '1') {
            $sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, decode(PRIORITET,1,1,4,2,7,3), PRIKAZ, OJID
					FROM $table 
					WHERE  CON_ID='$id_con'
						AND TNABOR='$nab'
						AND KATEGOR in ( $kat )
						AND DOC='Подл'
						and tur_fix = $tur 
					ORDER BY KATEGOR, BALL desc, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
        } else {
            $sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, BALL, KATEGOR, COLOR, decode(PRIORITET,1,1,4,2,7,3) as PRIORITET, PRIKAZ, OJID
					FROM $table 
					WHERE  CON_ID='$id_con'
						AND TNABOR='$nab'
						AND KATEGOR in ( $kat )
						and tur_fix = $tur 
					ORDER BY KATEGOR, BALL desc, p1 desc, p2 desc, p3 desc, p4 desc, priv desc, LASTNAME";
        }
    } else {
        $sql = "SELECT ABI_NUMBER, LASTNAME, FIRSTNAME, PATRONYMIC, HOST, TAWNAME_SMALL, KATEGORIA, DOC, NVL(BALL16,0) as BALL, KATEGOR, OJID
				FROM ABIVIEW_PODVAL_26 
				WHERE  CON_ID='$id_con'
					AND TNABOR='$nab'
				ORDER BY KATEGOR, BALL desc, LASTNAME";
    }

    $cur = execq($sql, false);
    //echo json_encode($cur);
    $BALL16_OLD = 'ned';
    $KATEGOR_OLD = 'ned';
    $switchhh = 0;
    $num = 0;

    /*foreach($cur as $k=> $row)
            $length++;
        */
    foreach ($cur as $k => $row) {
        $null = '';
        $num++;
        $ABI_NUMBER = $row['ABI_NUMBER'];
        $LASTNAME = $row['LASTNAME'];
        $FIRSTNAME = $row['FIRSTNAME'];
        $PATRONYMIC = $row['PATRONYMIC'];
        $HOST = $row['HOST'];
        $TAWNAME_SMALL = $row['TAWNAME_SMALL'];
        $KATEGORIA = $row['KATEGORIA'];
        $BALL16 = $row['BALL'];
        $DOC = $row['DOC'];
        $PRIORITET = $row['PRIORITET'];
        $COLOR = $row['COLOR'];
        $BALL16 = $row['BALL'];
        $PRIKAZ = $row['PRIKAZ'];
        $OJID = $row['OJID'];
        $abi_id = $row['ABI_ID'];
        $KATEGOR = $row['KATEGOR'];

        if ($KATEGOR != $KATEGOR_OLD) {
            $str .= '<Row></Row>';
            $KATEGOR_OLD = $KATEGOR;
            switch ($KATEGOR) {
                case 23:
                {
                    $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s63"><Data ss:Type="String">Выдержавшие вступительные испытания и претендующие на поступление</Data></Cell>
					</Row>';
                    $length++;
                    break;
                }
                case 29:
                {
                    if ($tur != '3') {
                        $length++;
                        $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="2" ss:StyleID="s63"><Data ss:Type="String">Прошедшие по конкурсу</Data></Cell>
					</Row>';

                    } else {
                        $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Участники конкурса на оставшиеся бюджетные места</Data></Cell>
					</Row>
					<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Завершение предоставления Документов - 20 августа, 17.00</Data></Cell>
					</Row>
					<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Зачисление - 21 августа по сумме набранных баллов</Data></Cell>
					</Row>';
                        $length += 3;
                    }
                    break;
                }
                case 31:
                {
                    if ($tur != '3') {
                        $length++;
                        $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Выдержавшие вступительные испытания и претендующие на поступление</Data></Cell>
					</Row>';

                        if ($tur == '1') {
                            if ($nab == 3) {
                                $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места (внебюджетный набор)</Data></Cell>
					</Row>';
                                $length++;
                            } else {
                                $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места после 1 этапа</Data></Cell>
					</Row>';
                                $length++;
                            }
                        } else {
                            $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места после 2 этапа</Data></Cell>
					</Row>';
                            $length++;
                        }
                    } else {
                        $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Участники конкурса на оставшиеся бюджетные места</Data></Cell>
					</Row>';
                        $length++;
                        break;
                    }
                }
                case 33:
                {
                    $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">Выдержавшие вступительные испытания и претендующие на поступление</Data></Cell>
					</Row>';
                    $length++;
                    if ($tur == '1') {
                        $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места после 1 этапа</Data></Cell>
					</Row>';
                        $length++;
                    } else {
                        $str .= '<Row>
						<Cell ss:Index="2" ss:MergeAcross="7" ss:StyleID="s63"><Data ss:Type="String">на 1-й курс университета на вакантные места после 2 этапа</Data></Cell>
					</Row>';
                        $length++;
                        break;
                    }
                }
            }
            $str .= '
			<Row>
			</Row>
			<Row>
    <Cell ss:Index="2" ss:StyleID="s67"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:Index="4" ss:StyleID="s67"><Data ss:Type="String">ФИО</Data></Cell>
    <Cell ss:Index="6" ss:StyleID="s67"><Data ss:Type="String">Балл</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String">Аттестат</Data></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="String">Общежитие</Data></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="String">Рекомендован</Data></Cell>
   </Row>';
            $length += 2;
        }

        if ($COLOR == 1)
            $col = '#eeeeee';
        else
            $col = '#ffffff';
        $str .= '
   <Row >
    <Cell ss:Index="2" ss:StyleID="s65"><Data ss:Type="Number">' . $num . '</Data></Cell>
    <Cell ss:Index="4"><Data ss:Type="String">' . $LASTNAME . ' ' . $FIRSTNAME . ' ' . $PATRONYMIC . '</Data></Cell>
    <Cell ss:Index="6" ss:StyleID="s70"><Data ss:Type="Number">' . $BALL16 . '</Data></Cell>
    <Cell ss:StyleID="s71"><Data ss:Type="String">' . $DOC . '</Data></Cell>';
        if ($OJID == 'Д' && $nab == '1')
            $str .= '
		<Cell ss:StyleID="s71"><Data ss:Type="String">Общежитие</Data></Cell>';
        else
            $str .= '
		<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>';
        if (($KATEGOR != 31) && ($KATEGOR != 33)) {
            $str .= '
<Cell ss:StyleID="s71"><Data ss:Type="String">Рекомендован</Data></Cell>
   </Row>';
            $length++;
        } else {
            $str .= '
		</Row>';
            $length++;
        }
    }
}

echo '<Table ss:ExpandedColumnCount="9" ss:ExpandedRowCount="' . $length . '" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s62">
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="51"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="38.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="14.25"/>
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
     <ActiveRow>' . $length . '</ActiveRow>
     <ActiveCol>7</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>';

?>
