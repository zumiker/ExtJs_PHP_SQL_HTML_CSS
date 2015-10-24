<?php
    class CSort
    {
        var $columns = array();
        var $sort_orders = array();
        var $pics = array();

        function CSort($columns, $curcol, $curorder)
        {
            $this->columns = $columns;

            foreach ($this->columns as $col)
            {
                if ($curcol == $col && $curorder == 'ASC')
                {
                    $this->sort_orders[]  = 'DESC';
                    $this->pics[]         = '<img src="up.gif">';
                }
                else if ($curcol == $col && $curorder == 'DESC')
                {
                    $this->sort_orders[]  = 'ASC';
                    $this->pics[]         = '<img src="down.gif">';
                }
                else
                {
                    $this->sort_orders[]  = 'ASC';
                    $this->pics[]         = '';
                }
            }
        }

        function GetPics()
        {
            return $this->pics;
        }

        function GetSortOrders()
        {
            return $this->sort_orders;
        }
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
    }

    class CSQLUpdate
    {
        var $sql;
        var $valid = 0;
        var $items = array();
        function CSQLUpdate($table_name)
        {
            $this->sql = "update $table_name set ";
        }

        function AddUpdateItem($colname, $value, $exc_value)
        {
            if ($value != $exc_value)
            {
                $this->items[] = "$colname=$value";
                $this->valid = 1;
            }
        }

        function IsSQLValid()
        {
            return $this->valid;
        }

        function GetSQL($where)
        {
            $update_items = implode(', ', $this->items);
            return $this->sql . $update_items . " where $where";
        }
    }
