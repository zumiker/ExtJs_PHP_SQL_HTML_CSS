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
                layout: 'vbox',
                items: [
                    {
                        xtype: 'combo',
                        width: 450,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите семестр',
                        itemId: 'studyid',
                        valueField: 'STUDYID',
                        displayField: 'STUDY',
                        store: 'ListStudySt'
                    },
                    {
                        xtype: 'combo',
                        width: 450,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        //disabled:true,
                        fieldLabel: 'Выберите факультет',
                        itemId: 'facid',
                        valueField: 'FACID',
                        displayField: 'FAC',
                        store: 'ListFacSt'
                    },
                    {
                        xtype: 'combo',
                        width: 450,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        //disabled:true,
                        fieldLabel: 'Выберите отчет',
                        itemId: 'buttid',
                        valueField: 'BUTTID',
                        displayField: 'BUTT',
                        store: 'ListButtSt'
                    },{
                        xtype: 'button',
                        text: 'Сформировать',
                        disabled:'true',
                        width: 200,
                        itemId: 'reportid',
                        margin: '10 0 0 260',
                        queryMode: 'local'
                    }
                ]
            },

            {
                margin: '5 0 0 0',
                xtype: 'gridStud',
                flex: 1
            },
            {
                xtype:'Win1'
            },
            {
                xtype:'Win2'
            },
            {
                xtype:'Win3'
            },
            {
                xtype:'Win_prep'
            },
            {
                xtype:'Win_Spi'
            }

        ];


        this.callParent(arguments);
    }
})
;