/*------Group-------------------------------------------------------------*/
var cGroup=Ext.create('Ext.form.ComboBox', 
{
	store:sGroup,
	displayField:'GROCODE',
	valueField:'GROCODE',
	fieldLabel:'Выберите группу',
	labelWidth:130,
	inputWidth:400,
	emptyText:'- группа -',
	submitEmptyText:false,
	editable:false,
	margin:10,
	listeners:
	{
		select: function(combo,records,eOpts)
		{
			gStudents.store.load({params:{grocode:combo.getValue()}});
			gStudents.setVisible(true);
		}
	}
});
/*---------------------------------------------------------------------------*/