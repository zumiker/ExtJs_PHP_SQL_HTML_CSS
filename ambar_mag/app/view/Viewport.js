
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
                        disabled: false,
                        editable: false,
                        queryMode: 'local',
                        fieldLabel: 'Выберите Абитуриентов',
                        itemId: 'vubid',
                        valueField: 'stid',
                        displayField: 'stname',
                        store: 'ListStudSt'
                    },
                 {
                        xtype: 'label',
                        width: 500,
                        padding: '0 0 0 10',
                        html: "<h1 align=center>Для того, чтобы получить отчёт на конкретный<br> промежуток времени, введите дату</h1>"
                    },
                    {
                        xtype:'begform'
                    },
                    {
                        xtype:'endform'
                    },
                
                    {
                        xtype: 'buttonis'
                        /*,
                        text: 'Печать',
                        width: 200,
                        disabled: false,
                        // formBind: true,
                        itemId: 'report',
                        margin: '10 0 0 310',
                        queryMode: 'local'
  */                  }
                ]
            }

        ];


        this.callParent(arguments);
    }
})
;