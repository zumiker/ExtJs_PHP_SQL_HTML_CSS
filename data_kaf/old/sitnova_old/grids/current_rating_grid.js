var current_rating_grid = new Ext.grid.GridPanel({
		title: 'Результаты ЕГЭ',
		//colModel: current_ratingColumnModel,
		height: 670,
		forceFit: true,
		viewConfig: {
			loadMask:false,
			emptyText: 'Нет данных'
		},
		store: current_rating_store,
		columns: [
					{ header: 'ФИО',  dataIndex: 'fio', width:170, sortable:true},
					{ header: 'Рус.яз', dataIndex: 'rus', width:70, sortable:true},
					{ header: 'Матем.', dataIndex: 'mat', width:70, sortable:true },
					{ header: 'Физика',  dataIndex: 'fiz', width:70, sortable:true },
					{ header: 'Химия', dataIndex: 'him', width:70, sortable:true},
					{ header: 'История', dataIndex: 'ist', width:70, sortable:true },
					{ header: 'Обществ.', dataIndex: 'obsh', width:70, sortable:true},
					{ header: 'Геогр.', dataIndex: 'geo', width:70, sortable:true }
		]
});


 var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
							clicksToEdit: 1
						});


var osnGrid = new Ext.grid.Panel({
		//title: 'Текущая успеваемость студентов',
		id: 'osnGrid',
		//width: 1012,
		autoHeight: true,
		viewConfig: {
			loadMask:false,
			emptyText: 'Нет данных'
		},
		//columnLines: true,
		border: true,
		frame:true,
		clicksToEdit: 1,
		columnLines: true,
		//hidden: true,
		//stripeRows : true,
		plugins: [cellEditing],
		store: osnGridStore,
		bbar: [
				{
					xtype:'button',
					minWidth: 150,
					border: true,
					text: 'Save',
					handler : function() {
								var inf_arr = new Array();
								var rs = osnGrid.getStore().getUpdatedRecords();
								for (var i = 0, ln = rs.length; i < ln; i++) {
									inf_arr.push(rs[i].data.kaf + '_' + rs[i].data.divid + '_'+rs[i].data.p1+ '_'+rs[i].data.p2+ '_'+rs[i].data.p3+ '_'+rs[i].data.p4+ '_'+rs[i].data.p5+ '_'+rs[i].data.p6+ '_'+rs[i].data.p7+ '_'+rs[i].data.p8+ '_'+rs[i].data.p9+ '_'+rs[i].data.p10+ '_'+rs[i].data.p11+ '_'+rs[i].data.p12);//+'-'+rs[i].data.p2+'-'+rs[i].data.p3+'-'+rs[i].data.p4
									}
								inf_arr = inf_arr.join(';');
								Ext.Ajax.request({   
										method:'POST',
										url: 'php/save_inf.php',
										params: {
										inf_arr: inf_arr,
											},
										success: function(response){
													osnGridStore.commitChanges();
													//Ext.MessageBox.alert('Успех!','Путь к успеху пройден!');
												},
										failure: function(){
											Ext.MessageBox.alert('ОШИБКА.','Невозможно сохранить! Ошибка базы данных!');
											}
										});
								
								}
							
				}
			],
		columns: [
					/*{	
						header: 'divid', 
						fixed: true,  
						width: 100, 
						dataIndex: 'divid', 
						sortable:false, 
						hidden:false
					},*/
					{
						header: 'Название кафедры', 
						fixed: true,  
						width: 600, 
						dataIndex: 'kaf', 
						sortable:false, 
						hidden:false
					},
					{
						header: '1', 
						fixed: true,  
						width: 50, 
						dataIndex: 'p1', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					}/*,
					{
						header: '2', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p2', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '3', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p3', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '4', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p4', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '5', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p5', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '6', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p6', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '7', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p7', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '8', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p8', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '9', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p9', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '10', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p10', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '11', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p11', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},
					{
						header: '12', 
						fixed: true,  
						width: 30, 
						dataIndex: 'p12', 
						sortable:false, 
						hidden:false,
						editor: 
						{
							xtype:'textfield',
							listners:{
															activate: function(){
																	this.clearValue();
															}
														}
						},
					},*/
				]
}); 

 

 var colName = new Ext.grid.Panel({
		title: 'Расшифровка названий колонок',
		id: 'colName',
		autoHeight: true,
		width: 712,
		columnLines: true,
		autoScroll: true,
		viewConfig: {
			loadMask:false,
			emptyText: 'Нет данных'
		},
		hidden: false,
		store: colNameStore,
		columns: [
					 {header: '№', fixed: true,  width: 30, dataIndex: 'num', sortable:false, hidden:false},
				    {header: 'Название колонки', fixed: true,  width: 680, dataIndex: 'predmet', sortable:false, hidden:false}	 
				],
		/* listeners:{
		afterrender: function(){
			alert('111');
		} */
});   