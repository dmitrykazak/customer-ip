<?php

class DK_CustomerIP_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getMapper()
    {
        $mapper = Mage::getStoreConfig('dk_customerip/settings/mapper');
        if ($mapper) {

        }
    }

    public function getRemoteAddress()
    {
        return Mage::helper('core/http')->getRemoteAddr();
    }

    /**
     * Get Current service model for to get IP info.
     *
     * @return Mage_Core_Model_Abstract|null
     */
    public function getCurrentServiceModel()
    {
        $service = Mage::getStoreConfig('dk_customerip/import/service');

        if ($service) {
            try {
                $model = Mage::getModel(Mage::getConfig()->getNode('global/ip/services/' . $service . '/model')->asArray());

                return $model;
            } catch (Exception $e) {
                Mage::log('The model was not found!');
            }
        }

        return null;
    }
}