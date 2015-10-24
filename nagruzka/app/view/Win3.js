/**
 * Created by user on 13.04.15.
 */
Ext.define('AM.view.Win3', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Архив',
    alias: 'widget.Win3',
    itemId: 'win3',
    width: 250,
    modal:true,
    //closable: false,
    autoScroll: true,           // скроллинг если текст не влезает.
    bodyStyle: 'background-color:#fffffff', // прямое указание стиля для содержимого окна
    closeAction: 'hide',        // !!! Важно. Указание на то, что окно при закрывании
    shadow: true,               // тень
    resizable: false,            // возможность изменения размеров окна.
    draggable: true,            // возможность перетаскивания окна.
    //modal: true,
    headerPosition: 'top',
    initComponent: function () {
        console.log('init Win3');
        this.buttons = [
            {
                itemId:'arch_disp',
                text: 'Диспетчерская'
            },
            {
                itemId:'arch_nagr',
                text: 'Нагрузка'
            }
        ],

            this.callParent(arguments);
    }
});
