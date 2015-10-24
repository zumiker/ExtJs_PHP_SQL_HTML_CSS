Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListGroSt', 'GridStudSt'],
    models: ['ListFacM', 'ListGroM','GridStudM'],
    views: ['Viewport', 'GridStud'],
    init: function () {
        this.control({
            'viewport #facid': {
                select: function (combo, records, eOpts, grid) {
                    var viewport = combo.up('viewport');
                    sb = viewport.query('#sb')[0];
                    comboGroup = viewport.query('#groid')[0];
                    gridsud = viewport.query('#gridstud')[0];
                    gridsud.store.clearFilter();
                    comboGroup.enable();
                    comboGroup.reset();
                    gridsud.store.load();
                    Ext.getBody().mask('Загрузка данных...');
                    comboGroup.store.load({
                        params: {
                            facid: combo.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {



                                if(comboGroup.store.getCount()==1){
                                    comboGroup.setValue(comboGroup.store.getAt(0).get('GROID'));
                                    gridsud.store.load({
                                        params: {
                                            facid: combo.getValue(),
                                            groid:  comboGroup.store.getAt(0).get('GROID')
                                        },
                                        callback: function (records, options, success) {
                                            if (success) {
                                                if(gridsud.store.getCount()==0){
                                                    sb.disable();
                                                }
                                                else{
                                                    sb.enable();}
                                                Ext.getBody().unmask();
                                            }}
                                    })
                                }
                                else{
                                    //console.log(0);
                                    gridsud.store.load({
                                        params: {
                                            facid:combo.getValue()
                                        },
                                        callback: function (records, options, success) {
                                            if (success) {
                                                if(gridsud.store.getCount()==0){
                                                    sb.disable();
                                                }
                                                else{
                                                    sb.enable();}
                                                Ext.getBody().unmask();
                                            }}
                                    })
                                }

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
                                gridsud = viewport.query('#gridstud')[0];
                                sb = viewport.query('#sb')[0];
                                gridsud.store.clearFilter();
                                combo.setRawValue(this.getAt(0).get('FAC'));
                                combo.setValue(this.getAt(0).get('FACID'));
                                Ext.getBody().mask('Загрузка данных...');
                                comboGroup.store.load({
                                    params: {
                                        facid: this.getAt(0).get('FACID')
                                    },
                                    callback: function (records, options, success) {
                                        if (success) {



                                            if(comboGroup.store.getCount()==1){
                                                comboGroup.setValue(comboGroup.store.getAt(0).get('GROID'));
                                            gridsud.store.load({
                                                params: {
                                                    facid:combo.getValue(),
                                                    groid:  comboGroup.store.getAt(0).get('GROID')
                                                },
                                                callback: function (records, options, success) {
                                                    if (success) {

                                                        if(gridsud.store.getCount()==0){
                                                            sb.disable();
                                                        }
                                                        else{
                                                            sb.enable();}
                                                        Ext.getBody().unmask();
                                                    }}
                                            })
                                            }
                                            else{
                                                gridsud.store.load({
                                                    params: {
                                                        facid:combo.getValue()
                                                    },
                                                    callback: function (records, options, success) {
                                                        if (success) {
                                                            if(gridsud.store.getCount()==0){
                                                                sb.disable();
                                                            }
                                                            else{
                                                                sb.enable();}
                                                            Ext.getBody().unmask();
                                                        }}
                                                })
                                            }

                                        }

                                    }});
                            }
                        }
                    });
                }
            },
            'viewport #groid':{
          /*     afterrender:function(combo){
                  var viewport = combo.up('viewport');
                  gridsud = viewport.query('#gridstud')[0];
                  sb = viewport.query('#sb')[0];
                  combo.setValue('0');
                  Ext.getBody().mask('Загрузка данных...');
                  gridsud.store.load({
                        params: {
                            napid: combo.getValue()
                        },
                      callback: function (records, options, success) {
                          if (success) {
                              console.log(gridsud.store);
                              if(gridsud.store.getCount()==0){
                                  sb.disable();
                              }
                              else{
                                  sb.enable();
                              }
                              Ext.getBody().unmask();

                          }
                      }
                    })
                },

            select: function(combo){
                var viewport = combo.up('viewport');
                gridsud = viewport.query('#gridstud')[0];
                sb = viewport.query('#sb')[0];
                Ext.getBody().mask('Загрузка данных...');
                gridsud.store.load({
                    params: {
                        napid: combo.getValue()
                    },
                    callback: function (records, options, success) {
                        if (success) {
                            console.log(gridsud);
                            if(gridsud.store.getCount()==0){
                                sb.disable();
                            }
                            else{
                                sb.enable();
                            }
                            Ext.getBody().unmask();
                        }
                    }
                })
            }
            },*/
                select: function(combo){
                    var viewport = combo.up('viewport');
                    gridsud = viewport.query('#gridstud')[0];
                    sb = viewport.query('#sb')[0];
                    gridsud.store.clearFilter();
                    //Ext.getBody().mask('Загрузка данных...');
                    /*gridsud.store.load({
                        params: {
                            groid: combo.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                if(gridsud.store.getCount()==0){
                                    sb.disable();
                                }
                                else{
                                    sb.enable();
                                }
                                Ext.getBody().unmask();
                            }
                        }
                    })*/
                    sb.disable();
                    gridsud.store.filter(function(rec){
                        //console.log(rec.get('CON_ID'));
                       // var counter=0;
                       if(rec.get('CON_ID')==combo.getValue()){
                          // counter++;
                           sb.enable();
                         return true;}


                        //if()}
                    })
                }
            },
            'viewport #sb': {
                click: function (grid, records, eOpts, store) {
                    var viewport = grid.up('viewport');
                    comboGroup = viewport.query('#groid')[0];
                    comboFac = viewport.query('#facid')[0];
                    window.open('php/reportp.php?groid=' + comboGroup.getValue()+'&facid='+comboFac.getValue(),'_blank')
                }
            }
        });
    }
});
