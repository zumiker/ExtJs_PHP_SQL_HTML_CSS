var flag = 0;
var passNumberVType = {
    passNumber: function(val, field){
        var passNumberRegex = /^\d{1,2}\-\d{2}$/;
        return passNumberRegex.test(val);
    },
    passNumberText: 'Не правильный формат (XX(X)-XX)',
    passNumberMask: /[\d\-]/
};

Ext.apply(Ext.form.field.VTypes, passNumberVType);

Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListGridSt', 'ListSpiSt', 'ListSpi1St', 'ListVubSt'],
    models: ['ListGridM', 'ListSpiM', 'ListVubM'],
    views: ['Viewport', 'GridStud', 'Win_Spi', 'begform', 'Win_Spi2','Form_Spi'],
    init: function () {
        this.control({
            'viewport #gridstud': {
                afterrender: function (th) {
                    alert('fds');
                    Ext.getBody().mask('Загрузка данных...');
                    var viewport = th.up().up('viewport');
                    var combo = viewport.query('#vubid')[0];
                    th.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                combo.store.load({
                                    params: {
                                        vub: 0
                                    },
                                   callback: function (records, options, success) {
                                        if (success) {

                                            combo.setValue('0');
                                            Ext.getBody().unmask();
                                        }
                                    }
                                });

                            }
                        }
                    })
                },
                celldblclick: function (th, td, cellIndex, record) {
                    var viewport = th.up('viewport');
                    var win = viewport.query('#win_spi')[0];
                    var forma = viewport.query('#formid')[0].getForm();
                    var combo = viewport.query('#comid')[0];
                    var comboPr = viewport.query('#prid')[0];
                    forma.reset();
                    viewport.query('#priorid')[0].enable();
                    viewport.query('#prid')[0].enable();
                    viewport.query('#begid')[0].enable();
                    viewport.query('#timeid')[0].enable();
                    viewport.query('#gorodid')[0].enable();
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        params: {
                            vub: 1
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                comboPr.store.load({
                                    params: {vub: 1},
                                    callback: function (records, options, success) {
                                        if (success) {
                                            Ext.getBody().unmask();

                                        }
                                    }
                                });

                            }
                        }
                    });


                    forma.loadRecord(record);
                    flag = 1;
                    win.show();
                }
            },
            'viewport #zaka': {
                click:function(th){
                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win_spi')[0];
                    var grid = viewport.query('#grisha')[0];
                    viewport.query('#vubid1')[0].reset();
                    grid.store.clearFilter();
                    grid.store.filter(function (record) {
                       return false;

                    });
                    win.hide();
                }
            },
            'viewport #vubid1': {
                afterrender: function(th){
                    var viewport = th.up().up('viewport');
                    var grid = viewport.query('#grisha')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    grid.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                grid.store.clearFilter();
                                // if (th.getValue() != '0')
                                grid.store.filter(function (record) {
                                    if (record.get('CON_ID') == th.getValue())
                                        return true;

                                });
                                Ext.getBody().unmask();

                            }
                        }
                    });
                },
                select:function(th){
                    var viewport = th.up().up('viewport');
                    var grid = viewport.query('#grisha')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    grid.store.clearFilter();
                               // if (th.getValue() != '0')
                                    grid.store.filter(function (record) {
                                        if (record.get('CON_ID') == th.getValue())
                                            return true;

                                    });
                                Ext.getBody().unmask();


                }
            },
            'viewport #add': {
                click: function (th) {
                    var viewport = th.up('viewport');
                    var forma = viewport.query('#formid')[0].getForm();
                    var grid = viewport.query('#gridstud')[0];
                    var win = viewport.query('#win_spi')[0];
                    if (forma.isValid()) {
                        forma.updateRecord();
                        forma.submit({
                            waitMsg: 'Идет отправка...',
                            url: 'php/save.php?flag=' + flag,
                            submitEmptyText: false,
                            success: function () {
                                Ext.getBody().mask('Загрузка данных...');
                                grid.store.load({
                                    callback: function (rec, op, suc) {
                                        if (suc) {
                                            win.hide();
                                            Ext.getBody().unmask();

                                        }
                                    }

                                });
                            }


                        });


                    }
                    else
                        Ext.example.msg('Внимание', 'Ошибка! Не заполнены обязательные поля!');


                }
            },
            'viewport #groadd': {
                click: function (th) {
                    flag = 0;

                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win_spi')[0];
                    var combo = viewport.query('#comid')[0];

                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        params: {
                            vub: 1
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                Ext.getBody().unmask();
                                console.log(combo.store);
                                win.show();
                            }
                        }
                    });


                }
            },
            'viewport #subadd': {
                click: function (th) {

                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win_spi2')[0];
                    var combo = viewport.query('#comid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        params: {
                            vub: 1
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                Ext.getBody().unmask();
                                console.log(combo.store);
                                win.show();
                            }
                        }
                    });


                }
            },
            'viewport #vubid': {
                select: function (th, rec) {
                    var viewport = th.up('viewport');
                    var grid = viewport.query('#gridstud')[0];
                    //console.log(th.getValue());
                    grid.store.clearFilter();
                    if (th.getValue() != '0')
                        grid.store.filter(function (record) {
                            if (record.get('CON_ID') == th.getValue())
                                return true;

                        });

                }
            },
            'viewport #prid': {
                select: function (th, rec) {
                    var viewport = th.up('viewport');
                    var textPrior = viewport.query('#priorid')[0];
                    var date = viewport.query('#begid')[0];
                    var time = viewport.query('#timeid')[0];
                    textPrior.enable();
                    date.enable();
                    time.enable();

                }
            },
            'viewport #sbrosid': {
                click: function (th, rec) {
                    var viewport = th.up('viewport');
                    var date = viewport.query('#begid')[0];
                    date.reset();

                }
            },
            'viewport #comid': {
                select: function (th, rec) {
                    var viewport = th.up('viewport');
                    var com = viewport.query('#prid')[0];
                    com.enable();
                    Ext.getBody().mask('Загрузка данных...');
                    com.store.load({
                        params: {
                            con_id: th.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                Ext.getBody().unmask();
                            }
                        }

                    })

                }
            },

            'viewport #zakid': {
                click: function (th) {

                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win_spi')[0];
                    var forma = viewport.query('#formid')[0];
                    forma.getForm().reset();

                    win.hide();

                }
            }


        });
    }
});
