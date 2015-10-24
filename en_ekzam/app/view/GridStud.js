Ext.define('AM.view.GridStud', {
    extend: 'Ext.grid.Panel',
    title: 'Экзамены',
    alias: 'widget.gridStud',

    //height: 1000,
    //flex:1,
    typer: 0,
    autoScroll: true,
    draggable:false,
    columnLines: true,
    /*columns: [
        {header: 'Город', dataIndex: 'GOROD', flex:1},
        //{header: 'Конкурсная группа', dataIndex: 'CONGROUP', flex:1},
        {header: 'Предмет', dataIndex: 'PREDMET', flex: 1},
        {header: 'Приоритет', dataIndex: 'PRIORITET', width: 100},
        {xtype: 'datecolumn', header: 'Дата', dataIndex: 'KOGDA', format: 'd.m.Y', flex: 1},
        {header: 'Время', dataIndex: 'CLOCK', flex: 1}
    ],*/
    initComponent: function () {
        console.log('init gridstud');
        if(this.typer == 0){
        this.columns = [
            {header: 'Город', dataIndex: 'GOROD', flex:1},
            {header: 'Конкурсная группа', dataIndex: 'CONGROUP', flex:1},
            {header: 'Предмет', dataIndex: 'PREDMET', flex: 1},
            {header: 'Приоритет', dataIndex: 'PRIORITET', width: 100},
            {xtype: 'datecolumn', header: 'Дата', dataIndex: 'KOGDA', format: 'd.m.Y', flex: 1},
            {header: 'Время', dataIndex: 'CLOCK', flex: 1}
        ];
        this.tbar = [
            {
                text:'Добавить группу',
                scale:'medium',
                //disabled:true,
                // iconCls:'icon_savee',
                // disabled:false,
                itemId:'groadd'
            },
            {
                text:'Добавить предмет',
                scale:'medium',
                //disabled:true,
                //iconCls:'icon_pdf',
                // disabled:false,
                itemId:'subadd'
            }
        ];
        }
        else{
            this.columns = [
                {header: 'Город', dataIndex: 'GOROD', flex:1},
                //{header: 'Конкурсная группа', dataIndex: 'CONGROUP', flex:1},
                {header: 'Предмет', dataIndex: 'PREDMET', flex: 3},
                {header: 'Приоритет', dataIndex: 'PRIORITET', width: 100},
                {xtype: 'datecolumn', header: 'Дата', dataIndex: 'KOGDA', format: 'd.m.Y', flex: 1},
                {header: 'Время', dataIndex: 'CLOCK', flex: 1}
            ];
        }
        this.callParent(arguments);
    }
});

