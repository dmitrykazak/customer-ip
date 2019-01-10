<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class DK_CustomerIP_Helper_Data
 */
class DK_CustomerIP_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getRemoteAddress()
    {
        return Mage::helper('core/http')->getRemoteAddr();
    }

    /**
     * @return string
     */
    public function getGoogleMapKey()
    {
        return Mage::getStoreConfig('dk_customerip/settings/google_api_key');
    }

    /**
     * @return bool
     */
    public function isCustomerIpEnabled()
    {
        return Mage::getStoreConfigFlag('dk_customerip/settings/customer_enabled');
    }

    /**
     * @return bool
     */
    public function isSubscriberIpEnabled()
    {
        return Mage::getStoreConfigFlag('dk_customerip/settings/subscriber_enabled');
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
                $modelName = Mage::getConfig()->getNode('global/ip/services/' . $service . '/model')->asArray();

                $model = Mage::getModel($modelName);

                return $model;
            } catch (Exception $e) {
                Mage::log(sprintf('The model (%s) was not found!', $modelName));
            }
        }

        return null;
    }
}