<?
	require_once("/var/www/study/include.php");
	require_once( $lib );
	$conn = connect();
	if (!$conn) {
		$e = oci_error();
		echo htmlentities($e['message'])." (ошибка коннекта к базе)";
	}
?>