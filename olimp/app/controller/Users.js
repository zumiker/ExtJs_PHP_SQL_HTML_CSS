
Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListStudSt'],
    models: ['ListFacM'],
    views: ['Viewport'],
    init: function () {
        this.control({
            'viewport #facid': {
                afterrender: function (combo, records, eOpts) {
                    combo.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                var viewport = combo.up('viewport');
                                comboVub = viewport.query('#vubid')[0];
                                report=viewport.query('#report')[0];
                                combo.setRawValue(this.getAt(0).get('FAC'));
                                combo.setValue(this.getAt(0).get('FACID'));
                                comboVub.enable();
                                if (comboVub.getValue()==null)
                                    comboVub.setValue("0");

                            }
                        }
                    });
                }
            },

            'viewport #report': {
                click: function ( button,records, eOpts, store,sucess) {

                    var viewport = button.up('viewport');
                    comboVub = viewport.query('#vubid')[0];
                    comboFac = viewport.query('#facid')[0];
                   var a = comboFac.getRawValue();
                    var b = comboVub.getValue();
                    var t=comboFac.getValue();

                    window.open('php/report1.php?vub='+b+'&div='+t+'&fac='+a);
                }
            }

        });
    }
});
