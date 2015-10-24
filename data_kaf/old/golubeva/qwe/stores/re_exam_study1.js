var re-exam_study1 = new Ext.data.Store({
	url: 'php/re-exam/get_study1.php',
	reader: new Ext.data.JsonReader({
		root:'rows',
		fields:[
			{
				name:'divid',
				mapping:'divid'
			},
			{
				name:'divname',
				mapping:'divname'
			}
		]
	}),
	autoLoad: false

});