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
 * Class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_GMap
 */
class DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_View_GMap
    extends DK_CustomerIP_Block_Adminhtml_Customer_Edit_Tab_Abstract
{
    /**
     * @return string
     */
    public function getGoogleMapKey()
    {
        return Mage::helper('dk_customerip')->getGoogleMapKey();
    }

    /**
     * @return array
     */
    public function getCoordinates()
    {
        $coordinates = Mage::registry('customer_coordinates');
        if ($coordinates) {
            return $coordinates;
        }

        $coordinates = $this->getLayout()
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
