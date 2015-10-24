Ext.apply(Ext.form.field.VTypes, {
    daterange: function (val, field) {
        var date = field.parseDate(val);


        if (!date) {

            return false;
        }
        if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
            var start = field.up('form').up('form').down('#' + field.startDateField);
            start.setMaxValue(date);
            start.validate();

            this.dateRangeMax = date;
        }
        else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
            var end = field.up('form').up('form').down('#' + field.endDateField);
            end.setMinValue(date);
            end.validate();

            this.dateRangeMin = date;
        }
        return true;
    },
    daterangeText: 'Начальная дата должна быть меньше конечной'
});
Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListGroSt', 'ListSubSt','ListStudSt','SortirSt'],
    models: ['ListFacM', 'ListGroM', 'ListSubM'],
    views: ['Viewport','endform','begform'],
    init: function () {
        this.control({
            'viewport #facid': {
                select: function (combo, records, eOpts, grid) {
                    var viewport = combo.up('viewport');
                    comboGroup = viewport.query('#groid')[0];
                   // comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    comboSor = viewport.query('#sortid')[0];
                    report=viewport.query('#report')[0];
                    report.disable();
                    comboGroup.enable();
                    comboGroup.reset();
                    //comboSub.reset();
                    //comboSub.disable();
                  //  comboVub.reset();
                    comboVub.disable();
                    //comboSor.reset();
                    comboSor.disable();
                    //Ext.getCmp('startdt').reset();
                    //Ext.getCmp('enddt').reset();
                    Ext.getCmp('startdt').disable();
                    Ext.getCmp('enddt').disable();
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
                 //   comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    comboSor = viewport.query('#sortid')[0];
                    report=viewport.query('#report')[0];
                    comboVub.enable();
                    if (comboVub.getValue()==null)
                        comboVub.setValue("0");
                    // comboSor.reset();
                    comboSor.enable();
                    console.log(comboSor.getValue());
                    if (comboSor.getValue()==null)
                        comboSor.setValue("0");
                    var dar = new Date();
                    var mm = dar.getMonth()+1;
                    if(mm<10){
                        mm="0"+mm;
                    }
                    var dd = dar.getDate();
                    if(dd<10){
                        dd="0"+dd;
                    }
                    var yyyy = dar.getFullYear();

                    var das =  dd + "." + mm + "." + yyyy;
                    Ext.getCmp('startdt').enable();
                    if(Ext.getCmp('enddt').getValue()!=null)
                        Ext.getCmp('enddt').enable();
                    if(Ext.getCmp('startdt').getValue()==null)
                        Ext.getCmp('startdt').setRawValue(das);
                    report.enable();
                    //Ext.getCmp('enddt').enable();



                   // comboSub.reset();
                  //  comboSub.enable();


                    /*Ext.getBody().mask('Загрузка данных...');
                    comboSub.store.load({
                        params: {
                            groid: combo.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                if(comboSub.store.getCount()==1){
                                   comboSub.setRawValue(comboSub.store.getAt(0).get('SPCNAME'));
                                   comboSub.setValue(comboSub.store.getAt(0).get('SPCID'));
                                    comboVub.enable();
                                   if (comboVub.getValue()==null)
                                        comboVub.setValue("0");
                                   // comboSor.reset();
                                    comboSor.enable();
                                    console.log(comboSor.getValue());
                                    if (comboSor.getValue()==null)
                                        comboSor.setValue("0");
                                    var dar = new Date();
                                    var mm = dar.getMonth()+1;
                                    if(mm<10){
                                        mm="0"+mm;
                                    }
                                    var dd = dar.getDate();
                                    if(dd<10){
                                        dd="0"+dd;
                                    }
                                    var yyyy = dar.getFullYear();

                                    var das =  dd + "." + mm + "." + yyyy;
                                    Ext.getCmp('startdt').enable();
                                    if(Ext.getCmp('enddt').getValue()!=null)
                                        Ext.getCmp('enddt').enable();
                                    if(Ext.getCmp('startdt').getValue()==null)
                                        Ext.getCmp('startdt').setRawValue(das);
                                    report.enable();
                                    //Ext.getCmp('enddt').enable();
                                }

                                Ext.getBody().unmask();

                            }
                        }});*/
                    report.enable();
                }},
            /*'viewport #subid': {
                select: function (combo, records, eOpts) {
                    var viewport = combo.up('viewport');
                    comboVub = viewport.query('#vubid')[0];
                    comboSor = viewport.query('#sortid')[0];
                    report=viewport.query('#report')[0];
                    //comboVub.reset();
                    comboVub.enable();
                    //comboVub.reset();
                    comboVub.enable();
                    if (comboVub.getValue()==null)
                     comboVub.setValue("0");
                  //  comboSor.reset();
                    comboSor.enable();
                    console.log(comboSor.getValue());
                    if (comboSor.getValue()==null)
                    comboSor.setValue("0");
                    var dar = new Date();
                    var mm = dar.getMonth()+1;
                    if(mm<10){
                        mm="0"+mm;
                    }
                    var dd = dar.getDate();
                    if(dd<10){
                        dd="0"+dd;
                    }
                    var yyyy = dar.getFullYear();

                    var das =  dd + "." + mm + "." + yyyy;
                    Ext.getCmp('startdt').enable();
                    if(Ext.getCmp('enddt').getValue()!=null)
                        Ext.getCmp('enddt').enable();
                    if(Ext.getCmp('startdt').getValue()==null)
                        Ext.getCmp('startdt').setRawValue(das);
                    report.enable();
                    var yyyyy=Ext.getCmp('startdt').getValue();
                    if(yyyyy!=""){console.log(  yyyyy);
                        Ext.getCmp('startdt').setRawValue(das);}
                    //report.enable();
                   // Ext.getCmp('enddt').enable();
                }
            },*/
            'viewport #sbrosid': {
                click: function ( form,records, eOpts, store,sucess) {
                    var viewport = form.up('viewport');
                    report=viewport.query('#report')[0];
                    Ext.getCmp('startdt').reset();
                    Ext.getCmp('enddt').reset();
                    Ext.getCmp('enddt').disable();
                    //report.disable();
                }

            },
            'viewport #esbrosid': {
                click: function ( form,records, eOpts, store,sucess) {
                    var viewport = form.up('viewport');
                    report=viewport.query('#report')[0];
                    Ext.getCmp('enddt').reset();
                    //report.disable();
                }

            },
            'viewport #report': {
                click: function ( button,records, eOpts, store,sucess) {
                    var viewport = button.up('viewport');
                 //   comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    comboSor = viewport.query('#sortid')[0];
                    comboGro = viewport.query('#groid')[0];
                    comboFac = viewport.query('#facid')[0];
                    dateBeg = Ext.getCmp('startdt');
                    dateEnd = Ext.getCmp('enddt');
                   // var a = comboSub.getValue();
                    var b = comboVub.getValue();
                    var c = comboSor.getValue();
                    var d = comboFac.getValue();
                    var e = dateBeg.getRawValue();
                    var f = dateEnd.getRawValue();
                    var g = comboGro.getValue();
                    window.open('php/report.php?divid='+d+'&groid='+g+/*'&subid='+a+*/'&dateb='+e+'&datee='+f+'&sor='+c+'&vub='+b);
                }
            }

        });
    }
});
