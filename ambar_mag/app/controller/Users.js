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
    stores: ['ListFacSt', /*'ListGroSt',*/ 'ListSubSt','ListStudSt','SortirSt'],
    models: ['ListFacM', /*'ListGroM', */'ListSubM'],
    views: ['Viewport','endform','begform','buttonis'],
    init: function () {
        this.control({
            'viewport #facid': {
                select: function (combo, records, eOpts, grid) {
                    var viewport = combo.up('viewport');
                    comboVub = viewport.query('#vubid')[0];
                },
                afterrender: function (combo, records, eOpts) {
				
                    combo.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                var viewport = combo.up('viewport');
                                combo.setRawValue(this.getAt(0).get('FAC'));
                                combo.setValue(this.getAt(0).get('FACID'));
								comboVub = viewport.query('#vubid')[0];
								comboVub.setValue("0");
                            }
                        }
                    });
                }
            },
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
                click: function ( form,records, eOpts, store,sucess) {
                    var viewport = form.up('viewport');
                    comboVub = viewport.query('#vubid')[0];
                    comboFac = viewport.query('#facid')[0];
                    dateBeg = Ext.getCmp('startdt');
                    dateEnd = Ext.getCmp('enddt');
                    var b = comboVub.getValue();
                    var d = comboFac.getValue();
                    var e = dateBeg.getRawValue();
                    var f = dateEnd.getRawValue();
                    window.open('php/report1.php?divid='+d+'&dateb='+e+'&datee='+f+'&vub='+b+'&div='+comboFac.getRawValue());
                }},
                'viewport #reportokr': {
                    click: function ( form,records, eOpts, store,sucess) {
					console.log("ins");
                        var viewport = form.up('viewport');
                        comboVub = viewport.query('#vubid')[0];
                        comboFac = viewport.query('#facid')[0];
                        dateBeg = Ext.getCmp('startdt');
                        dateEnd = Ext.getCmp('enddt');
                        var b = comboVub.getValue();
                        var d = comboFac.getValue();
                        var e = dateBeg.getRawValue();
                        var f = dateEnd.getRawValue();
                        window.open('php/reportsokr.php?divid='+d+'&dateb='+e+'&datee='+f+'&vub='+b+'&div='+comboFac.getRawValue());

            }

                }});
    }
});
