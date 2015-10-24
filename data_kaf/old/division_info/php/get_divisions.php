<?php
	include('../lib.php');
	$sql="select f.facname,lower(d.kaf) divname,count(v.manid) count,d.divid 
			from v_spi_fac f,v_spi_kafedr d,v_spi_prepod v 
			where f.facid < 12
				and f.facid = d.facid 
				and d.divid = v.divid 
				and v.dol_id != 6 
				and v.status = 0
			group by f.facname,d.kaf,d.divid 
			order by f.facname,d.kaf";
	$cur=execq($sql);
	echo '{rows:'.json_encode($cur).'}';  
?>