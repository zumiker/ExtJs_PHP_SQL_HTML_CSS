/*function c(){
    Ext.create('Ext.window.Window', {
        title: 'Hello',
        height: 200,
        width: 400,
        layout: 'fit',
        items: {  // Let's put an empty grid in just to illustrate fit layout
            xtype: 'grid',
            store: 'ListGridSt',
            border: false,
            id: 'gridan',
            draggable: false,
            columnLines: true,
            columns: [
                {xtype: 'rownumberer', width: 30, align: 'center' },
                //{header: 'Ставки', dataIndex: 'DIVABBREVIATE', width: 50},
                {header: 'Категория', dataIndex: 'STAT', width: 220},
                {header: 'Ставки', dataIndex: 'STAVKA', width: 220},
                {header: 'Всего ставок', dataIndex: 'PROF', width: 220},
                {header: 'Всего физ.лиц', dataIndex: 'DOC', width: 220},
                {header: 'Проф.', dataIndex: 'STAR', width: 220},
                {header: 'Доц.', dataIndex: 'PREP', width: 220},
                {header: 'Ст.Преп.', dataIndex: 'ASS', width: 220},
                {header: 'Преп.', dataIndex: 'PRIM', width: 220},
                {header: 'Асс.', dataIndex: 'STAVKA2', width: 220},
                {header: 'Примеч.', dataIndex: 'VSEGO', width: 220},
            ]
        }
    }).show();
}

*/



Ext.define('AM.view.GridRate', {
    extend: 'Ext.grid.Panel',
//    title: 'Рейтинг кафедр',
    alias: 'widget.gridRate',
    autoHeight: true,
    draggable: false,
    columnLines: true,
    typer:1,
   /* tbar:[
        {
            text:"Сохранить"
        }
    ],*/
initComponent: function() {
    if(this.typer>0){
        this.columns = [{header:"<style='align:left'>Кафедра", dataIndex: 'DIVNAME', width: 400}];
        this.tbar = [{text:"Сохранить"}];
        //this.width = 400;
        //console.log('init grid');
        for(var i=1;i<=this.typer;i++){
                this.columns.push({header: i, width: 80,dataIndex:i});
               // this.width += 80;
        }
        //this.height = 800;



    }
    else{
        console.log(this.store);
       /* this.tbar = [{xtype: 'label',margin:'24 0 0 0',
            html: " "}];*/
        this.columns = [{xtype: 'rownumberer',header:"№", width: 30},
            {header:"Название колонок",dataIndex:'COMMENTS',flex:1}];
       //
       // this.height = 800;
    }


    /* this.tbar = [

    /*{
     text:'Отчет',
     id:'pdff',
     action:'save',
     scale:'medium',
     disabled:true,
     iconCls:'icon_pdf',
     // disabled:false,
     itemId:'pdf'
     }*/
    //];
    this.callParent(arguments);
}
})
;

