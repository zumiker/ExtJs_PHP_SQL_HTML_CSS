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
       // {xtype: 'rownumberer', width: 30},
        {header: '№ л.д.', align:'center', dataIndex: 'ABI_NUMBER', width:80},
        {header: 'ФИО', dataIndex: 'FIO', width:300},
        {header: 'Почтовый индекс', dataIndex: 'POSTINDEX',width:120, align:'center' },
      //  {header: 'Город', dataIndex: '', flex: 1},
        {header: 'Адрес', dataIndex: 'ADDRESS', flex: 1},


    ],
    initComponent: function () {
        console.log('init gridstud');
       
        this.tbar = [
            {
                text:'Печать',
                id:'ot',
                action:'save',
                scale:'medium',
                disabled:true,
                iconCls:'icon_let',
                // disabled:false,
                itemId:'ot'
            },
            /*{
                text:'Отчет',
                id:'pdff',
                action:'save',
                scale:'medium',
                disabled:true,
                iconCls:'icon_pdf',
                // disabled:false,
                itemId:'pdf'
            }*/
        ];
        this.callParent(arguments);
    }
});

