<?php
require_once 'Spreadsheet/Excel/Writer.php';


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$kaf2=$_GET['fac'];
$god2=$_GET['god'];
$sem2=$_GET['sem'];


// sending HTTP headers
$workbook->send('nagruzka.xls');

$_GET['fac']=$kaf2;
$_GET['god']=$god2;
$_GET['sem']=$sem2;
include("excel_fac_itog.php");


$workbook->close();

?>
