<?php
//$tmp = file_get_contents('test.js');
//$tmp = file_get_contents('forms/current_rating.js');

//include("../../include.php");
require('/var/www/lib.php');//include('./../../../../lib_debug.php');

/* $tmp =  file_get_contents('stores/current_rating_facultet.js').
		file_get_contents('stores/current_rating_grocode.js').
		file_get_contents('stores/current_rating_store.js').
		file_get_contents('grids/current_rating_grid.js').
		file_get_contents('toolbar/toolbar.js').
		file_get_contents('forms/current_rating.js'); //<title>Переэкзаменовка</title>
echo str_replace(array('\r','\n','\t','"'),"",$tmp); */
?>


<html> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Информация по кафедрам (общее)</title>
		<link rel="stylesheet" type="text/css" href="../../../../../ext-4.1.1/resources/css/ext-all-gray.css" />
		<!--link rel="stylesheet" type="text/css" href="style.css" /-->
		<script type="text/javascript" src="../../../../../ext-4.1.1/ext-all-debug.js"></script>
		<script type="text/javascript" src="../../../../../ext-4.1.1/examples/shared/extjs/App.js"></script>
		<script type="text/javascript" src="combo_fix.js"></script>	
		<script type="text/javascript">
		
	
		 Ext.Loader.setPath({
				'Ext': '../../../../../ext-4.1.1'
			});
		<?$tmp =  file_get_contents('stores/current_rating_facultet.js').
				file_get_contents('stores/current_rating_grocode.js').
				file_get_contents('stores/current_rating_store.js').
				file_get_contents('grids/current_rating_grid.js').
				file_get_contents('toolbar/toolbar.js').
				file_get_contents('forms/current_rating.js'); 
				echo $tmp;?> 
				
			Ext.onReady(function(){
				Ext.QuickTips.init();
				
			
			// str_replace(array('\r','\n','\t','"'),"",$tmp)
				
				var view_panel = Ext.create('Ext.panel.Panel',{
						renderTo:Ext.getBody(),
						frame:true,
						frameHeader:false,
						hidden:true
					});	
					
				 //alert('111');
				 view_panel.removeAll();
				view_panel.add(panel);
				view_panel.show();
			});
		</script>		
	
    </head>
    <body>
    </body>
</html>


