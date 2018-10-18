<?php

/**
 * Class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_GMap
 */
class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_GMap
    extends Mage_Adminhtml_Block_Template
{
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
