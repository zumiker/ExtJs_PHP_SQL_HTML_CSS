Ext.define('AM.store.ListSubSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListSubM',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_sub.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});