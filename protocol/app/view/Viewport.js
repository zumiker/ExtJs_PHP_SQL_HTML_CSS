
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
                        xtype:'tabpanel',
                        activeTab: 0,
                        //width: 600,
                       // height: 250,
                        plain: true,
                        defaults :{
                            autoScroll: true,
                            bodyPadding: 10
                        },
                        items: [
                            {
                                title:'Бакалавриат',
                                itemId:'bakaid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите Этап',
                                        itemId: 'sturid',
                                        valueField: 'turid',
                                        displayField: 'turname',
                                        store: 'ListTurSt'
                                    },
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
                                        disabled: true,
                                        editable: false,
                                        id:'f',
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите конкурсную <br> группу',
                                        itemId: 'conid',
                                        valueField: 'CONID',
                                        displayField: 'CONNAME',
                                        store: 'ListConGroupSt'
                                    }, {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        editable: false,
                                        queryMode: 'local',
                                        //  triggerAction: 'all',
                                        disabled:'true',
                                        fieldLabel: 'Выберите отчет',
                                        itemId: 'repid',
                                        valueField: 'REPID',
                                        displayField: 'REP',
                                        store: 'ListRepSt'
                                    }, {
                                        xtype: 'combo',
                                        width: 500,
                                        id:'vvv',
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        disabled:'true',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите формат<br> отчет',
                                        itemId: 'vubid',
                                        valueField: 'vubid',
                                        displayField: 'vubname',
                                        store: 'ListVubSt'
                                    },
                                    {
                                        xtype: 'checkbox',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        disabled:'true',
                                        //editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Подлинник',
                                        itemId: 'podlid'
                                        // valueField: 'vubid',
                                        // displayField: 'vubname',
                                        //   store: 'ListVubSt'
                                    },
                                    {
                                        xtype: 'checkbox',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        disabled:'true',
                                        //editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Телефон',
                                        itemId: 'phoneid'
                                        // valueField: 'vubid',
                                        // displayField: 'vubname',
                                        //   store: 'ListVubSt'
                                    },
                                    {
                                        xtype: 'checkbox',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        disabled:'true',
                                        //editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'С направлением',
                                        itemId: 'napravid'
                                        // valueField: 'vubid',
                                        // displayField: 'vubname',
                                        //   store: 'ListVubSt'
                                    },
                                    {
                                        xtype: 'checkbox',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        disabled:'true',
                                        //editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'С подвалом',
                                        itemId: 'podvalid'
                                        // valueField: 'vubid',
                                        // displayField: 'vubname',
                                        //   store: 'ListVubSt'
                                    },
                                    {
                                        xtype: 'button',
                                        text: 'Печать',
                                        disabled:'true',
                                        width: 200,
                                        itemId: 'report',
                                        margin: '10 0 0 312',
                                        queryMode: 'local'
                                    }
                                ]

                        },
                        {
                            title:'Магистратура',
                            itemId:'magaid',
                            items:[

                                {
                                    xtype: 'combo',
                                    width: 500,
                                    labelWidth: 150,
                                    padding: '0 0 0 10',
                                    editable: false,
                                    queryMode: 'local',
                                    fieldLabel: 'Выберите форму',
                                    disabled: true,
                                    itemId: 'formid',
                                    valueField: 'formid',
                                    displayField: 'formname',
                                    store: 'ListFormSt'
                                },
                                {
                                    xtype: 'combo',
                                    width: 500,
                                    labelWidth: 150,
                                    padding: '0 0 0 10',
                                    editable: false,
                                    queryMode: 'local',
                                    fieldLabel: 'Выберите набор',
                                    itemId: 'magistid',
                                    valueField: 'magid',
                                    displayField: 'magname',
                                    store: 'ListMagSt'
                                },


                                {
                                    xtype: 'checkbox',
                                    width: 500,
                                    labelWidth: 150,
                                    padding: '0 0 0 10',
                                    disabled:'true',
                                    queryMode: 'local',
                                    fieldLabel: 'С указанием программы',
                                    itemId: 'progid'
                                    // valueField: 'vubid',
                                    // displayField: 'vubname',
                                    //   store: 'ListVubSt'
                                },
                                {
                                    xtype: 'button',
                                    text: 'Печать',
                                    disabled:'true',
                                    width: 200,
                                    itemId: 'reportid',
                                    margin: '10 0 0 312',
                                    queryMode: 'local'
                                }
                            ]

                        },
                            {
                                title:'Заочники',
                                width:500,
                              //  html: "Печать отчета...",
                                itemId:'zaochid'
                            }
                    ]
                    }
                ]
            }

        ];


        this.callParent(arguments);
    }
})
;