/**
 * Created by user on 19.05.15.
 */
Ext.define('AM.store.ListRateSt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListRateM',
    //autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_rate.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});