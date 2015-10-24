<?php
require_once 'Spreadsheet/Excel/Writer.php';


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$kaf2=$_GET['kaf'];
$god2=$_GET['god'];
$sem2=$_GET['sem'];


// sending HTTP headers
$workbook->send('nagruzka.xls');

$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_shtat.php");

$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_sovm.php");

$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_pochas.php");
/*
$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
include("excel_raspnag_s.php");

$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
include("excel_raspnag_o.php");
*/
$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_kaf_itog.php");

$_GET['kaf']=$kaf2;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_kaf_year-old.php");




$workbook->close();

?>
