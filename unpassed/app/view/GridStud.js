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
    columns: [
        {xtype: 'rownumberer', width: 30},
        {header: 'Номер <br> личного дела', dataIndex: 'ABI_NUMBER', width:100,align:'center' },
        {header: 'ФИО', dataIndex: 'FIO_FULL', flex: 1},
        {header: 'Предмет', dataIndex: 'PREDMET', flex: 1},
        {header: 'Балл', dataIndex: 'BALL100', width:100},
        {header: 'Бюджет', dataIndex:'NIZ_B', width:100,
            renderer : function(value, meta) {
               // console.log(value)
            if((value)< 0) {
                meta.style = "background-color:red;";
            }
        }},
        {header: 'Коммерция',dataIndex:'NIZ_C',  width:100,
            renderer : function(value, meta) {
                //console.log(value)
                if((value)< 0) {
                    meta.style = "background-color:red;";
                }
            }}

    ],
    initComponent: function () {
        console.log('init gridstud');
       
        this.tbar = [
            {
                text:'Печать',
                //id:'sbb',
                action:'save',
                scale:'medium',
                disabled:true,
                iconCls:'icon_pdf',
               // disabled:false,
                itemId:'sb'
            }
        ];
        this.callParent(arguments);
    }
});

