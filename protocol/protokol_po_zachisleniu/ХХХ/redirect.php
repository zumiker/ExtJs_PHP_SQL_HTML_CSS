<?php

if(isset($_GET['start']))
{
	$start=$_GET['start'];
}


if(isset($_GET['end']))
{
	$end=$_GET['end'];
}

if(isset($_GET['id_spec']))
{
	$id_spec=$_GET['id_spec'];
}

Header("Location: report.php");
?>
