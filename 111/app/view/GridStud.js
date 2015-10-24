Ext.define('AM.view.GridStud', {
    extend: 'Ext.grid.Panel',
    name:'studved',
    title: 'Студенты',
    alias: 'widget.gridStud',
    store: 'GridStudSt',
    region:'center',
    itemId: 'gridstud',
    draggable:false,
    columnLines: true,
    selType: 'checkboxmodel',
    selModel: {
        checkOnly: true,
        injectCheckbox: 0
    },
    columns: [
        {xtype: 'rownumberer', width: 30},
        {header: 'ФИО', dataIndex: 'FIO', flex: 1}
    ],
    initComponent: function () {
        console.log('init gridstud');
       
        this.tbar = [
            {
                text:'Сохранить',
                id:'sbb',
                action:'save',
                scale:'medium',
                disabled:true,
                iconCls:'icon_savee',
                // disabled:false,
                itemId:'sb'
            },
            {
                text:'Отчет',
                id:'pdff',
                action:'save',
                scale:'medium',
                disabled:true,
                iconCls:'icon_pdf',
                // disabled:false,
                itemId:'pdf'
            }
        ];
        this.callParent(arguments);
    }
});

