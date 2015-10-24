<?
include("./../../../lib.php");
$param	= array();
$data	= array();

($c = ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb"))

         {
                $allowed_facids = GetClientAllFacids(); //array(0,3,5);
                $where = 'AND (FACID=' . implode(' OR FACID=', $allowed_facids) . ')';
                $curs = ora_do($cur, "select FACID, FAC, FACNAME from FACULTY where FACSTAND=1 $where ORDER BY FACID");
				 
foreach( $cur as $i=>$data )
{
	$facname[$i]['facname']	= $data['FACID'];
	$facname[$i]['facid']	= $data['FACID'];
}
echo '{rows:'.json_encode($facname).'}';
?>