/**
 * Created by user on 20.12.14.
 */
Ext.define('AM.view.Win_prep', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Преподаватели',
    alias: 'widget.Win_prep',
    itemId: 'win_prep',
    autoHeight: 'true',
    width: 870,
    height: 450,
    modal: true,
    id:'wind',
    closable: false,
    closeAction: 'hide',
    layout: 'fit',
    items: [
        {
            xtype: 'grid',
            border: false,
            itemId: 'gridan',
            store: 'ListGridWinSt',
            //    draggable: false,
            columnLines: true,
            columns: [
                {xtype: 'rownumberer', width: 30, align: 'center' },
                {header: 'Категория', dataIndex: 'STAT', width: 200, align: 'left'},
                {header: 'Ставки', dataIndex: 'STAVKA', width: 70, align: 'center'},
                {header: 'Всего <br> ставок', dataIndex: 'SUM_STAVKA', width: 70, align: 'center'},
                {header: 'Всего<br>  физ.лиц', dataIndex: 'VSEGO', width: 70, align: 'center'},
                {header: 'Проф.', dataIndex: 'PROF', width: 70, align: 'center'},
                {header: 'Доц.', dataIndex: 'DOC', width: 70, align: 'center'},
                {header: 'Ст.Преп.', dataIndex: 'STAR', width: 70, align: 'center'},
                {header: 'Преп.', dataIndex: 'PREP', width: 70, align: 'center'},
                {header: 'Асс.', dataIndex: 'ASS', width: 70, align: 'center'},
                {header: 'Примеч.', dataIndex: 'PRIM', width: 70, align: 'center'}
            ]
}],  // Let's put an empty grid in just to illustrate fit layout
buttons: [
    {
        text: 'Закрыть',
        itemId:'zakid'

    }
]
})
;