/**
 * Created by user on 15.06.15.
 */
Ext.define('AM.store.ListSpiSt', {
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