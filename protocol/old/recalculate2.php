<?php
$podl=$_GET['podl'];

switch($podl)
{
	case 0:
	 echo "Пересчитывается для всего университета";
	 break;
	case 1:
	echo "Пересчитывается только для подлинников";
	break;
	case 99:
	echo "Параметр не выбран.";
	exit();	
	break;
}
?>
