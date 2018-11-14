<?php

class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_InfoTable
    extends Mage_Core_Block_Template
{
    private $collection = null;

    private $customer;

    /**
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return $this->customer ?: Mage::registry('current_customer');
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
     * @return DK_CustomerIP_Model_Info
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