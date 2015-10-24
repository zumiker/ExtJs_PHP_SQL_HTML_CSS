<?php
    $action = $_GET['action'];
    if (!$action)
    {
        $action = $_REQUEST['action'];
    }
    if (isset($action))
    {
        $db_handle = ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
        if (!$db_handle)
        {
            echo "Oracle Connect Error " . ora_error();
            return;
        }

        if ($action == 'search_result_excel')
        {
            $format = $_GET['format'];
            PrintSearchResults($db_handle, $format);
        }
        if ($action == 'osearch_result_excel')
        {
            $format = $_GET['format'];
            PrintOSearchResults($db_handle, $format);
        }
        ora_logoff($db_handle);
    }

    function CreateSelectSQL($select, $from, $where)
    {
        $sql = 'select ';
        $sql .= join($select, ',');
        $sql .= ' from ';
        $sql .= join($from, ',');
        $sql .= ' where ';
        $sql .= join($where, ' and ');
        return $sql;
    }

    function GetCorrectDate($day, $month, $year)
    {
        if (checkdate($month, $day, $year))
        {
            return $day . '-'  . $month . '-' . $year;
        }
        else
        return false;
    }

    class CSQLResolve
    {
        var $sql_s = array();
        var $sql_f = array();
        var $sql_w = array();
        var $search_params = array();

        function CSQLResolve()
        {
        }

        function AddItem($s, $f, $w, $text)
        {
            $this->sql_s[] = $s;
            $this->sql_f[] = $f;
            $this->sql_w[] = $w;
            $this->search_params[] = $text;
        }

        function GetResult($db_handle)
        {
            $sql = 'select ';
            $sql .= join($this->sql_s, ',');
            $sql .= ' from ';
            $sql .= join($this->sql_f, ',');
            $sql .= ' where ';
            $sql .= join($this->sql_w, ' and ');

            $curs = ora_do($db_handle, $sql);

            $res = '';
            for ($i=0; $i<ora_numcols($curs); $i++)
            {
                $res .= ($this->search_params[$i] . '<b>' . ora_getcolumn($curs, $i) . '</b><br>');
            }

            return $res;
        }

        function GetResult2($db_handle)
        {
            $sql = 'select ';
            $sql .= join($this->sql_s, ',');
            $sql .= ' from ';
            $sql .= join($this->sql_f, ',');
            $sql .= ' where ';
            $sql .= join($this->sql_w, ' and ');

            $curs = ora_do($db_handle, $sql);

            $res = '';
            for ($i=0; $i<ora_numcols($curs); $i++)
            {
                $res .= ($this->search_params[$i] . ora_getcolumn($curs, $i) . '&');
            }

            return $res;
        }
    }

    class CXMLFile
    {
        var $body;
        var $rows = array();
        var $colcount = 0;

        function CXMLFile($colcount)
        {
            $this->colcount = $colcount;
            $this->body .= '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?>' . "\r\n";
            $this->body .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">' . "\r\n";
            $this->body .= '<LastAuthor>George</LastAuthor><LastPrinted>2005-03-21T11:29:24Z</LastPrinted><Created>2005-03-21T11:30:34Z</Created><LastSaved>2005-03-21T11:27:27Z</LastSaved><Version>11.5606</Version></DocumentProperties>' . "\r\n";
            $this->body .= '<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel"><WindowHeight>12780</WindowHeight><WindowWidth>15195</WindowWidth><WindowTopX>480</WindowTopX><WindowTopY>30</WindowTopY><ProtectStructure>False</ProtectStructure><ProtectWindows>False</ProtectWindows></ExcelWorkbook>' . "\r\n";
            $this->body .= '<Styles><Style ss:ID="Default" ss:Name="Normal"><Alignment ss:Vertical="Bottom"/><Borders/><Font ss:FontName="Arial Cyr" x:CharSet="204"/><Interior/><NumberFormat/><Protection/></Style><Style ss:ID="s21"><Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/></Style></Styles>' . "\r\n";
            $this->body .= '<Worksheet ss:Name="Книга 11">' . "\r\n";
        }

        function AddRow($str)
        {
            $this->rows[] = $str;
        }

        function GetContent()
        {
            $rowcount = count($this->rows);
            $this->body .= "<Table ss:ExpandedColumnCount=\"$this->colcount\" ss:ExpandedRowCount=\"$rowcount\" x:FullColumns=\"1\" x:FullRows=\"1\">" . "\r\n";

            for ($i=1; $i <= $this->colcount ; $i++)
            {
                $this->body .= "<Column ss:Width=\"58\"/>" . "\r\n";
            }

            foreach ($this->rows as $row)
            {
                $cells = split(';', $row);
                $this->body .= '<Row>' . "\r\n";
                foreach ($cells as $cell)
                {
                    $cell = utf8_encode($cell);
                    $this->body .= "<Cell><Data ss:Type=\"String\">$cell</Data></Cell>" . "\r\n";
                }
                $this->body .= '</Row>' . "\r\n";
            }

            $this->body .= '</Table>' . "\r\n";
            $this->body .= '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel"><PageSetup><PageMargins x:Bottom="0.984251969" x:Left="0.78740157499999996" x:Right="0.78740157499999996" x:Top="0.984251969"/></PageSetup><Print><ValidPrinterInfo/><PaperSizeIndex>9</PaperSizeIndex><HorizontalResolution>300</HorizontalResolution><VerticalResolution>300</VerticalResolution></Print><Selected/><ProtectObjects>False</ProtectObjects><ProtectScenarios>False</ProtectScenarios></WorksheetOptions>' . "\r\n";
            $this->body .= '</Worksheet></Workbook>' . "\r\n";
        }

        function SaveToFile()
        {
            $this->GetContent();
            $handle = @fopen("D:\\testphp.xml","w+");
            fwrite($handle, $this->body);
            fclose($handle);
        }
    }

    class CCSVFile
    {
        var $body;

        function CCSVFile()
        {
        }

        function AddRow($str)
        {
            $this->body .= "$str\r\n";
        }

        function GetContent()
        {
           return $this->body;
        }

        function SaveToFile()
        {
            $handle = @fopen("D:\\testphp.csv","w+");
            fwrite($handle, $this->body);
            fclose($handle);
        }
    }

    function PrintSearchResults($db_handle, $format)
    {
        //PrintGetParams();
        $surname = strtoupper($_GET['txtSurname']);
        $name    = strtoupper($_GET['txtName']);
        $patr    = strtoupper($_GET['txtPatronymic']);
        $facid   = $_GET['cmbFacs']; if ($facid == 'z') { unset($facid); }
        $spcid   = $_GET['cmbSpcid']; if ($spcid == 'z') { unset($spcid); }
        $groid   = $_GET['cmbGroups']; if ($groid == 'z') { unset($groid); }
        $entry   = $_GET['cmbEntryid']; if ($entry == 'z') { unset($entry); }
        $status  = $_GET['cmbStatus']; if ($status == 'z') { unset($status); }
        $staid   = $_GET['cmbStaid']; if ($staid == 'z') { unset($staid); }
        $regid   = $_GET['cmbRegion']; if ($regid == 'z') { unset($regid); }
        $nation  = $_GET['cmbNation']; if ($nation == 'z') { unset($nation); }
        $sex     = $_GET['cmbSex']; if ($sex == 'z') { unset($sex); }
        $byear   = $_GET['byear'];  if ($byear == 'z') { unset($byear); }

        $query = 'action=search_result&';
        $sql = "select initcap(MANLASTNAME),initcap(MANFIRSTNAME),initcap(MANPATRONYMIC),FACULTY.FAC,STUDENT.GROCODE,TENNAME,lower(STATUS),MAN.MANID,REGNAME,TNATION.TNANAME,MAN.MANSEX,to_char(MAN.MANBIRTHDAY, 'DD.MM.YYYY') from MAN,STUDENT,TENTRY,TSTATUS,GROUPS,FACULTY,REGION,TNATION WHERE MAN.TNAID=TNATION.TNAID(+) AND MAN.REGID=REGION.REGID(+) AND STUDENT.MANID=MAN.MANID AND STUDENT.STUENTRYTYPE=TENTRY.TENID AND GROUPS.GROID=STUDENT.GROID AND STUDENT.STUCURRENTSTATUS=TSTATUS.STAID AND GROUPS.FACID=FACULTY.FACID";

        ///////////////////////////////////////////////////////////////////////////////////
        $sql_s = array();
        $sql_f = array();
        $sql_w = array();
        $search_params = array();
        $subtitle = '';

        if ($surname)
        {
            $sql .= " AND MAN.MANLASTNAME LIKE '%$surname%'";
            $query .= "txtSurname=$surname&";
            $subtitle .= "Фамилия = $surname&";
        }

        if ($name)
        {
            $sql .= " AND MAN.MANFIRSTNAME LIKE '%$name%'";
            $query .= "txtName=$name&";
            $subtitle .= "Имя = $name&";
        }

        if ($patr)
        {
            $sql .= " AND MAN.MANPATRONYMIC LIKE '%$patr%'";
            $query .= "txtPatronymic=$patr&";
            $subtitle .= "Отчество = $patr&";
        }

        if (isset($sex))
        {
            $sql .= " AND MAN.MANSEX='$sex'";
            $query .= "cmbSex=$sex&";
            $subtitle .= "Пол = $sex&";
        }

        if (isset($byear))
        {
            $sql .= " AND MAN.MANBIRTHDAY >= to_date('01-01-$byear', 'DD-MM-YYYY') AND MAN.MANBIRTHDAY <= to_date('31-12-$byear', 'DD-MM-YYYY')";
            $query .= "byear=$byear&";
            $subtitle .= "Год рождения = $byear&";
        }

        if (isset($regid))
        {
            $sql .= " AND MAN.REGID=$regid";
            $query .= "cmbRegion=$regid&";

            $sql_s[] = 'REGION.REGNAME';
            $sql_f[] = 'REGION';
            $sql_w[] = "REGION.REGID=$regid";
            $search_params[] = 'Регион = ';
        }

        if (isset($facid))
        {
            $sql .= " AND GROUPS.FACID=$facid";
            $query .= "cmbFacs=$facid&";

            $sql_s[] = 'FACULTY.FAC';
            $sql_f[] = 'FACULTY';
            $sql_w[] = "FACULTY.FACID=$facid";
            $search_params[] = 'Факультет = ';
        }

        if (isset($spcid))
        {
            $sql .= " AND GROUPS.SPCID=$spcid";
            $query .= "cmbSpcid=$spcid&";

            $sql_s[] = 'SPCIALIST.SPCNAME';
            $sql_f[] = 'SPCIALIST';
            $sql_w[] = "SPCIALIST.SPCID=$spcid";
            $search_params[] = 'Специальность = ';
        }

        if ($groid)
        {
            $sql .= " AND GROUPS.GROID=$groid";
            $query .= "cmbGroups=$groid&";

            $sql_s[] = 'GROUPS.GROCODE';
            $sql_f[] = 'GROUPS';
            $sql_w[] = "GROUPS.GROID=$groid";
            $search_params[] = 'Группа = ';
        }

        if ($entry)
        {
            $sql .= " AND STUDENT.STUENTRYTYPE=$entry";
            $query .= "cmbEntryid=$entry&";

            $sql_s[] = 'TENTRY.TENNAME';
            $sql_f[] = 'TENTRY';
            $sql_w[] = "TENTRY.TENID=$entry";
            $search_params[] = 'Тип набора = ';
        }

        if (isset($status))
        {
            $sql .= " AND STUDENT.STUCURRENTSTATUS=$status";
            $query .= "cmbStatus=$status&";

            $sql_s[] = 'initcap(TSTATUS.STATUS)';
            $sql_f[] = 'TSTATUS';
            $sql_w[] = "TSTATUS.STAID=$status";
            $search_params[] = 'Статус = ';
        }

        if (isset($nation))
        {
            $sql .= " AND MAN.TNAID=$nation";
            $query .= "cmbNation=$nation&";

            $sql_s[] = 'TNANAME';
            $sql_f[] = 'TNATION';
            $sql_w[] = "TNATION.TNAID=$nation";
            $search_params[] = 'Национальность = ';
        }

        $sql_find = CreateSelectSQL($sql_s, $sql_f, $sql_w);

        $curs = ora_do($db_handle, $sql_find);

        for ($i=0; $i<ora_numcols($curs); $i++)
        {
            $subtitle .= ($search_params[$i] . ora_getcolumn($curs, $i) . '&');
        }
        ////////////////////////////////////////////////////////////////////////

        if ($staid)
        {
            if ($staid == 148)
            {
                $sql .= " AND MAN.STAID=148";
                $subtitle .= "&nbsp;Гражданство = <b>Россия</b><br>";
            }
            else
            {
                $sql .= " AND MAN.STAID<>148";
                $subtitle .= "&nbsp;Гражданство = <b>Не Россия</b><br>";
            }
            $query .= "cmbStaid=$staid&";
        }

        //echo $sql;

        $sortby = $_GET['sortby'];
        if (!isset($sortby))
        {
            $sortby = 'MAN.MANLASTNAME';
        }

        $so = $_GET['so'];
        if (!isset($so))
        {
            $so = 'ASC';
        }

        $mln_so = 'ASC';

        $mln_pic = '';
        if ($sortby == 'MAN.MANLASTNAME' && $so == 'ASC')
        {
            $mln_so = 'DESC';
            $mln_pic = "<img src=\"up.gif\">";
        }

        if ($sortby == 'MAN.MANLASTNAME' && $so == 'DESC')
        {
            $mln_so = 'ASC';
            $mln_pic = "<img src=\"down.gif\">";
        }

        $fac_so = 'ASC';
        $fac_pic = '';
        if ($sortby == 'FACULTY.FAC' && $so == 'ASC')
        {
            $fac_so = 'DESC';
            $fac_pic = "<img src=\"up.gif\">";
        }

        if ($sortby == 'FACULTY.FAC' && $so == 'DESC')
        {
            $fac_so = 'ASC';
            $fac_pic = "<img src=\"down.gif\">";
        }

        $group_so = 'ASC';
        $group_pic = '';
        if ($sortby == 'STUDENT.GROCODE' && $so == 'ASC' )
        {
            $group_so = 'DESC';
            $group_pic = "<img src=\"up.gif\">";
        }
        if ($sortby == 'STUDENT.GROCODE' && $so == 'DESC' )
        {
            $group_so = 'ASC';
            $group_pic = "<img src=\"down.gif\">";
        }

        $sql .= " ORDER BY $sortby $so";

        $query .= 'sortby';
        $curs = ora_do($db_handle, $sql);

        $csv = new CCSVFile();

        $search_title = split('&', $subtitle);
        foreach ($search_title as $st)
        {
            $csv->AddRow("$st;");
        }
//        $xml = new CXMLFile(5);
        $csv->AddRow("ФИО;Пол;Группа;Набор;Статус;Регион;Национальность;Дата рождения");
        do
        {
            $name = join( array(ora_getcolumn($curs, 0) , ora_getcolumn($curs, 1) , ora_getcolumn($curs, 2)), " ");
            $grocode = ora_getcolumn($curs, 3);
            $etype = ora_getcolumn($curs, 4);
            $sta = ora_getcolumn($curs, 5);
            $status = ora_getcolumn($curs, 6);
            $manid = ora_getcolumn($curs, 7);
            $region = ora_getcolumn($curs, 8);
            $nation = ora_getcolumn($curs, 9);
            $sex = ora_getcolumn($curs, 10);
            $bdate = ora_getcolumn($curs, 11);

            $csv->AddRow("$name;$sex;$etype;$sta;$status;$region;$nation;$bdate");
//            $xml->AddRow("$name;$etype;$sta;$status;$region");
        }
        while (ora_fetch($curs));

//        $xml->SaveToFile();

        header("Content-Type: application/excel;");
        header("Content-Disposition: attachment; filename=list.csv");
        echo $csv->GetContent();
    }

    function PrintOSearchResults($db_handle, $format)
    {
        $ogroup = $_GET['cmbOgroup']; if ($ogroup == 'z') { unset($ogroup); }
        $torderid = $_GET['cmbTorderid']; if ($torderid == 'z') { unset($torderid); }
        $sdate = GetCorrectDate($_GET['sday'], $_GET['smonth'], $_GET['syear']);
        $edate = GetCorrectDate($_GET['eday'], $_GET['emonth'], $_GET['eyear']);
        $facid = $_GET['cmbFaculty']; if ($facid == 'z') { unset($facid); }
        $status = $_GET['cmbStatus']; if ($status == 'z') { unset($status); }
        $entry = $_GET['cmbEntryid']; if ($entry == 'z') { unset($entry); }

        $sql = "select initcap(MANLASTNAME),initcap(MANFIRSTNAME),initcap(MANPATRONYMIC),FACULTY.FAC,STUDENT.GROCODE,TORDER.TORDERNAME,to_char(ORDERS.ORDERDATE, 'DD.MM.YYYY'),ORDERS.ORDERNUMBER,MAN.MANID from MAN,FACULTY,STUDENT,GROUPS,TORDER,ORDERS where MAN.MANID=STUDENT.MANID and STUDENT.GROID=GROUPS.GROID and GROUPS.FACID=FACULTY.FACID and ORDERS.MANID=MAN.MANID and ORDERS.TORDERID=TORDER.TORDERID";
        $sqlrv = new CSQLResolve();

        $query = 'action=osearch_result&';
        $subtitle = '';

        if ($ogroup)
        {
            $sql .= " and TORDER.TORDERGROUPID=$ogroup";
            $query .= "cmbOgroup=$ogroup&";
            $sqlrv->AddItem('TORDERGROUP.TORDERGROUPNAME', 'TORDERGROUP', "TORDERGROUP.TORDERGROUPID=$ogroup", 'Группа приказов = ');
        }

        if ($torderid)
        {
            $sql .= " and TORDER.TORDERID=$torderid";
            $query .= "cmbTorderid=$torderid&";
            $sqlrv->AddItem('TORDER.TORDERNAME', 'TORDER', "TORDER.TORDERID=$torderid", 'Событие = ');
        }

        if ($sdate)
        {
            $sql .= " and ORDERS.ORDERDATE >= to_date('$sdate', 'DD-MM-YYYY')";
            $query .= "sday=" . $_GET['sday'] . "&smonth=" . $_GET['smonth'] . "&syear="  . $_GET['syear'] . "&";
            $subtitle .= "Искать с = $sdate";
        }

        if ($edate)
        {
            $sql .= " and ORDERS.ORDERDATE <= to_date('$edate', 'DD-MM-YYYY')";
            $query .= "eday=" . $_GET['eday'] . "&emonth=" . $_GET['emonth'] . "&eyear="  . $_GET['eyear'] . "&";
            $subtitle .= " Искать по = $edate";
        }

        if (isset($facid))
        {
            $sql .= " AND GROUPS.FACID=$facid";
            $query .= "cmbFaculty=$facid&";
            $sqlrv->AddItem('FACULTY.FAC', 'FACULTY', "FACULTY.FACID=$facid", 'Факультет = ');
        }

        if (isset($status))
        {
            $sql .= " AND STUDENT.STUCURRENTSTATUS=$status";
            $query .= "cmbStatus=$status&";
            $sqlrv->AddItem('initcap(TSTATUS.STATUS)', 'TSTATUS', "TSTATUS.STAID=$status", 'Статус = ');
        }

        if (isset($entry))
        {
            $sql .= " AND STUDENT.STUENTRYTYPE=$entry";
            $query .= "cmbEntryid=$entry&";
            $sqlrv->AddItem('TENTRY.TENNAME', 'TENTRY', "TENTRY.TENID=$entry", 'Тип набора = ');
        }

        //////////////////////////////////// sorting
        $sortby = $_GET['sortby'];
        if (!isset($sortby))
        {
            $sortby = 'MAN.MANLASTNAME';
        }

        $so = $_GET['so'];
        if (!isset($so))
        {
            $so = 'ASC';
        }

        $mln_so = 'ASC';

        $mln_pic = '';
        if ($sortby == 'MAN.MANLASTNAME' && $so == 'ASC')
        {
            $mln_so = 'DESC';
            $mln_pic = "<img src=\"up.gif\">";
        }

        if ($sortby == 'MAN.MANLASTNAME' && $so == 'DESC')
        {
            $mln_so = 'ASC';
            $mln_pic = "<img src=\"down.gif\">";
        }

        $fac_so = 'ASC';
        $fac_pic = '';
        if ($sortby == 'ORDERS.ORDERDATE' && $so == 'ASC')
        {
            $fac_so = 'DESC';
            $fac_pic = "<img src=\"up.gif\">";
        }

        if ($sortby == 'ORDERS.ORDERDATE' && $so == 'DESC')
        {
            $fac_so = 'ASC';
            $fac_pic = "<img src=\"down.gif\">";
        }

        $group_so = 'ASC';
        $group_pic = '';
        if ($sortby == 'STUDENT.GROCODE' && $so == 'ASC' )
        {
            $group_so = 'DESC';
            $group_pic = "<img src=\"up.gif\">";
        }
        if ($sortby == 'STUDENT.GROCODE' && $so == 'DESC' )
        {
            $group_so = 'ASC';
            $group_pic = "<img src=\"down.gif\">";
        }

        $sql .= " ORDER BY $sortby $so";

        //echo $sql;
        $query .= 'sortby';
        $curs = ora_do($db_handle, $sql);

        if (ora_numrows($curs) == 0)
        {
            echo "По запросу ничего не найдено<hr size=\"1\">";
            PrintBackButton();
            ?>
            <form name="frmGroupList" method="get" action="master.php">
            <input type="hidden" name="action" value="order">
            </form>
            <?
            return;
        }

        $subtitle = $sqlrv->GetResult2($db_handle) . $subtitle;
        $csv = new CCSVFile();

        $search_title = split('&', $subtitle);
        foreach ($search_title as $st)
        {
            $csv->AddRow("$st;");
        }
        $csv->AddRow(";");
        $csv->AddRow("ФИО;Факультет;Группа;Событие;Дата;Номер приказа");

        do
        {
            $name = join( array(ora_getcolumn($curs, 0) , ora_getcolumn($curs, 1) , ora_getcolumn($curs, 2)), " ");
            $grocode = ora_getcolumn($curs, 3);
            $etype = ora_getcolumn($curs, 4);
            $sta = ora_getcolumn($curs, 5);
            $status = ora_getcolumn($curs, 6);
            $region = ora_getcolumn($curs, 7);
            $manid = ora_getcolumn($curs, 8);

            $csv->AddRow("$name;$grocode;$etype;$sta;$status;$region");
        }
        while (ora_fetch($curs));

        header("Content-Type: application/excel;");
        header("Content-Disposition: attachment; filename=list.csv");
        echo $csv->GetContent();
    }
?>