const CustomerIP = new Class.create();

CustomerIP.prototype = {
    /**
     * Initialize object
     */
    initialize(ajaxUrl, entityId, buttonId) {
        this.url = ajaxUrl;
        this.entityId = entityId;
        this.button = $(buttonId);
        this.tableInfo = $('table-info-customerip');
        this.paramsRequest = {};
    },

    update() {
      this.paramsRequest['customer'] = this.entityId;

      new Ajax.Request(this.url, {
        method:'POST',
        parameters: this.paramsRequest,

        onSuccess(response) {
          const blocks = response.responseText.evalJSON();

          if (blocks !== '') {
            this.tableInfo.update(blocks.table);
          }
      },

      onFailure() {

      }
    });
    },

    disableButton: function() {

    },
    enableButton: function() {

    }
};