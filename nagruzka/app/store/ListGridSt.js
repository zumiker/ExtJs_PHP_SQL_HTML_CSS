Ext.define('AM.store.ListGridSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListGridM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_grid.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});