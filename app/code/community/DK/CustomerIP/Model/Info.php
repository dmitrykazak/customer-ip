<?php

class DK_CustomerIP_Model_Info extends Mage_Core_Model_Abstract
{
    const DISABLED_STATUS_IP = 0;
    const PROCESSING_STATUS = 1;
    const UPDATED_STATUS = 2;

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('dk_customerip/info');
    }
}
