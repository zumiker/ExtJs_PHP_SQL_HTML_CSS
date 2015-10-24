<?
include('./../../../lib_debug.php');
$param	= array();
$data	= array();



$vibor_list = json_decode($_REQUEST['stor'], true);

//print_variable($returned_data);
	
//Удалим всех студентов группы из таблицы студент_выбор (в ней студенты, отказавшиеся от предмета)
//сначала достанем все ведомости

$sql = "SELECT VBLID from VBLANK
	where couid={$_REQUEST['couid']} and grocode='{$_REQUEST['grocode']}' and YEAR_GROCODE = GET_EDUC_GOD AND SPRING_AUTUMN LIKE GET_SEMESTR_OV_RAT";
    //print $sql ."\n" ; 
    $cur = @execq($sql);
    if (!$cur)
	{//нету ведомостей
	print "no vblids for couid request = \"$sql\" \n";
	return;
	}
	
	foreach($cur as $vb) //делаем простой массив из номеров ведомостей
	{
		$vbLids[]=$vb['VBLID'];
	}

//теперь удаляем
$where = '(VBLID=' . implode(' OR VBLID=', $vbLids) . ')';
$sql = "DELETE from PREDMET_VIBOR_STUDENT where $where";
//print $sql . "\n";
execq($sql);

if ( $_REQUEST['couid'] == '48' )//для военки еще нужно удалить из таблицы студент
{
        $sql = "UPDATE STUDENT set STUVOINA=NULL where GROCODE='{$_REQUEST['grocode']}'";
        //print $sql . "\n";
        execq($sql);
}

// удалили всех отказников, теперь нужно добавить отказавшихся студентов

foreach ($vibor_list as $current)
{
	if (!$current['checked']) // отказался кто-то
	{
		//для каждой ведомости нужно записать отказ
		foreach($vbLids as $vb)
		{
			$sql  = "INSERT INTO PREDMET_VIBOR_STUDENT(VBLID, MANID, FLAG) values ($vb, {$current['manid']}, 'F')";
			//print $sql . "\n";
			execq($sql);
		}		
	}
	else if( $_REQUEST['couid'] == '48' ) // а здесь еденичка для тех, кто НЕ октазался от военки
	{
		$sql = "UPDATE STUDENT set STUVOINA='1' where MANID={$current['manid']}";
		//print $sql . "\n";
		execq($sql);
	}
}

?>

