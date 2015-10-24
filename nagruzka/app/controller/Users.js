var booll = 0;

function Prep() {
    booll = 1;
}
function Spi() {
    booll = 2;
}
function Disp() {
    booll = 3;
}
function Oth() {
    booll = 4;
}
function Sear() {
    booll = 5;
}
function Arch() {
    booll = 6;
}


Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListStudySt', 'ListGridSt', 'ListButtSt', 'ListGridWinSt', 'ListSpiSt'],
    models: ['ListStudyM', 'ListGridM', 'ListFacM', 'ListGridWinM', 'ListSpiM'],
    views: ['Viewport', 'GridStud', 'Win1', 'Win2', 'Win3', 'Win_prep', 'Win_Spi'],
    init: function () {
        this.control({
            'viewport #buttid': {
                select: function (combo) {
                    combo.up('viewport').query('#reportid')[0].enable();
                }
            },
            'viewport #arch_disp': {
                click: function (th) {
                    //Ext.example.msg('Внимание', 'Отчет в процессе разработки111111');
                    var viewport = th.up('viewport');
                    viewport.query('#win3')[0].close();
                    //Ext.example.msg('Внимание', 'Отчет в процессе разработки111111');
                    viewport.query('#win3')[0].close();
                    var grid = viewport.query('#gridstud')[0];
                    var comboStudy = viewport.query('#studyid')[0];
			        /*var date = new Date();
                   	var timeInMs = date.getTime();
                    SaveFile({
                        fileName:'Диспетчерская_архив'+timeInMs+'.xml',
                        formFile:'/study/tasks/dev/nagruzka_umu/php/dispetch_archiv.php',
                        params:{
                            divid:grid.getSelectionModel().getSelection()[0].get('DIVID'),
                            studyid:comboStudy.getValue()
                        }
                    });*/
                    window.open("php/dispetch_archiv.php?divid="+grid.getSelectionModel().getSelection()[0].get('DIVID')+'&studyid='+comboStudy.getValue(),'_blank');
                }
            },
            'viewport #arch_nagr': {
                click: function (th) {
                    //Ext.example.msg('Внимание', 'Отчет в процессе разработки222222');
                    var viewport = th.up('viewport');
                    viewport.query('#win3')[0].close();
                    var grid = viewport.query('#gridstud')[0];
                    var comboStudy = viewport.query('#studyid')[0];

			/*var date = new Date();
                    var timeInMs = date.getTime();
                    SaveFile({
                        fileName:'Нагрузка_архив'+timeInMs+'.xml',
                        formFile:'/study/tasks/dev/nagruzka_umu/php/excel_nagruzka_archive.php',
                        params:{
                            divid:grid.getSelectionModel().getSelection()[0].get('DIVID'),
                            studyid:comboStudy.getValue()
                        }
                    });*/
                    window.open("php/excel_nagruzka_archive.php?divid="+grid.getSelectionModel().getSelection()[0].get('DIVID')+'&studyid='+comboStudy.getValue(),'_blank');
                }
            },
            'viewport #reportid': {
                click: function (button) {
                    var viewport = button.up('viewport');
                    var comboFac = viewport.query('#facid')[0];
                    var comboOtch = viewport.query('#buttid')[0];
                    var comboStudy = viewport.query('#studyid')[0];
                  /*  var date = new Date();
                    var timeInMs = date.getTime();
                    var timeraus=500;
                    var stringname="";
                  switch(comboOtch.getValue()){
                       case '1': timeraus=1000;stringname="Нагрузка по кафедрам";break;
                       case '2': timeraus=10000;stringname="Нагрузка (итоговая,годовая)";break;
                       case '3': timeraus=1000;stringname="Плановая численность ";break;
                       case '4': timeraus=500;stringname="Преподаватели";break;
                   }
                    console.log(stringname);
                     SaveFile({
                        fileName:stringname+timeInMs+'.xml',
                        formFile:'/study/tasks/dev/nagruzka_umu/php/report1.php',
                        params:{
                            fac:comboFac.getValue(),
                            otch:comboOtch.getValue(),
                            studyid:comboStudy.getValue()
                        }
                    });*/ 
                  window.open("php/report1.php?studyid="+comboStudy.getValue()+"&fac="+comboFac.getValue()+"&otch="+comboOtch.getValue());
                }
            },


            'viewport #prinid': {
                click: function (th) {
                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win1')[0];
                    var comboFac = viewport.query('#facid')[0];
                    var comboStudy = viewport.query('#studyid')[0];
                    var gridic = viewport.query('#gridstud')[0];
                    var sm = (gridic.getSelectionModel().getSelection())[0].get('DIVID');
                    Ext.getBody().mask('Внесение изменений...');
                    //win.mask('Внесение изменений...');
                    win.hide();
                    Ext.Ajax.request({
                        url: 'php/close.php',
                        params: {
                            div: sm,
                            studyid: comboStudy.getValue()
                        },
                        success: function (response, options) {
                            //win.unmask();
                            Ext.getBody().unmask();//win.hide();
                            Ext.example.msg('Принято!', 'Изменения внесены. Нагрузка принята!');
                            gridic.store.load({
                                params: {
                                    fac: comboFac.getValue(),
                                    studyid: comboStudy.getValue()
                                }
                            });

                        } })

                }
            },
            'viewport #openid': {
                click: function (th) {
                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win1')[0];
                    var comboFac = viewport.query('#facid')[0];
                    var comboStudy = viewport.query('#studyid')[0];
                    var gridic = viewport.query('#gridstud')[0];
                    var sm = (gridic.getSelectionModel().getSelection())[0].get('DIVID');
                    Ext.getBody().mask('Внесение изменений...');
                    win.hide();
                    Ext.Ajax.request({
                        url: 'php/open.php',
                        params: {
                            div: sm,
                            studyid: comboStudy.getValue()
                        },
                        success: function (response, options) {
                            Ext.getBody().unmask();//win.hide();

                            Ext.example.msg('В Работе!', 'Изменения внесены. Нагрузка в работе!');
                            gridic.store.load({
                                params: {
                                    fac: comboFac.getValue(),
                                    studyid: comboStudy.getValue()
                                }
                            });

                        } })


                }
            },
            'viewport #retid': {
                click: function (th) {
                    var viewport = th.up().up('viewport');
                    var win = viewport.query('#win2')[0];
                    var comboFac = viewport.query('#facid')[0];
                    var comboStudy = viewport.query('#studyid')[0];
                    var gridic = viewport.query('#gridstud')[0];
                    var sm = (gridic.getSelectionModel().getSelection())[0].get('DIVID');
                    //var divid = sm[0].get('DIVID');
                    Ext.getBody().mask('Внесение изменений...');
                    win.hide();
                    Ext.Ajax.request({
                        url: 'php/return.php',
                        params: {
                            div: sm,
                            studyid: comboStudy.getValue()
                        },
                        success: function (response, options) {
                            Ext.getBody().unmask();
                           // win.hide();
                            Ext.example.msg('Изменения внесены', 'Статус нагрузки - принята!');
                            gridic.store.load({
                                params: {

                                    fac: comboFac.getValue(),
                                    studyid: comboStudy.getValue()
                                }
                            });

                        } })
                }
            },
            'viewport #facid': {
                select: function (combo) {
                    var viewport = combo.up('viewport');
                    var comboStudy = viewport.query('#studyid')[0];
                    var gridic = viewport.query('#gridstud')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    gridic.store.load({
                        params: {
                            studyid: comboStudy.getValue(),
                            fac: combo.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                Ext.getBody().unmask();
                            }
                        }
                    });

                },
                afterrender: function (combo) {
                    var viewport = combo.up('viewport');
                    var comboStudy = viewport.query('#studyid')[0];
                    var gridic = viewport.query('#gridstud')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                combo.setValue(combo.store.getAt(0));
                                comboStudy.store.load({
                                        callback: function (success) {
                                            if (success) {
                                                comboStudy.setValue(comboStudy.store.getAt(0));
                                                gridic.store.load({
                                                    params: {
                                                        studyid: comboStudy.getValue(),
                                                        fac: combo.getValue()
                                                    },
                                                    callback: function (records, options, success) {
                                                        if (success) {
                                                            Ext.getBody().unmask();
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                );
                            }
                        }
                    });
                }
            },
            'viewport #studyid': {
                select: function (combo) {
                    var viewport = combo.up('viewport');
                    var comboFac = viewport.query('#facid')[0];
                    var gridic = viewport.query('#gridstud')[0];
                    var grid_window = viewport.query('#grid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    gridic.store.load({
                        params: {
                            studyid: combo.getValue(),
                            fac: comboFac.getValue()
                        },
                        callback: function (records, options, success) {
                            if (success) {
                                Ext.getBody().unmask();
                            }
                        }
                    });

                }
            },
            'viewport #zakid': {
                click: function (th) {
                    var viewport = th.up().up('viewport');
                    var wind = viewport.query('#win_prep')[0];
                    var wind_spi = viewport.query('#win_spi')[0];
                    wind.hide();
                    wind_spi.hide();
                    booll = 0;
                }},
            'viewport #gridstud': {
                cellclick: function (t, td, cellIndex, record, tr, rowIndex) {
                    var viewport = t.up('viewport');
                    var windows = viewport.query('#win1')[0];
                    var window2 = viewport.query('#win2')[0];
                    var window3 = viewport.query('#win3')[0];
                    var wind = viewport.query('#win_prep')[0];
                    var gridStud = viewport.query('#gridstud')[0];
                    var wind_spi = viewport.query('#win_spi')[0];
                    var gridan = viewport.query('#gridan')[0];
                    var gridi = viewport.query('#gridi')[0];

                    switch (booll) {
                        case 1:
                        {
                            wind.show();
                            wind.setPosition((gridStud.getX()) + 300, gridStud.getY() - 50);
                            wind.mask('Загрузка данных...');
                            gridan.store.load({
                                params: { div: record.get('DIVID')
                                },
                                callback: function (record, asd, success) {
                                    if (success) {
                                        wind.unmask();
                                    }
                                }
                            });
                            booll = 0;
                            break;
                        }
                        case 2:
                        {
                            wind_spi.show();
                            wind_spi.setPosition((gridStud.getX()) + 300, gridStud.getY() - 50);
                            wind_spi.mask('Загрузка данных...');
                            gridi.store.load({
                                params: { div: record.get('DIVID')
                                },
                                callback: function (record, asd, success) {
                                    if (success) {
                                        wind_spi.unmask();
                                    }
                                }
                            });
                            booll = 0;
                            break;

                        }
                        case 3:
                        {
                            record.get('DIVID');
                            var comboStudy = viewport.query('#studyid')[0];
                            var rec=comboStudy.store.find('STUDYID',comboStudy.getValue());
                             /*var date = new Date();
                           var timeInMs = date.getTime();
                           SaveFile({
                                fileName:'Диспетчерская'+timeInMs+'.xml',
                                formFile:'/study/tasks/dev/nagruzka_umu/php/dispech.php',
                                params:{
                                    divid:record.get('DIVID'),
                                    year:comboStudy.store.getAt(rec).get('YEARNAME'),
                                }
                            });*/

                            window.open('php/dispech.php?divid='+record.get('DIVID')+'&year='+comboStudy.store.getAt(rec).get('YEARNAME'),'_blank');
                            booll = 0;
                            break;
                        }
                        case 4:
                        {
                            //Ext.example.msg('Внимание', 'Отчет в процессе разработки');
                            record.get('DIVID');
                            var comboStudy = viewport.query('#studyid')[0];
                            var rec=comboStudy.store.find('STUDYID',comboStudy.getValue());
                             /*var date = new Date();
                            var timeInMs = date.getTime();
                           SaveFile({
                                fileName:'Нагрузка'+timeInMs+'.xml',
                                formFile:'/study/tasks/dev/nagruzka_umu/php/excel_nagruzka.php',
                                params:{
                                    divid:record.get('DIVID'),
                                    studyid:comboStudy.getValue(),
                                    god:comboStudy.store.getAt(rec).get('YEARNAME')
                                }
                            });*/
                            window.open('php/excel_nagruzka.php?divid='+record.get('DIVID')+'&studyid='+comboStudy.getValue()+'&god='+comboStudy.store.getAt(rec).get('YEARNAME'),'_blank');
                            booll = 0;
                            break;
                        }
                        case 5:
                        {

                            //Ext.example.msg('Внимание', 'Отчет в процессе разработки');
                            record.get('DIVID');
                            var comboStudy = viewport.query('#studyid')[0];
                            //var rec=comboStudy.store.find('STUDYID',comboStudy.getValue());
                             /*var date = new Date();
                            var timeInMs = date.getTime();
                           SaveFile({
                                fileName:'Отчет'+timeInMs+'.pdf',
                                formFile:'/study/tasks/dev/nagruzka_umu/php/search.php',
                                params:{
                                    divid:record.get('DIVID'),
                                    studyid:comboStudy.getValue()
                                   // god:comboStudy.store.getAt(rec).get('YEARNAME')
                                }
                            });*/
                            window.open('php/search.php?divid='+record.get('DIVID')+'&studyid='+comboStudy.getValue(),'_blank');
                            booll = 0;
                            break;
                        }
                        case 6:{
                            //Ext.example.msg('Внимание', 'Отчет в процессе разработки');
                            window3.show();
                            booll = 0;
                            break;
                        }
                        case 0:
                        {
                            if(cellIndex==2){
                            if (record.get('STATUS') == '1') {
                                if (!window2.isHidden())
                                    window2.hide();
                                windows.show();
                                windows.setPosition((gridStud.getX()) + 350, gridStud.getY() + (rowIndex * 37 + 68));
                            } else if (record.get('STATUS') == '2') {
                                if (!windows.isHidden())
                                    windows.hide();
                                window2.show();
                                window2.setPosition((gridStud.getX()) + 350, gridStud.getY() + (rowIndex * 37 + 68));
                            } else if (record.get('STATUS') == '0') {
                                if (!windows.isHidden())
                                    windows.hide();
                                if (!window2.isHidden())
                                    window2.hide();
                            }
                        }

                        }
                    }
                }
            }

        });
    }
});
