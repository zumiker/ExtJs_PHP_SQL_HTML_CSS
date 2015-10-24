/**
 * Created by user on 22.12.14.
 */
Ext.define('AM.view.Win_Spi2', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Добавить группу',
    alias: 'widget.Win_Spi2',
    itemId: 'win_spi2',
    height: 240,
    // autoHeight: 'true',
    width: 520,
    modal: true,
    closable: false,
    closeAction: 'hide',
    //autoScroll: true,
    //layout: 'fit',
    items: [
        {
            xtype:'form',
            width: '100%',
            height: '100%',
            autoScroll: true,
            layout: {
                type: 'vbox',
                padding: '10px'},
            items:[
                {
                    xtype: 'combo',
                    width: 450,
                    // autoHeight: 'true',
                    labelWidth: 150,
                    //padding: '10 0 0 10',
                    editable: false,
                    queryMode: 'local',
                    fieldLabel: 'Конкурсная группа',
                    itemId: 'comid',
                    valueField: 'CON_ID',
                    displayField: 'CONGROUP',
                    store: 'ListSpi1St'

                },
                {
                    xtype: 'combo',
                    width: 450,
                    disabled: true,
                    // autoHeight: 'true',
                    labelWidth: 150,
                    //padding: '10 0 0 10',
                    editable: false,
                    queryMode: 'local',
                    fieldLabel: 'Предмет',
                    itemId: 'prid',
                    valueField: 'ID_PR',
                    displayField: 'PREDMET',
                    store: 'ListVubSt'

                },
                {
                    xtype: 'textfield',
                    width: 450,
                    disabled: true,
                    // autoHeight: 'true',
                    labelWidth: 150,
                    //padding: '10 0 0 10',
                    editable: false,
                    queryMode: 'local',
                    fieldLabel: 'Приоритет',
                    itemId: 'priorid'
                },
                {
                    xtype: 'begform'
                },
                {
                    xtype: 'textfield',
                    width: 450,
                    disabled: true,
                    // autoHeight: 'true',
                    labelWidth: 150,
                    padding: '5 0 0 0',
                    editable: false,
                    queryMode: 'local',
                    fieldLabel: 'Время',
                    itemId: 'timeid',
                    value: '9-00'

                },

            ],
            buttons: [
                {
                    text: 'Сохранить',
                    itemId: 'add'

                },
                {
                    text: 'Отмена',
                    itemId: 'zakid'

                }
            ]
        }

       /* {
            xtype: 'gridStud',
            flex: 1,
            typer: 1,
            height: 395
        }

        /*{
         xtype: 'grid',
         border: false,
         itemId: 'gridi',
         // store: 'ListSpiSt',
         columnLines: true,
         columns: [
         {xtype: 'rownumberer', width: 30, align: 'center' },
         {header: 'ФИО', dataIndex: 'FIO_PREPOD', flex:1, align: 'left'},
         {header: 'Должность', dataIndex: 'DOL', flex:1, align: 'center'},
         {header: 'Степень', dataIndex: 'STEPEN', flex:1, align: 'center'},
         {header: 'Звание', dataIndex: 'ZVAN',flex:1, align: 'center'},
         {header: 'Категория', dataIndex: 'STAT', flex:1, align: 'center'},
         {header: 'Ставка', dataIndex: 'STAVKA', flex:1, align: 'center'},
         ]
         }*/
    ]

})
;