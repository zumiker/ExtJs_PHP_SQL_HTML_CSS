

var tb = new Ext.Toolbar({
	hidden:false,
	items: [{
				xtype: 'combo',
				id: 'type-id',
				name:'type-id',
				width:270,
				listWidth:270,
                store: ktype,
                displayField: 'ktype_name',
                valueField: 'ktype_id',
                emptyText:'- тип кафедры-',
				queryMode: 'local',
                submitEmptyText:false,
                editable:false
			},{
			xtype: 'combo',
			store: current_rating_facultet,
			queryMode: 'local',
			width:270,
			listWidth:270,
			autoSelect:true,
			emptyText:'Выберите факультет:',
			name: 'current_rating_fac',
			id: 'current_rating_fac',
			triggerAction:  'all',
			editable:       false,
			displayField: 'facname',
			valueField: 'facid',
			listeners:{
				select: function(){
				
					var view=osnGrid.getView();
					osnGridStore.removeAll(true);
					osnGridStore.load({params:{facid: this.value, ktype: Ext.getCmp('type-id').getValue()}});
					//colNameStore.removeAll(true);
					colNameStore.load();
					//alert(colNameStore.getCount());
				}
			}
		},
	]
})
