/**
 * Created by user on 18.12.14.
 */
Ext.define('AM.store.ListButtSt', {
    extend: 'Ext.data.Store',
    fields: ['BUTTID','BUTT'],
    data: [
        {"BUTTID": "1","BUTT":"Нагрузка по кафедрам"},
        {"BUTTID": "2","BUTT":"Нагрузка (итоговая/годовая)"},
        {"BUTTID": "3","BUTT":"Плановая численность ППС"},
        {"BUTTID": "4","BUTT":"Преподаватели - excel"}
    ]

});