<?php
$excel = $_GET['excel'];
if ($excel)
{
	ob_start();
}

session_start();
include("treecore.php");
include("common.php");
?>

<?php

    function PrintCommonHTML($nocache, $item1, $item2)
    {
        if ($nocache)
        {
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }

    ?>
    <html>

    <script language="JavaScript" type="text/javascript">
    <!--
    function order_submit()
    {
        frmGroupList.submit();
    }
    //-->
    </script>

    <head>
    	<title>Master Frame</title>
    	<link rel='stylesheet' href='mtu.css'>
        <script language="javascript" src="tree.js"></script>

        <STYLE type="text/css"><!--
        h2, h3, h4, input {font-family: arial,verdana,helvetica,geneva,sans-serif}
        li {list-style-type:square}
        td.menu {background-color: #ffcc00}
        td.nolink {background-color: #e0e0e0}
        td.menu-on {background-color: #ffee00}//--></STYLE>

        <script language="JavaScript">
        <!--
        function menu()
        {
        if (document.getElementsByTagName)
        {
            var allCells = document.getElementsByTagName('td');
            for (var i = 0; i < allCells.length; i++)
            {
                if (allCells.item(i).className == 'menu')
                {
                    var currClass = allCells.item(i).className;
                    eval('allCells.item(i).onmouseover = function() {this.className = \'' + currClass + '-on\' }');
                    eval('allCells.item(i).onmouseout = function() {this.className = \'' + currClass + '\'}');
                    }
                }
            }
        }
        //--></script>

    <style type="text/css">
    @import "x-all.css";
    </style>
    <!--[if IE]>
    <link
     href="x-ie.css"
     rel="stylesheet"
     type="text/css"
     media="screen">
    <script type="text/javascript">
    onload = function() { content.focus() }
    </script>
    <![endif]-->

    </head>

    <body leftmargin="5" topmargin="5" marginwidth="5" marginheight="5" bgcolor="#f0f0f0" onload="menu()">
    <?
//    $i1 = '<td align="center" width="25%" class="menu"><a href="master.php?action=show_man"><b>добавить</b></a></td>';
    //$i2 = '<td align="center" width="25%" class="menu"><a href="master.php?action=specialities"><b>специальности</b></a></td>';
    //$i3 = '<td align="center" width="25%" class="menu"><a href="master.php?action=currs"><b>учебные планы</b></a></td>';
    $i4 = '<td align="center" width="25%" class="menu"><a href="master.php?action=report"><b>отчет</b></a></td>';
    $i2 = '<td align="center" width="25%" class="menu"><a href="master.php?action=search"><b>добавить / поиск</b></a></td>';
    $i3 = '<td align="center" width="25%" class="nolink"><b> </b></td>';
    //$i4 = '<td align="center" width="25%" class="nolink"><b>поиск</b></td>';
    ?>
    <!-- Top Menu -->

    <div id="fixedBox">
    <table BORDER="0" cellspacing="1" cellpadding="2" bgcolor="ffffff" ALIGN="center" width="98%">
    <tr bgcolor="ffcc00">
    <?
    echo $i1;
    echo $i2;
    echo $i4;
    echo $i3;
    ?>
    </tr>
    </table>
    </div>
    <!-- Top Menu -->
    <div id="content">
    <?
    }
?>

<?php
	$action = $_REQUEST['action'];
  	if (isset($action))
	{
		$db_handle = ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		if (!$db_handle)
		{
			echo "Oracle Connect Error " . ora_error();
			return;
		}

        if ($action == 'show_div')
        {
            PrintCommonHTML(0, 1, 1);
            $divid  = $_REQUEST['divid'];
            if (isset($divid)) { mShowGroup($db_handle, $divid); }
        }

        if ($action == 'show_man') { PrintCommonHTML(0, 1, 1); ShowMan($db_handle); }
        if ($action == 'update_man') { PrintCommonHTML(0, 1, 1); UpdateMan($db_handle); }
        if ($action == 'add_man') { PrintCommonHTML(0, 1, 1); AddMan($db_handle); }
		if ($action == 'search') { PrintCommonHTML(0, 1, 1); showSearch($db_handle); }
		if ($action == 'report') { PrintCommonHTML(0, 1, 1); showReport($db_handle); }


		ora_logoff($db_handle);
	}
	else
	{
		echo PrintCommonHTML(0, 0, 1);
            ?>
            <form name="frmGroupList" method="get" action="master.php">
            <input type="hidden" name="action" value="order">
            </form>
            <?        
	}
	
	function showReport($db_handle)
	{
		global $excel;
		?>
		<b>Укажите параметры поиска:</b><br /><br />
		<form method="GET" action="master.php">
			<input type="hidden" name="action" value="report">
			<input type="hidden" name="exec" value="1">
			Год<br />
			<?php
			$year_grocode = (string)$_GET['year_grocode'];
			echo getSelect('SELECT study_year id, study_year FROM year_list ORDER BY study_year DESC', $year_grocode, 'year_grocode');
			?>
			<br /><br />
			Статус<br />
			<?php
			$tempstatus = intval($_GET['tempstatus']);
			echo getSelect('SELECT id, name FROM tempstatus ORDER BY id', $tempstatus, 'tempstatus');
			?>	
			<br /><br />
			Должность<br />
			<?php
			$dolzhnost = intval($_GET['dolzhnost']);
			echo getSelect('SELECT id, name FROM tdolzhnost WHERE AND KOL_SIMVOL IS NOT NULL ORDER BY id', $dolzhnost, 'dolzhnost');
			?>
			<br /><br />
			Категория<br />
			<?php
			$kat = intval($_GET['kat']);
			echo getSelect('SELECT id, name FROM tstepen_kat ORDER BY id', $kat, 'kat');
			?>
			<br /><br />
			Профиль<br />
			<?php
			$profil = intval($_GET['profil']);
			echo getSelect('SELECT profil, profil_name FROM tstepen_profil ORDER BY profil', $profil, 'profil');
			?>
			<hr size="1">
			Сортировка<br />
			<select name="sort">
				<option value="1">ФИО</option>
				<option value="2">Кафедра+ФИО</option>
			</select>
			<br /><input type="checkbox" name="excel" value="1" id="excel"> <label for="excel">Экспортировать в Excel</label>
			<br /><br />
			<input type="submit" value="Найти">
		</form>
		<?
		
		$exec = $_GET['exec'];
		if (!$exec)
		{
			return;
		}
		
		$sql = 'SELECT initcap(FIO_PREPOD), YEAR_GROCODE, DIVABBREVIATE, STAT, DOL, STAVKA, ZVAN, BEZ, STEPEN, 
				PROFIL_NAME, VSEGO, PREPID
				FROM z_prepod_minobraz 
				WHERE 1=1 ';
		if (!empty($year_grocode))
		{
			$sql .= 'AND year_grocode=\'' . $year_grocode . '\' ';
		}
		
		if (!empty($tempstatus))
		{
			$sql .= 'AND stat_id=' . $tempstatus . ' ';
		}
		
		if (!empty($dolzhnost))
		{
			$sql .= 'AND dol_id=' . $dolzhnost . ' ';
		}
		
		if (!empty($kat))
		{
			$sql .= 'AND kat=' . $kat . ' ';
		}
		
		if (!empty($profil))
		{
			$sql .= 'AND profil=' . $profil . ' ';
		}
		
		$sort = $_GET['sort'];
		if ($sort == 2)
		{
			$sql .= ' ORDER BY divabbreviate, fio_prepod';
		}
		else
		{
			$sql .= ' ORDER BY fio_prepod';
		}
		
		$curs = ora_do($db_handle, $sql);
		// echo $sql;
		if ($curs)
		{
			$header = array('Фио преподавателя', 'Год', 'Кафедра', 'Статус', 'Должность', 'Ставка', 'Звание', 'Оплата', 'Степень', 'Профиль', 'Всего часов');
			$data = array();
			
			$index = 0;
			do
			{
				for ($i = 0; $i < count($header); $i++)
				{
					$data[$index][$i] = ora_getcolumn($curs, $i);
				}
				$index++;
			}
			while (ora_fetch($curs));
			
			// print_r($data);
			
			if ($excel)
			{
				ob_end_clean();
				error_reporting(2047);
				
				echoSpreadsheet(
					$header,
					$data,
					array(35, 9, 9, 23, 16, 7, 10, 13, 8, 11, 12)
				);
			}
			else
			{
				echo '<table border="1"><tr>';
				foreach ($header as $title)
				{
					if (!empty($title))
					{
						echo '<td><b>' . $title . '</b></td>';
					}
				}
				echo '</tr>';
				
				foreach ($data as $row)
				{
					echo '<tr>';
					for ($i = 0; $i < count($header); $i++)
					{
						if (!empty($header[$i]))
						{
							echo '<td>' . $row[$i] . '&nbsp;</td>';
						}
					}
					echo '</tr>';
				}
				echo '</table>';
			}
		}
		else
		{
			echo 'По Вашему запросу ничего не найдено';
		}
	}
	
	function echoSpreadsheet($col_names, $data, $widths = null)
	{
		$pear_path  = dirname(__FILE__) . '\PEAR';
		ini_set('include_path', $pear_path . ';' . ini_get('include_path'));
		
		require_once "Spreadsheet/Excel/Writer.php";
		

		$xls =& new Spreadsheet_Excel_Writer();
		$sheet =& $xls->addWorksheet('result');
		
		if (!is_null($widths))
		{
			foreach ($col_names as $i => $title)
			{
				if (isset($widths[$i]))
				{
					$sheet->setColumn($i, $i, $widths[$i]);
				}
			}
		}

		$colHeadingFormat =& $xls->addFormat();
		$colHeadingFormat->setBold();
		$colHeadingFormat->setAlign('center');

		$sheet->writeRow(0, 0, $col_names, $colHeadingFormat);

		$index = 1;
		foreach ($data as $row)
		{
			$sheet->writeRow($index, 0, $row);
			$index++;
		}

		$xls->send("doc.xls");
		$xls->close();
	}
	
	function getSelect($sql, $selected_id, $control_name)
	{
		global $db_handle;
		$cur = ora_do($db_handle, $sql);
		
		$html = '<select name="' . $control_name . '" style="width: 200px;"><option value="">-выберите-</option>';
		if ($cur)
		{
			do
			{
				$id = ora_getcolumn($cur, 0);
				$title = ora_getcolumn($cur, 1);
				$html .= '<option value="' . $id . '" ' . (($id == $selected_id) ? 'selected' : '' ) . '>' . $title . '</option>';
			}
			while (ora_fetch($cur));
		}
		$html .= '</select>';
		return $html;
	}
	
	function showSearch($db_handle)
	{
		// $_REQUEST['query'] = 'ИВА';
		
		$query = $_REQUEST['query'];
		
		?>
		Введите фамилию преподавателя для поиска:<br /><br />
		<form method="GET" action="master.php">
			<input type="hidden" name="action" value="search">
			<input type="text" value="<?php echo $query; ?>" name="query">
			<input type="submit" value="Найти">
		</form>
		<?
		
		if (!empty($query))
		{
			$sql = "select 
					   Initcap(MANLASTNAME) || ' ' ||
					   Initcap(MANFIRSTNAME) || ' ' ||
					   Initcap(MANPATRONYMIC),
					   DIVISION.DIVABBREVIATE,
					   MANSEX,	   
					   TEMPSTATUS.NAME as TEM,
					   TRABSTAVKA.NAME as TRA,
					   TDOLZHNOST.NAME as DOL,
					   TSTEPEN.NAME,
					   TZVANIE.NAME as ZVN,
				       ID_MANID,CHIEF, PREPOD.DIVID, PREPOD.MANID
				from 
					 MAN,
					 PREPOD,
					 TSTEPEN,
					 TDOLZHNOST,
					 TEMPSTATUS,
					 TZVANIE,
					 TRABSTAVKA,
					 DIVISION
				where 
					  PREPOD.MANID=MAN.MANID 
					  and TSTEPEN.ID=PREPOD.TST_ID 
					  and TDOLZHNOST.ID=PREPOD.TDO_ID 
					  and PREPOD.TEM_ID = TEMPSTATUS.ID
					  and PREPOD.TZV_ID (+)= TZVANIE.ID
					  and PREPOD.TRA_ID = TRABSTAVKA.ID
					  and MAN.MANLASTNAME LIKE UPPER('$query%')
					  and DIVISION.DIVID = PREPOD.DIVID
				order by MANLASTNAME";
			
			$curs = ora_do($db_handle, $sql);
			if ($curs)
			{
				echo '<table>
					<tr><td><b>ФИО Преподавателя</b></td><td><b>Кафедра</b></td><td><b>Категория сотрудника</b></td></tr>';
				do
				{
					echo '<tr>';
					echo '<td><a href="master.php?action=show_man&manid=' .  ora_getcolumn($curs, 11) .'&id_manid=' .  ora_getcolumn($curs, 8) .'">' . ora_getcolumn($curs, 0) . '</a></td>';
					echo '<td>' . ora_getcolumn($curs, 1) . '</td>';
					echo '<td>' . ora_getcolumn($curs, 3) . '</td>';
					echo '<td><a href="master.php?action=show_man&manid=' .  ora_getcolumn($curs, 11) .'">Добавить категорию</a></td>';
					echo '</tr>';
				}
				while (ora_fetch($curs));
				echo '</table>';
			}
			else
			{
				echo 'По Вашему запросу ничего не найдено';
			}
		}
		else
		{
			if (isset($_REQUEST['query']) && empty($query))
			{
				echo 'По Вашему запросу ничего не найдено';
			}
		}
	}
	
	function mShowGroup($db_handle, $divid, $ordby, $status, $so)
	{
		$trash = $_REQUEST['trash'] == 'true';
		$curs = ora_do($db_handle, "select FACNAME,lower(DIVNAME) from DIVISION,FACULTY where DIVISION.FACID=FACULTY.FACID and DIVID=$divid");
		$facname = ora_getcolumn($curs, 0);
		$divname = ucfirst(ora_getcolumn($curs, 1));
		StartShowResultset("Факультет: <b>$facname</b><br>Кафедра: <b>$divname</b>", false);

        //$sql = //"select Initcap(MANLASTNAME),Initcap(MANFIRSTNAME),Initcap(MANPATRONYMIC),MANSEX,TSTEPEN.NAME,TDOLZHNOST.NAME,MAN.MANID,CHIEF from MAN,PREPOD,TSTEPEN,TDOLZHNOST where PREPOD.MANID=MAN.MANID and TSTEPEN.ID=PREPOD.TST_ID and TDOLZHNOST.ID=PREPOD.TDO_ID and PREPOD.DIVID=$divid order by MANLASTNAME";
		$prepod_old = '';
		if ($trash)
		{
			$prepod_old = " OR (PREPOD.DIVID_OLD=$divid AND PREPOD.DIVID IS NULL)";
		}
        $sql = "select 
					   Initcap(MANLASTNAME), 
					   Initcap(MANFIRSTNAME),
					   Initcap(MANPATRONYMIC),
					   MANSEX,	   
					   TEMPSTATUS.NAME as TEM,
					   TRABSTAVKA.NAME as TRA,
					   TDOLZHNOST.NAME as DOL,
					   TSTEPEN.NAME,
					   TZVANIE.NAME as ZVN,
				       MAN.MANID ,CHIEF, DIVID,ID_MANID
				from 
					 MAN,
					 PREPOD,
					 TSTEPEN,
					 TDOLZHNOST,
					 TEMPSTATUS,
					 TZVANIE,
					 TRABSTAVKA 
				where 
					  PREPOD.MANID=MAN.MANID 
					  and TSTEPEN.ID=PREPOD.TST_ID 
					  and TDOLZHNOST.ID=PREPOD.TDO_ID 
					  and (PREPOD.DIVID=$divid $prepod_old)
					  and PREPOD.TEM_ID = TEMPSTATUS.ID
					  and PREPOD.TZV_ID (+)= TZVANIE.ID
					  and PREPOD.TRA_ID = TRABSTAVKA.ID
				order by MANLASTNAME";
        //echo $sql;
        $curs = ora_do($db_handle, $sql);
		if (!$curs)
		{
			EndShowResultset();
			return;
		}
		$counter = 1;
		$flag = true;

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
        echo "<td>Ф. И. О.</td>";
        echo "<td>Пол</td>";
        echo "<td>Категория</td>";
        echo "<td>Ставка</td>";
        echo "<td>Должность</td>";       
        echo "<td>Степень</td>";
        echo "<td>Звание</td>";
        ?>
        </tr>
        <?

		do
		{
			$name			= join( array(ora_getcolumn($curs, 0) , ora_getcolumn($curs, 1) , ora_getcolumn($curs, 2)), " ");
			$sex			= ora_getcolumn($curs, 3);
			$kat			= ora_getcolumn($curs, 4);
			$stavka			= ora_getcolumn($curs, 5);
			$dol			= ora_getcolumn($curs, 6);
			$stepen			= ora_getcolumn($curs, 7);			
			$zvan			= ora_getcolumn($curs, 8);
			$manid			= ora_getcolumn($curs, 9);
			$chief			= ora_getcolumn($curs, 10);
			$current_divid	= ora_getcolumn($curs, 11);
			$id_manid		= ora_getcolumn($curs, 12);
			if ($chief)
			{
				$name = "<b>$name</b>";
			}
			if (!$current_divid)
			{
				$name = " <i>$name (уволен)</i>";
			}
			AddToContentTable($flag, "&nbsp;$counter&nbsp;","cb",$name, $sex,$kat,$stavka, $dol, $stepen,$zvan, $manid, $id_manid);
			if ($flag)
			{
				$flag = false;
			}
			else
			{
				$flag = true;
			}
			$counter++;
		} while (ora_fetch($curs));
		EndContentTable($counter-1);
		EndShowResultset();
		?>
		<br />
		<input type="checkbox" id="cbtrash" <?php if ($trash) echo 'checked'; ?> onclick="document.location.href='master.php?action=show_div&divid=<? echo $divid; ?>&trash='+this.checked;" /> <label for="cbtrash">Включать уволенных в список</label>
		<?
	}

    function PrintOptions($curs, $selected)
    {
        do
            {
                $id   = ora_getcolumn($curs, 0);
                $name = ora_getcolumn($curs, 1);
                if ($id == $selected)
                {
                    echo "<option value=\"$id\" selected>$name</option>";
                }
                else
                {
                    echo "<option value=\"$id\">$name</option>";
                }
            }
            while (ora_fetch($curs));
    }

    function ShowMan($db_handle)
    {
        $manid = $_REQUEST['manid'];
        $id_manid = $_REQUEST['id_manid'];
        if ($id_manid)
		{
            $curs = ora_do($db_handle, "select FACNAME,lower(DIVNAME) from DIVISION,FACULTY,PREPOD where DIVISION.FACID=FACULTY.FACID and PREPOD.DIVID=DIVISION.DIVID and ID_MANID=$id_manid");
            $facname = ora_getcolumn($curs, 0);
            $divname = ucfirst(ora_getcolumn($curs, 1));
            StartShowResultset("Факультет: <b>$facname</b><br>Кафедра: <b>$divname</b>", false);
            $action = "update_man";

            $sql = "select Initcap(MANLASTNAME),Initcap(MANFIRSTNAME),Initcap(MANPATRONYMIC),
							MANSEX,DIVID,TEM_ID,TRA_ID,TST_ID,TZV_ID,TDO_ID,CHIEF,BEZ_OPLATY, DIVID_OLD 
							from PREPOD,MAN where MAN.MANID=PREPOD.MANID and ID_MANID=$id_manid";
            $cur = ora_do($db_handle, $sql);
		}
        else
        {
            $curs = ora_do($db_handle, "select FACNAME,lower(DIVNAME) from DIVISION,FACULTY,PREPOD where DIVISION.FACID=FACULTY.FACID and PREPOD.DIVID=DIVISION.DIVID and PREPOD.MANID=$manid");
            $facname = ora_getcolumn($curs, 0);
            $divname = ucfirst(ora_getcolumn($curs, 1));
            StartShowResultset("Добавление категории сотрудника", false);
            StartShowResultset("Факультет: <b>$facname</b><br>Кафедра: <b>$divname</b>", false);
            $action = "add_man";

            $sql = "select id_manid from PREPOD where manid = $manid";
            $cur = ora_do($db_handle, $sql);
			$id = ora_getcolumn($cur, 0);
			$new = 0;
			if ( $id )
			{
				$sql = "select Initcap(MANLASTNAME),Initcap(MANFIRSTNAME),Initcap(MANPATRONYMIC),
								MANSEX,DIVID,TEM_ID,TRA_ID,TST_ID,TZV_ID,TDO_ID,CHIEF,BEZ_OPLATY, DIVID_OLD 
								from PREPOD,MAN where MAN.MANID=PREPOD.MANID and PREPOD.MANID=$manid";
			}
			else
			{
				$sql = "select Initcap(MANLASTNAME),Initcap(MANFIRSTNAME),Initcap(MANPATRONYMIC),MANSEX, divid from sotrudnik s, man m where m.manid = $manid and m.manid = s.manid";
				$new = 1;
			}
            $cur = ora_do($db_handle, $sql);
        }

        $manid ? $surname = ora_getcolumn($cur, 0) :  $surname = '';
        $manid ? $name = ora_getcolumn($cur, 1) :  $name = '';
        $manid ? $patr = ora_getcolumn($cur, 2) :  $patr = '';
        $manid ? $sex = ora_getcolumn($cur, 3) :  $sex = '0';
        ?>
        <br>
        <form name="frmMan" method="get" action="master.php">
        <input type="hidden" name="action" value="<? echo($action); ?>">
		<input type="hidden" name="sub_action" value="">
        <input type="hidden" name="manid" value="<? echo($manid); ?>">
        <input type="hidden" name="id_manid" value="<? echo($id_manid); ?>">
        <table border="0" cellspacing="1" cellpadding="2" align="center" width="90%">
        <tr>
            <td align="right">Фамилия</td>
            <td><input type="text" name="MANLASTNAME" value="<? echo($surname); ?>" style="width:200px;"></td>
        </tr>
        <tr>
            <td align="right">Имя</td>
            <td><input type="text" name="MANFIRSTNAME" value="<? echo($name); ?>" style="width:200px;"></td>
        </tr>
        <tr>
            <td align="right">Отчество</td>
            <td><input type="text" name="MANPATRONYMIC" value="<? echo($patr); ?>" style="width:200px;"></td>
        </tr>
        <tr>
            <td align="right">Пол</td>
            <td>
            <select name="MANSEX" size="1"  style="width:100px;">
            <?
            $sexs = array(array('<выберите>','0'), array('М','М'), array('Ж','Ж'));
            foreach ($sexs as $s)
            {
                if ($s[1] == $sex)
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
            </td>
        </tr>
        <tr><td colspan="2"><hr size="1"></td></tr>
        <tr>
            <!--td align="right">Кафедра 1</td-->
            <td align="right">Кафедра</td>
            <td>
            <select name="DIVID1" size="1"  style="width:300px;">
			<!-- option value="null"><не выбрана></option -->
            <?
            $manid ? $divid1 = ora_getcolumn($cur, 4) :  $divid1 = 0;
			
			$divid_selected = $divid1;
			if ($divid_selected == 0 && ( $manid > 0 && !$new ) )
			{
				$divid_selected = ora_getcolumn($cur, 12);
			}
			
            $sql = "select DIVID,DIVABBREVIATE from DIVISION where DTYPE='K' and DIVID<>209 order by DIVABBREVIATE";
            $curs = ora_do($db_handle, $sql);
            PrintOptions($curs, $divid_selected);
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right">Категория сотрудника</td>
            <td>
            <select name="TEM_ID" style="width:200px;">
            <option value="null"><выберите></option>
            <?
            ( $manid && !$new ) ? $temid = ora_getcolumn($cur, 5) :  $temid = 0;
            $sql = "select ID,NAME from TEMPSTATUS order by NAME";
            $curs = ora_do($db_handle, $sql);
            PrintOptions($curs, $temid);
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right">Рабочая ставка</td>
            <td>
            <select name="TRA_ID" size="1" style="width:100px;">
            <?
            ( $manid && !$new ) ? $traid = ora_getcolumn($cur, 6) :  $traid = 1;
            $sql = "select ID,NAME from TRABSTAVKA order by NAME";
            $curs = ora_do($db_handle, $sql);
            PrintOptions($curs, $traid);
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right">Ученая степень</td>
            <td>
            <select name="TST_ID" size="1" style="width:100px;">
            <option value="0"><нет></option>
            <?
            ( $manid && !$new ) ? $tstid = ora_getcolumn($cur, 7) :  $tstid = 0;
            $sql = "select ID,NAME from TSTEPEN where ID<>0 order by NAME";
            $curs = ora_do($db_handle, $sql);
            PrintOptions($curs, $tstid);
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right">Звание</td>
            <td>
            <select name="TZV_ID" size="1" style="width:100px;">
            <option value="0"><нет></option>
            <?
            ( $manid && !$new ) ? $tzvid = ora_getcolumn($cur, 8) :  $tzvid = 0;
            $sql = "select ID,NAME from TZVANIE where ID<>0 order by NAME";
            $curs = ora_do($db_handle, $sql);
            PrintOptions($curs, $tzvid);
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right">Должность</td>
            <td>
            <select name="TDO_ID" size="1" style="width:150px;">
            <option value="null"><выберите></option>
            <?
            ( $manid && !$new ) ? $tdoid = ora_getcolumn($cur, 9) :  $tdoid = 0;
            $sql = "select ID,NAME from TDOLZHNOST where ID<>0 AND KOL_SIMVOL IS NOT NULL order by NAME";
            $curs = ora_do($db_handle, $sql);
            PrintOptions($curs, $tdoid);
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right">Зав. кафедрой</td>
            <td>
            <?
            ( $manid && !$new ) ? $chief = ora_getcolumn($cur, 10) :  $chief = 0;
            $cb_checked = '';
            if ($chief) { $cb_checked = 'checked'; }
            ?>
            <input name="CHIEF" type="checkbox" value="1" <? echo $cb_checked; ?> >
            </td>
        </tr>
        <tr>
            <td align="right">Без оплаты</td>
            <td>
            <?
            ( $manid && !$new ) ? $free = ora_getcolumn($cur, 11) :  $free = 0;
            $cb_checked = '';
            if ($free) { $cb_checked = 'checked'; }
            ?>
            <input name="BEZ_OPLATY" type="checkbox" value="1" <? echo $cb_checked; ?> >
            </td>
        </tr>
        </table>
        </form>
        <br>
        <?
        EndShowResultset();

        ?>
        <script language="JavaScript" type="text/javascript">
        <!--
		var main_divid = <?php echo intval($divid1); ?>;
        function Validate_submit(sub_action)
        {
            if (frmMan.MANLASTNAME.value == '')
            {
                alert('Введите фамилию');
                return;
            }
            if (frmMan.MANFIRSTNAME.value == '')
            {
                alert('Введите имя');
                return;
            }
            if (frmMan.MANPATRONYMIC.value == '')
            {
                alert('Введите отчество');
                return;
            }
            if (frmMan.MANSEX.value == 0)
            {
                alert('Выберите пол');
                return;
            }

            if (frmMan.action.value == 'add_man' && frmMan.DIVID1.value == 'null')
            {
                alert('Выберите кафедру 1');
                return;
            }

            if (frmMan.TEM_ID.value == 'null')
            {
                alert('Выберите категорию сотрудника');
                return;
            }
            if (frmMan.TDO_ID.value == 'null')
            {
                alert('Выберите должность');
                return;
            }
			
			if (sub_action == 'move')
			{
				if (main_divid == frmMan.DIVID1.value)
				{
					alert('Выберите кафедру (отличную от текущей) на которую хотите перевести преподавателя');
					return;
				}
			}
			
			<?php if ($action != 'add_man') :  ?>
			if (sub_action == 'save')
			{
				if (main_divid != frmMan.DIVID1.value)
				{
					alert('Для сохранения измененной кафедры выберите действие "Перевести" вместо "Сохранить"');
					return;
				}
			}
			<?php endif; ?>
			
			frmMan.sub_action.value = sub_action;
            frmMan.submit();
        }
        //-->
        </script>

        <br><div align="center">
        <input name="btnBack" type="button" value="Назад" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="javascript:history.go(-1)">
		<?php if (!$id_manid || $divid1 != 0): ?>
		<input name="btnSave0" type="button" value="Сохранить" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="Validate_submit('save')">
		<?php endif; ?>
        <?php if ($id_manid > 0 && $divid1 > 0): ?>
		<input name="btnSave" type="button" value="Уволить" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="Validate_submit('trash')">
		<input name="btnSave1" type="button" value="Перевести" style="font-family: arial; font-size: 10pt; height:25px; width:100px;" onClick="Validate_submit('move')">
		<?php endif; ?>
		<?php if ($id_manid > 0 && $divid1 == 0): ?>
		<input name="btnSave2" type="button" value="Удалить из базы" style="font-family: arial; font-size: 10pt; height:25px; width:120px;" onClick="Validate_submit('del')">
		<?php endif; ?>
		<!--
		<input name="btnSave2" type="button" value="Удалить из базы" style="font-family: arial; font-size: 10pt; height:25px; width:120px;" onClick="Validate_submit('del')">
		<input name="btnSave3" type="button" value="Удалить перевод" style="font-family: arial; font-size: 10pt; height:25px; width:120px;" onClick="Validate_submit('del_move')">
		-->
        </div>
        <?
    }

    function UpdateMan($db_handle)
    {
		$MANLASTNAME	= $_REQUEST['MANLASTNAME'];
        $MANFIRSTNAME	= $_REQUEST['MANFIRSTNAME'];
        $MANPATRONYMIC	= $_REQUEST['MANPATRONYMIC'];
        $MANSEX			= $_REQUEST['MANSEX'];
        $DIVID1			= $_REQUEST['DIVID1'];
        $TEM_ID			= $_REQUEST['TEM_ID'];
        $TRA_ID			= $_REQUEST['TRA_ID'];
        $TST_ID			= $_REQUEST['TST_ID'];
        $TZV_ID			= $_REQUEST['TZV_ID'];
        $TDO_ID			= $_REQUEST['TDO_ID'];
        $TEM_ID2		= $_REQUEST['TEM_ID2'];
        $TRA_ID2		= $_REQUEST['TRA_ID2'];
        $CHIEF			= $_REQUEST['CHIEF'] + 0; if ($CHIEF == 0) { $CHIEF = 'null'; }
		$BEZ_OPLATY		= $_REQUEST['BEZ_OPLATY'] + 0; if ($BEZ_OPLATY == 0) { $BEZ_OPLATY = 'null'; }
        $manid			= $_REQUEST['manid'];
        $id_manid		= $_REQUEST['id_manid'];
		$sub_action		= $_REQUEST['sub_action'];

        $sql_commands[] = "update MAN set (MANLASTNAME,MANFIRSTNAME,MANPATRONYMIC,MANSEX) = (select upper('$MANLASTNAME'),upper('$MANFIRSTNAME'),upper('$MANPATRONYMIC'),'$MANSEX' from dual) where MANID=$manid";
        $sql_commands[] = "update PREPOD set (DIVID,TEM_ID,TRA_ID,TST_ID,TZV_ID,TDO_ID,CHIEF,BEZ_OPLATY) = (select $DIVID1, $TEM_ID,$TRA_ID,$TST_ID,$TZV_ID,$TDO_ID,$CHIEF,$BEZ_OPLATY from dual) where ID_MANID=$id_manid";

		$cur_divid = null;
		if (in_array($sub_action, array('trash', 'move')))
		{
			$sql = 'SELECT divid FROM prepod WHERE id_manid=' . $id_manid;
			$cur = ora_do($db_handle, $sql);
			$cur_divid = ora_getcolumn($cur, 0);
		}
		
		if ($sub_action == 'trash')
		{
			$sql_commands[] = 'update PREPOD set DIVID_OLD=' . $cur_divid . ', DIVID=NULL, DIVID_DO_PEREH=NULL WHERE id_manid=' . $id_manid;
		}
		elseif ($sub_action == 'move')
		{
			$sql_commands[] = 'update PREPOD set DIVID_DO_PEREH=' . $cur_divid . ' WHERE id_manid=' . $id_manid;
		}
		elseif ($sub_action == 'del')
		{
			$sql_commands[] = 'update PREPOD set DIVID_DO_PEREH=NULL, DIVID_OLD=NULL, DIVID=NULL WHERE id_manid=' . $id_manid;
		}
		elseif ($sub_action == 'del_move')
		{
			$sql_commands[] = 'update PREPOD set DIVID_DO_PEREH=NULL WHERE id_manid=' . $id_manid;
		}
		
        echo "сохранение данных...<br>";
        //beginning oracle transaction
        $cur = ora_open($db_handle) or die (ora_errorcode($db_handle).' : '.ora_error($db_handle));
		// print_r($sql_commands);
		// die;
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

        if ($DIVID1 == 'null')
        {
            echo "преподаватель удален...<br>";
        }
        else
        {
            RedirectTo("master.php?action=show_div&divid=$DIVID1");
        }
    }

    function AddMan($db_handle)
    {
        $manid			= $_REQUEST['manid'];
        $MANLASTNAME	= $_REQUEST['MANLASTNAME'];
        $MANFIRSTNAME	= $_REQUEST['MANFIRSTNAME'];
        $MANPATRONYMIC	= $_REQUEST['MANPATRONYMIC'];
        $MANSEX			= $_REQUEST['MANSEX'];
        $DIVID1			= $_REQUEST['DIVID1'];
        $TEM_ID			= $_REQUEST['TEM_ID'];
        $TRA_ID			= $_REQUEST['TRA_ID'];
        $TST_ID			= $_REQUEST['TST_ID'];
        $TZV_ID			= $_REQUEST['TZV_ID'];
        $TDO_ID			= $_REQUEST['TDO_ID'];
        $TEM_ID2		= $_REQUEST['TEM_ID2'];
        $TRA_ID2		= $_REQUEST['TRA_ID2'];
        $CHIEF			= $_REQUEST['CHIEF'] + 0; if ($CHIEF == 0) { $CHIEF = 'null'; }
		$BEZ_OPLATY		= $_REQUEST['BEZ_OPLATY'] + 0; if ($BEZ_OPLATY == 0) { $BEZ_OPLATY = 'null'; }

 //		$sql_commands[] = "insert into MAN (MANID,MANLASTNAME,MANFIRSTNAME,MANPATRONYMIC,MANSEX) values (SEQ_MAN.NextVal, upper('$MANLASTNAME'),upper('$MANFIRSTNAME'),upper('$MANPATRONYMIC'),'$MANSEX')";
		$sql_commands[] = "insert into PREPOD (MANID,DIVID,TEM_ID,TRA_ID,TST_ID,TZV_ID,TDO_ID,CHIEF,BEZ_OPLATY,ID_MANID) values ($manid,$DIVID1, $TEM_ID,$TRA_ID,$TST_ID,$TZV_ID,$TDO_ID,$CHIEF,$BEZ_OPLATY,SEQ_PREPOD.NextVal)";

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

        RedirectTo("master.php?action=show_div&divid=$DIVID1");
    }
?>
</div>
</body>
</html>