?>
<?php
    function RedirectTo($url)
    {
        echo '<script language="JavaScript">';
        echo "window.location=\"$url\"";
        echo '</script>';
        return;
    }

    function PrintPostParams()
    {
        $post_keys = array_keys($_REQUEST);
        foreach($post_keys as $key)
        {
            echo $key . ' = ' . $_REQUEST[$key] . "<br>";
        }
        echo "<br>";
    }

    function PrintGetParams()
    {
        $post_keys = array_keys($_GET);
        foreach($post_keys as $key)
        {
            echo $key . ' = ' . $_GET[$key] . "<br>";
        }
        echo "<br>";
    }

    function PrintDateControls2($day, $day_name, $month, $month_name, $year, $year_name, $jsname, $startyear=1970, $state='')
    {
        echo "<select name=\"$day_name\" size=\"1\" style=\"width:50px;\" $state  onChange=\"OnSomethingChanged()\">";
        echo "<option value=\"0\" selected>--</option>";
        for ($i=1; $i<32; $i++)
        {
            if ($i == $day)
            {
                echo "<option value=$i selected>$i</option>";
            }
            else
            {
                echo "<option value=$i>$i</option>";
            }
        }
        echo "</select>&nbsp;";

        $months = array("Январь", "Февраль", "Март", "Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
        echo "<select name=\"$month_name\" size=\"1\" style=\"width:89px;\" $state  onChange=\"OnSomethingChanged()\">";
        echo "<option value=\"0\" selected>--</option>";
        for ($i=0; $i<12; $i++)
        {
            $month_number = $i+1;
            if ($month_number == $month)
            {
                echo "<option value=$month_number selected>$months[$i]</option>";
            }
            else
            {
                echo "<option value=$month_number>$months[$i]</option>";
            }
        }
        echo "</select>&nbsp;";

        echo "<select name=\"$year_name\" size=\"1\" style=\"width:64px;\" $state  onChange=\"OnSomethingChanged()\">";
        echo "<option value=\"0\" selected>----</option>";
        for ($i=$startyear; $i<2010; $i++)
        {
            if ($i == $year)
            {
                echo "<option value=$i selected>$i</option>";
            }
            else
            {
                echo "<option value=$i>$i</option>";
            }
        }
        echo "</select>&nbsp;";
        //end date
        ?>
        <script language="JavaScript" type="text/javascript">
        <!--

        function <?php echo($jsname); ?>()
        {
            y = document.frmStudentInfo.<?php echo($year_name); ?>.value;
            m = document.frmStudentInfo.<?php echo($month_name); ?>.value;
            d = document.frmStudentInfo.<?php echo($day_name); ?>.value;
            var dt = new Date(y, m-1, d);
            return ((y == dt.getFullYear()) && ((m-1) == dt.getMonth()) && (d == dt.getDate()));
        }
        //-->
        </script>
        <?
    }

    function NiceDate($y, $m, $d)
    {
        $date = "";
        $date .= $y;
        $m < 10 ? $date .= "0$m" : $date .= $m;
        $d < 10 ? $date .= "0$d" : $date .= $d;
        return $date;
    }

    function NiceDateTimeNow()
    {
        $datetime = getdate(time());
        $retval = "";
        $hours = $datetime['hours'];
        $hours < 10 ? $retval .= "0$hours" : $retval .= $hours;
        $minutes = $datetime['minutes'];
        $minutes < 10 ? $retval .= "0$minutes" : $retval .= $minutes;
        $seconds = $datetime['seconds'];
        $seconds < 10 ? $retval .= "0$seconds" : $retval .= $seconds;
        return NiceDate($datetime['year'], $datetime['mon'], $datetime['mday']) . $retval;
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

    function PrintBackNextButtons($next_text, $next_js, $next_enabled)
    {
        $disabled = '';
        if (!$next_enabled)
        {
            $disabled = 'disabled';
        }
        ?>
        <br><table border="0" cellspacing="1" cellpadding="2" align="center" width="70%">
        <tr><td align="right"><input type="button" value="Назад" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="javascript:history.go(-1);"></td>
        <td><input name="btnNext" type="button" value="<?php echo($next_text); ?>" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="<?php echo($next_js); ?>" <?php echo($disabled); ?>></td>
        </tr>
        </table>
        <?
    }

    function PrintBackSaveButtons($back_url, $save_js)
    {
        ?>
        <script>
        function GoToBackURL(){location.href="<?php echo($back_url); ?>";}
        </script>
        <br><table border="0" cellspacing="1" cellpadding="2" align="center" width="70%">
        <tr><td align="right"><input type="button" value="Назад" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="GoToBackURL()"></td>
        <td><input name="btnNext" type="button" value="Сохранить" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="<?php echo($save_js); ?>"></td>
        </tr>
        </table>
        <?
    }

    function PrintBackButton()
    {
        ?>
        <br><table border="0" cellspacing="1" cellpadding="2" align="center" width="70%">
        <tr><td align="center"><input type="button" value="Назад" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="javascript:history.go(-1);"></td>
        </tr>
        </table>
        <?
    }

    function IntellFunction1($count)
    {
        $retval = 'человек';
        $str = $count . '';
        $lastsym = substr($str, strlen($str)-1, 1);
        if ($lastsym == '2' || $lastsym == '3' || $lastsym == '4')
        {
            $retval = 'человека';
        }

        $last2 = substr($str, strlen($str)-2, 2);
        if ($last2 == '12' || $last2 == '13' || $last2 == '14')
        {
            $retval = 'человек';
        }
        return $retval;
    }

    function StartShowResultset($title, $showcombo, $groid, $db_handle, $curstatus)
    {
        ?>
        <table BORDER="0" CELLSPACING="1" CELLPADDING="1" BGCOLOR="#c3d5fd" ALIGN="center" width="100%">
        <tr>
        <td align="left" valign="top"><?php echo $title; ?></td>
        <?

        if ($showcombo)
        {
            ?>
            <td align="right"><form name="frmStatusFilter" method="GET" action="master.php">
            <input type="hidden" name="action" value="show_group">
            <?
            echo "<input type=\"hidden\"  name=\"groid\" value=\"$groid\">";
            ?>
            <select name="status" size="1" onChange="filter_submit()">
            <?

            $status_array = array(array('ВСЕ', 65536), array('Учебный процесс',0), array('Отчислен, Академический отпуск...',1));

            foreach ($status_array as $s)
            {
                if ($s[1] == $curstatus)
                {
                    echo "<option value=\"$s[1]\" selected>$s[0]</option>";
                }
                else
                {
                    echo "<option value=\"$s[1]\">$s[0]</option>";
                }
            }

            ?>
            </select>
            <script language="JavaScript" type="text/javascript">
            <!--
            function filter_submit()
            {
                frmStatusFilter.submit();
            }
            //-->
            </script>
            </form></td>
            <?
        }

        ?>
        </tr><tr>
        <?

        if ($showcombo)
        {
            ?><td bgcolor="#ffffff" colspan="2"><?
        }
        else
        {
            ?><td bgcolor="#ffffff"><?
        }
        //<table BORDER="1" CELLSPACING="1" CELLPADDING="0" BGCOLOR="#00ff0f" ALIGN="center" width="90%">
    }

    function StartShowResultset2($title)
    {
        ?>
        <table BORDER="0" CELLSPACING="1" CELLPADDING="1" BGCOLOR="#c3d5fd" ALIGN="center" width="100%">
        <tr>
        <td align="left" valign="top" bgcolor="#c3d5fd"><?php echo $title; ?></td>
        </tr><tr>
        <td bgcolor="#ffffff" colspan="4">
        <?
     }

    function StartContentTable($groid, $namesort, $entrysort, $status)
    {
        $name_pic = '';
        $entry_pic = '';
        $so_n = 'ASC';
        $so_e = 'ASC';
        if ($namesort == 1)
        {
            $name_pic = "<img src=\"up.gif\">";
            $so_n = 'DESC';
        }
        if ($namesort == 2)
        {
            $name_pic = "<img src=\"down.gif\">";
            $so_n = 'ASC';
        }

        if ($entrysort == 1)
        {
            $entry_pic = "<img src=\"up.gif\">";
            $so_e = 'DESC';
        }
        if ($entrysort == 2)
        {
            $entry_pic = "<img src=\"down.gif\">";
            $so_e = 'ASC';
        }

        //<td><input type="checkbox" name="all" onClick="check_cb()"></td>
        ?>
        <form name="frmGroupList" method="get" action="master.php">
        <table border="0" cellspacing="1" cellpadding="2" class="stdtable" align="center" width="100%">
        <tr align="center" class="theader">
        <td>N<input type="hidden" name="action" value="order"><input type="hidden" name="groid" value="<?php echo($groid); ?>"></td>


        <script language="JavaScript" type="text/javascript">
        <!--
        function check_cb()
        {
            var state = document.frmGroupList.all.checked;
            for (i = 0; i < document.frmGroupList.elements.length; i++)
            {
                if(document.frmGroupList[i].type == 'checkbox')
                {
                    document.frmGroupList[i].checked = state;
                }
            }
        }
        //-->
        </script>
        <?
        echo "<td><a href=\"master.php?action=show_group&groid=$groid&ordby=lname&so=$so_n&status=$status\">Ф. И. О.</a> $name_pic</td>";
        echo "<td><a href=\"master.php?action=show_group&groid=$groid&ordby=entry&so=$so_e&status=$status\">Набор</a> $entry_pic</td>";
        echo "<td>Гражд.</td>";
        echo "<td>Статус</td>";
        echo "<td>История<br>приказов</td>";
        ?>
        </tr>
        <?
    }
	//AddToContentTable($flag, "&nbsp;$counter&nbsp;","cb",$name, $sex,$kat,$stavka, $dol, $stepen,$zvan, $manid);
    function AddToContentTable()
    {
        if (func_get_arg(0))
        {
            echo "<tr  class=\"trowe\">";
        }
        else
        {
            echo "<tr  class=\"trowo\">";
        }
        $number = func_get_arg(1);
        $cb = func_get_arg(2);
        $name = func_get_arg(3);
        $sex = substr(func_get_arg(4), 0, 1);
        $kat = func_get_arg(5);
        $stavka = func_get_arg(6);
        $dol = func_get_arg(7);
        $stepen = func_get_arg(8);
        $zvan = func_get_arg(9);
        $manid = func_get_arg(10);
        $id_manid = func_get_arg(11);

        echo "<td align=\"left\" nowrap>$number</td>";
//        echo "<td align=\"left\" nowrap>&nbsp;<a href=master.php?action=show_man&manid=$manid&id_manid=$id_manid>$name</a></td>";
        echo "<td align=\"left\" nowrap>&nbsp;$name</td>";
        echo "<td align=\"center\" nowrap>$sex</td>";
        echo "<td align=\"center\" nowrap>$kat</td>";
        echo "<td align=\"center\" nowrap>$stavka</td>";
        echo "<td align=\"center\" nowrap>$dol</td>";
        echo "<td align=\"center\" nowrap>$stepen</td>";
        echo "<td align=\"center\" nowrap>$zvan</td>";
        echo "</tr>";
    }

    function EndContentTable($count)
    {
        $statement = IntellFunction1($count);
        ?>
        <tr class="tsummary">
        <td align="left" colspan="8"><?php echo "Всего&nbsp;$count $statement"; ?></th>
        </tr>
        </form>
        </table>
        <?
    }

    function EndShowResultset()
    {
        ?>
        </td></tr></table>
        <?
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

    function mAddTown($db_handle)
    {
        $ref = GetEnv('HTTP_REFERER');
        StartShowResultset2('Добавить город');
        ?>
        <form name="frmAddTown" action="master.php" method="get">
        <input type="hidden" name="action" value="add_town_e">
        <input type="hidden" name="ref" value="<?php echo($ref); ?>">

        <table border="0" cellspacing="1" cellpadding="2" align="center" width="70%">
        <tr><td width="40%" align="right">Регион: </td><td>
        <select name="regid" size=1 style="width:210px;">
        <option value="z"><выберите регион></option>
        <?
        $sql = "select REGID,REGNAME from REGION where STAID=148 order by REGNAME";
        $cur = ora_do($db_handle, $sql);
        do
        {
            $regid = ora_getcolumn($cur, 0);
            $regname = ora_getcolumn($cur, 1);
            echo "<option value=\"$regid\">$regname</option>";
        }
        while (ora_fetch($cur));
        ?>
        </select></td>
        <tr><td align="right">Город: </td><td><input type="text" name="planame" style="width:210px;"></td>
        </table></form>

        <script language="JavaScript" type="text/javascript">
        <!--

        function ValidateAndAdd()
        {
            if (document.frmAddTown.regid.value == 'z')
            {
                alert('выберите регион');
                return;
            }

            if (document.frmAddTown.planame.value == '')
            {
                alert('введите название города');
                return;
            }
            frmAddTown.submit();
        }
        //-->
        </script>
        <?
        EndShowResultset();
        PrintBackNextButtons("Добавить", "ValidateAndAdd()", true);
    }

    function mAddTownE($db_handle)
    {
        $ref = $_REQUEST['ref'];
        $regid = $_REQUEST['regid'];
        $planame = $_REQUEST['planame'];
        $sql = "insert into PLACEOFRESIDENCE(PLAID,REGID,PLANAME) values (SEQ_PLACE.NextVal, $regid, '$planame')";
        ora_do($db_handle, $sql);
        ora_commit($db_handle);
        RedirectTo($ref);
    }

    function mSaveStudentInfo($db_handle)
    {
        $ref = GetEnv('HTTP_REFERER');
        $fromgroup = $_REQUEST['fromgroup'];
        $back_url  = $_REQUEST['back_url'];
        $back_url  = urlencode($back_url);
        $mode = $_REQUEST['mode'];
        $manid = $_REQUEST['manid'];
        $nextpage = $_REQUEST['nextpage'];
        $ref = ereg_replace("mode=$mode", "mode=$nextpage", $ref);

        $sql_commands = array();
        if ($mode == 1)
        {
            $sex   = $_REQUEST['mansex'];
            $staid = $_REQUEST['staid'];
            $tceid = $_REQUEST['tceid'];
            $tflid = $_REQUEST['tflid'];
            $manlastname = $_REQUEST['manlastname'];
            $manfirstname = $_REQUEST['manfirstname'];
            $manpatronymic = $_REQUEST['manpatronymic'];

            $sqlu = new CSQLUpdate('MAN');
            $sqlu->AddUpdateItem('MANSEX', "'$sex'", "'z'");
            $sqlu->AddUpdateItem('STAID', "$staid", "z");
            $sqlu->AddUpdateItem('MANLASTNAME', "upper('$manlastname')", "''");
            $sqlu->AddUpdateItem('MANFIRSTNAME', "upper('$manfirstname')", "''");
            $sqlu->AddUpdateItem('MANPATRONYMIC', "upper('$manpatronymic')", "''");
            if ($sqlu->IsSQLValid())
            {
                $sql_commands[] = $sqlu->GetSQL("MANID=$manid");
            }

            $sqlu = new CSQLUpdate('STUDENT');
            $sqlu->AddUpdateItem('STUENTRYCATEGORY', "$tceid", "z");
            $sqlu->AddUpdateItem('STUFLATMODE', "$tflid", "z");
            if ($sqlu->IsSQLValid())
            {
                $sql_commands[] = $sqlu->GetSQL("MANID=$manid");
            }
        }

        if ($mode == 2)
        {
            $regid =         $_REQUEST['cmbRegion'];
            $plaid =         $_REQUEST['cmbTown'];
            $maresidence =   $_REQUEST['maresidence'];
            $manpostindex =  $_REQUEST['manpostindex'];
            $tnaid =         $_REQUEST['tnaid'];
            $manbirthplace = $_REQUEST['manbirthplace'];
            $manpasnumber =  $_REQUEST['manpasnumber'];
            $manpasplace =   $_REQUEST['manpasplace'];
            $manfamstatus =  $_REQUEST['manfamstatus'];
            $bdate = GetCorrectDate($_REQUEST['bday'], $_REQUEST['bmonth'], $_REQUEST['byear']);
            $pdate = GetCorrectDate($_REQUEST['pday'], $_REQUEST['pmonth'], $_REQUEST['pyear']);

            $sqlu = new CSQLUpdate('MAN');
            $regid         && $sqlu->AddUpdateItem('REGID', "$regid", "z");
            $plaid         && $sqlu->AddUpdateItem('PLAID', "$plaid", "z");
            $maresidence   && $sqlu->AddUpdateItem('MARESIDENCE', "'$maresidence'", "z");
            $manpostindex  && $sqlu->AddUpdateItem('MANPOSTINDEX', "'$manpostindex'", "z");
            $tnaid         && $sqlu->AddUpdateItem('TNAID', "$tnaid", "z");
            $manbirthplace && $sqlu->AddUpdateItem('MANBIRTHPLACE', "'$manbirthplace'", "z");
            $manpasnumber  && $sqlu->AddUpdateItem('MANPASNUMBER', "'$manpasnumber'", "z");
            $manpasplace   && $sqlu->AddUpdateItem('MANPASPLACE', "'$manpasplace'", "z");
            $manfamstatus  && $sqlu->AddUpdateItem('MANFAMSTATUS', "'$manfamstatus'", "z");
            if ($bdate)
            {
                $sqlu->AddUpdateItem('MANBIRTHDAY', "to_date('$bdate','DD-MM-YYYY')", "z");
            }
            if ($pdate)
            {
                $sqlu->AddUpdateItem('MANPASDATE', "to_date('$pdate','DD-MM-YYYY')", "z");
            }
            if ($sqlu->IsSQLValid())
            {
                $sql_commands[] = ereg_replace('\\\"', '"', $sqlu->GetSQL("MANID=$manid"));
            }
        }

        if ($mode == 3)
        {
            $iddoc           = $_REQUEST['iddoc'];
            $stueducationgod = GetCorrectDate(1, 7, $_REQUEST['stueducationgod']);
            $godintorgu      = $_REQUEST['godintorgu'];
            $stufrom         = $_REQUEST['stufrom'];
            $stufromonkurs   = $_REQUEST['stufromonkurs'];
            $sirota          = $_REQUEST['sirota'];
            $godintonergu    = $_REQUEST['godintonergu'];

            $sqlu = new CSQLUpdate('STUDENT');
            $iddoc         && $sqlu->AddUpdateItem('STUEDUDOCUMENT', "$iddoc", "z");
            $stufrom       && $sqlu->AddUpdateItem('STUFROM', "'$stufrom'", "z");
            $stufromonkurs && $sqlu->AddUpdateItem('STUFROMONKURS', "$stufromonkurs", "z");
            $godintonergu  && $sqlu->AddUpdateItem('GODINTONERGU', "'$godintonergu'", "'z'");
            if ($stueducationgod)
            {
                $sqlu->AddUpdateItem('STUEDUCATIONGOD', "to_date('$stueducationgod','DD-MM-YYYY')", "z");
            }
            $sqlu->AddUpdateItem('GODINTORGU', "'$godintorgu'", "'z'");
            $sqlu->AddUpdateItem('SIROTA', "$sirota", "z");
            if ($sqlu->IsSQLValid())
            {
                $sql_commands[] = ereg_replace('\\\"', '"', $sqlu->GetSQL("MANID=$manid"));
            }
        }


        echo "сохранение данных...<br>";
        //beginning oracle transaction
        $cur = ora_open($db_handle) or die (ora_errorcode($db_handle).' : '.ora_error($db_handle));

        foreach ($sql_commands as $sql_command)
        {
            $ret = ora_parse($cur, $sql_command, 0);
            if (!$ret)
            {
                echo "<font color=\"ff0000\">1: $sql_command</font><br>";
                ora_rollback($db_handle);
                die (ora_error($curs));
            }
            $ret = ora_exec($cur);
            if (!$ret)
            {
                echo "<font color=\"ff0000\">3: $sql_command</font><br>";
                ora_rollback($db_handle);
                die (ora_error($curs));
            }
        }
        ora_close($cur);
        ora_commit($db_handle);

        if ($fromgroup == 1)
        {
            $ref .= "&justsaved=1&back_url=$back_url";
        }
        else
        {
            $ref .= "&justsaved=1";
        }
        RedirectTo($ref);
    }

?>