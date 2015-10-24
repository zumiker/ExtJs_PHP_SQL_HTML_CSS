Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListShifrSt', 'ListRateSt'],
    models: ['ListFacM', 'ListShifrM', 'ListRateM'],
    views: ['Viewport', 'Panels', 'GridRate'],
    init: function () {
        Ext.Ajax.request({
            url: 'php/verify.php',
            success: function (response, options) {
                dat = response.responseText;
            }
        });
        this.control({
            /*'viewport #shifr_grid': {
             afterrender:function(gr){
             gr.store.


             }
             },*/
            'viewport #golubid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    viewport.query('#bur_shifr_grid')[0].hide();
                    viewport.query('#golun_shifr_grid')[0].hide();
                    viewport.query('#kib_shifr_grid')[0].hide();
                    //viewport.query('#mak_shifr_grid')[0].hide();
                    var shifr = viewport.query('#gol_shifr_grid')[0];
                    var rate = viewport.query('#gol_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A28', 'AMOUNT_CLASSBOOK', 'AMOUNT_OTHERBOOK"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #golid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    viewport.query('#bur_shifr_grid')[0].hide();
                    viewport.query('#gol_shifr_grid')[0].hide();
                    viewport.query('#kib_shifr_grid')[0].hide();
                    //viewport.query('#mak_shifr_grid')[0].hide();
                    var shifr = viewport.query('#golun_shifr_grid')[0];
                    var rate = viewport.query('#golun_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A48', 'A13', 'AMOUNT_DPO_PROGRAM"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #kibid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    viewport.query('#bur_shifr_grid')[0].hide();
                    viewport.query('#golun_shifr_grid')[0].hide();
                    viewport.query('#gol_shifr_grid')[0].hide();
                    //viewport.query('#mak_shifr_grid')[0].hide();
                    var shifr = viewport.query('#kib_shifr_grid')[0];
                    var rate = viewport.query('#kib_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A12"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #makid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    var shifr = viewport.query('#mak_shifr_grid')[0];
                    var rate = viewport.query('#mak_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A33"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #muraid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    var shifr = viewport.query('#mur_shifr_grid')[0];
                    var rate = viewport.query('#mur_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A15', 'A24', 'A25', 'A31', 'A34', 'A37', 'A49', 'A51"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #poplid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    var shifr = viewport.query('#pop_shifr_grid')[0];
                    var rate = viewport.query('#pop_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A15', 'A24"//Надо исправлять!!!!!!!!!!!!!!!!
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #pyatid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    var shifr = viewport.query('#pyat_shifr_grid')[0];
                    var rate = viewport.query('#pyat_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "PART_LOAD_VIRTUAL"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #ydoid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    var shifr = viewport.query('#ud_shifr_grid')[0];
                    var rate = viewport.query('#ud_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "A2"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #yanid': {
                activate: function (th) {
                    var viewport = th.up('viewport');
                    var shifr = viewport.query('#yan_shifr_grid')[0];
                    var rate = viewport.query('#yan_rate_grid')[0];
                    var combo = viewport.query('#facid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                                shifr.store.load({
                                    params: {
                                        group: "PART_STUDENT_PRACTICE"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                        }
                                    }
                                })

                            }
                        }
                    });
                }

            },
            'viewport #facid': {
                afterrender: function (combo) {
                    var viewport = combo.up('viewport');
                    var shifr = viewport.query('#bur_shifr_grid')[0];
                    var rate = viewport.query('#bur_rate_grid')[0];
                    Ext.getBody().mask('Загрузка данных...');
                    combo.store.load({
                        callback: function (success) {
                            if (success) {
                               // combo.setValue(combo.store.getAt(0));
                                shifr.store.load({
                                    params: {
                                        group: "A43', 'A6"
                                    },
                                    callback: function (success) {
                                        if (success) {
                                            Ext.getBody().unmask();
                                            /*rate.store.load({
                                                params: {
                                                    facid: combo.getValue(),

                                                    //col: "'A15', 'A24', 'A25', 'A31', 'A34', 'A37', 'A49', 'A51'"
                                                    col: "'A43', 'A6'"
                                                },
                                                callback: function () {
                                                    if (success) {

                                                    }
                                                }
                                            });*/

                                        }
                                    }
                                })

                            }
                        }
                    });

                }


            }

        });
    }
});
