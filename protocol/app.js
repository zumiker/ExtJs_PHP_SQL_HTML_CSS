Ext.application({
    name: 'AM',
    appFolder: 'app',
    autoCreateViewport: true,
    launch: function () {
        Ext.QuickTips.init();
        console.log('launch App');
    },
    controllers: ['Users']
});