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
                layout: 'hbox',
                items: [
                    {
                        xtype: 'combo',
                        width: 400,
                        labelWidth: 200,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите конкурсную группу',
                        itemId: 'groupid',
                        valueField: 'GROID',
                        displayField: 'GRONAME',
                        store: 'ListGroSt'
                    },
                    {
                        xtype: 'combo',
                        width: 310,
                        labelWidth: 150,
                        padding: '0 0 0 20',
                        editable: false,
                        queryMode: 'local',
                        disabled:true,
                        fieldLabel: 'Выберите набор',
                        itemId: 'nabid',
                        valueField: 'nabid',
                        displayField: 'nabname',
                        store: 'ListNabSt'
                    },
                    {
                        xtype: 'checkbox',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 15',
                        disabled:'true',
                        queryMode: 'local',
                        fieldLabel: 'Зачислены',
                        itemId: 'zachid'
                        // valueField: 'vubid',
                        // displayField: 'vubname',
                        //   store: 'ListVubSt'
                    },
                ]
            },

            {
                margin: '5 0 0 0',
                xtype: 'gridStud',
                flex: 1
            },

        ];


        this.callParent(arguments);
    }
})
;