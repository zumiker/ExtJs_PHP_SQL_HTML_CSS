Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListGroSt', 'ListSubSt', 'GridStudSt'],
    models: ['ListFacM', 'ListGroM', 'ListSubM', 'GridStudM'],
    views: ['Viewport', 'GridStud'],
    init: function () {
        this.control({
            'viewport #facid': {
                select: function (combo, records, eOpts, grid) {
                    var viewport = combo.up('viewport');
                    sb = viewport.query('#sb')[0];
                    pdf = viewport.query('#pdf')[0];
                    sb.disable();
                    pdf.disable();
                    comboGroup = viewport.query('#groid')[0];
                    comboSub = viewport.query('#subid')[0];
                    gridsud = viewport.query('#gridstud')[0];
                    comboGroup.enable();
                    comboGroup.reset();
                    comboSub.reset();
                    gridsud.store.load();
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
                    sb = viewport.query('#sb')[0];
                    pdf = viewport.query('#pdf')[0];
                    sb.disable();
                    pdf.disable();
                    gridsud = viewport.query('#gridstud')[0],
                        gridsud.store.load();
                    comboSub = viewport.query('#subid')[0];
                    comboSub.reset();
                    comboSub.enable();
                    Ext.getBody().mask('Загрузка данных...');
                    comboSub.store.load({
                        params: {
                            groid: combo.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                if (this.getCount() == 0) {
                                    comboSub.setRawValue("Нет предметов по выбору");
                                    Ext.getBody().unmask();
                                }
                                if (this.getCount() == 1) {
                                    var t = this.getAt(0).get('VBLID');
                                    var q;

                                    comboSub.setRawValue(this.getAt(0).get('COUNAME'));
                                    comboSub.setValue(t);
                                    gridsud.store.load({
                                        params: {
                                            groid: combo.getValue(),
                                            vblid: comboSub.store.getAt(0).get('VBLID')
                                        },
                                        callback: function (records, options, success) {
                                            if (success) {
                                                for (var i = 0; i < gridsud.store.getCount(); ++i) {
                                                    gridsud.store.getAt(i).set('VBLID', comboSub.store.getAt(0).get('VBLID'));
                                                    gridsud.store.getAt(i).set('t', '0');
                                                }
                                                console.log(gridsud.store);
                                                var a1 = [];
                                                var k = 0;
                                                var u = 0;
                                                for (var i = 0; i < gridsud.store.getCount(); ++i) {
                                                    if (gridsud.store.getAt(i).get('FLAG') == "0") {
                                                        a1[k] = gridsud.store.getAt(i);
                                                        k++;
                                                    }
                                                }
                                                gridsud.getSelectionModel().select(a1);
                                                sb.disable();
                                                pdf.enable();
                                                Ext.getBody().unmask();
                                            }
                                        }
                                    })
                                }
                                Ext.getBody().unmask();
                            }
                        }})
                }},
            'viewport #subid': {
                select: function (combo, records, eOpts) {
                    var viewport = combo.up('viewport');
                    sb = viewport.query('#sb')[0];
                    pdf = viewport.query('#pdf')[0];
                    sb.disable();
                    pdf.disable();

                    comboGroup = viewport.query('#groid')[0];
                    gridsud = viewport.query('#gridstud')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    gridsud.store.load({
                        params: {
                            groid: comboGroup.getValue(),
                            vblid: records[0].get('VBLID')
                        },
                        callback: function (success) {
                            if (success) {
                                vblid = records[0].get('VBLID');
                                for (var i = 0; i < gridsud.store.getCount(); ++i) {
                                    gridsud.store.getAt(i).set('VBLID', vblid);
                                    gridsud.store.getAt(i).set('t', '0');
                                }
                                var a1 = [];
                                var k = 0;
                                var u = 0;
                                console.log(gridsud.store);
                                for (var i = 0; i < gridsud.store.getCount(); ++i) {
                                    if (gridsud.store.getAt(i).get('FLAG') == 0) {
                                        a1[k] = gridsud.store.getAt(i);
                                        k++;
                                    }
                                }
                                gridsud.getSelectionModel().select(a1);
                                Ext.getBody().unmask();
                                sb.disable();
                                pdf.enable();
                            }
                        }
                    })
                }},
            'viewport #gridstud': {
                select: function (grid, records, eOpts, store) {
                   /* var gridstud = grid.down('viewport');
                    sb = gridstud.query('#sb')[0];
                    pdf = gridstud.query('#pdf')[0];*/
                    sb = Ext.getCmp('sbb');
                    pdf = Ext.getCmp('pdff');
                    pdf.disable();
                    sb.enable();
                },
                deselect: function (grid, records, eOpts, store) {
                   /* var gridstud = grid.down('viewport');
                    sb = gridstud.query('#sb')[0];
                    pdf = gridstud.query('#pdf')[0];*/
                     sb = Ext.getCmp('sbb');
                     pdf = Ext.getCmp('pdff');
                    sb.enable();
                    pdf.disable();
                }
            },
            'viewport #sb': {
                click: function (grid, records, eOpts, store) {
                    var viewport = grid.up('viewport');
                    sb = viewport.query('#sb')[0];
                    pdf = viewport.query('#pdf')[0];
                    gridsud = viewport.query('#gridstud')[0];
                    var selmod1 = [];
                    var yyy;
                    selmod1 = gridsud.getSelectionModel().getSelection();//.length;
                    /*if (selmod1.length == 0){
                        for (var i = 0; i < gridsud.store.getCount(); ++i) {
                                gridsud.store.getAt(i).set('t', '0');
                        }
                    }*/
                    for (var i = 0; i < gridsud.store.getCount(); ++i) {
                            gridsud.store.getAt(i).set('FLAG', '1');
                    }
                    for (var i = 0; i < selmod1.length; ++i) {
                        yyy = gridsud.store.find('MANID', selmod1[i].get('MANID'));
                        gridsud.store.getAt(yyy).set('FLAG', '0');
                        gridsud.store.getAt(yyy).set('t', '1');
                    }
                    for (var i = 0; i < gridsud.store.getCount(); ++i) {
                        if (gridsud.store.getAt(i).get('t') != '1') {
                            gridsud.store.getAt(i).set('FLAG', '1');
                        }
                    }
                    if (gridsud.store.sync()) {
                        Ext.example.msg('Сохранение!', 'Изменения внесены!');
                        sb.disable();
                        pdf.enable();

                    }
                }
            },
            'viewport #pdf': {
                click: function (grid, records, eOpts, store) {
                    var viewport = grid.up('viewport');
                    pdf = viewport.query('#pdf')[0];
                    comboGroup = viewport.query('#groid')[0];
                    comboSub = viewport.query('#subid')[0];
                    //var a=comboSub.store.getAt(comboSub.store.find('COUID',comboSub.getValue)).get['VBLID'];
                   // console.log(a);

                    window.open('php/reportp_1.php?groid='+comboGroup.getValue()+'&vblid='+comboSub.getValue()+'&couname='+comboSub.getRawValue(),'_blank');
                    /*var viewport = grid.up('viewport');
                    pdf = viewport.query('#pdf')[0];
                    gridsud = viewport.query('#gridstud')[0];
                    var selmod1 = [];
                    var yyy;
                    selmod1 = gridsud.getSelectionModel().getSelection();//.length;
                    /*if (selmod1.length == 0){
                     for (var i = 0; i < gridsud.store.getCount(); ++i) {
                     gridsud.store.getAt(i).set('t', '0');
                     }
                     }
                    for (var i = 0; i < gridsud.store.getCount(); ++i) {
                        gridsud.store.getAt(i).set('FLAG', '1');
                    }
                    for (var i = 0; i < selmod1.length; ++i) {
                        yyy = gridsud.store.find('MANID', selmod1[i].get('MANID'));
                        gridsud.store.getAt(yyy).set('FLAG', '0');
                        gridsud.store.getAt(yyy).set('t', '1');
                    }
                    for (var i = 0; i < gridsud.store.getCount(); ++i) {
                        if (gridsud.store.getAt(i).get('t') != '1') {
                            gridsud.store.getAt(i).set('FLAG', '1');
                        }
                    }
                    var newstore= gridsud.store;


                    var proxy = Ext.create('Ext.data.AjaxProxy', {
                        type: 'ajax',
                            api: {
                            update: 'php/reportp_1.php'
                        },
                        reader: {
                            type: 'json',
                                root: 'rows'
                        },
                        writer: {
                            type: 'json',
                                allowSingle:false
                        },
                        appendId: false,
                            actionMethods: {
                            read   : 'POST',
                                update : 'POST'
                        }
                    });
                    newstore.setProxy(proxy);
                    console.log(newstore);
                    newstore.sync();*/
                    /*if (gridsud.store.sync()) {
                        Ext.example.msg('Сохранение!', 'Изменения внесены!');
                        //sb.disable();
                    }*/
                }
            }
        });
    }
});
