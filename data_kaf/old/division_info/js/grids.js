/*-------------------------------------------------------------------------------*/
var groupingFeature=Ext.create('Ext.grid.feature.Grouping',
{
	groupHeaderTpl:'Факультет: {name}',
	startCollapsed:true
});
var grid=Ext.create('Ext.grid.Panel',
{
	store:sPersons,
	id:'personsid',
	autoScroll:true,
	height:window.innerHeight-29,
	width:602,
	features: 
	[
		groupingFeature
	],
	columns: 
	[
		{
			text:'Кафедра',
			id:'divname',
			dataIndex:'DIVNAME',
			width:450
		},
		{
			text:'Число сотрудников',
			id:'count',
			dataIndex:'COUNT',
			width:150
		}
	],
	listeners:
	{
		selectionchange: function(sm, selectedRecord)
		{
			Ext.getCmp('pNagruzka').update('<p style="padding: 10px;font-family:Tahoma;font-size:16px;">Подождите...</p>');
			Ext.Ajax.request({
				url:'php/get_nagruzka.php?divid='+selectedRecord[0].data['DIVID'],
				success:function(response)
				{
					var pNagruzka=Ext.getCmp('pNagruzka');
					answer=response.responseText.split('_');
					pNagruzka.update('<p style="padding:10px;font-family:Tahoma;"><table width = "20%" border = "1"><tr align = "center" ><td colspan = 2> Нагрузка</td></tr>' + '<tr align="center"><td width="50%"> Аудиторная </td><td width="50%"> Всего </td></tr><tr align="center"><td>' + answer[0] + '</td><td>' +  answer[1] +'</td></tr></table></p>');
				}
			});
		}
	}
});
/*-----------------------------------------------------------------------------------------*/
var gRed=Ext.create('Ext.grid.Panel',
{
	store:sRed,
	hidden:true,
	columnLines:true,
	height:window.innerHeight-70,
	autoScroll:true,
	columns: 
	[	{
			xtype:'rownumberer',
			text:'№',
			align:'center',
			width:50
		},
		{
			text:'Группа',
			dataIndex:'GROCODE',
			align:'center',
			flex:2
		},
		{
			text:'ФИО',
			dataIndex:'FIO',
			align:'center',
			flex:3,
			renderer:function(val)
			{
				return '<p align="left">' + val + '</p>';
			}
		},
		{
			text:'Средний балл',
			dataIndex:'SRED_BALL',
			align:'center',
			flex:2
		},
		{
			text:'Средний рейтинг',
			dataIndex:'SRED_RATING',
			align:'center',
			flex:2
		},
		{
			text:'Холдинг',
			dataIndex:'HOLDINGNAME',
			align:'center',
			flex:3,
			renderer:function(val)
			{
				return '<p align="left">' + val + '</p>';
			}
		},
		{
			text:'Предприятие',
			dataIndex:'COMPANYNAME',
			align:'center',
			flex:3,
			renderer:function(val)
			{
				return '<p align="left">' + val + '</p>';
			}
		},
		{
			text:'Тип набора',
			dataIndex:'KAT',
			align:'center',
			flex:2
		}
	]
});
/*-----------------------------------------------------------------------------------------*/