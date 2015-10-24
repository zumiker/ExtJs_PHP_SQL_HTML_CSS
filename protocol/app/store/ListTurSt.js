/**
 * Created by user on 07.08.14.
 */
Ext.define('AM.store.ListTurSt', {
    extend: 'Ext.data.Store',
    fields: ['turid','turname'],
    data: [
      //  {"turid": "99","turname":"Выберите..."},
        {"turid": "0","turname":"Первый"},
        {"turid": "1","turname":"Второй"}

    ]
 //   autoLoad:true
});