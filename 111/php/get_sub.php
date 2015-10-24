<?
require_once("../include.php");
$groid = $_REQUEST['groid'];

$sql = "select distinct c.COUID,
            substr( lower( c.COUNAME ), 1, 50 )
            || ' (' || 
                case
                    when v.treid_z is not null and v.treid_i is not null
                        then v.trename_z || ' ' || v.trename_i
                    when v.treid_i is null
                        then v.trename_z
                    else v.trename_i
                end 
            || ')' || decode( nvl( v.difid, 0 ), 0, '', ' (' || v.difcode || ')' ) as COUNAME,
            v.VBLID
        from vblank v
        inner join course c
            on v.couid = c.couid
        inner join marker m
            on v.vblid = m.vblid
        inner join v_spi_student s
            on m.student_id = s.student_id
        where v.groid = '$groid'
            and v.studyid = ( select get_studyid from dual )
            and ( v.vibor = 1 or v.treid_i in (4,5))
        order by couname";
$cur = execq( $sql );
echo '{rows:'.json_encode($cur).'}';
?>