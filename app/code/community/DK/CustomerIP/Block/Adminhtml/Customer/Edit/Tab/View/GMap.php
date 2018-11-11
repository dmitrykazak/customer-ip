<?php

/**
 * Class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_GMap
 */
class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_GMap
    extends Mage_Adminhtml_Block_Template
{
    private $customer;

    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer ?: Mage::registry('current_customer');
    }

    /**
     * @return string
     */
    public function getGoogleMapKey()
    {
        return Mage::helper('dk_customerip')->getGoogleMapKey();
    }

    public function getCoordinates()
    {
        $coordinates = Mage::registry('customer_coordinates');
        if ($coordinates) {
            return $coordinates;
        }

        $coordinates = $this
            ->getLayout()
            ->getBlockSingleton('dk_customerip/adminhtml_customer_edit_tab_view_infoip')
            ->setCustomer($this->getCustomer())
            ->getCoordinates();

        return $coordinates;
    }

    /**
     * Hide block if the google api key is empty
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->getGoogleMapKey()) {
            return '';
        }

        return parent::_toHtml();
    }
}
