var panel = new Ext.FormPanel({
	renderTo:Ext.getBody(),
	autoHeight: true,
    frameHeader:false,
	frame: true,
	listeners:{
		afterrender: function(){
		}
	},
	layout: 'vbox',
	items: [
		tb,
		osnGrid,
		colName
	]
});