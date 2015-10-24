/**
 * Created by user on 30.06.14.
 */
Ext.define('AM.view.begform', {
    extend: 'Ext.form.Panel',
    name:'begform',
    itemId: 'begformid',
    alias: 'widget.begform',
    region:'center',
    layout: 'hbox',
    initComponent: function () {
        console.log('init formBeg');
        this.items = [ {
            xtype: 'datefield',
            width: 500,
            labelWidth: 150,
            editable: false,
            padding: '0 0 0 10',
            queryMode: 'local',
            fieldLabel: 'Промежуток с',
            //itemId: 'begid',
            disabled: false,
            startDay: 1,
            id: 'startdt',
            vtype: 'daterange',
            endDateField: 'enddt',
            format: 'd.m.Y',
            listeners:{
                select:function(field){


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
                                //report.disable();
                            }
                            else
                            if(ss==dd){

                                Ext.getCmp('enddt').reset();
                            }
                            else{
                                Ext.example.msg('Внимание!', 'Промежуток с должен быть меньше текущей даты!');
                                field.setRawValue(das);
                                //  Ext.getCmp('enddt').disable();
                                Ext.getCmp('enddt').reset();
                                //report.enable();
                            }
                    var sisa=Ext.getCmp('enddt').getRawValue();
                    var sisa1=Ext.getCmp('enddt').getRawValue();


                    if(sisa==sisa1)
                        Ext.getCmp('enddt').reset();



                }
            }

        },
            {
                xtype: 'button',
                width:24,
                sortable: false,
                menuDisabled: true,
                style:"background-color:#ffffff !important; border-color: #ffffff; background-image:none !important;",
                iconCls:'icon_del',
                itemId:'sbrosid'

            },
        ];
        this.callParent(arguments);
    }
});
