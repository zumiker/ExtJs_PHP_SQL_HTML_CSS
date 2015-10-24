<?php
require('/var/www/lib.php');//require("./../../../../../lib.php");
//include( "./../../lib_debug.php" );
//$groid = $_REQUEST['groid'];
$cnt = 0;

$arr	= explode('_',$_REQUEST['groid']);
$groid	= $arr[0];
$difid	= $arr[1];
$date = date('d.m.Y');
$week = GetWeek();
$sql1="select weeid 
		from weekofcontrol 
		where currentgod = get_educ_god 
			and semestr like get_semestr_real || '%' 
			and weestart < to_date('$date','dd.mm.yyyy') 
		order by weenomer desc";
//logstring( $sql7 );
$cur1	= execq( $sql1 );
$weeid	= $cur1[0]['WEEID'];

$sql2 = "select fio_full, tstid, ";		
	
	$sql3 = "select distinct ( couname || decode(treid,4,' (ÊÏ)',5,' (ÊÐ)','') ) as predmet, 
				n.couid || decode(treid,4,' (ÊÏ)',5,' (ÊÐ)','') as couid , 
                sum( max_ball ) as max_ball
			from v_nagruzka_fact_kaf n, course c, v_student_works w 
			where n.groid = '$groid' 
                and n.groid = w.groid(+) 
                and n.vblid = w.vblid(+) 
                and week(+) <= '$week' 
				and ( n.difid = '$difid' or n.difid = 0 )
				and c.couid = n.couid 
            group by couname, treid, n.couid 
			order by predmet";
	//logstring($sql3);
	//$sql3 = EncodeStr($sql3);
	$cur3 = execq( $sql3 );
	//logstring($sql3);
	foreach( $cur3 as $i=>$data )
	{	
		
		$cnt++;
		//logstring($cnt);
		$buffCi[$i]		= DecodeStr($data['COUID']);
		//$max_ball[$i]	= $data['MAX_BALL'];
		if($i!=0) 
			$sql2 .=",";
		//$buffCi = $data['COUID'];//DecodeStr($data['COUID']);
		$sql2 .=" SUM(CASE to_char(couid) WHEN '$buffCi[$i]' THEN nvl (ball, 0) END) as \"$buffCi[$i]\"";
	}	
	
$sql2 .=", propusk_all, propusk_uv
		from(select fio_full, tstid, s.groid, couname||k as predmet, d.couid||k as couid, ball, propusk_all, propusk_uv 
			from v_spi_student s,course d,
				(SELECT V.VBLID,COUID,B.student_id,BALL,decode(treid_I,4,' (ÊÏ)',5,' (ÊÐ)','') K, groid, 
					decode(propusk_all,0,'',propusk_all) propusk_all, 
					decode(propusk_uv,0,'',propusk_uv) propusk_uv 
				FROM  vblank V, 
					(select student_id, sb.vblid,sum(nvl(ball,0)) BALL
					from v_student_balls sb
					group by student_id, sb.vblid) B, contpropusk j 
				WHERE B.VBLID(+) = V.VBLID
					AND YEAR_GROCODE = Get_Educ_God_Ses 
					AND SPRING_AUTUMN = Get_Semestr_Real
					and B.student_id = j.student_id(+) 
					and j.weeid(+) = '$weeid' ) v
			where s.student_id = v.student_id(+) 
				and s.groid = '$groid'
				and ( s.difid = '$difid' or nvl(s.difid,0) = 0 )
				and d.couid(+) = v.couid
				and v.groid(+) = s.groid
			order by predmet)
		group by tstid, fio_full, propusk_all, propusk_uv 
		order by tstid, fio_full";
//$sql2 = EncodeStr($sql2);
$cur2 = execq( $sql2 );
logstring($sql2);
foreach( $cur2 as $k=>$data )
{
	$list[$k]['fio_full']		= 	$data['FIO_FULL'];
	$list[$k]['propusk_all']	=   $data['PROPUSK_ALL'];
	$list[$k]['propusk_uv']		=   $data['PROPUSK_UV'];
	for($j=0; $j<$cnt; $j++)
	{
		$cn = $j + 1;
		$list[$k]['p'.$cn]	= DecodeStr( $data["$buffCi[$j]"] ); //= $data['p'.$j];
		//logstring($data['p'.$j]);
	}
	
}
//logstring($cnt);
//logstring(print_r($list,true));
//console.log($list[$k]['p'.$j]);
echo '{rows:'.json_encode($list).'}';

?>