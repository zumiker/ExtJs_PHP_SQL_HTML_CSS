/**
 * Setup some ComboBox defaults
 */
Ext.override(Ext.form.field.ComboBox, {
    /** 
     * added store load listener due to bug in Sencha which prevents the loadmask from be removed after a successful loading of data.
     * TODO: see if this can be removed after sencha 4.1 upgrade
     * http://www.sencha.com/forum/showthread.php?152803-Picker-quot-Loading...-quot-mask-stuck-on&referrerid=460
     */
    afterRender: function() {
        var me = this;
        if(me.getStore()) {
            me.getStore().on('load',function(store, recs, success){
                if(success && Ext.typeOf(this.getPicker().loadMask) != "boolean") {
                    //console.log("trying to hide the loadmask");
                    this.getPicker().loadMask.hide();
                }                
            },me);
        }
        me.callOverridden(arguments);
    }
});