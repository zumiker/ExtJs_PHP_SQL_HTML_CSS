Ext.onReady(function(){

Ext.QuickTips.init();    
// setup the state provider, all state information will be saved to a cookie
Ext.state.Manager.setProvider(Ext.create('Ext.state.CookieProvider'));
/*************Menu********************************************************/
var main_tab = Ext.create('Ext.tab.Panel', {
    height: window.innerHeight,
	width: window.innerWidth,
	autoDestroy:false,
	id: 'main-tab',
	name: 'main-tab',
	items:
	[
		{
			title: 'Число сотрудников',
			closable:true,
			layout:'table',
			columns:2,
			items:
			[
				grid,
				{
					xtype: 'panel',
					id:'pNagruzka',
					height: window.innerHeight-29,
					width:window.innerWidth-600,
					html: '<p style="padding: 10px;font-family:Tahoma;font-size:16px;">Выберите кафедру и подождите...</p>'
				}
			]
		},
		{
			title:'Список студентов',
			closable:true,
			autoScroll:true,
			items:
			[
				cFaculty,
				cGroup,
				{
					xtype:'splitbutton',
					id:'bSpisok',
					text:'Просмотреть список',
					margin:10,
					disabled:true,
					handler: function() 
					{
						Ext.getCmp('pSpisok').setVisible(true);
						Ext.getCmp('pSpisok').update('<p style="padding:10px;font-family:Tahoma;font-size:16px;">Подождите...</p>');
						Ext.Ajax.request({
							url: 'php/get_spisok.php?grocode=' + cGroup.getValue(),
							success: function(response)
							{
								Ext.getCmp('pSpisok').update(response.responseText);
							}
						});
					},
					menu:new Ext.menu.Menu(
					{
						items: 
						[
							{
								text:'Список в excel', 
								icon:'icons/excel.ico',
								handler:function()
								{
									window.open("xml/xml.php?grocode="+cGroup.getValue(),"_blank");
								}
							},
							{
								text:'Список в pdf',
								icon:'icons/pdf.ico',
								handler:function()
								{
									window.open("pdf/pdf_1.php?grocode="+cGroup.getValue(),"_blank");
								}
							}
						]
					})
				},
				{
					xtype:'panel',
					id:'pSpisok',
					autoScroll:true,
					hidden:true,
					width:window.innerWidth
				}
			]
		},
		{
			title:'Претенденты на красный диплом',
			closable:true,
			items:
			[
				cFaculty2,gRed
			]
		}
	]
});


/**********Main Panel***********************************************************/

Ext.create('Ext.panel.Panel', {
	autoDestroy:false,
    height: window.innerHeight,
    items: 
    [
		main_tab
    ],
    renderTo: Ext.getBody()
});  


});