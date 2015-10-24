 <? session_start(); ?>
<html>
<head>
<title>Экзаменационный лист абитуриента</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<B><FONT FACE="Garamond" SIZE=6><P ALIGN="CENTER">Экзаменационный лист абитуриента<FONT FACE="Garamond" SIZE=5></B>

<body BACKGROUND="../wp3.gif">
<form action="ind.php" method="post" target="_self">
<input type="hidden" name="task"></input>
  <?

if (isset($_REQUEST['fac'])) $_SESSION['facid']=$_REQUEST['fac'];
if (isset($_REQUEST['group'])) $_SESSION['gro']=$_REQUEST['group'];
if (isset($_REQUEST['spec'])) $_SESSION['spc']=$_REQUEST['spec'];
/*
if ($_REQUEST['task']=='chfac')
					{
					unset($_SESSION['gro']);
					}*/
if (isset($_REQUEST['student'])) $_SESSION['stu']=$_REQUEST['student'];
if (isset($_REQUEST['list'])) $_SESSION['lst']=$_REQUEST['list'];
if (isset($_REQUEST['medal'])) $_SESSION['medal']=$_REQUEST['medal'];
if (isset($_REQUEST['bud'])) $_SESSION['bud']=$_REQUEST['bud'];
if (isset($_REQUEST['cel'])) $_SESSION['cel']=$_REQUEST['cel'];
if (isset($_REQUEST['com'])) $_SESSION['com']=$_REQUEST['com'];
if (isset($_REQUEST['start'])) $_SESSION['start']=$_REQUEST['start'];
if (isset($_REQUEST['end'])) $_SESSION['end']=$_REQUEST['end'];
if (isset($_REQUEST['Submit'])) echo "<script>location.href='in_pdf.php';</script>";
?>



<table border="1" align="center">
  <tr> 
    <td><B>Факультет:</B></td>
    <td><SELECT NAME="fac" onChange="task.value='chfac';form.submit();">
        <?

 $conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
 $cur=ora_do($conn,"SELECT FACID,FACNAME from ABI_FAC ORDER BY FACNAME");
 for ($i=0;$i<ora_numrows($cur);$i++)
 {
 echo "<OPTION VALUE='";
 echo ora_getcolumn($cur,0);
 if (!isset($_SESSION['facid'])) $_SESSION['facid']=ora_getcolumn($cur,0);
 if (ora_getcolumn($cur,0)==$_SESSION['facid']) echo "' selected >";
 	else echo "'>";
 echo ora_getcolumn($cur,1);
 ora_fetch($cur);
 }
 $cur=0;
 ?>
      </SELECT></td>
  </tr>
  <tr> 
    <td><strong>Конкурсная группа:</strong></td>
    <td><select name="group" id="group" onChange="form.submit();">      
	<?
	$fac=$_SESSION['facid'];
	$sql="SELECT ID_CON,CONGROUP,FACID FROM ABI_CONGROUP WHERE FACID=$fac ORDER BY ID_CON";
	$cur=ora_do($conn,$sql);
	 for ($i=0;$i<ora_numrows($cur);$i++)
 {
 echo "<OPTION VALUE='";
 echo ora_getcolumn($cur,0);
if (!isset($_SESSION['gro'])) $_SESSION['gro']=ora_getcolumn($cur,0);
if (ora_getcolumn($cur,0)==$_SESSION['gro']) echo "' selected >";
 	else echo "'>";
 echo ora_getcolumn($cur,1);
 ora_fetch($cur);
 }
 $cur=0;
	?>
      </select></td>
  </tr>
  <tr>
  <td><B>Специальность:</B></td>
  <td> <select name="spec" id="spec" onChange="form.submit();">
  <?
	$fac=$_SESSION['facid'];
    $group=$_SESSION['gro'];
    
	$sql1="SELECT ID_CON, ID_SPEC FROM ABI_CON_SPEC WHERE  ID_CON='$group'";
	$cur1=ora_do($conn,$sql1);
	
	 for ($i=0;$i<ora_numrows($cur1);$i++)
 {
 	$spcid=ora_getcolumn($cur1,1);
 	$sql2="SELECT SPCNAME, SPCID FROM ABI_SPEC WHERE  SPCID='$spcid'";
	$cur2=ora_do($conn,$sql2);
	
		 for ($g=0;$g<ora_numrows($cur2);$g++)
 		{
 	
 echo "<OPTION VALUE='";
 echo ora_getcolumn($cur2,1);
 if (!isset($_SESSION['spc'])) $_SESSION['spc']=ora_getcolumn($cur2,1);
 if (ora_getcolumn($cur2,1)==$_SESSION['spc']) echo "' selected >";
 	else echo "'>";
 echo ora_getcolumn($cur2,0);
 ora_fetch($cur2);
 		}
 ora_fetch($cur1);
 } 
  $cur=0;
?>
  
  </select> </td>
  </tr>
  <tr>
  <td><B>Абитуриент:</B></td>
  <td> <select name="student">
  <?
	$fac=$_SESSION['facid'];
    $group=$_SESSION['gro'];
    $spc=$_SESSION['spc'];
   
	$sql="SELECT ABI_NUMBER, LASTNAME, SPECID FROM ABITURIENT WHERE  SPECID='$spc' ORDER BY LASTNAME";
//if (!isset($_SESSION['manid'])) $_SESSION['manid']=ora_getcolumn($cur,0);
	$cur=ora_do($conn,$sql);
	 for ($i=0;$i<ora_numrows($cur);$i++)
 {
 echo "<OPTION VALUE='";
 echo ora_getcolumn($cur,0);
 if (!isset($_SESSION['gro'])) $_SESSION['stu']=ora_getcolumn($cur,0);
 if (ora_getcolumn($cur,0)==$_SESSION['stu']) echo "' selected >";
 	else echo "'>";
 echo ora_getcolumn($cur,1);
 ora_fetch($cur);
 }
	 ?>
  
  </select> </td>
  </tr>
</table><br><br>
<table><tr><td>
<input type="radio" name="list" value="0" checked>Абитуриент<br></td><td ><input type="checkbox" name="bud">Бюджет</td>
<td rowspan=3><input type="radio" name="medal" value="1">Только медалисты<br><input type="radio" name="medal" value="2">Без медалистов</td></tr>
<tr><td><input type="radio" name="list" value="1">Специальность</td><td ><input type="checkbox" name="cel">Целевой</td></tr>
<tr><td><input type="radio" name="list" value="2">Конкурсная группа</td><td><input type="checkbox" name="com">Коммерческий</td></tr>
</table>

<table><tr><td>
<tr><td>За промежуток c:</td>
	<td><input type="text" name="start"></td><td>по:</td>
	<td><input type="text" name="end"></td></tr>
</table>

<P> 
  <center><input type="submit" name="Submit" value="Получить отчёт" class="bluebutton">
 <!-- <input type="submit" name="bud" value="(Бюд.)" class="bluebutton">
  <input type="submit" name="cel" value="(Цел.)" class="bluebutton">
  <input type="submit" name="kom" value="(Ком.)" class="bluebutton">-->
  </center>
  
</form>
<? 
echo $_SESSION['facid']."<br>";
echo $_SESSION['gro']."<br>";
echo $_SESSION['spc']."<br>";
echo $_SESSION['stu']."<br>";
 
 include "../visit.php" ?>
</body>
</html>
