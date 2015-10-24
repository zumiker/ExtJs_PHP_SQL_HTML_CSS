
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
                        fieldLabel: 'Выберите факультет',
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
                        fieldLabel: 'Выберите конкурсную группу',
                        itemId: 'groid',
                        valueField: 'GROID',
                        displayField: 'GRO',
                        store: 'ListGroSt'
                    },
                    {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите специальность',
                        itemId: 'subid',
                        valueField: 'SPCID',
                        displayField: 'SPCNAME',
                        store: 'ListSubSt'
                    },
                    {
                        xtype: 'combo',
                        width: 500,
                        id:'aa',
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите абитуриента',
                        itemId: 'abid',
                        valueField: 'ABI_ID',
                        displayField: 'LASTNAME',
                        store: 'ListAbbSt'
                    },
                    {
                        xtype: 'combo',
                        width: 500,
                        labelWidth: 150,
                        padding: '0 0 0 10',
                        disabled: true,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите набор',
                        itemId: 'vubid',
                        valueField: 'stid',
                        displayField: 'stname',
                        store: 'ListStudSt'
                    },


                    {
                        xtype: 'button',
                        text: 'Печать',
                        width: 200,
                        //disabled: true,
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