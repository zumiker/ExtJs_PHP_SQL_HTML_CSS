Ext.application({
    name: 'AM',
    appFolder: 'app',
    autoCreateViewport: true,
    launch: function () {
        //AM.app = this;
        Ext.QuickTips.init();
        console.log('launch App');
    },
    controllers: ['Users']
});