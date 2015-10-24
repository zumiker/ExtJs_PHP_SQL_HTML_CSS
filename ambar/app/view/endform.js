/**
 * Created by user on 30.06.14.
 */
/**
 * Created by user on 29.06.14.
 */

Ext.define('AM.view.endform', {
    extend: 'Ext.form.Panel',
    name:'endform',
    padding:'5 0 0 0',
    itemId: 'endformid',
    alias: 'widget.endform',
    region:'center',
    layout: 'hbox',
    initComponent: function () {
        console.log('init formEnd');
        this.items = [
            {
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
                                    console.log();
                                //Ext.getCmp('startdt').reset();
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

                        if(Ext.getCmp('startdt').getRawValue()==Ext.getCmp('enddt').getRawValue())
                            Ext.getCmp('enddt').reset();
                    }
                }

            },,
            {
                xtype: 'button',
                width:24,
                sortable: false,
                menuDisabled: true,
                style:"background-color:#ffffff !important; border-color: #ffffff; background-image:none !important;",
                iconCls:'icon_del',
                itemId:'esbrosid'

            },
        ];
        this.callParent(arguments);
    }
});