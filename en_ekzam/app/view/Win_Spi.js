/**
 * Created by user on 22.12.14.
 */



Ext.define('AM.view.Win_Spi', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Добавить группу',
    alias: 'widget.Win_Spi',
    itemId: 'win_spi',
    height: 500,
    // autoHeight: 'true',
    width: 900,
    modal: true,
    closable: false,
    closeAction: 'hide',
    //autoScroll: true,
    layout: {
        type: 'hbox'
    },
    items: [
       /* {
            xtype: 'Form_Spi'
        },*/
        {
            xtype: 'form',
            itemId: 'gridform',
            width: '80%',
            //height: '100%',
            autoScroll: true,
            layout: {
                type: 'vbox'},
                //padding: '10px'
            items: [
                {
                    xtype: 'combo',
                    width: 450,
                    // autoHeight: 'true',
                    labelWidth: 150,
                    padding: '5 0 5 10',
                    editable: false,
                    queryMode: 'local',
                    fieldLabel: 'Конкурсная группа',
                    itemId: 'vubid1',
                    valueField: 'CON_ID',
                    displayField: 'CONGROUP',
                    store: 'ListSpi1St'

                },
                {
                    xtype: 'gridStud',
                    height: 440,
                    itemId:'grisha',
                    width: 580,
                    typer: 1,
                    store: {
                        xtype:'store',
                        model: 'AM.model.ListGridM',
                        //autoLoad: true,
                        proxy: {
                            type: 'ajax',
                            url: 'php/get_grid.php',
                            reader: {
                                type: 'json',
                                root: 'rows'
                            }
                        }
                    }
                }
            ]


        }
    ],
    buttons:[{
        text: 'Закрыть',
        itemId: 'zaka'
    }]
})
;