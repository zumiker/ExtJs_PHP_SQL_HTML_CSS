/**
 * Created by user on 21.06.14.
 */
Ext.define('AM.store.ListStudSt', {
    extend: 'Ext.data.Store',
    fields: ['stid','stname'],
    data: [
        {"stid": "0","stname":"По Фамилии"},
        {"stid": "1","stname":"По предмету"}

    ]

});