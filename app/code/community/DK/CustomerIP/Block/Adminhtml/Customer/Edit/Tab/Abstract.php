<?php

abstract class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_Abstract
    extends Mage_Adminhtml_Block_Template
{
    /**
     * @var Mage_Customer_Model_Customer $customer
     */
    private $customer;

    private $collection = null;

    /**
     * @param Mage_Customer_Model_Customer $customer
     *
     * @return $this
     */
    public function setCustomer(Mage_Customer_Model_Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return $this->customer ?: Mage::registry('current_customer');
    }

    /**
     * @return DK_CustomerIP_Model_Info|null
     */
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
    public function getInfoData()
    {
        $info = $this->getCollection();
        if ($info && $info->getNormalizedInfo()) {
            return Zend_Json_Decoder::decode($info->getNormalizedInfo());
        }

        return [];
    }
}
