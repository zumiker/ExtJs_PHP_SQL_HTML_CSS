<?php
require_once("../include.php");
$groid = $_REQUEST['groid'];
$vblid = $_REQUEST['vblid'];

$sql = "select distinct initcap( s.fio_full ) as FIO, s.MANID, s.STUDENT_ID, decode( p.FLAG, null, 0, 1 ) as FLAG, s.tstid
		from v_spi_student s
		inner join marker m
			on s.student_id = m.student_id
				and m.vblid = '$vblid'
		left join predmet_vibor_student p
			on s.student_id = p.student_id
				and m.vblid = p.vblid
		where s.groid = '$groid'
		order by tstid, fio";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>