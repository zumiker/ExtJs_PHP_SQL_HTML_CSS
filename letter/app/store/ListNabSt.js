Ext.define('AM.store.ListNabSt', {
    extend: 'Ext.data.Store',
    fields: ['nabid','nabname'],
    data: [
        // {"vubid": "99","vubname":"Выберите..."},
        {"nabid": "0","nabname":"Все"},
        {"nabid": "1","nabname":"Бюджет"},
        {"nabid": "2","nabname":"Целевой"},
        {"nabid": "3","nabname":"Коммерческий"},
        {"nabid": "4","nabname":"Контракт"}

    ]

});