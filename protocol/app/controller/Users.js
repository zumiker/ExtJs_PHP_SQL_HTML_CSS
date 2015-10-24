var dat=-1;
var kubyshka=0;
var chekin=false;
Ext.define('AM.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['ListFacSt', 'ListConGroupSt', 'ListTurSt', 'ListRepSt','ListFormSt', 'ListVubSt','ListMagSt'],
    models: ['ListFacM', 'ListConGroupM'],
    views: ['Viewport'],
    init: function () {
        Ext.Ajax.request({
            url: 'php/verify.php',
            success: function (response, options) {
                dat = response.responseText;
            }
        });
        this.control({
            'viewport #magistid':{
                afterrender:function(combo){
                    var viewport = combo.up('viewport');
                    comboForm = viewport.query('#formid')[0];
                    comboForm.enable();
                    comboForm.setValue('1');
                    combo.setValue('1');
                    viewport.query('#reportid')[0].enable();
                    viewport.query('#progid')[0].enable();



                }
               /* select:function(combo){
                    var viewport = combo.up('viewport');
                    comboForm = viewport.query('#formid')[0];
                    checkProg = viewport.query('#progid')[0];
                    button = viewport.query('#reportid')[0];
                    if(combo.getValue() == 1 || combo.getValue() == 3){
                        comboForm.enable();
                        checkProg.enable();

                        if(comboForm.getValue()==null)
                            button.disable();
                    }
                    else{
                        comboForm.reset();
                        comboForm.disable();
                        checkProg.enable();
                        button.enable();
                    }
                }*/
            },
            'viewport #formid':{
                select:function(combo){
                    var viewport = combo.up('viewport');
                    comboMagi =viewport.query('#magistid')[0];
                    //viewport.query('#reportid')[0].enable();
                    if(combo.getValue()=='4'){
                        comboMagi.disable();
                        comboMagi.reset();
                    }
                    else if(comboMagi.getValue()==null){
                        comboMagi.enable();
                        comboMagi.setValue('1');
                    }
                        //comboMagi.();



                }
                /*afterrender:function(combo){
                    var viewport = combo.up('viewport');
                     comboForm = viewport.query('#magistid111')[0].setValue('1');
                     combo.setValue('1');



                }*/
            },
            'viewport #reportid':{
                click:function(button){
                    var viewport = button.up('viewport');
                    comboMag  = viewport.query('#magistid')[0];
                    comboForm = viewport.query('#formid')[0];
                    checkProg = viewport.query('#progid')[0];
                    if(checkProg.getValue() == true)
                        var xxx = 1;
                    else
                        var xxx = 0;
                    var q = comboMag.getValue();
                    var w = comboForm.getValue()
                    if(w=='4'){
                        q=w;
                        w=null;
                    }
                    window.open('php/reportp_1.php?nabor=' + q+'&formaid=' + w + '&zaoch='+'-1'+'&check=' + xxx,'_blank');




                }
            },
            'viewport #zaochid':{
                activate:function(tab){
                    var tabpanel = tab.up('tabpanel');
                    window.open('php/reportp_1.php?zaoch='+1,'_blank')
                    //window.down('tabpanel').
                    tabpanel.setActiveTab(kubyshka);
                }
            },
            'viewport #bakaid':{
                activate:function(tab){
                    kubyshka=0;
                }
            },
            'viewport #magaid':{
                activate:function(tab){
                    kubyshka=1;
                }
            },
            'viewport #facid': {
                afterrender: function (combo, records, eOpts) {
                    combo.store.load({
                        callback: function (records, options, success) {
                            if (success) {
                                var viewport = combo.up('viewport');
                                comboTur = viewport.query('#sturid')[0];
                                comboGroup = viewport.query('#conid')[0];
                                comboReport = viewport.query('#repid')[0];
                                comboRepR = viewport.query('#vubid')[0];
                                combo.setRawValue(this.getAt(0).get('FAC'));
                                combo.setValue(this.getAt(0).get('FACID'));
                                comboRepR.setRawValue(comboRepR.store.getAt(0).get('vubname'));
                                comboRepR.setValue(comboRepR.store.getAt(0).get('vubid'));
                                comboTur.setRawValue(comboTur.store.getAt(0).get('turname'));
                                comboTur.setValue(comboTur.store.getAt(0).get('turid'));
                                /*comboReport.store.filterBy(function(record){

                                    if(record.get('PROVREP')=='1')
                                    {
                                        console.log(record.get('PROVREP'));
                                        return record;
                                    }
                                    else

                                        return false;
                                })*/
                                if(dat==0)
                                    comboReport.store.filter('PROVREP','0');
                                comboGroup.enable();
                                comboGroup.store.load({
                                    params: {facid: combo.getValue()},
                                    callback: function (records, options, success) {
                                        if (success && comboGroup.store.getCount() == 1) {
                                            comboGroup.setRawValue(comboGroup.store.getAt(0).get('CONNAME'));
                                            comboGroup.setValue(comboGroup.store.getAt(0).get('CONID'));
                                            comboReport.enable();

                                        }
                                    }
                                })

                            }
                        }
                    });
                },
                select: function (combo, records, eOpts, store, sucess) {
                   // console.log('dasda');
                    var viewport = combo.up('viewport');
                    comboGroup = viewport.query('#conid')[0];
                    comboTur = viewport.query('#sturid')[0];
                    //  comboGroup = viewport.query('#conid')[0];
                    comboReport = viewport.query('#repid')[0];
                    comboRepR = viewport.query('#vubid')[0];
                    buttonRep = viewport.query('#report')[0];
                    comboGroup.reset();
                    checkPodval = viewport.query('#podvalid')[0];
                    checkNaprav = viewport.query('#napravid')[0];
                    checkPodl = viewport.query('#podlid')[0];
                    comboGroup.store.load({
                        params: {facid: combo.getValue()},
                        callback: function (records, options, success) {
                            if (success) {
                                if (comboGroup.store.getCount() == 1) {
                                    comboGroup.setRawValue(comboGroup.store.getAt(0).get('CONNAME'));
                                    comboGroup.setValue(comboGroup.store.getAt(0).get('CONID'));
                                    comboReport.enable();
                                }
                                else {
                                    buttonRep.setDisabled(1);
                                    checkPodl.reset();
                                    checkPodl.disable();
                                }
                            }
                        }
                    })
                }
            },
            'viewport #conid': {
                select: function (combo, records, eOpts, store, sucess) {
                    var viewport = combo.up('viewport');
                    comboReport = viewport.query('#repid')[0];
                    checkPodl = viewport.query('#podlid')[0];
                    checkPhone = viewport.query('#phoneid')[0];
                    checkPodval = viewport.query('#podvalid')[0];
                    checkNaprav = viewport.query('#napravid')[0];

                    if (!comboReport.isDisabled()){
                        buttonRep.enable();
                        checkPodl.enable();
                        checkPhone.enable();

                    }

                    comboReport.enable();
                }
            },
            'viewport #repid': {
                select: function (combo, records, eOpts, store, sucess) {
                    var viewport = combo.up('viewport');
                    comboRep = viewport.query('#vubid')[0];
                    buttonRep = viewport.query('#report')[0];
                    checkPodl = viewport.query('#podlid')[0];
                    comboTur = viewport.query('#sturid')[0];
                    checkPhone = viewport.query('#phoneid')[0];
                    checkPodval = viewport.query('#podvalid')[0];
                    checkNaprav = viewport.query('#napravid')[0];
                    if(combo.getValue()==1)
                    {
                        if(checkPodval.getValue()==true){
                            checkNaprav.disable();
                        }
                        else{
                            checkNaprav.enable();
                        }
                        if(checkNaprav.getValue()==true){
                           checkPodval.disable();
                            checkPhone.disable();
                        }
                        else{
                            checkPodval.enable();
                            checkPhone.enable();
                        }

                    }
                    else{
                        checkPodval.reset();
                        checkNaprav.reset();
                        checkPodval.disable();
                        checkNaprav.disable();
                    }

                    if(combo.getValue()=="4"||combo.getValue()=="9"||combo.getValue()=="10")
                    {
                        comboTur.enable();
                        //chekin=checkPodl.getValue();
                        checkPodl.setValue(true);
                        //checkPodl.disable();
                        buttonRep.enable();
                        if(checkPhone.getValue()==true)
                            comboRep.disable();
                        else
                            comboRep.enable();
                        checkPhone.enable();
                    }
                    else
                    {
                            comboTur.enable();
                            buttonRep.enable();
                        if(checkPhone.getValue()==true)
                            comboRep.disable();
                        else
                            comboRep.enable();
                        checkPodl.enable();
                        //checkPhone.enable();
                          //
                          //
                          // checkPodl.setValue(chekin);
                    }

                }
            },
            'viewport #phoneid': {
                change : function (checkbox) {
                    var viewport = checkbox.up('viewport');
                    comboRepR = viewport.query('#vubid')[0];
                    checkNaprav = viewport.query('#napravid')[0];
                    if(checkbox.getValue()==true){
                        comboRepR.setValue('0');
                        comboRepR.disable();
                        checkNaprav.reset();
                        checkNaprav.disable();
                    }
                    else{
                        comboRepR.enable();
                        checkNaprav.enable();
                    }
        }

            },
            'viewport #podvalid': {
                change : function (checkbox) {
                    var viewport = checkbox.up('viewport');
                    checkNaprav = viewport.query('#napravid')[0];
                    if(checkbox.getValue()==true){
                        checkNaprav.disable();
                    }
                    else{
                        checkNaprav.enable();
                    }
                }
            },
            'viewport #napravid': {
                change : function (checkbox) {
                    var viewport = checkbox.up('viewport');
                    checkPhone = viewport.query('#phoneid')[0];
                    comboRep = viewport.query('#vubid')[0];
                    checkPodval = viewport.query('#podvalid')[0];
                    if(checkbox.getValue()==true){
                        checkPodval.disable();
                        checkPhone.reset();
                        checkPhone.disable();
                        comboRep.setValue('1');
                        comboRep.disable();
                    }
                    else{
                        checkPodval.enable();
                        checkPhone.enable();
                        comboRep.enable();
                    }
                }
            },
            'viewport #report': {
                click: function (button, records, eOpts, store, sucess) {
                    var viewport = button.up('viewport');
                    comboTur = viewport.query('#sturid')[0];
                    comboGroup = viewport.query('#conid')[0];
                    comboReport = viewport.query('#repid')[0];
                    comboRepR = viewport.query('#vubid')[0];
                    comboFac = viewport.query('#facid')[0];
                    checkPodl= viewport.query('#podlid')[0];
                    comboVub= viewport.query('#vubid')[0];
                    checkPhone = viewport.query('#phoneid')[0];
                    checkPodval = viewport.query('#podvalid')[0];
                    checkNaprav = viewport.query('#napravid')[0];


                    var a = comboTur.getValue();
                    var b = comboFac.getValue();
                    var с = comboGroup.getValue();
                    var d = comboReport.getValue();
                    var e = comboRepR.getValue();
                    var zz = checkPhone.getValue();
                    if (checkPhone.getValue()==true)
                        zz = 1;
                    else
                        zz = 0;
                    if (checkPodl.getValue()==true)
                        var f = 1;
                    else
                        var f = 0;
                    switch(d){
                        case "1":{
                            if(checkNaprav.getValue()==true){
                                window.open('php/excel_nap.php?tur=' + a
                                    + '&fac=' + b + '&group=' + с + '&rep='
                                    + d + '&vub=' + e + '&podl=' + f);
                            }
                            else if(checkPodval.getValue()==true){
                                if(a==1){
                                    d="1";
                                    f=2;
                                }
                                else{
                                    d="1";
                                    f=777;
                                }


                            }
                            break;
                        }
                        case "4":{
                            d="2";
                            f=242;
                            break;
                        }
                        case "9":{
                            d="2";
                            f=34;
                            break;
                        }
                        case "10":{
                            d="2";
                            f=51;
                            break;
                        }
                    }
                    if(checkNaprav.getValue()!=true){
                    if(comboVub.getValue()==0)
                    window.open('php/reportp_1.php?tur=' + a
                        + '&fac=' + b + '&group=' + с + '&rep='
                        + d + '&vub=' + e + '&podl=' + f+'&phone='+zz);
                    else
                        window.open('php/excel.php?tur=' + a
                            + '&fac=' + b + '&group=' + с + '&rep='
                            + d + '&vub=' + e + '&podl=' + f);
                    }
                }
            }
        });
    }
});
