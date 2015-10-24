
Ext.define('AM.view.Viewport', {
    extend: 'Ext.container.Viewport',
    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    alias: 'widget.viewport',
    defaults: {
        border: false
    },
    initComponent: function () {
        this.items = [
            {
                //
                xtype: 'form',
                layout: 'vbox',
                items: [
                    {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите Факультет',
                        itemId: 'facid',
                        valueField: 'FACID',
                        displayField: 'FAC',
                        store: 'ListFacSt'
                    },
                    {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        //disabled:true,
                        fieldLabel: 'Выберите Конкурсную Группу',
                        itemId: 'groid',
                        valueField: 'GROID',
                        displayField: 'GRO',
                        store: 'ListGroSt'
                    },
                   /* {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите Специальность',
                        itemId: 'subid',
                        valueField: 'SPCID',
                        displayField: 'SPCNAME',
                        store: 'ListSubSt'
                    },*/
                    {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите Абитуриентов',
                        itemId: 'vubid',
                        valueField: 'stid',
                        displayField: 'stname',
                        store: 'ListStudSt'
                    },
                    {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Сортировка',
                        itemId: 'sortid',
                        valueField: 'sorid',
                        displayField: 'sorname',
                        store: 'SortirSt'
                    },
                    {
                        xtype: 'label',
                        width: 500,
                        padding: '0 0 0 10',
                        html: "<h1 align=center>Для того, чтобы получить отчёт на конкретный<br> промежуток времени, введите дату</h1>"
                    },
                    {
                        xtype:'begform'
                    },
                    {
                        xtype:'endform'
                    },
                 /*   {
                        xtype: 'datefield',
                        width: 500,
                        labelWidth: 150,
                        editable: false,
                        padding: '0 0 0 10',
                        queryMode: 'local',
                        fieldLabel: 'Промежуток с',
                        //itemId: 'begid',
                        disabled: true,
                        startDay: 1,
                        id: 'startdt',
                        vtype: 'daterange',
                        endDateField: 'enddt',
                        format: 'd.m.Y',
                        listeners:{
                            select:function(field){

                                var viewport = field.up('viewport');
                                report=viewport.query('#report')[0];
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
                                var swe=field.getRawValue();
                                var ss="";
                                for (var i=0;i<2;++i)
                                    ss+=swe[i];
                                var sos="";
                                for (var i=3;i<5;++i)
                                    sos+=swe[i];
                                var soso="";
                                for (var i=6;i<10;++i)
                                    soso+=swe[i];

                                if(soso<yyyy){
                                    Ext.getCmp('enddt').enable();
                                    //report.disable();
                                }
                                else
                                    if(soso==yyyy )
                                        if(sos<mm){
                                            Ext.getCmp('enddt').enable();
                                           // report.disable();
                                        }
                                        else
                                            if(sos==mm)
                                                 if(ss<dd){
                                                     Ext.getCmp('enddt').enable();
                                                     report.disable();
                                                 }
                                                 else
                                                    if(ss==dd){
                                                        Ext.getCmp('enddt').disable();
                                Ext.getCmp('enddt').reset();


                                                       report.enable();}
                                                    else{
                                                        Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                                        field.setRawValue(das);
                                                        Ext.getCmp('enddt').disable();
                                                        Ext.getCmp('enddt').reset();
                                                        report.enable();
                                                    }

                                        else{
                                    Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                    field.setRawValue(das);
                                                Ext.getCmp('enddt').disable();
                                                Ext.getCmp('enddt').reset();
                                                report.enable();
                                }
                                    else{
                                    Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                    field.setRawValue(das);
                                        Ext.getCmp('enddt').disable();
                                        Ext.getCmp('enddt').reset();
                                        report.enable();
                                }


                            }
                        }

                    },*/
                 /*   {
                        xtype: 'datefield',
                        width: 500,
                        editable: false,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        queryMode: 'local',
                        fieldLabel: 'по',
                        disabled: true,
                        // itemId: 'endid',
                        startDay: 1,
                        id: 'enddt',
                        //   allowBlank:true,
                        format: 'd.m.Y',
                        listeners:{
                            select:function(field){
                                var viewport = field.up('viewport');
                                report=viewport.query('#report')[0];
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
                                var swe=field.getRawValue();
                                var ss="";
                                for (var i=0;i<2;++i)
                                        ss+=swe[i];
                                var sos="";
                                for (var i=3;i<5;++i)
                                    sos+=swe[i];
                                var soso="";
                                for (var i=6;i<10;++i)
                                    soso+=swe[i];
                              // console.log(soso);
                                if(soso<yyyy)
                                    report.enable();
                                else
                                if(soso==yyyy )
                                    if(sos<mm)
                                        report.enable();
                                    else
                                    if(sos==mm)
                                        if(ss<dd)
                                            report.enable();
                                        else
                                        if(ss==dd)
                                            report.enable();
                                        else{
                                            Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                            field.setRawValue(das);
                                            report.enable();
                                        }

                                    else{
                                        Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                        field.setRawValue(das);
                                        report.enable();
                                    }
                                else{
                                    Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                    field.setRawValue(das);
                                    report.enable();
                                }
                            }
                        }

                    },*/
                    {
                        xtype: 'button',
                        text: 'Печать',
                        width: 200,
                        disabled: true,
                        // formBind: true,
                        itemId: 'report',
                        margin: '10 0 0 310',
                        queryMode: 'local'
                    }
                ]
            }

        ];


        this.callParent(arguments);
    }
})
;