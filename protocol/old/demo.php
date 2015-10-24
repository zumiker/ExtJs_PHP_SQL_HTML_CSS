<?php
//session_start();
header( "Pragma: no-cache" );
header( 'Content-type: application/pdf' );

require_once( "fpdf/fpdf.php" );
define('FPDF_FONTPATH','fpdf/font/');
//require_once("lib.php");
include("db_connect.php");

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddFont('TimesNewRomanPSMT','','times.php');
$pdf->AddFont('TimesNewRomanPS-BoldMT','','times_b.php');
$pdf->AddFont('ArialMT','','arial.php');
$pdf->AddFont('Arial-BoldMT','','arial_bold.php');
$pdf->AddFont('ComicSansMS','','comic.php');
$pdf->SetFont( 'TimesNewRomanPSMT', '', 14 );
$pdf->AddPage();


global $oraconn;//Global oracle connection identifier

function EncodeStr($var)
{
    $to = "UTF-8";
    $from = "CP1251";
    return mb_convert_encoding($var, $to, $from);
}

function DecodeStr($var)
{
    $to = "CP1251";
    $from = "UTF-8";
    return mb_convert_encoding($var, $to, $from);
}

function StringEncoding($var)
{
    return DecodeStr($var);
    //return $var;
}



function execq($query)
{
	global $ora_login, $ora_password, $ora_db;
    if (empty($query))
        return;

    $conn = oci_pconnect($ora_login, $ora_password, $ora_db, 'AL32UTF8');
    if (!$conn)
    {
        $error = oci_error();
        printf("Не могу подключиться к базе", print_r($error));
        die();
    }
	
   $result = oci_parse($conn, $query);
   oci_execute($result);

   $ncols = oci_num_fields($result);
   $iRow = 0;
   while ($row = oci_fetch_array($result, OCI_BOTH))
   {
      for ($iCol=1; $iCol<=$ncols; $iCol++)
      {
         $FieldName = oci_field_name($result, $iCol);    
         $FieldType  = strtoupper(oci_field_type($result, $iCol));
         $FieldSize  = oci_field_size($result, $iCol);
         $data=@$row[@$iCol-1];
         switch ($FieldType)
         {             
             case 'DATE':       $data = date("d.m.Y", strtotime(@$data));
                                break;             
             case 'CHAR':
             case 'VARCHAR':
             case 'VARCHAR2':   $data = StringEncoding(@$data);
                                break;  
			case 'BLOB' :
         }
         $results[$iRow][$FieldName] = $data;

      }
      $iRow = $iRow + 1;
   }
   oci_free_statement($result);

   return $results;
}

/////////////////////////////
//$sql_1 = "begin rollback; end;";
//$arr = execq($sql_1);

// заголовок
$sql_2 = "SELECT distinct substr(TEXT,1,instr(TEXT, ',')-1) as ZAG from NAGR_CHECK_SEMPLAN";
$zag = execq($sql_2);

foreach( $zag as $i=>$data )
 {
	 $list[$i]['zag']	= $data['ZAG'];
	 //$cnt ++;
 }
 
for ( $i = 0; $i < sizeof($zag); $i++)
{
	$pdf->Write(7, $list[$i]['zag']);	
	$pdf->Ln();
}	

$pdf->SetFont( 'TimesNewRomanPSMT', '', 12 );
$pdf->Ln();

// данные
$sql_1 = "SELECT substr(TEXT,instr(TEXT, ',')+2) as TXT from NAGR_CHECK_SEMPLAN order by substr(TEXT,instr(TEXT, ',')+2)";
$arr = execq($sql_1);

foreach( $arr as $i=>$data )
 {
	 $list[$i]['text']	= $data['TXT'];
	 //$cnt ++;
 }

for ( $i = 0; $i < sizeof($arr); $i++)
{
	$pdf->Write(5, ($i+1).'.) '.$list[$i]['text']);	
	$pdf->Ln();
}	

$pdf->Output('demo.pdf','D');



?>