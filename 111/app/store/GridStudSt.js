Ext.define('AM.store.GridStudSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.GridStudM',
    autoLoad: false,

    proxy: {




        type: 'ajax',
        api: {
             read: 'php/get_student.php',
            update: 'php/save_student.php'

        },

        reader: {
            type: 'json',
            root: 'rows'
        },
        writer: {
            type: 'json',
            allowSingle:false
        },
        appendId: false,
        actionMethods: {
            read   : 'POST',
            update : 'POST'
        }




    }
});