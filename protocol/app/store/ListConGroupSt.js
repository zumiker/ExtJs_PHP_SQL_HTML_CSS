/**
 * Created by user on 21.06.14.
 */
Ext.define('AM.store.ListConGroupSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListConGroupM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_con_group.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }

});