
Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListGroSt', 'ListSubSt','ListStudSt','ListGridSt'],
    models: ['ListFacM', 'ListGroM', 'ListSubM','ListGridM'],
    views: ['Viewport'],
    init: function () {
        this.control({
            'viewport #facid': {
                select: function (combo, records, eOpts, grid) {
                  var viewport = combo.up('viewport');
                    comboGroup = viewport.query('#groid')[0];
                    comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    report=viewport.query('#report')[0];
                    //report.disable();
                    comboGroup.enable();
                    comboGroup.reset();
                    comboSub.reset();
                    comboSub.disable();
                  //  comboVub.reset();
                   // comboVub.disable();

                    //Ext.getCmp('startdt').reset();
                    //Ext.getCmp('enddt').reset();
                 //   Ext.getCmp('startdt').disable();
                   // Ext.getCmp('enddt').disable();
                    Ext.getBody().mask('Загрузка данных...');
                    comboGroup.store.load({
                        params: {
                            facid: combo.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                Ext.getBody().unmask();
                            }
                        }
                    });
                },
                afterrender: function (combo, records, eOpts) {
                    combo.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                var viewport = combo.up('viewport');
                                comboGroup = viewport.query('#groid')[0];
                                combo.setRawValue(this.getAt(0).get('FAC'));
                                combo.setValue(this.getAt(0).get('FACID'));
                                comboVub = viewport.query('#vubid')[0];
                                comboVub.enable();
                                if (comboVub.getValue()==null)
                                    comboVub.setValue("0");
                                Ext.getBody().mask('Загрузка данных...');
                                comboGroup.store.load({
                                    params: {
                                        facid: this.getAt(0).get('FACID')
                                    },
                                    callback: function (records, options, success) {
                                        if (success) {

                                            Ext.getBody().unmask();
                                        }
                                    }});
                            }
                        }
                    });
                }
            },
              'viewport #groid': {
                select: function (combo, records, eOpts) {
                    var viewport = combo.up('viewport');
                    comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    report=viewport.query('#report')[0];
                    comboFac = viewport.query('#facid')[0];
                    comboSub.reset();
                    comboSub.enable();


                    Ext.getBody().mask('Загрузка данных...');
                    comboSub.store.load({
                        params: {
                            groid: combo.getValue(),
                            facid:comboFac.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                if(comboSub.store.getCount()==1){
                                   comboSub.setRawValue(comboSub.store.getAt(0).get('SPCNAME'));
                                   comboSub.setValue(comboSub.store.getAt(0).get('SPCID'));
                                    Ext.getBody().unmask();
                                }
                                else{
                                    comboSub.setValue('0');
                                    Ext.getBody().unmask();
                                }


                            }
                        }})
                    Ext.getBody().unmask();
                }},
            'viewport #subid': {
                select: function (combo, records, eOpts) {
                    var viewport = combo.up('viewport');
                    comboVub = viewport.query('#vubid')[0];
                    comboGroup = viewport.query('#groid')[0];
                    comboGroup = viewport.query('#groid')[0];
                    //Ext.getBody().mask('Загрузка данных...');






                }
                 },

            'viewport #report': {
                click: function ( button,records, eOpts, store,sucess) {
                    var viewport = button.up('viewport');
                    comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    comboGro = viewport.query('#groid')[0];
                    comboFac = viewport.query('#facid')[0];
                    var a = comboSub.getValue();
                    var b = comboVub.getValue();
                    var d = comboFac.getValue();
                    var g = comboGro.getValue();
                    window.open('php/report.php?divid='+d+'&groid='+g+'&subid='+a+'&vub='+b);
                }
            }

        });
    }
});
