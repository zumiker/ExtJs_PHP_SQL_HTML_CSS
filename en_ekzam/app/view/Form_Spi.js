/**
 * Created by user on 20.06.15.
 */
Ext.define('AM.view.Form_Spi', {
    extend: 'Ext.form.Panel', // создание окна
    alias: 'widget.Form_Spi',
    width: '100%',
    height: '100%',
    itemId: 'formid',
    autoScroll: true,
    layout: {
    type: 'vbox',
        padding: '10px'},
    items:[
        {
            xtype: 'combo',
            width: 450,
            name:'CON_ID',
            labelWidth: 150,
            //padding: '10 0 0 10',
            editable: false,
            labelSeparator: '<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span>',
            queryMode: 'local',
            fieldLabel: 'Конкурсная группа',
            itemId: 'comid',
            valueField: 'CON_ID',
            displayField: 'CONGROUP',
            allowBlank: false,
            readOnly: true,
            store: 'ListSpi1St'

        },
        {
            xtype: 'textfield',
            width: 450,
            disabled: true,
            name:'GOROD',
            readOnly: true,
            //maskRe:/[]/i, //только числа
            //maskRe:/[1-9]/i, //только числа
            labelWidth: 150,
            //labelSeparator: '<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span>',
            //allowBlank: false,
            //padding: '10 0 0 10',
            editable: false,
            queryMode: 'local',
            fieldLabel: 'Город',
            itemId: 'gorodid'
        },
        {
            xtype: 'combo',
            name:'ID_PR',
            width: 450,
            disabled: true,
            // autoHeight: 'true',
            labelWidth: 150,
            //padding: '10 0 0  10',
            editable: false,
            queryMode: 'local',
            fieldLabel: 'Предмет',
            labelSeparator: '<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span>',
            itemId: 'prid',
            valueField: 'ID_PR',
            displayField: 'PREDMET',
            allowBlank: false,
            readOnly: true,
            store: 'ListVubSt'

        },
        {
            xtype: 'textfield',
            width: 450,
            disabled: true,
            name:'PRIORITET',
            maskRe:/[1-9]/i, //только числа
            labelWidth: 150,
            labelSeparator: '<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span>',
            allowBlank: false,
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
            name:'CLOCK',
            // autoHeight: 'true',
            labelWidth: 150,
            padding: '5 0 0 0',
            editable: false,
            queryMode: 'local',
            fieldLabel: 'Время',
            itemId: 'timeid',
            vtype: 'passNumber',
            //maskRe:/^-?[0-9]{1,}$/,//а вот здесь непозволяет вводить "-"
            //regex:/^\-{0,1}[0-9]{1,}$/, //здесь все правильно, подсвечивает если неправильный формат
            value: '9-00'

        },

    ],
    buttons: [
        {
            text: 'Сохранить',
            formBind: true,
            itemId: 'add'

        },
        {
            text: 'Отмена',
            itemId: 'zakid'

        }

]
});