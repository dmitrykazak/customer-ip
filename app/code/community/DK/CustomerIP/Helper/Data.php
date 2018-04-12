<?php

class DK_CustomerIP_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getMapper()
    {
        $mapper = Mage::getStoreConfig('dk_customerip/settings/mapper');
        if ($mapper) {

        }
    }
}