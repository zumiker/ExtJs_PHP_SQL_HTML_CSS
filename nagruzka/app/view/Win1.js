/**
 * Created by user on 13.12.14.
 */
Ext.define('AM.view.Win1', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Закрыто',
    alias: 'widget.Win1',
    itemId: 'win1',
    width: 250,
    //closable: false,
    autoScroll: true,           // скроллинг если текст не влезает.
    bodyStyle: 'background-color:#fffffff', // прямое указание стиля для содержимого окна
    closeAction: 'hide',        // !!! Важно. Указание на то, что окно при закрывании
    shadow: true,               // тень
    resizable: false,            // возможность изменения размеров окна.
    draggable: true,            // возможность перетаскивания окна.
    //modal: true,
    headerPosition: 'top',


    /**/
    initComponent: function () {
        console.log('init Win1');
        this.buttons = [
           {

                itemId:'prinid',
                text: 'Принять'
            },
            {
                itemId:'openid',
                text: 'Открыть'
            }
        ],

        this.callParent(arguments);
    }
});


