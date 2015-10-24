/*function c(){
    Ext.create('Ext.window.Window', {
        title: 'Hello',
        height: 200,
        width: 400,
        layout: 'fit',
        items: {  // Let's put an empty grid in just to illustrate fit layout
            xtype: 'grid',
            store: 'ListGridSt',
            border: false,
            id: 'gridan',
            draggable: false,
            columnLines: true,
            columns: [
                {xtype: 'rownumberer', width: 30, align: 'center' },
                //{header: 'Ставки', dataIndex: 'DIVABBREVIATE', width: 50},
                {header: 'Категория', dataIndex: 'STAT', width: 220},
                {header: 'Ставки', dataIndex: 'STAVKA', width: 220},
                {header: 'Всего ставок', dataIndex: 'PROF', width: 220},
                {header: 'Всего физ.лиц', dataIndex: 'DOC', width: 220},
                {header: 'Проф.', dataIndex: 'STAR', width: 220},
                {header: 'Доц.', dataIndex: 'PREP', width: 220},
                {header: 'Ст.Преп.', dataIndex: 'ASS', width: 220},
                {header: 'Преп.', dataIndex: 'PRIM', width: 220},
                {header: 'Асс.', dataIndex: 'STAVKA2', width: 220},
                {header: 'Примеч.', dataIndex: 'VSEGO', width: 220},
            ]
        }
    }).show();
}

*/



Ext.define('AM.view.GridStud', {
    extend: 'Ext.grid.Panel',
    name: 'studved',
    title: 'Нагрузка',
    alias: 'widget.gridStud',
    store: 'ListGridSt',
    region: 'center',
    itemId: 'gridstud',
    draggable: false,
    columnLines: true,
    columns: [
        {xtype: 'rownumberer', width: 30, align: 'center'},
        {header: 'Кафедра', dataIndex: 'DIVABBREVIATE', width: 220},
        {header: 'Статус', dataIndex: 'SS', align: 'center', width: 100, renderer: function (value, meta, record) {
            if (record.get('STATUS') == '1') {
                meta.style = "background-color:#B0FFC5;height:37";
            } else if (record.get('STATUS') == '0') {
                meta.style = "background-color:#FFB0C4;height:37";
            }
            return value;/*+"<br><input style='margin-right:15' onclick='Prep()' type='button' value='Преподаватели'>"*/
        }},
        //{xtype: 'datecolumn', header: 'Дата изменения', dataIndex: 'KOGDA', width: 120, format: 'DD-MM-YYYY HH:MI', cls: 'my', align: 'center'},
        {header: 'Дата изменения', dataIndex: 'KOGDA', width: 110, align: 'center' },
        {flex: 1, renderer: function(valuee, meta, record){
          //  div = record.get('DIVID');
            return  "<input style='margin-right:15' onclick='Prep()' type='button' value='Ставки'>" +
                    "<input style='margin-right:15' type='button' onclick='Spi()' value='Список преподавателей'>" +
                    "<input style='margin-right:15' type='button' onclick='Disp()' value='Диспетчерская'>" +
                    "<input style='margin-right:15' type='button' onclick='Oth()' value='Нагрузка'>"  +
                    "<input style='margin-right:15' type='button' onclick='Sear()' value='Выписка из семестрового плана'>" +
                    "<input type='button' onclick='Arch()' value='Архив'>";

        }
}
//        {header: 'Адрес', dataIndex: 'ADDRESS', flex: 1},


],
initComponent: function () {
    console.log('init gridstud');

    /* this.tbar = [

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
    //];
    this.callParent(arguments);
}
})
;

