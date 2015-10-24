/**
 * Created by user on 22.12.14.
 */
Ext.define('AM.view.Win_Spi', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Преподаватели',
    alias: 'widget.Win_Spi',
    itemId: 'win_spi',
    height: 450,
   // autoHeight: 'true',
    width: 970,
    modal: true,
    closable: false,
    closeAction: 'hide',
    autoScroll: true,
    layout: 'fit',
    items: [
        {
            xtype: 'grid',
            border: false,
            itemId: 'gridi',
            store: 'ListSpiSt',
            columnLines: true,
            columns: [
                {xtype: 'rownumberer', width: 30, align: 'center' },
                {header: 'ФИО', dataIndex: 'FIO_PREPOD', width: 250, align: 'left'},
                {header: 'Должность', dataIndex: 'DOL', flex:1, align: 'center'},
                {header: 'Степень', dataIndex: 'STEPEN', width: 100, align: 'center'},
                {header: 'Звание', dataIndex: 'ZVAN', width: 100, align: 'center'},
                {header: 'Категория', dataIndex: 'STAT', width: 200, align: 'center'},
                {header: 'Ставка', dataIndex: 'STAVKA', width: 100, align: 'center'},
            ]
        }],
    buttons: [
        {
            text: 'Закрыть',
            itemId:'zakid'

        }
    ]
})
;