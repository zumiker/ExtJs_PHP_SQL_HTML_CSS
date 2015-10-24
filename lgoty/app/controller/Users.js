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
                    comboVub.enable();
                    console.log(combo.getValue());
                },
                afterrender: function (combo, records, eOpts) {
                    combo.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                var viewport = combo.up('viewport');
                                comboVub = viewport.query('#vubid')[0];
                                report=viewport.query('#report')[0];
                                this.insert(0, {"FACID": 'null', "FAC": "Все Факультеты"}),
                                combo.setValue('null');
                                comboVub.enable();
                                if (comboVub.getValue()==null)
                                    comboVub.setValue("0");

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
