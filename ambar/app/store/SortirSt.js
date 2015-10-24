/**
 * Created by user on 23.06.14.
 */
Ext.define('AM.store.SortirSt', {
    extend: 'Ext.data.Store',
    fields: ['sorid','sorname'],
    data: [
        {"sorid": "0","sorname":"По умолчанию"},
        {"sorid": "1","sorname":"По фамилии"},
        {"sorid": "2","sorname":"По приоритету"},
        {"sorid": "3","sorname":"По номеру личного дела"},
        {"sorid": "4","sorname":"По дате рождения"}
    ]

});