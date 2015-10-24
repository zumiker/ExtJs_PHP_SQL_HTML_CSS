Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListGroSt', 'ListNabSt', 'GridStudSt'],
    models: ['ListGroM','GridStudM'],
    views: ['Viewport', 'GridStud'],
    init: function () {
        this.control({
            'viewport #groupid':{
                afterrender:function(combo){
                    var viewport = combo.up('viewport');
                    comboNab = viewport.query('#nabid')[0];
                    checkZach = viewport.query('#zachid')[0];
                    gridStud = viewport.query('#gridstud')[0];
                    //console.log(gridStud.store.data);
                    //comboNab.setValue('0');
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback:function(success){
                            if(success){
                                combo.setValue(combo.store.getAt(0));
                                comboNab.setValue('0');
                                comboNab.enable();
                                checkZach.enable();

                                gridStud.store.load({
                                    params:{
                                        con_id: combo.getValue(),
                                        filter: comboNab.getValue()

                                    },
                                    callback: function (records, options, success) {
                                        if (success){


                                        }
                                    }


                                })
                                Ext.getBody().unmask();
                            }
                        }
                    })
                },
                select:function(combo){
                    var viewport = combo.up('viewport');
                    comboNab = viewport.query('#nabid')[0];
                    gridStud = viewport.query('#gridstud')[0];
                    checkZach = viewport.query('#zachid')[0];

                    var prover=0;
                    if(checkZach.getValue()==true){
                        prover=1;
                    }else{
                        prover=0;
                    }
                    //comboNab.setValue('0');
                    comboNab.enable();

                    Ext.getBody().mask('Загрузка данных...');
                    gridStud.store.load({
                        params:{
                            con_id: combo.getValue(),
                            filter:comboNab.getValue(),
                            zach:prover
                        },
                        callback: function (records, options, success) {
                            if (success){

                                Ext.getBody().unmask();
                            }
                        }


                    })

                }
            },
            'viewport #nabid':{
                select:function(combo){

                    var viewport = combo.up('viewport');
                    comboCon = viewport.query('#groupid')[0];
                    gridStud = viewport.query('#gridstud')[0];
                    checkZach = viewport.query('#zachid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    var prover=0;
                    if(checkZach.getValue()==true){
                        prover=1;
                    }else{
                        prover=0;
                    }
                    gridStud.store.load({
                        params:{
                            con_id: comboCon.getValue(),
                            filter:combo.getValue(),
                            zach:prover
                        },
                        callback: function (records, options, success) {
                            if (success){

                                Ext.getBody().unmask();
                            }
                        }})
                }
            },
            'viewport #zachid':{
                change:function(checkbox){
                    var viewport = checkbox.up('viewport');
                    gridStud = viewport.query('#gridstud')[0];
                    comboNab = viewport.query('#nabid')[0];
                    comboGroup = viewport.query('#groupid')[0];
                    var prover=0;
                    if(checkbox.getValue()==true){
                        prover=1;
                    }else{
                        prover=0;
                    }
                    gridStud.store.load({
                    params:{
                        zach:prover,
                        con_id: comboGroup.getValue(),
                        filter: comboNab.getValue()
                    }
                    });

                    /*gridStud.store.clearFilter();
                    gridStud.store.filter(function(rec){
                        if(combo.getValue()=='0')
                            return true;
                        else
                        if(rec.get('NABOR')==combo.getValue()){
                            return true;
                        }
                    })
                }*/
            }},
            'viewport #gridstud': {
                select: function (grid, records, eOpts, store) {
                    ot = Ext.getCmp('ot');

                    ot.enable();
                },
                deselect: function (selmod, records, eOpts, store) {
                    ot = Ext.getCmp('ot');
                    selmod1 = selmod.getSelection().length;
                    if(selmod1==0)
                    ot.disable();
                }
            },
            'viewport #ot':{
                click:function(button){
                    var viewport = button.up('viewport');
                    gridStud = viewport.query('#gridstud')[0];
                    var mas=[];
                    var selmod=[];
                    selmod = gridStud.getSelectionModel().getSelection();
                    var kk=0;
                    for(var i=0;i<selmod.length;i++){
                        mas[i]=selmod[i].get('ABI_ID');
                    }
                    /*console.log(selmod);
                    console.log(selmod[0]);
                    console.log(selmod[0].get('FIO'));
                    console.log(mas);*/
                    mass = Ext.encode(mas);
                    window.open('php/report1.php?mas='+mass,'_blank');
                }
            }
        });
    }
});
