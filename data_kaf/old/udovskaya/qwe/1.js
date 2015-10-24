var Main = function() {
	var re=new Ext.App();
	
	//re.setAlert(null,'Доброго времени суток');
    new Ext.Viewport({		
		renderTo:Ext.getBody(),
        layout: {
			type: 'border'              	  
        },
		items :  [
				{
						xtype: 'toolbar',
						region: 'north',
						height:25,
						//autoWidth: true,
						//autoScroll: true,
						//hidden:false,
						items: [
									{
										xtype: 'combo',
										store: new Ext.data.SimpleStore({
											fields:['sort_id','sort_full'],
											data: [['g','По студенту'],['k','По кафедре'],['p','По предмету']],
											autoLoad: true
											}), 
										mode: 'local',
										width:140,
										listWidth:140,
										disabled:false,
										emptyText:'Группировка:',
										name: 'combo_sort',
										id: 'combo_sort',
										triggerAction:  'all',
										editable:       false,
										displayField: 'sort_full',
										valueField: 'sort_id',
										listeners:{
											select: function(){
											Ext.getCmp('grid1').hide();
											Ext.getCmp('fieldset').hide();
											Ext.getCmp('label_info').show();
											Ext.getCmp('label_info1').show();
											new Ext.LoadMask(Ext.getBody(),{
														msg:'Загрузка данных...',
														store: re_exam_group  
													});	
											re_exam_group.load({params:{sort_id:this.getValue()}});
											Ext.getCmp('combo_tip').show();
											Ext.getCmp('combo_tip').reset();
											Ext.getCmp('como_student').hide();
											Ext.getCmp('como_student').reset();
											Ext.getCmp('search').reset();
											var tip = this.getValue();
											if ( tip == 'g') {Ext.getCmp('combo_tip').setValue('Выберите группу:');}
											else if ( tip == 'k') {Ext.getCmp('combo_tip').setValue('Выберите кафедру:');}
											else {Ext.getCmp('combo_tip').setValue('Выберите предмет:');}
											
											}
										}
									},
									{
										xtype: 'combo',
										store: re_exam_group,
										mode: 'local',
										width:340,
										listWidth:540,
										//disabled:true,
										emptyText:'',
										name: 'combo_tip',
										id: 'combo_tip',
										triggerAction:  'all',
										editable:       false,
										hidden:true,
										displayField: 'name',
										valueField: 'id',
										listeners:{
											select: function(){
											var tip = Ext.getCmp('combo_sort').getValue();
											if ( tip == 'g') 
												{		
														Ext.getCmp('grid1').hide();
														Ext.getCmp('fieldset').hide();
														Ext.getCmp('label_info').show();
														Ext.getCmp('label_info1').show();
														new Ext.LoadMask(Ext.getBody(),{
															msg:'Загрузка данных...',
															store: re_exam_student  
														});
													Ext.getCmp('search').reset();	
													Ext.getCmp('como_student').reset();
													Ext.getCmp('como_student').show();	
													re_exam_student.load({params:{info_id:this.getValue()}});
												}
											else if ( tip == 'k') 
												{	
													  new Ext.LoadMask(Ext.getBody(),{
														msg:'Загрузка данных...',
														store: re_exam_study  
													});  
													Ext.getCmp('search').reset();
													Ext.getCmp('label_info1').hide();
													re_exam_study.load({params:{info_id:Ext.getCmp('combo_tip').getValue(), start:0, search: 'no'}});
												}
											else 
												{
													 new Ext.LoadMask(Ext.getBody(),{
														msg:'Загрузка данных...',
														store: re_exam_study  
													});	 
													Ext.getCmp('search').reset();
													Ext.getCmp('label_info1').hide();
													re_exam_study.load({params:{info_id:Ext.getCmp('combo_tip').getValue(), start:0, search: 'no'}});
													Ext.getCmp('grid1').show();
													
												}	
											}
										}
									},
									{
										xtype: 'combo',
										store: re_exam_student,
										mode: 'local',
										width:250,
										listWidth:440,
										//disabled:true,
										emptyText:'Выберите студента:',
										name: 'como_student',
										id: 'como_student',
										triggerAction:  'all',
										editable:       false,
										hidden:true,
										displayField: 'fio_full',
									    valueField: 'student_id',
										listeners:{
											select: function(){
												 new Ext.LoadMask(Ext.getBody(),{
														msg:'Загрузка данных...',
														store: re_exam_study  
													});	 
												Ext.getCmp('search').reset();	
												Ext.getCmp('label_info1').hide();
												re_exam_study.load({params:{info_id:Ext.getCmp('combo_tip').getValue(),student_id:this.getValue(), search: 'no'}});
												Ext.getCmp('grid1').show();
											}
										}
									},
									'->',
									{
										xtype: 'label',
										text: 'ПОИСК ПО ФИО:   ',
										style: {
												"margin-right": "5px",
											},

									},
									{
										xtype: 'textfield',
										width: 335,
										id: 'search',
										listeners: {
											specialkey: function(field, e){
												 if (e.getKey() == e.ENTER && this.getValue()!='') 
												  Ext.getCmp('button_search').fireEvent('click');
											},
										}
											
									
									},
									{
										xtype: 'button',
										width:70,
										disabled:false,
										icon : 'ico/search.ico',
										text:'Найти',
										id: 'button_search',
										listeners: {
										click:function(){
											new Ext.LoadMask(Ext.getBody(),{
														msg:'Загрузка данных...',
														store: re_exam_study  
													});	
											Ext.getCmp('label_info1').hide();		
										    var name = Ext.getCmp('search').getValue();
											re_exam_study.load({params:{name:name, search:'yes', start:0}});
										}
										}	
									
									}
								]
				},
				 new Ext.Panel({
					region:'center',				
					buttonAlign:'center',
					title: '<center>Панель отображения',
					autoScroll : true,
					border:true,
					frame:true,
					//layout:'hbox',
					layoutConfig: {
						align : 'stretch',
						pack  : 'start',
					},
					id: 're_form1',
					listeners: {
						beforerender:function(panel){
							//panel.setWidth(document.body.clientWidth-20);		
							/* alert(document.body.clientHeight);
							alert(document.body.clientWidth); */
						}
					},
					items:[				{
											xtype: 'label',
											id: 'label_info1',
											html : '<center><font color="olive", size="5">Выберите тип отображения'
										},	
										 {
											xtype: 'grid',
											region:'center',
											id: 'grid1',
											viewConfig: {
												forceFit: true,
												autoFill : true,
												scrollOffset :0,
											}, 
											bbar: new Ext.PagingToolbar({
													store: re_exam_study,
													pageSize: 30,
													plugins: new Ext.ux.ProgressBarPager({progBarWidth:400}),
													displayInfo: true,
													//displayMsg: 'Показано  {0} - {1} из {2}',
													listeners:{
														beforechange: function(tb, par){
														re_exam_study.setBaseParam('start',par.start);
															if (Ext.getCmp('search').getValue()!='') 
															{
																re_exam_study.load({params:{name:Ext.getCmp('search').getValue(), search:'yes', start:par.start}})
															}
															 else  
															 {
																re_exam_study.load({params:{info_id:Ext.getCmp('combo_tip').getValue(),start:par.start, search: 'no'}})
															 }
															 return false;
															}
														}
												}),
											border: true,
											//loadMask: true,
											frame:true,
											clicksToEdit: 1,
											autoHeight: true,
											autoScroll : true,
											columnLines: true,
											stripeRows : true, 
											hidden: true,
											store: re_exam_study,
											selModel : new Ext.grid.RowSelectionModel({
														singleSelect: true,
														listeners: {
															rowselect: function(sm, row, rec) {
																Ext.getCmp("label_info").hide();
																Ext.getCmp("fieldset").show();
																Ext.getCmp("combo_re_exam").reset();
																Ext.getCmp("date_re_exam").reset();
																Ext.getCmp("field_rating").reset();
																Ext.getCmp("re_form").getForm().loadRecord(rec);
																// re_exam_study.remove(Ext.getCmp('grid1').getSelectionModel().getSelected())
																var DataEx =[['5','5'],['4','4'],['3','3'],['2','2'],['н','н'],['у','у']];
																var DataZ =[['з','з'],['н','н']];
																var DataDif =[['5','5'],['4','4'],['3','3'],['2','2'],['н','н']];
																if(rec.data.treid==1 ) {re_exam_combo.loadData(DataEx,false);} //экзамен
																	else if (rec.data.treid==3 ){re_exam_combo.loadData(DataZ,false); } //зачет
																		else {re_exam_combo.loadData(DataDif,false); }
																
															}
														}
													}), 
											colModel:colmod,
											listeners: {
												beforerender:function(grid){	
												},
												afteredit: function(e){
												
												}
											}	
											
										},	 

					]  
				}),
				  new Ext.FormPanel({
					region:'east',	
					width: 500,	
					autoScroll : true,
					title: '<center>Панель редактирования',
					border:true,
					frame:true,
					id: 're_form',
					items:[
						{
							xtype: 'label',
							id: 'label_info',
							html : '<center><font color="olive", size="5">Выберите студента, для его переэкзаменовки'
						},
						{
							xtype: 'fieldset',
							//width: 1174,
							labelWidth: 90,
							buttonAlign:'center',
							title:'Студент',
							id: 'fieldset',
							hidden:true,
							defaultType: 'textfield',
							autoHeight: true,
							//bodyStyle: Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',
							border: true,
							style: {
								//"margin-left": "10px",
								  //"margin-top": "5px",
							},
							items: [
							{
								readOnly : true,
								hideMode: 'offsets',
								fieldLabel: 'ФИО',
								name: 'fio_full',
								width: 500,
							},
							{
								fieldLabel: 'Предмет',
								readOnly : true,
								name: 'couname',
								width: 500,
							},
							{
								fieldLabel: 'Вид отчетности',
								readOnly : true,
								name: 'trename',
								width: 100,
							},
							{
								xtype: 'datefield',
								editable : false,
								fieldLabel: 'Дата пересдачи',
								id:'date_re_exam',
								name: 're_date',
								width: 100,
							},
							{
								
								fieldLabel: 'Рейтинг',
								id:'field_rating',
								name: 're_rating',
								maskRe:/[0-9.,]/,
								maxLength : 4,
								width: 100,
							},
							{
								xtype: 'combo',
								editable : false,
								store :re_exam_combo,
								mode: 'local',
								width:100,
								listWidth:100,
								disabled:false,
								emptyText:'Оценка:',
								id: 'combo_re_exam',
								triggerAction:  'all',
								editable:       false,
								displayField: 'mark_id',
								valueField: 'mark_id',
								fieldLabel: 'Оценка',
							},
							{	
								id :'re_vblid',
								name: 'vblid',
								hidden : true,
							},
							{	
								id :'re_treid',
								name: 'treid',
								hidden : true,
							},
							{
								id :'re_student_id',
								name: 'student_id',
								hidden : true,
							},
							{
								id :'field_re_num',
								name: 're_num',
								hidden : true,
							},
							{
								
								xtype:'button',
								text:'Сохранить',
								icon : 'ico/save.ico',
								width: 200,
								handler:function(){
									
									if (Ext.getCmp('date_re_exam').getRawValue() == '' || Ext.getCmp('field_rating').getValue() == '' || Ext.getCmp('combo_re_exam').getValue() == '')
										{Ext.MessageBox.alert('Внимание','Для сохранения заполните все поля!');	break; }
									var lm =	new Ext.LoadMask(Ext.getBody(),
									{
										msg:'Сохранение...'
									});	
										lm.show();
										setTimeout(function() { 
											lm.hide();
										}, 1000);  	
									Ext.Ajax.request({   
											method:'POST',
											url: 'php/update_study.php',
											params: {
														tmaid      : Ext.getCmp('combo_re_exam').getValue(),
														rating     : Ext.getCmp('field_rating').getValue(), 
														student_id : Ext.getCmp('re_student_id').getValue(), 
														vblid      : Ext.getCmp('re_vblid').getValue(),
														re_num     : Ext.getCmp('field_re_num').getValue(),   
														treid      : Ext.getCmp('re_treid').getValue(),  
														re_date    : Ext.getCmp('date_re_exam').getRawValue()
													},
											success: function(response){
												var result=eval(response.responseText);
												switch(result){
													default:
														//re_exam_study.reload();
															re_exam_study.remove(Ext.getCmp('grid1').getSelectionModel().getSelected()); //удаление выделенной строчки
															var count_number = re_exam_study.getCount(); //Количество записей грида
																if (count_number == 0) {
																	Ext.getCmp("fieldset").hide();
																	Ext.getCmp("label_info").show();
																	re_exam_study.reload();
																}
															Ext.getCmp('grid1').getSelectionModel().selectPrevious(); 
															Ext.getCmp('grid1').getSelectionModel().selectNext(); 
															
															
													break;
														}//switch
													},
											failure: function(){
												Ext.MessageBox.alert('ОШИБКА.','Невозможно сохранить! Ошибка базы данных!');
												}
											}) //Аякс 	
						
										},
								}
							]
						} 
					]
					}) 
				
		],
		listeners:{
			afterrender:function(){
			},
			 render:function(){
				(function(){				
				}).defer(1);
			} 
		}
    });

}

Ext.onReady(Main);
