var re_exam_study =  new Ext.data.Store
({
	url: 'php/get_study.php',
	 reader: new Ext.data.JsonReader({
		totalProperty: 'total',
		//messageProperty : 'Здарова',
		root:'rows',
		fields:['vblid','student_id','fio_full','couname','grocode','treid','trename','re_num','tmaid','rating','year_grocode','spring_autumn']
	}), 
	autoLoad: false,
	//autoSave: true,
	baseParams:{
		start:0
	},	
	listeners: {
		load:function(store,rec){
			 Ext.getCmp('grid1').show();
		},
		beforeload:function(store){
			// Ext.getCmp('grid1').hide();
		}
	}
}); 