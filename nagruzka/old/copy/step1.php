<?php
//get the q parameter from URL
$kafedra=$_GET["kafedra"];
$god=$_GET["god"];
$semestr=$_GET["semestr"];
//echo "<font color='blue'>Debug info: $semestr $god $kafedra <br></font>";

?>
<table>
<tr><td width='300'>
<B>Выберите курс:
</td><td>
<select name="kurs" id="kurs" onchange="ShowPredmet(this.value)">
<option value="0">--выбрать--</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td></tr>
</table>
<div id="text2"> </div>