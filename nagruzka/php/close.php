<?php
/**
 * Created by PhpStorm.nagruzka_dwh
 * User: user
 * Date: 24.12.14
 * Time: 14:57
 */
require_once("../include.php");
$div  = $_REQUEST['div'];
$studyid = $_REQUEST['studyid'];




$sql = "UPDATE NAGRUZKA_STATUS SET STATUS='2', KOGDA=(SELECT SYSDATE FROM DUAL)   WHERE DIVID='$div' AND studyid='$studyid'";
$cur = execq($sql);

/*$sq = "INSERT INTO nagruzka_dwh select * from nagruzka where divid='$div' and studyid='$studyid'";
$cu = execq($sq);
*/

$query1="delete from NAGRUZKA_DISPETCH_DWH WHERE DIVID='$div' AND studyid='$studyid'";
$cu1 = execq($query1);

$query1="delete from NAGRUZKA_PREPOD_DWH WHERE DIVID='$div' AND studyid='$studyid'";
$cu1 = execq($query1);

$sq = "INSERT INTO NAGRUZKA_DISPETCH_DWH
(select NAGID , DIVID , DIVNAME , KURS , GROCODE , KOLVO , VSEGO ,
LEC , LAB ,SEM ,SMDSEM ,SROK,EXAM,ZACH, PROEKT,PREDMET,VIBOR ,FACID ,FAC ,COUID,
FACNAME ,GROID ,KOLWEEKS ,SPRING_AUTUMN ,YEAR_GROCODE ,POTOK_LEK, PRIM, LEKTOR , SEMINAR , LABRAB , ROOM_LEC , ROOM_SEM ,ROOM_LAB ,
PREPID_LEC ,PREPID_SEM ,PREPID_LAB ,POR_SORT ,DIFID ,STUDYID ,KOL_LAB ,KOL_SEM ,POTOK_SEM ,POTOK_LAB ,
(select sysdate from dual) DATE_OF_SREZ
FROM Z_DISPETCH_NAGRUZKA
WHERE STUDYID = '$studyid'
AND DIVID = '$div')";
$cu = execq($sq);

$sq = "INSERT INTO NAGRUZKA_PREPOD_DWH
(select DIVID , SPRING_AUTUMN, YEAR_GROCODE , PREPID , FIO ,
LECTIME , SEMTIME , LABTIME, VSEGO5 , EKZ_ZACH, ITOGO7, KPR,
N9 , N10, N11, N12, VSEGO13, VSEGOPLAN,
N15, N16, N17, N18, N19, N20, VSEGO21,
N22, N23, N24, PRIM ,VSEGO25, SEMESTR,
F2, F3, F4, F_VSEGO5, F6, F_ITOGO7, F8, F9,
F10 ,F11, F12,F_VSEGO13, F_VSEGOPLAN,
F15, F16,F17, F18,F19, F20, F_VSEGO21, F22, F23, F24, FPRIM,
F_VSEGO25, F_SEMESTR, STAT, STAT_ID, DOL_ID, DOL_SMALL, STAVKA,
DIVABBREVIATE, BEZ, NET, FACID, STUDYID,
(select sysdate from dual) DATE_OF_SREZ
FROM Z_PREPOD_NAGRUZKA
WHERE STUDYID = '$studyid'
AND DIVID = '$div')";
$cu = execq($sq);


echo json_encode(array('success'=>true));
?>