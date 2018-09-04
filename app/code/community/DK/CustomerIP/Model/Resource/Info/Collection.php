<?php

class DK_CustomerIP_Model_Resource_Info_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('dk_customerip/info');
    }
}