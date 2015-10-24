/**
 * Created by user on 18.05.15.
 */
Ext.define('AM.store.ListShifrSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListShifrM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_shifr.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});