var re-exam_study2 = new Ext.data.Store({
	url: 'php/re-exam/get_study2.php',
	reader: new Ext.data.JsonReader({
		root:'rows',
		fields:[
			{
				name:'couid',
				mapping:'couid'
			},
			{
				name:'couname',
				mapping:'couname'
			}
		]
	}),
	autoLoad: false

});