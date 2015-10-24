Ext.define('AM.store.GridStudSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.GridStudM',
    autoLoad: false,
    proxy: {
        type: 'ajax',
        url: 'php/get_student.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});