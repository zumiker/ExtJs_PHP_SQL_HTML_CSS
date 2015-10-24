/*---Faculty------------------------------------------------------------*/
var cFaculty=Ext.create('Ext.form.ComboBox', 
{
	store:sFaculty,
	displayField:'FACNAME',
	valueField:'FACID',
	fieldLabel:'Выберите факультет',
	labelWidth:130,
	inputWidth:400,
	emptyText:'- факультет -',
	submitEmptyText:false,
	editable:false,
	margin:10,
	listeners:
	{
		select:function(combo,records,eOpts)
		{
			cGroup.clearValue();
			cGroup.store.load({params:{facid:combo.getValue()}});
			cGroup.setDisabled(false);
		}
	}
});

var cFaculty2=Ext.create('Ext.form.ComboBox', 
{
	store:sFaculty2,
	displayField:'FACNAME',
	valueField:'FACID',
	fieldLabel:'Выберите факультет',
	labelWidth:130,
	inputWidth:400,
	emptyText:'- факультет -',
	submitEmptyText:false,
	editable:false,
	margin:10,
	listeners:
	{
		select:function(combo,records,eOpts)
		{
			gRed.store.load({params:{facid:combo.getValue()}});
			gRed.setVisible(true);
		}
	}
});

/*------Group-------------------------------------------------------------*/
var cGroup=Ext.create('Ext.form.ComboBox', 
{
	store:sGroup,
	disabled:true,
	displayField:'GROCODE',
	valueField:'GROCODE',
	fieldLabel:'Выберите группу',
	labelWidth:130,
	inputWidth:400,
	emptyText:'- группа -',
	submitEmptyText:false,
	queryMode:'local',
	editable:false,
	margin:10,
	listeners:
	{
		select: function(combo,records,eOpts)
		{
			Ext.getCmp('bSpisok').setDisabled(false);
		}
	}
});
/*---------------------------------------------------------------------------*/







