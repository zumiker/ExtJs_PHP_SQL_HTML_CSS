var panel = new Ext.FormPanel({
	renderTo:Ext.getBody(),
//	width: 410,
	//height: 700,
	autoHeight: true,
    frameHeader:false,
	//id:'current_rating',
	//name:'current_rating',
//	hidden:true,
	frame: true,
	listeners:{
		afterrender: function(){
//			this.hide();
		}
	},
	layout: 'vbox',
	items: [
		tb,
		osnGrid,
		colName
		/*current_rating_grid*/
	]
});

/*<?echo file_get_contents('stores/current_rating_facultet.js');?>
		<?echo file_get_contents('stores/current_rating_grocode.js');?>
		<?echo file_get_contents('stores/current_rating_store.js');?>
		<?echo file_get_contents('grids/current_rating_grid.js');?>
		<?echo file_get_contents('toolbar/toolbar.js');?>
		<?echo file_get_contents('forms/current_rating.js');?>*/