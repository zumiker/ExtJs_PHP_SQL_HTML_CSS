Ext.define('AM.store.ListGroSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListGroM',
    proxy: {
        type: 'ajax',
        url: 'php/get_group.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    },
    autoLoad:true
});