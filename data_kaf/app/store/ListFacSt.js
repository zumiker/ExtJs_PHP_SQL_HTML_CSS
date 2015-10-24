Ext.define('AM.store.ListFacSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListFacM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_faculty.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});