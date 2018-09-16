<?php

class DK_CustomerIP_Model_Resource_Info extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('dk_customerip/customer_info_ip', 'info_id');
    }
}