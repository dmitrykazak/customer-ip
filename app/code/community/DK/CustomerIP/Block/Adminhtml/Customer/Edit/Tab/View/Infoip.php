<?php

/**
 * Class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_Infoip
 */
class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_Infoip
    extends Mage_Adminhtml_Block_Template
{
    /**
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return Mage::registry('current_customer');
    }

    /**
     * @return string
     */
    public function getRegistrationIp()
    {
        return $this->getCustomer()->getRegistrationIp();
    }

    /**
     * @return DK_CustomerIP_Model_Info
     */
    public function getInfoData()
    {
        /** @var DK_CustomerIP_Model_Info $info */
        $info = Mage::getModel('dk_customerip/info')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomer()->getId())
            ->setPageSize(1)
            ->setCurPage(1)
            ->getFirstItem();

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
