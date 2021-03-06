<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class DK_CustomerIP_Adminhtml_CustomeripController extends Mage_Adminhtml_Controller_Action
{
    public function updateAction()
    {
        if ($this->getRequest()->isAjax()) {
            if ($customerId = (int) $this->getRequest()->getParam('customer')) {
                $customer = Mage::getModel('customer/customer')->load($customerId);

                Mage::getModel('dk_customerip/process')->updateCustomerIp($customer);

                $response = [];

                $response['coordinates'] = $this->getLayout()
                    ->createBlock('dk_customerip/adminhtml_customer_edit_tab_view_gMap')
                    ->setCustomer($customer)
                    ->getCoordinates();

                $response['table'] = $this->getLayout()
                    ->createBlock('dk_customerip/adminhtml_customer_edit_tab_view_infoTable')
                    ->setTemplate('dk/customerip/customer/tab/view/info_table.phtml')
                    ->setCustomer($customer)
                    ->toHtml();

                $this->getResponse()
                    ->clearHeaders()
                    ->setHeader('Content-type','application/json', true);

                $this->getResponse()->setBody(
                    Zend_Json_Encoder::encode($response)
                );
            }
        }

        return;
    }
}
