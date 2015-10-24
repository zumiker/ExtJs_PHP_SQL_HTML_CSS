var current_rating_grocode = new Ext.data.JsonStore({
	autoLoad: false,
proxy: {
        type: 'ajax',
        url:  'category/creating/tabl_kaf/php/get_grocode.php',
        reader: {
            type: 'json',
            root: 'rows'
				}
		},
		fields: [ 'grocode', 'groid']
});