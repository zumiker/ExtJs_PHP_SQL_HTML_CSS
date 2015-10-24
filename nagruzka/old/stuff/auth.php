<? include_once ("../../RGURating.php"); ?>
<?
//Global check
//No pin code or much trials
$manid=GetClientManid();
$conn=DB_Connect();
$sql="SELECT CERTPINSHA,CERTPINTRY FROM CERTS WHERE MANID=$manid";
$res=ora_do($conn,$sql);
$certpintry=ora_getcolumn($res,1);
// Enough trials
if ($certpintry=="")
{
	echo '<center><font color=red>Ваш сертификат полностью отозван! Регистрируйтесь заново! Обращайтесь в лабораторию КИС.';
	exit();
}
if ($certpintry<=0) 
	{
	echo '<center><font color=red>Аккаунт заблокирован! Трижды неверно введен пин-код. Обращайтесь в лабораторию КИС.';
	exit();
 	}
$cps=ora_getcolumn($res,0);
// No pin code
if ($cps=="")
	{
		mt_srand(make_seed());
		$pin=mt_rand(1001,9999);
		$pinsha=sha1($pin);
		echo "<center><font color=red>Внимание, Вам выдан новый пин-код:<B>($pin)</b>. Запомните его, пожалуйста.";
		ora_do($conn,"UPDATE CERTS SET CERTPINSHA='$pinsha' WHERE MANID=$manid");
	}
ora_logoff($conn);
$res=0;
//////////////////////////////////////////////////////////////////
// We have already send pin
if (isset($_REQUEST['pin']))
{
$_SESSION['pinhash']=$_REQUEST['pin'];
if (PinCheck($_SESSION['pinhash']))
	{
	$req=$_SESSION['req'];
	echo "<script>location.href='$req';</script>";
	}
else
{
if ($pintry==3) $pintry='3 попытки';
if ($pintry==2) $pintry='2 попытки';
if ($pintry==1) $pintry='1 попытка';
if ($pintry==0) 
	{
	echo '<center><font color=red>Аккаунт заблокирован! Трижды неверно введен пин-код. Обращайтесь в лабораторию КИС.';
	exit();
 	}
echo "<center><font color=red>Пин-код неверен. У вас $pintry";
}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Система аутентификации</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="../style.css" rel="stylesheet" type="text/css">
<script src="../sha1.js"></script>
</head>
<body>
<div align="center"> 
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10" height="10" background="../../top_left_corner.png"></td>
      <td align="center" background="../../top_line.png"></td>
      <td width="10" height="10" background="../../top_right_corner.png"></td>
    </tr>
    <tr>
      <td background="../../left_line.png"></td>
      <td bgcolor="#FFFFFF"> <p align="center"><img src="../../gubkin.gif" width="74" height="72"></p>
        <p align="center"><font color="#FF0000" size="5"><img src="../password.gif" width="32" height="32" align="absmiddle"><font size="4">Введите свой пин код:</font></font></p>  
      <form action="auth.php" method="get" name="PassForm" target="_self" id="PassForm" onSubmit="this.pin.value=(hex_sha1(this.pin.value));">
         <center><input name="pin" type="password" id="Login2" size="4" maxlength="4" tabindex="1">
          <p align="center"><input type="submit" name="Submit" class="greenbtn " value="Ввести">
            <input name="Reset" type="reset" class="greenbtn" value="Отмена">
          </p>
        </form>
   
      </td>
      <td background="../../right_line.png">&nbsp;</td>
    </tr>
    <tr>
      <td width="10" height="10" background="../../bottom_left_corner.png"></td>
      <td background="../../bottom_line.png"></td>
      <td width="10" height="10" background="../../bottom_right_corner.png"></td>
    </tr>
  </table>
  