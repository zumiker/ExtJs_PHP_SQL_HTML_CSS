var current_rating_store = new Ext.data.JsonStore({
	autoLoad: false,
proxy: {
        type: 'ajax',
        url:  'php/current_rating_get.php',
        reader: {
            type: 'json',
            root: 'rows'
				}
		},
		fields: [ 'fio','rus','mat','fiz','him','ist','obsh','geo'],
		listeners:{
		load: function(){
			alert(this.getCount());
			current_rating_grid.reconfigure(this,current_rating_grid.getColumnModel());
		}
	}
});

//10.100.50.4\www\dev\study\tasks\obshepit\stores
var groupGridKolvo= new Ext.data.JsonStore({
						autoLoad: false,
						id: 'groupGridKolvo',
						proxy: {
							type: 'ajax',
							url:  'php/cur_rtng_getKolvo.php',
							reader: {
								type: 'json',
								root: 'rows'
							}
						}, 
						fields: [ 'kolvo']
					}); 


Ext.define('dataModel',{
	extend: 'Ext.data.Model',
 	fields: [ 'kaf','divid','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10','p11','p12']
});


					
var osnGridStore= new Ext.data.JsonStore({
					autoLoad: false,
					id: 'osnGridStore',
					proxy: {
						type: 'ajax',
						url:  'php/get_kaf.php',
						reader: {
							type: 'json',
							root: 'rows'
						}
					}, 
					model: 'dataModel',
					 listeners:{				
								load: function(){
										//alert('load');
										//Ext.getCmp('groupGrid').reconfigure		
									}
							} 
				});

				
Ext.define('dataModel1',{
	extend: 'Ext.data.Model',
 	fields: [ 'num','predmet']
});

var colNameStore= new  Ext.data.JsonStore({
					autoLoad: false,
					id: 'colNameStore',
					proxy: {
						type: 'ajax',
						url:  'php/cur_rtng_getPredName.php',
						reader: {
							type: 'json',
							root: 'rows'
						}
					}, 
					model: 'dataModel1',
					listeners:{				
								load: function(){
									//	alert(this.getCount());
										//this.eachfunction()
									}
							} 
				});  
				
				
				
