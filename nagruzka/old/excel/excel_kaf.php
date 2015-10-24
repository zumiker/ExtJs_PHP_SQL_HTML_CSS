<?php
require_once 'Spreadsheet/Excel/Writer.php';


$fac=$_GET['fac'];
$god=$_GET['god'];
$sem=$_GET['sem'];

if($sem=='01.09.')
$sem='Осенний';
else
$sem='Весенний';
$god=$god.'/'.($god+1);
if($fac=='999')
{
$facul="";
}
else
{
$facul="FACID='$fac' AND";
}

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
$sql="insert into temp_prepod_nagruzka (select * from z_prepod_nagruzka WHERE $facul YEAR_GROCODE='$god')";
$cur=ora_do($conn,$sql);
$sql="insert into temp_semestr_kategor (select * from Z_semestr_kategor WHERE $facul YEAR_GROCODE='$god')";
$cur=ora_do($conn,$sql);
$sql="insert into temp_god (select * from Z_GOD WHERE $facul YEAR_GROCODE='$god')";
$cur=ora_do($conn,$sql);


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fac=$_GET['fac'];
$god2=$_GET['god'];
$sem2=$_GET['sem'];


// sending HTTP headers
$workbook->send('nagruzka.xls');
$_GET['fac']=$fac;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_shtat_.php");
$_GET['fac']=$fac;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_sovm_.php");
$_GET['fac']=$fac;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_pochas_.php");

/*GET['kaf']=$kaf;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_fac_year.php");*/




$workbook->close();

?>
