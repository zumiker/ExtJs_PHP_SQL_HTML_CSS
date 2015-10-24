
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
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите Сортировку',
                        itemId: 'vubid',
                        valueField: 'stid',
                        displayField: 'stname',
                        store: 'ListStudSt'
                    },
                    {
                        xtype: 'button',
                        text: 'Печать',
                        width: 200,
                        itemId: 'report',
                        margin: '10 0 0 330',
                        queryMode: 'local'
                    }
                ]
            }

        ];


        this.callParent(arguments);
    }
})
;