<?php

/**
 * Class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_Infoip
 */
class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_Infoip
    extends Mage_Adminhtml_Block_Template
{
    const LIMIT_SHOW_ATTRIBUTE = 5;

    private $collection = null;

    /**
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return Mage::registry('current_customer');
    }

    /**
     * @return int
     */
    public function limitShowAttribute()
    {
        return self::LIMIT_SHOW_ATTRIBUTE;
    }

    /**
     * @return string
     */
    public function getRegistrationIp()
    {
        return $this->getCustomer()->getRegistrationIp();
    }

    public function getCollection()
    {
        if ($this->collection) {
            return $this->collection;
        }

        /** @var DK_CustomerIP_Model_Info $info */
        $this->collection = Mage::getModel('dk_customerip/info')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomer()->getId())
            ->setPageSize(1)
            ->setCurPage(1)
            ->getFirstItem();

        return $this->collection;
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
        if ($collection) {
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
     * @return DK_CustomerIP_Model_Info
     */
    public function getInfoData()
    {
        $info = $this->getCollection();
        if ($info) {
            return Zend_Json_Decoder::decode($info->getNormalizedInfo());
        }

        return [];
    }

    /**
     * Hide block if the customer has not been saved yet
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->getCustomer() || !$this->getCustomer()->getId()) {
            return '';
        }
        return parent::_toHtml();
    }
}
