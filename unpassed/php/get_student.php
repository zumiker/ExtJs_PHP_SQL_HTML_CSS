<?php
require_once("../include.php");
$groid = $_REQUEST['groid'];
$facid = $_REQUEST['facid'];
$facid = str_replace( ",", "','", $facid );
//echo $facid;
if($groid==null){
	$sql = "SELECT distinct cs.ID_CON as GROID
				FROM abi_spec s, abi_con_spec cs, ABI_CONGROUP c
				WHERE s.FACID=$facid
				AND c.GOD=(select TO_CHAR(sysdate, 'yyyy')  from dual)
				and cs.id_spec=s.spcid
				and cs.id_con=c.id_con
				ORDER BY GROID";
	$cur = execq( $sql );
	$sqlll=" con_id in (";
	foreach($cur as $k=>$row){
	if($k!=0)
	$sqlll.=", ";
		$sqlll.=$row['GROID'];
		

	}	
	$sqlll.=")";
}
else
	$sqlll="con_id='$groid'";	

$sql = "select initcap( fio_full ) as fio_full,
			fio,
			min( niz_b ) as niz_b,
			min( niz_c ) as niz_c,
			predmet, ball100 ,abi_number,con_id
		from abi_neproshol
		where $sqlll
		group by fio_full, fio, predmet, ball100, abi_number, con_id
		order by con_id, fio_full, predmet";
//echo $sql;


$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>