<?php
	include('/var/www/lib.php');
	function get_currentyear()
	{
		$month=date("n",time());
		$year=date("Y",time());
		if($month<7)
		{
			return ($year-1).'/'.$year;
		}
		else
		{
			return $year.'/'.($year+1);
		}
	}
?>