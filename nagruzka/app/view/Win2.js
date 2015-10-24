/**
 * Created by user on 13.12.14.
 */
/**
 * Created by user on 13.12.14.
 */
Ext.define('AM.view.Win2', {
    extend: 'Ext.window.Window', // создание окна
    title: 'Принято',
    alias: 'widget.Win2',
    itemId: 'win2',
    width: 250,
   // closable: false,
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
        console.log('init Win2');
        this.buttons = [
           /* {
                xtype:'grid',
                columnLines: true,
                columns: [
                    {xtype: 'rownumberer', width: 30, align:'center'},
                    {header: 'Кафедра',dataIndex:'DIVABBREVIATE',   width:220},
                    {header: 'Статус', dataIndex:'SS',align:'center', width:100},
                    //{xtype: 'datecolumn', header: 'Дата изменения', dataIndex: 'KOGDA', width: 120, format: 'DD-MM-YYYY HH:MI', cls: 'my', align: 'center'},
                    {header: 'Дата изменения',dataIndex:'KOGDA',width:130, align:'center' },
//        {header: 'Адрес', dataIndex: 'ADDRESS', flex: 1},


                ]
            },
*/

            {

                itemId:'retid',
                text: 'Вернуть'
            }
        ],

            this.callParent(arguments);
    }
});
