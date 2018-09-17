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

    public function getRegistrationIp()
    {
        return $this->getCustomer()->getRegistrationIp();
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
