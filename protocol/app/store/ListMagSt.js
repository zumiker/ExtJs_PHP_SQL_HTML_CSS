/**
 * Created by user on 10.11.14.
 */
Ext.define('AM.store.ListMagSt', {
    extend: 'Ext.data.Store',
    fields: ['magid','magname'],
    data: [
        //  {"turid": "99","turname":"Выберите..."},
        {"magid": "1","magname":"Бюджетный"},
        {"magid": "3","magname":"Коммерческий"}
       // {"magid": "4","magname":"Крым"},

    ]
    //   autoLoad:true
});