/**
 * Created by user on 11.06.15.
 */
Ext.define('AM.model.ListGridM', {
    extend: 'Ext.data.Model',
    fields: ['GOROD', 'CONGROUP','PREDMET','CLOCK','CON_ID','ID_PR','PRIORITET', {name: 'KOGDA', type:'date', dateFormat: 'd.m.Y'}]
});