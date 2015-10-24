/**
 * Created by user on 18.05.15.
 */
Ext.define('AM.view.Panels', {
    extend: 'Ext.panel.Panel',
    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    typer:1,
    alias: 'widget.panels',
    initComponent: function() {
        this.items=[

                {
                    margin: '5 0 0 0',
                    padding:'0 0 0 1',
                    id:'7',
                    itemId:'shifr_grid',
                    xtype: 'gridRate',
                    store: 'ListShifrSt',
                    collapsible: true,
                    //border:true,
                    title: 'Расшифровка названий колонок',
                     //width:window.innerWidth - window.innerWidth/2,
                    typer: 0,
                    flex: 1

                },
                {
                    xtype:'gridRate',
                    margin:'5 0 0 0',
                    title:'Рейтинг кафедр',
                    itemId: 'rate_grid',
                    store: 'ListRateSt',
                    ///width:window.innerWidth/2,
                    typer: this.typer
                    //flex: 1
                }
            ];
        this.callParent();
    }
});