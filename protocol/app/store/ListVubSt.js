/**
 * Created by user on 24.09.14.
 */
Ext.define('AM.store.ListVubSt', {
    extend: 'Ext.data.Store',
    fields: ['vubid','vubname'],
    data: [
       // {"vubid": "99","vubname":"Выберите..."},
        {"vubid": "0","vubname":"PDF"},
        {"vubid": "1","vubname":"Excel"}

    ]

});