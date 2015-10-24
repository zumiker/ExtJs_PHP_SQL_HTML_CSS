/**
 * Created by user on 16.06.15.
 */
Ext.define('AM.store.ListSpi1St', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListSpiM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_combo.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }

});