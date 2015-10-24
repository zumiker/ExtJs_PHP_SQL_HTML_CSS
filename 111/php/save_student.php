<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.06.14
 * Time: 12:58
 */
require_once("../include.php");
$data = json_decode(file_get_contents('php://input'), true);
foreach ( $data as $row )
{
	$vblid		= $row['VBLID'];
	$manid		= $row['MANID'];
	$student_id	= $row['STUDENT_ID'];
   // echo $row['FLAG'];
	if( $row['FLAG'] === '1' )
	{
        $sql = "insert into predmet_vibor_student ( vblid, manid, flag, student_id )
				values (
					'$vblid',
					'$manid',
					'F',
					'$student_id'
				)";
	}
	else //if( $row['FLAG'] === 0 )
	{
        $sql = "delete from predmet_vibor_student
				where vblid = '$vblid'
					and student_id = '$student_id'";
	}
   // echo $sql;
	$cur = execq( $sql );
	echo json_encode(array('success'=>true));
}
?>