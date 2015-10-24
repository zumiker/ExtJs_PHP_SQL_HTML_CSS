Ext.define('AM.store.ListStudySt', {
    extend: 'Ext.data.Store',
    model: 'AM.model.ListStudyM',
  //  autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'php/get_study.php',
        reader: {
            type: 'json',
            root: 'rows'
        }
    }
});