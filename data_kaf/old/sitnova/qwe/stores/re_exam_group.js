var re_exam_group =  new Ext.data.Store
({
	url: 'php/get_group.php',
	reader: new Ext.data.JsonReader({
		root:'rows',
		fields:['id','name']
	}),
	autoLoad: false
}); 