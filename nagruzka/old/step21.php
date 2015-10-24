<?php
//get the q parameter from URL
 $manid=$_GET["manid"];
 $kafedra=$_GET["kafedra"];
 $god=$_GET["god"];
 $semestr=$_GET["semestr"];


?>
</br>
<table>
<tr>
	<td colspan=1 align='center' width="50%">
	
	</td>
	<td colspan=1 align='center'>
	<?php echo "<input type='button' value='Планируемое' onClick=\"ShowPrepod($manid,$kafedra,$god,'$semestr')\">";?>
	<?php echo "<input type='button' value='Фактическое' onClick=\"ShowPrepodF($manid,$kafedra,$god,'$semestr')\">";?>
	</td>
</tr>
</table>
	
<div id="text3"> </div>