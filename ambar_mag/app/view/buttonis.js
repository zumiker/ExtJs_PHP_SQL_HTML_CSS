/**
 * Created by user on 01.08.14.
 */
Ext.define('AM.view.buttonis', {
    extend: 'Ext.form.Panel',
    name:'buttonis',
    itemId: 'buttonisid',
    alias: 'widget.buttonis',
    region:'center',
    layout: 'hbox',
    initComponent: function () {
        console.log('init buttons');
        this.items = [{

            xtype: 'button',
            text: "Полный отчет",
            //width: 200,
            disabled: false,
            // formBind: true,
            itemId: 'report',
            margin: '10 0 0 250',
            queryMode: 'local'
        },
            {
                xtype: 'button',
                text: "Сокращенный отчет",
                //width: 200,
                disabled: false,
                // formBind: true,
                itemId: 'reportokr',
                margin: '10 0 0 20',
                queryMode: 'local'
            }
        ];
        this.callParent(arguments);
    }
});