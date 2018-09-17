<?php

class DK_CustomerIP_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getRemoteAddress()
    {
        return Mage::helper('core/http')->getRemoteAddr();
    }

    /**
     * Get current service model for to get IP info.
     *
     * @return Mage_Core_Model_Abstract|null
     */
    public function getCurrentServiceModel()
    {
        $service = Mage::getStoreConfig('dk_customerip/import/service');

        if ($service) {
            try {
                $modelName = Mage::getConfig()->getNode('global/ip/services/' . $service . '/model');
                $model = Mage::getModel(Mage::getConfig()->getNode($modelName)->asArray());

                return $model;
            } catch (Exception $e) {
                Mage::log(sprintf('The model (%s) was not found!', $modelName));
            }
        }

        return null;
    }
}