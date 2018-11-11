const CustomerIP = new Class.create();

CustomerIP.prototype = {
    /**
     * Initialize object
     */
    initialize: function(ajaxUrl, entityId, buttonId) {
        this.url = ajaxUrl;
        this.entityId = entityId;
        this.paramsRequest = {};
        this.button = $(buttonId);
    },

    update: function() {
        this.paramsRequest['customer'] = this.entityId;

        new Ajax.Request(this.url, {
            method:'POST',
            parameters: this.paramsRequest,
            onSuccess: function(response) {
              const rp = response.responseText.evalJSON();
              let map = $$('div .map');
              map.update('test');
            },
            onFailure: function() {

            }
        });
    },

    disableButton: function() {

    },
    enableButton: function() {

    }
};