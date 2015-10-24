 var colmod = new Ext.grid.ColumnModel([
	new Ext.grid.RowNumberer({header: "#"}),
	{header:'Группа', dataIndex: 'grocode', fixed:true,width:80,id:'col_grocode'},	
	{header:'ФИО', dataIndex: 'fio_full', width:20,id:'col_fio'},	
	{header: "Предмет", dataIndex: 'couname', width:45,sortable:true,id:'col_couname'},
	{header: "Вид отчетности", dataIndex: 'trename',fixed:true,align: 'center', width:110},
	{header: '<span style="white-space:normal !important;">Номер пересдачи</span>', align: 'center',dataIndex: 're_num',fixed:true,width:75}
]) ;