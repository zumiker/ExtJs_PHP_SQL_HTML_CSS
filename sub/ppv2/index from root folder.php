<?
session_start();
include("./../lib.php");
/*
$_SESSION['manid']='42139';
$manid=$_SESSION['manid'];
*/

$_SESSION['karta_manid']= GetClientManid();
$_SESSION['uvp_divid']	= GetClientDekanatsDivid();
$_SESSION['divid']		= GetClientKafedrasDivid();//несколько

/*
	$divid	= GetClientDekanatsDivid();
	$divkaf	= GetClientKafedrasDivid();
	for ( $k = 0; $k < count( $divid ); $k++ )
		$facid[] = GetFacidForDivid( $divid[$k] );	
	$kurs = $_REQUEST['kurs'];
	$sql = "SELECT DISTINCT GROCODE,GROID FROM R_PREDMET_KAFEDRA_SES WHERE ("; 
		for ( $k = 0; $k < count( $facid ); $k++ )
		{
			if ( k != ( count( $facid ) - 2 ) )
				$sql = $sql."FACID=$facid[$k] OR ";
			else if ( count( $divkaf ) > 0 )
				$sql = $sql."FACID=$facid[$k] OR ";
			else
				$sql = $sql."FACID=$facid[$k] ";
		}
		for ( $k = 0; $k < count( $divkaf ); $k++ )
		{
			if ( k != ( count( $divkaf ) - 1 ) )
				$sql = $sql."DIVID=$divkaf[$k] OR ";
			else
				$sql = $sql."DIVID=$divkaf[$k] ";
		}
	$sql = $sql.") AND KURS=$kurs ORDER BY GROCODE";
*/
?>
<html>
	<head>
	
		<link rel="icon" type="image/vnd.microsoft.icon" href="gubkin.ico">
		<title>Защищенная система</title>

		<link rel="stylesheet" type="text/css" id="theme" href="../ext-3.3.0/resources/css/ext-all1.css" />
		<!--link rel="stylesheet" type="text/css" href="../ext-3.4.0/resources/css/xtheme-blue.css" /-->
		<link rel="stylesheet" type="text/css" href="../ext-3.4.0/resources/css/xtheme-purple.css" />
		<link rel="stylesheet" type="text/css" href="Ext.ux.tot2ivn.VrTabPanel.css" />
		<link rel="stylesheet" type="text/css" href="tabs-example1.css" />

		<script type="text/javascript" src="../ext-3.4.0/adapter/ext/ext-base.js"></script>
		<script type="text/javascript" src="../ext-3.4.0/ext-all.js"></script>
		<script type="text/javascript" src="Ext.ux.tot2ivn.VrTabPanel.js"></script>
		<script type="text/javascript" src="../ext-3.4.0/examples/shared/extjs/App.js"></script>
		<script type="text/javascript" src="ext-lang-ru.js"></script>
		
<script>

