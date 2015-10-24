var current_rating_facultet = new Ext.data.JsonStore({
	autoLoad: true,
proxy: {
        type: 'ajax',
        url:  'php/get_facultet.php',
        reader: {
            type: 'json',
            root: 'rows'
				}
		},
		fields: [ 'facname', 'facid']
});

var ktype = new Ext.data.JsonStore({
	autoLoad: true,
proxy: {
        type: 'ajax',
        url:  'php/get_ktype.php',
        reader: {
            type: 'json',
            root: 'rows'
				}
		},
		fields: [ 'ktype_id', 'ktype_name']
});