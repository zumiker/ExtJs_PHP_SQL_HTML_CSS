<?
include('include.php');     
/*
$_SESSION['manid']='42139';
$manid=$_SESSION['manid'];
*/

$_SESSION['karta_manid']= GetClientManid();
$_SESSION['uvp_divid']	= GetClientDekanatsDivid();
$_SESSION['divid']		= GetClientKafedrasDivid();//несколько


?>
<html>
<base href="./../..">
	<head>
	
		<link rel="icon" type="image/vnd.microsoft.icon" href="gubkin.ico">
		<title>Защищенная система </title>

		<link rel="stylesheet" type="text/css" id="theme" href="../ext-3.3.0/resources/css/ext-all1.css" />
		<link rel="stylesheet" type="text/css" href="../ext-3.4.0/resources/css/xtheme-blue.css" />
		<link rel="stylesheet" type="text/css" href="./Ext.ux.tot2ivn.VrTabPanel.css" />
		<link rel="stylesheet" type="text/css" href="./tabs-example1.css" />
		

		<script type="text/javascript" src="../ext-3.4.0/adapter/ext/ext-base-debug.js"></script>
		<script type="text/javascript" src="../ext-3.4.0/ext-all-debug-w-comments.js"></script>
		<script type="text/javascript" src="./Ext.ux.tot2ivn.VrTabPanel.js"></script>
		<script type="text/javascript" src="../ext-3.4.0/examples/shared/extjs/App.js"></script>
		<script type="text/javascript" src="../ext-3.4.0/examples/ux/CheckColumn.js"></script>
		<script type="text/javascript" src="./ext-lang-ru.js"></script>
		
<script>

Ext.onReady(function(){
var sec=new Ext.App();

//ppv
<?echo file_get_contents('js/ppv2/stores/ppv_store.js');?>
<?echo file_get_contents('js/ppv2/grids/ppv_grid.js');?>


<?echo file_get_contents('js/combobox.js');?>
<?echo file_get_contents('js/resize.js');?>
<?echo file_get_contents('js/stores/arhiv.js');?>
<?echo file_get_contents('js/stores/kurs.js');?>
<?echo file_get_contents('js/stores/grocode.js');?>


<?// Задача "3. Диплом"?>
<?echo file_get_contents('js/diplom/stores/diplom_grocode.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_list.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_mark.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_student.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_vypusk_kafedra.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_kafedra_rukovoditel.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_nauch_rukovoditel.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_store.js');?>

<?echo file_get_contents('js/ege_result/stores/ege_result_facultet.js');?>
<?echo file_get_contents('js/ege_result/stores/ege_result_grocode.js');?>
<?echo file_get_contents('js/ege_result/stores/ege_result_store.js');?>
<?echo file_get_contents('js/ege_result/columns/ege_resultColumnModel.js');?>
<?echo file_get_contents('js/ege_result/grids/ege_result_grid.js');?>



var tabs2 = new Ext.ux.tot2ivn.VrTabPanel({
        renderTo: 'tabs2',
        activeTab: 0,
        width:window.innerWidth-40,
		id:'tab_panel',
        height:window.innerHeight-150,
        //plain:true,
		//minWidth:200,
		tabWidth:350,
		frame:true,
		border:1,
		//bodyStyle: 'padding: 10px',
        defaults:{autoScroll: true},
		//size:20,
		//tabCls:{font-weight:'underlined'},
        items:[
<?
	echo "		{
                title: '<font size=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Предмет по выбору</font>',
				id:'ppvs',
				name:'ppvs',
//				defaults:{hidden: false},
				items: [
					".file_get_contents('js/ppv2/toolbar.js').",
					".file_get_contents('js/ppv2/forms/ppv.js')."
				]},
			{
                title: '<font size=3>4. &nbsp;&nbsp;&nbsp;Диплом</font>',
				id:'diploms',
				name:'diploms',
//				defaults:{hidden: false},
				items: [
					".file_get_contents('js/diplom/toolbar.js').",
					".file_get_contents('js/diplom/forms/diplom.js')."
				]
            },
            {
                title: '<font size=3>4. &nbsp;&nbsp;&nbsp;Диплом</font>',
				id:'diploms2',
				name:'diploms2',
//				defaults:{hidden: false},
				items: [
					".file_get_contents('js/diplom/toolbar.js').",
					".file_get_contents('js/diplom/forms/diplom.js')."
				]
            }
            "
?>
        ],
		listeners:{
			tabchange: function(panel, tab){
				//alert(tab.items.length);
				var tabitem=tab.items.item(0).items;
				for(var i=0; i<tabitem.length; i++)
				{
				//alert(i);
					tabitem.item(i).reset();
					}
				
			}
		}
    });
});
</script>
</head>
<body>
<TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD width="51"><IMG height=50 alt="" 
            src="./../../PeekLime_01.gif" 
            ></TD>
          <TD width="466" align=left vAlign=center><SPAN class=title>РГУ нефти и газа имени И.М.Губкина. Защищенная система</SPAN></TR></TBODY></TABLE>
<div id='tabs2'></div>
<iframe id="buffer" hidden=true style="display:none;"></iframe>
</body>