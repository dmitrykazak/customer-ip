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
    const self = this;
    this.paramsRequest['customer'] = this.entityId;

    self.disableButton();

    new Ajax.Request(this.url, {
      method: 'POST',
      parameters: this.paramsRequest,
      onSuccess(response) {
        self.enableButton();

        if (response.responseJSON) {
          const blocks = response.responseJSON;

          if (blocks.table !== '') {
            self.tableInfo.update(blocks.table);
          }

          if (blocks.coordinates != '') {
            const map = new google.maps.Map(document.getElementById('map-customer-ip'), {
              zoom: 4,
              center: {
                lat: blocks.coordinates.latitude,
                lng: blocks.coordinates.longitude
              }
            });

            new google.maps.Marker({
              position: {
                lat: blocks.coordinates.latitude,
                lng: blocks.coordinates.longitude
              },
              map: map
            });
          }
        }
      },

      onFailure() {
        self.enableButton();
      }
    });
  },

  disableButton() {
    this.button.disabled = true;
  },

  enableButton() {
    this.button.disabled = false;
  }
};
