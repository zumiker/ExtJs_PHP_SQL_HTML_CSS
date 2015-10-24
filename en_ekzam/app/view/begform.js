
Ext.define('AM.view.begform', {
    extend: 'Ext.form.Panel',
    name:'begform',
    itemId: 'begformid',
    alias: 'widget.begform',
       region:'center',
       layout: 'hbox',
       initComponent: function () {
       console.log('init formBeg');
        this.items = [{
            xtype: 'datefield',
            width: 450,
            name:'KOGDA',
            labelWidth: 150,
            editable: false,
           //padding: '0 0 0 10',
            queryMode: 'local',
            fieldLabel: 'Дата',
            itemId: 'begid',
            disabled: true,
            startDay: 1,

            format: 'd.m.Y'
        },
            {
                xtype: 'button',
                width:24,
                sortable: false,
                menuDisabled: true,
                style:"background-color:#ffffff !important; border-color: #ffffff; background-image:none !important;",
                iconCls:'icon_del',
                itemId:'sbrosid'

            },
        ];
       this.callParent(arguments);
    }
});
