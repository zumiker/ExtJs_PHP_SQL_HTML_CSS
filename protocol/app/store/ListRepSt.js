/**
 * Created by user on 24.09.14.
 */
Ext.define('AM.store.ListRepSt', {
    extend: 'Ext.data.Store',
    fields: ['REPID','REP','PROVREP'],
    data: [
        {"REPID": "1","REP":"Бюджет",PROVREP:"0"},
        {"REPID": "3","REP":"Коммерция",PROVREP:"0"},
        {"REPID": "2","REP":"Целевой",PROVREP:"1"},// открыто только при $role_id=1;
        {"REPID": "4","REP":"УВЦ",PROVREP:"1"},// открыто только при $role_id=1;
        {"REPID": "9","REP":"ОПК",PROVREP:"1"},// открыто только при $role_id=1;
        {"REPID": "10","REP":"Беслан",PROVREP:"1"},// открыто только при $role_id=1;

       // {"REPID": "8","REP":"Бюджет с направлениями",PROVREP:"0"},
     //   {"REPID": "3","REP":"Подлинники, бюджет",PROVREP:"0"},
       // {"REPID": "6","REP":"Подлинники, коммерция",PROVREP:"0"},
        //{"REPID": "14","REP":"Подлинники, целевой",PROVREP:"1"},// открыто только при $role_id=1;
        //{"REPID": "4","REP":"Подлинники, бюджет с напавлениями",PROVREP:"0"},
       // {"REPID": "7","REP":"Бюджет с подвалом",PROVREP:"0"},
        //{"REPID": "7","REP":"30 июля, без целевого",PROVREP:"0"},




       // {"REPID": "11","REP":"Целевой",PROVREP:"1"},
        {"REPID": "6","REP":"31 июля, без целевого",PROVREP:"1"},// открыто только при $role_id=1;
        {"REPID": "5","REP":"31 июля, с целевым",PROVREP:"1"},// открыто только при $role_id=1;
       // {"REPID": "12","REP":"Подвал (Бюджет, 2 этап)",PROVREP:"1"},// открыто только при $role_id=1;

        //{"REPID": "15","REP":"31 июля, без целевого",PROVREP:"1"},



    ]

});