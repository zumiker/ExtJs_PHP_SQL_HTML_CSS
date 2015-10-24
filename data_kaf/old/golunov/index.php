<?
require('/var/www/lib.php');
?>
<html> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>־עקועû</title>
		<link rel="stylesheet" type="text/css" href="../../../../../ext-4.1.1/resources/css/ext-all-gray.css" />
		<script type="text/javascript" src="../../../../../ext-4.1.1/ext-all-debug.js"></script>
		<script type="text/javascript" src="../../../../../ext-4.1.1/examples/shared/extjs/App.js"></script>
		<script type="text/javascript" src="combo_fix.js"></script>	
		<script type="text/javascript">
			Ext.Loader.setPath({
				'Ext': '../../../../../ext-4.1.1'
			});
<?
			$tmp =  file_get_contents('stores/current_rating_facultet.js').
					file_get_contents('stores/current_rating_store.js').
					file_get_contents('grids/current_rating_grid.js').
					file_get_contents('toolbar/toolbar.js').
					file_get_contents('forms/current_rating.js'); 
			echo $tmp;
?> 
			Ext.onReady(function(){
				Ext.QuickTips.init();
				var view_panel = Ext.create('Ext.panel.Panel',{
						renderTo:Ext.getBody(),
						frame:true,
						frameHeader:false,
						hidden:true
					});	
				view_panel.removeAll();
				view_panel.add(panel);
				view_panel.show();
			});
		</script>		
    </head>
    <body>
    </body>
</html>