<?php
$nags=$_GET["nags"];
$manid=$_GET["manid"];
$room=$_GET["prim"];
$str=$_GET["str"];
$nag=split (",", $nags);
function cp1251_to_utf8($s){
           $c209 = chr(209); $c208 = chr(208); $c129 = chr(129);
           for($i=0; $i<strlen($s); $i++)    {
               $c=ord($s[$i]);
               if ($c>=192 and $c<=239) $t.=$c208.chr($c-48);
               elseif ($c>239) $t.=$c209.chr($c-112);
               elseif ($c==184) $t.=$c209.$c209;
               elseif ($c==168)    $t.=$c208.$c129;
               else $t.=$s[$i];
           }
           return $t;
       }

        function utf8_to_cp1251($s)
        {
            for ($c=0;$c<strlen($s);$c++)
            {
               $i=ord($s[$c]);
               if ($i<=127) $out.=$s[$c];
                   if ($byte2){
                       $new_c2=($c1&3)*64+($i&63);
                       $new_c1=($c1>>2)&5;
                       $new_i=$new_c1*256+$new_c2;
                   if ($new_i==1025){
                       $out_i=168;
                   } else {
                       if ($new_i==1105){
                           $out_i=184;
                       } else {
                           $out_i=$new_i-848;
                       }
                   }
                   $out.=chr($out_i);
                   $byte2=false;
                   }
               if (($i>>5)==6) {
                   $c1=$i;
                   $byte2=true;
               }
            }
            return $out;
        }

$prim=utf8_to_cp1251($prim);
echo "<FONT FACE='Garamond' SIZE='2' color='red'>";
	for($i=0;$i<sizeof($nag);$i++)
	{
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
		
			$sql="UPDATE NAGRUZKA SET PRIM='$prim'WHERE NAGID='$nag[$i]'";
				$cur=ora_do($conn,$sql);
				$lec=ora_getcolumn($cur,0);
				
			
		}
		
	ora_logoff($conn);
echo "Примечание сохранено.";	
//echo "<input type='button' onclick='ShowPrepods($str)' value='Обновить'>";

?>