/**
 * Created by user on 04.07.14.
 */
Ext.define('AM.store.ListAbbSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListAbbM',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_abb.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});