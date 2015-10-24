<?php //include_once ("../../RGURating.php"); ?>
<?php include_once ("test.php"); ?>
<?php

function print_expandable_node($name, $id, $title, $alt)
{
?>
<table border=0 cellpadding='1' cellspacing=1>
<tr>
<td width='10'>
<a id=<?php echo $id; ?> href="javascript:Toggle('<?php echo $name; ?>');">
<img src='node_plus.png' width='9' height='9' hspace='0' vspace='0' border='0' ></a>
</td>
<td width='150'>
<a id=<?php echo $id; ?> href="javascript:Toggle('<?php echo $name; ?>'); " title="<?php echo $alt; ?>"><b>
<?php echo $title; ?></b>
</td>
</a></table>
<?
}

function start_div($div_id)
{
?>
        <div id="<?php echo $div_id; ?>" style="display: none; margin-left: 10pt;">
<?
}

function end_div()
{
        echo "</div>";
}
function print_groups($ora_handle, $facid)
{
        $sql = "select DIVID,DIVNAME,DIVABBREVIATE from DIVISION where DTYPE='K' and FACID=$facid order by DIVABBREVIATE";

        $curs = ora_do($ora_handle, $sql);
        if ($curs == null)
        {
                // echo "no groups"; in the speciality
                return 0;
        }
        do
        {
                $divid = ora_getcolumn($curs, 0);
                $divname = ucfirst(ora_getcolumn($curs, 2));
                echo "<a href=\"master.php?action=show_div&divid=$divid\" target=master>$divname</a><br>";
        }
        while (ora_fetch($curs));
}

function print_spec($ora_handle, $facid)
{
        print_groups($ora_handle, $facid);
}

?>

<html>

<head>
        <title>Tree Menu</title>
        <link rel='stylesheet' href='tree.css'>
        <script language="javascript" src="tree.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border=0 cellpadding='10' cellspacing=0><tr><td>

<?php
if ($c = ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb"))
{
        $sql  = "select FAC,FACID from FACULTY where (FACSTAND=1 or FACID=8) and FACID<>11";
        $curs = ora_do($c, $sql);

        do
        {
                $fac = ora_getcolumn($curs, 0);
                $facid = ora_getcolumn($curs, 1);
                print_expandable_node("f$facid", "xf$facid", $fac, ora_getcolumn($curs, 2));
                start_div("f$facid");

                print_spec($c, $facid);

                end_div();
        }
        while (ora_fetch($curs));

        ora_logoff($c);


}
else
{
        echo "Oracle Connect Error " . ora_error();
}
?>

</td></tr></table>
</body>
</html>