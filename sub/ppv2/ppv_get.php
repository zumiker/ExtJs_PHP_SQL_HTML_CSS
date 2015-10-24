<?
include('./../../../lib_debug.php');
$param	= array();
$data	= array();

foreach ( $_REQUEST as $key=>$value )
{
	$param[]= $key;
	$data[]	= urldecode($value);
}
for( $i=0; $i<count( $param ); $i++ )
{
	$parm	= $param[$i];
	$dat	= $data[$i];
	if( substr( $parm, 0, 1 ) != '_' )
	{
		if( $i == 0 )
			$where = 'where ';
		$where .= "$parm = '$dat' ";
		
	}
	
		$where .= " and ";
}		



    $predmetID = $_REQUEST['couid'];
    $isVoina = ( $predmetID == '48' );

    $sql = "SELECT VBLID from VBLANK
	where couid={$_REQUEST['couid']} and grocode='{$_REQUEST['grocode']}' and YEAR_GROCODE = GET_EDUC_GOD AND SPRING_AUTUMN LIKE GET_SEMESTR_OV_RAT";
   // print $sql; 
    $cur = @execq($sql);
    if (!$cur)
	print "no vblids for couid request = \"$sql\"";
    $vblID = @$cur[0][VBLID]; // ведомостей по предмету может быть больше одной, выбираем первую
   
   
    $sql = "SELECT initcap(FIO_FULL) as FIO_FULL,v.MANID,m.MANSEX 
    from V_SPI_STUDENT v,MAN m 
    WHERE v.GROCODE='{$_REQUEST['grocode']}' AND m.MANID=v.MANID ORDER BY FIO_FULL";
    $cur = @execq($sql); // в $cur  лежит список студентов группы.

$npp = 0;// номер записи в таблице
unset($grid_data);
foreach($cur as $a=>$b)
{
	if ($isVoina && ($b['MANSEX']=='Ж'))//девочек на военке не отображать.
	    //continue;
	print $isVoina;			
	
	$grid_data[$npp]['fio_full']		= $b['FIO_FULL'];
	$grid_data[$npp]['manid']		= $b['MANID'];

	//print "<br>SELECT 1 from PREDMET_VIBOR_STUDENT where VBLID=$vblID AND MANID= {$b['MANID']}<br>";
	if (@execq("SELECT 1 from PREDMET_VIBOR_STUDENT where VBLID=$vblID AND MANID= {$b['MANID']}"))
	// если человек есть в таблице выбор_студент, значит он отказался от данного предмета.
                $grid_data[$npp]['checked'] = false;
        else
                $grid_data[$npp]['checked'] = true; //если человека нету в таблике выбор студента, то он выбрал этот курс
	$npp ++;
}

//         $grid_data[0]['fio_full'] = 'asdf';
//         $grid_data[1]['fio_full'] = 'asdf2';
//         $grid_data[2]['fio_full'] = 'asdf1';
// 
// 
//          $grid_data[0]['checked'] = 'false';
//          $grid_data[1]['checked'] = '1';
//          $grid_data[2]['checked'] = '0';
//          
// 
// 	$grid_data[0]['manid'] = '1230';
//          $grid_data[1]['manid'] = '1432';
//          $grid_data[2]['manid'] = '012312';

	echo '{rows:'.json_encode($grid_data).'}';
	
	
	    function print_variable($ar,$parent = '' )
 {
        if (is_array($ar))

      {

          foreach( $ar as $key=> $value)

          {

            print_variable($value, $parent." : ".sprintf("%s",$key));

          }

      }

      else

      { 

        print $parent . " : " . $ar." ; <br>";

      }

 }
?>

