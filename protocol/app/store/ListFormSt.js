/**
 * Created by user on 11.11.14.
 */
Ext.define('AM.store.ListFormSt', {
    extend: 'Ext.data.Store',
    fields: ['formid','formname'],
    data: [
        // {"vubid": "99","vubname":"Выберите..."},
        {"formid": "1","formname":"Очная"},
        {"formid": "2","formname":"Вечерняя"},
        {"formid": "4","formname":"Крым"}
    ]

});