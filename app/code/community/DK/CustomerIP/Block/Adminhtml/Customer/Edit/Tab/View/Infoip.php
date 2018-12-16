<?php

/**
 * Class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_Infoip
 */
class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_Infoip
    extends DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_Abstract
{
    const LIMIT_SHOW_ATTRIBUTE = 5;

    /**
     * @return int
     */
    public function limitShowAttribute()
    {
        return static::LIMIT_SHOW_ATTRIBUTE;
    }

    /**
     * @return string
     */
    public function getRegistrationIp()
    {
        return $this->getCustomer()->getRegistrationIp();
    }

    /**
     * @return array
     */
    public function getCoordinates()
    {
        $collection = $this->getCollection();

        $coordinates = [
            'latitude' => 0,
            'longitude' => 0,
        ];
        if ($collection && $collection->getInfo()) {
            $info = Zend_Json_Decoder::decode($collection->getInfo());

            $coordinates = [
                'latitude' => $info['latitude'] ?: 0,
                'longitude' => $info['longitude'] ?: 0,
            ];
        }

        Mage::register('customer_coordinates', $coordinates);

        return $coordinates;
    }

    /**
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->helper('adminhtml')->getUrl('adminhtml/customerip/update');
    }

    /**
     * Hide block if the customer has not been saved yet
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->helper('dk_customerip')->isCustomerIpEnabled()) {
            return '';
        }

        if (!$this->getCustomer() || !$this->getCustomer()->getId()) {
            return '';
        }

        return parent::_toHtml();
    }
}
