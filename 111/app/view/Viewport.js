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
                        width: 270,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                      //  id:'fa',
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите факультет',
                        itemId: 'facid',
                        valueField: 'FACID',
                        displayField: 'FAC',
                        store: 'ListFacSt'
                    },
                    {
                        xtype: 'combo',
                        width: 310,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        //disabled:true,
                        fieldLabel: 'Выберите группу',
                        itemId: 'groid',
                        valueField: 'GROID',
                        displayField: 'GRO',
                        store: 'ListGroSt'
                    },
                    {
                        xtype: 'combo',
                        width: 600,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled:true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите предмет',
                        itemId: 'subid',
                        valueField: 'VBLID',
                        displayField: 'COUNAME',
                        store: 'ListSubSt'
                    }
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