Ext.onReady(function(){
var sec=new Ext.App();
<?echo file_get_contents('js/combobox.js');?>
<?echo file_get_contents('js/resize.js');?>
<?echo file_get_contents('js/stores/arhiv.js');?>
<?echo file_get_contents('js/stores/kurs.js');?>
<?echo file_get_contents('js/stores/grocode.js');?>

<?// Задача "1. Составление плана занятий"?>
<?echo file_get_contents('js/prepod_semestr_raboty/stores/prepod_semestr_raboty_predmet.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/stores/prepod_semestr_raboty_tip.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/stores/prepod_semestr_raboty_max_rabot.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/stores/prepod_semestr_raboty_store.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/stores/prepod_semestr_raboty_store2.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/columns/prepod_semestr_rabotyColumnModel.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/columns/prepod_semestr_rabotyColumnModel2.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/grids/prepod_semestr_raboty_grid.js');?>
<?echo file_get_contents('js/prepod_semestr_raboty/grids/prepod_semestr_raboty_grid2.js');?>

<?// Задача "2. Ввод результатов защит работ"?>
<?echo file_get_contents('js/prepod_insert_balls/stores/prepod_insert_balls_predmet.js');?>
<?echo file_get_contents('js/prepod_insert_balls/stores/prepod_insert_balls_store.js');?>
<?echo file_get_contents('js/prepod_insert_balls/columns/prepod_insert_ballsColumnModel.js');?>
<?echo file_get_contents('js/prepod_insert_balls/grids/prepod_insert_balls_grid.js');?>

<?// Задача "Пропуски занятий"?>
<?//echo file_get_contents('js/control_week/forms/propuski.js');?>
<?echo file_get_contents('js/control_week/columns/propuskiColumnModel.js');?>
<?echo file_get_contents('js/control_week/stores/propuski_store.js');?>
<?echo file_get_contents('js/control_week/grids/propuski_grid.js');?>

<?// Задача "2. Сессия"?>
<?echo file_get_contents('js/session/stores/session_predmet.js');?>
<?echo file_get_contents('js/session/stores/session_tmarker.js');?>
<?echo file_get_contents('js/session/stores/session_store.js');?>
<?echo file_get_contents('js/session/columns/sessionColumnModel.js');?>
<?echo file_get_contents('js/session/grids/session_grid.js');?>

<?// Задача "3. Диплом"?>
<?echo file_get_contents('js/diplom/stores/diplom_grocode.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_list.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_mark.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_student.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_vypusk_kafedra.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_kafedra_rukovoditel.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_nauch_rukovoditel.js');?>
<?echo file_get_contents('js/diplom/stores/diplom_store.js');?>
<?//echo file_get_contents('js/diplom/columns/diplomColumnModel.js');?>
<?//echo file_get_contents('js/diplom/grids/diplom_grid.js');?>

<?// Задача "Предмет по выбору"?>
<?/*echo file_get_contents('js/ppv/stores/ppv_facultet.js');?>
<?echo file_get_contents('js/ppv/stores/ppv_grocode.js');?>
<?echo file_get_contents('js/ppv/stores/ppv_store.js');?>
<?echo file_get_contents('js/ppv/columns/ppvColumnModel.js');?>
<?echo file_get_contents('js/ppv/grids/ppv_grid.js');*/?>

<?// Задача "Контрольная неделя"?>
<?echo file_get_contents('js/control_week/stores/control_week.js');?>
<?echo file_get_contents('js/control_week/stores/cw_task.js');?>

<?// Задача "Результаты ЕГЭ"?>
<?echo file_get_contents('js/ege_result/stores/ege_result_facultet.js');?>
<?echo file_get_contents('js/ege_result/stores/ege_result_grocode.js');?>
<?echo file_get_contents('js/ege_result/stores/ege_result_store.js');?>
<?echo file_get_contents('js/ege_result/columns/ege_resultColumnModel.js');?>
<?echo file_get_contents('js/ege_result/grids/ege_result_grid.js');?>

<?// Задача "Ввод оценок за прошлые годы"?>
<?echo file_get_contents('js/prosh/stores/prosh_student.js');?>
<?echo file_get_contents('js/prosh/stores/prosh_semestr.js');?>
<?echo file_get_contents('js/prosh/stores/prosh_store.js');?>
<?echo file_get_contents('js/prosh/columns/proshColumnModel.js');?>
<?echo file_get_contents('js/prosh/grids/prosh_grid.js');?>

<?// Задача "Работа с оценками за все семестры"?>
<?echo file_get_contents('js/delete/stores/delete_student.js');?>
<?echo file_get_contents('js/delete/stores/delete_semestr.js');?>
<?echo file_get_contents('js/delete/stores/delete_store.js');?>
<?//echo file_get_contents('js/delete/columns/deleteColumnModel.js');?>
<?//echo file_get_contents('js/delete/grids/delete_grid.js');?>
//var oldvalue;
<?//Задача "15. Темы курсовых работ"?>
<?echo file_get_contents('js/theme_of_cours/stores/theme_of_cours_facultet.js');?>
<?echo file_get_contents('js/theme_of_cours/stores/theme_of_cours_grocode.js');?>
<?echo file_get_contents('js/theme_of_cours/stores/theme_of_cours_students.js');?>
<?echo file_get_contents('js/theme_of_cours/stores/theme_of_cours_store.js');?>
<?echo file_get_contents('js/theme_of_cours/stores/theme_of_cours_packet.js');?>
<?echo file_get_contents('js/theme_of_cours/stores/theme_of_cours_predmet.js');?>

<?echo file_get_contents('js/theme_of_cours/columns/theme_of_coursColumnModel.js');?>
<?echo file_get_contents('js/theme_of_cours/columns/theme_of_coursColumnModel_packet.js');?>

<?echo file_get_contents('js/theme_of_cours/grids/theme_of_cours_grid.js');?>
<?echo file_get_contents('js/theme_of_cours/grids/theme_of_cours_packet_grid.js');?>

<?//Задача "16. Справочник направлений и специальностей"?>
<?echo file_get_contents('js/spravochnik_naprav/stores/spravochnik_naprav_facultet.js');?>
<?echo file_get_contents('js/spravochnik_naprav/stores/spravochnik_naprav_form.js');?>

//предмет по выбору
<?echo file_get_contents('js/ppv2/stores/ppv_store.js');?>
<?echo file_get_contents('js/ppv2/grids/ppv_grid.js');?>

<?/*//Задача "17. Сотрудники"?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_store.js');?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_division.js');?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_dolg.js');?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_status.js');?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_stavka.js');?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_stepen.js');?>
<?echo file_get_contents('js/sotrudniki/stores/sotrudniki_zvanie.js');?>

<?echo file_get_contents('js/sotrudniki/columns/sotrudniki_ColumnModel.js');?>

<?echo file_get_contents('js/sotrudniki/grids/sotrudniki_grid.js');?>
<?echo file_get_contents('js/sotrudniki/forms/sotrudniki_editform.js');*/?>


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
	echo "	{
				title: '<font size=3>1. &nbsp;&nbsp;&nbsp;Составление плана занятий</font>',
				id:'prepod_semestr_rabotys',
				name:'prepod_semestr_rabotys',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/prepod_semestr_raboty/toolbar.js').",
					".file_get_contents('js/prepod_semestr_raboty/forms/prepod_semestr_raboty.js')."
				]
			},
			{
				title: '<font size=3>2. &nbsp;&nbsp;&nbsp;Ввод результатов защит работ</font>',
				id:'prepod_insert_ballss',
				name:'prepod_insert_ballss',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/prepod_insert_balls/toolbar.js').",
					".file_get_contents('js/prepod_insert_balls/forms/prepod_insert_balls.js')."
				]
			},
			
			
			{
                title: '<font size=3>3. &nbsp;&nbsp;&nbsp;Сессия</font>',
				id:'sessions',
				name:'sessions',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/session/toolbar.js').",
					".file_get_contents('js/session/forms/session.js')."
				]
            },
			{
                title: '<font size=3>4. &nbsp;&nbsp;&nbsp;Диплом</font>',
				id:'diploms',
				name:'diploms',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/diplom/toolbar.js').",
					".file_get_contents('js/diplom/forms/diplom.js')."
				]
            },
			{
                title: '<font size=3>13. &nbsp;Ввод оценок за прошлые годы</font>',
				id:'proshs',
				name:'proshs',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/prosh/toolbar.js').",
					".file_get_contents('js/prosh/forms/prosh.js')."
				]
            },
			{
                title: '<font size=3>14. &nbsp;Работа с оценками за все семестры</font>',
				id:'deletes',
				name:'deletes',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/delete/toolbar.js')."
				]
            },

				{
                title: '<font size=3>5. &nbsp;&nbsp;&nbsp;Темы курсовых работ</font>',
				id:'theme_of_courss',
				name:'theme_of_courss',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/theme_of_cours/toolbar.js').",
					".file_get_contents('js/theme_of_cours/forms/theme_of_cours.js')."
				]
            }";/*,
			{
				title: '<font size=3>6. &nbsp;&nbsp;&nbsp;Сотрудники</font>',
				id:'sotrudnikis',
				name:'sotrudnikis',
//				defaults:{hidden: true},
				items: [
					 ".file_get_contents('js/sotrudniki/toolbar.js')." ,
					".file_get_contents('js/sotrudniki/forms/sotrudniki.js')."
				]
			}			{
                title: '<font size=3>6. &nbsp;&nbsp;&nbsp;Справочник направлений</font>',
				id:'spravochnik_napravs',
				name:'spravochnik_napravs',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/spravochnik_naprav/toolbar.js')."
				]
            }, 
			{
                title: '<font size=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Предмет по выбору</font>',
				id:'ppvs',
				name:'ppvs',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/ppv/toolbar.js').",
					".file_get_contents('js/ppv/forms/ppv.js')."
				]
            }*/echo",
			{
				title: '<font size=3>1. &nbsp;&nbsp;&nbsp;Контрольная неделя</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(текущая аттестация)</font>',
				id:'control_week',
				name:'control_week',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/control_week/toolbar.js').",
					".file_get_contents('js/control_week/forms/propuski.js')."
				]
			}"/*,
			{
                title: '<font size=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Результаты ЕГЭ</font>',
				id:'ege_results',
				name:'ege_results',
//				defaults:{hidden: true},
				items: [
					".file_get_contents('js/ege_result/toolbar.js').",
					".file_get_contents('js/ege_result/forms/ege_result.js')."
				]
            },

*/
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
            src="PeekLime_01.gif" 
            ></TD>
          <TD width="466" align=left vAlign=center><SPAN class=title>РГУ нефти и газа имени И. М. Губкина. Защищенная система</SPAN></TR></TBODY></TABLE>
<div id='tabs2'></div>
<iframe id="buffer" hidden=true style="display:none;"></iframe>
</body>