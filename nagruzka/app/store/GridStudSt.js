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
        },
   /*

    proxy: {




        type: 'ajax',
        api: {
             read: 'php/get_student.php',


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




    }*/
});