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
    stores: ['ListFacSt', 'ListStudSt'],
    models: ['ListFacM'],
    views: ['Viewport', 'begform','endform'],
    init: function () {
        this.control({
            'viewport #facid': {
                select: function (combo, records, eOpts, grid) {
                    var viewport = combo.up('viewport');
                    comboVub = viewport.query('#vubid')[0];
                    report=viewport.query('#report')[0];
                    //report.disable();
                    comboVub.enable();
                  //  Ext.getCmp('startdt').enable();
                    //Ext.getCmp('enddt').disable();
                },
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
                              /*  var dar = new Date();
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
                                report.enable();*/
                            }
                        }
                    });
                }
            },
            'viewport #sbrosid': {
                click: function ( button,records, eOpts, store,sucess) {
                    Ext.getCmp('startdt').reset();
                    Ext.getCmp('enddt').reset();
                    Ext.getCmp('enddt').disable();
                }

            },
            'viewport #esbrosid': {
                click: function ( button,records, eOpts, store,sucess) {
                    Ext.getCmp('enddt').reset();
                }

            },
            'viewport #report': {
                click: function ( button,records, eOpts, store,sucess) {

                    var viewport = button.up('viewport');
                    comboSub = viewport.query('#subid')[0];
                    comboVub = viewport.query('#vubid')[0];
                    comboSor = viewport.query('#sortid')[0];
                    comboGro = viewport.query('#groid')[0];
                    comboFac = viewport.query('#facid')[0];
                    dateBeg = Ext.getCmp('startdt');
                    dateEnd = Ext.getCmp('enddt');
                   var a = comboFac.getRawValue();
                    var b = comboVub.getValue();
                    var d = comboFac.getValue();
                    var e = dateBeg.getRawValue();
                    var f = dateEnd.getRawValue();
                    window.open('php/report.php?divid='+d+'&dateb='+e+'&datee='+f+'&vub='+b+'&div='+a);
                }
            }

        });
    }
});
