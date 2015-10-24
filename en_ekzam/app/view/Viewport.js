
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
                //xtype: 'form',
                //layout: 'vbox',
                items: [
                    {

                        xtype: 'combo',
                        width: 450,
                        // autoHeight: 'true',
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Конкурсная группа',
                        itemId: 'vubid',
                        valueField: 'CON_ID',
                        displayField: 'CONGROUP',
                        store: 'ListSpiSt'

                    },
                    {
                        xtype: 'gridStud',
                        flex: 1,
                        height: 1000,
                        store: 'ListGridSt',
                        itemId: 'gridstud',
                        typer: 0
                    },
                    {
                        xtype:'Win_Spi'
                    },
                    {
                        xtype:'Win_Spi2'
                    }

                ]
            }

        ];


        this.callParent(arguments);
    }
})
;