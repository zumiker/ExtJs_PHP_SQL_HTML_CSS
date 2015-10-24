Ext.define('AM.store.ListGridWinSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListGridWinM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_grid_window.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});
