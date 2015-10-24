
function vacationRenderer (value, cell){
	var record = cOtpusk.findRecord('value', value);
	  if(record)
	    return record.get('data');
	   else
	    return null;
}
var cellEditing=Ext.create('Ext.grid.plugin.CellEditing', 
{
	clicksToEdit:1
});
var gStudents=Ext.create('Ext.grid.Panel',
{
	title:'Выберите студентов для предоставления отпуска...',
	store:sStudents,
	//hidden:true,
	height:window.innerHeight-42,
	autoScroll:true,
	selModel: 
	{
		selType:'cellmodel'
	},
	plugins:
	[
		cellEditing
	],
	columns: 
	[	
		{
			xtype:'rownumberer',
			text:'№',
			align:'center',
			width:50
		},
		{
			xtype: 'checkcolumn',
			text: 'Не указывать<br>форму обучения',
			dataIndex: 'NOT_FORM',
			width:150,
			align: 'center'
		},
		{
			xtype: 'checkcolumn',
			width:150,	
			text: 'Не указывать<br>специализацию',
			dataIndex: 'NOT_SPEC',
			align: 'center'
		},
		{
			text:'Отпуск',
			dataIndex:'NA_OTPUSK',
			width:230,
			renderer: vacationRenderer,
			editor:
			{
				xtype:'combobox',
				store:cOtpusk,
				valueField: 'value',
				displayField:'data',
				editable:false,
				allowBlank:false,
				lazyRender:true,
				listClass:'x-combo-list-small',
				
			}
		},
		{
			text:'Председатель ГЭК',
			dataIndex:'MANID_PREDSEDATEL',
			width:230,
			renderer: function(value, cell){
			/*if(value == "")
			return "не выбран";
			else{*/
	var record = ListPredsedSt.findRecord('MANID', value);
	//console.log(cell,value);
	  if(record)
	    return record.get('PRED');
	   else
	    return ListPredsedSt.getAt(0).get('PRED');
},
			editor:
			{
				xtype:'combobox',
				store:ListPredsedSt,
				valueField: 'MANID',
				displayField:'PRED',
				editable:false,
				allowBlank:false,
				lazyRender:true,
				listClass:'x-combo-list-small',
				
			}
		},
		{
			text:'ФИО',
			dataIndex:'FIO_FULL',
			flex:3
		}
	]/*,
	bbar:
	[
		{
			xtype:'button',
			text:'Подтвердить',
			handler:function(btn)
			{
				var array=new Array();
				var rows=gStudents.getView().getSelectionModel().getSelection();
				var text='count='+rows.length;
				for(var i=0;i<rows.length;i++)
				{
					array[i]=rows[i].data['STUDENT_ID'];
					text+='&array['+i+']='+array[i];
				}
				if(sm.getCount()==0)
				{
					Ext.Msg.alert('Внимание!','Вы не выбрали ни одного студента! Выберите хотя бы одного.');
				}
				else
				{
					Ext.Msg.show({
						title:'Сохранение изменений',
						msg:'Вы хотите сохранить изменения?',
						buttons:Ext.Msg.YESNO,
						icon:Ext.Msg.QUESTION,
						fn:function(buttonId)
						{
							if(buttonId=='yes')
							{
								Ext.Ajax.request({
									url:'php/update.php?' + text,
									success:function(response)
									{
										res=response.responseText;
										if(res==1)
										{
											gStudents.store.load({params:{grocode:cGroup.getValue()}});
										}
										else
										{
											Ext.Msg.alert('Внимание!','Данные не были сохранены.');
										}
									}
								});
							}
						}
					});
				}
			}
		}
	]*/
});
