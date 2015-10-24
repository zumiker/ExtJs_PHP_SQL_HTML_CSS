/**
 * Created by user on 16.06.15.
 */
Ext.define('AM.store.ListVubSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListVubM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_com.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }

});