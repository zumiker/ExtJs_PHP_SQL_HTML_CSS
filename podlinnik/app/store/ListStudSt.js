/**
 * Created by user on 21.06.14.
 */
Ext.define('AM.store.ListStudSt', {
    extend: 'Ext.data.Store',
    fields: ['stid','stname'],
    data: [
        {"stid": "0","stname":"Все"},
        {"stid": "1","stname":"Бюджет"},
        {"stid": "2","stname":"Целевой"},
        {"stid": "3","stname":"Коммерция"}
    ]

});