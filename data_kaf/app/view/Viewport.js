
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
                        width: window.innerWidth,
                        items: [
                            {
                                title:'Бурцева',
                                itemId:'burcid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        xtype:'panels'

                                    }
                                ]
                        },
                            {
                                title:'Голубева',
                                itemId:'golubid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'gol_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'gol_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 3
                                        //flex: 1
                                    }
                                ]
                            },
                            {
                                title:'Голунов',
                                itemId:'golid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'golun_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'golun_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 3
                                        //flex: 1
                                    }
                                ]
                            },/*
                            {
                                title:'Гуревич',
                                itemId:'gurid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    }]
                            },
                            {
                                title:'Егоров',
                                itemId:'egorid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        xtype: 'gridRate',
                                        typer: 2,
                                        flex: 1

                                    }]
                            },
                            {
                                title:'Зиновьева',
                                itemId:'zinid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    }]
                            },*/
                            {
                                title:'Кибовская',
                                itemId:'kibid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'kib_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'kib_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 1
                                        //flex: 1
                                    }
                                ]
                            },
                           /* {
                                title:'Кошелев',
                                itemId:'koshid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '0 0 0 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    }]
                            },*/
                           /* {
                                title:'Макаров',
                                itemId:'makid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'mak_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'mak_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 1
                                        //flex: 1
                                    }
                                ]
                            },
                            {
                                title:'Мурадов',
                                region:'north',
                                itemId:'muraid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        region:'east',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'mur_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'mur_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 8
                                        //flex: 1
                                    }
                                ]
                            },
                            {
                                title:'Поплетеева',
                                itemId:'poplid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'pop_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'pop_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 2
                                        //flex: 1
                                    }
                                ]
                            },
                            {
                                title:'Пятибратов',
                                itemId:'pyatid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'pyat_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'pyat_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 1
                                        //flex: 1
                                    }
                                ]
                            },
                            {
                                title:'Юдовская',
                                itemId:'ydoid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'ud_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'ud_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 1
                                        //flex: 1
                                    }
                                ]
                            },
                            {
                                title:'Янченко',
                                itemId:'yanid',
                                items:[
                                    {
                                        xtype: 'combo',
                                        width: 500,
                                        labelWidth: 150,
                                        padding: '10 0 10 10',
                                        editable: false,
                                        queryMode: 'local',
                                        fieldLabel: 'Выберите факультет',
                                        itemId:'facid',
                                        store:'ListFacSt',
                                        valueField:'FACID',
                                        displayField:'FACNAME'
                                    },
                                    {
                                        margin: '5 0 0 0',
                                        padding:'0 0 0 1',
                                        id:'7',
                                        itemId:'yan_shifr_grid',
                                        xtype: 'gridRate',
                                        store: 'ListShifrSt',
                                        collapsible: true,
                                        //border:true,
                                        title: 'Расшифровка названий колонок',
                                        //width:window.innerWidth - window.innerWidth/2,
                                        typer: 0,
                                        flex: 1

                                    },
                                    {
                                        xtype:'gridRate',
                                        margin:'5 0 0 0',
                                        title:'Рейтинг кафедр',
                                        itemId: 'yan_rate_grid',
                                        store: 'ListRateSt',
                                        ///width:window.innerWidth/2,
                                        typer: 1
                                        //flex: 1
                                    }
                                ]
                            },*/

                    ]
                    }
                ]
            }

        ];


        this.callParent(arguments);
    }
})
;