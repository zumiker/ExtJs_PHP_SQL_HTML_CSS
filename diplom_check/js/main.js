
Ext.onReady(
function()
{
	Ext.QuickTips.init();    
	// setup the state provider, all state information will be saved to a cookie
	Ext.state.Manager.setProvider(Ext.create('Ext.state.CookieProvider'));
	/**********Main Panel***********************************************************/
	Ext.create('Ext.container.Viewport',
	{
		items: 
		[
			cGroup,gStudents
		],
		renderTo:Ext.getBody()
	});
});