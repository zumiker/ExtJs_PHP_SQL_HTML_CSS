/**
 * Created by user on 22.12.14.
 */
Ext.define('AM.store.ListSpiSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListSpiM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_spi_prep.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});