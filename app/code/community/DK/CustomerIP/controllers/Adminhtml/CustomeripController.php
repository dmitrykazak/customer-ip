<?php

class DK_CustomerIP_Adminhtml_CustomeripController extends Mage_Adminhtml_Controller_Action
{
    public function updateAction()
    {
        if ($this->getRequest()->isAjax()) {
            if ($customerId = $this->getRequest()->getParam('customer')) {
                $customer = Mage::getModel('customer/customer')->load($customerId);

                Mage::getModel('dk_customerip/process')->updateCustomerIp($customer);

                $response = [];

                $response['coordinates'] = $this->getLayout()
                    ->createBlock('dk_customerip/adminhtml_customer_edit_tab_view_gMap')
                    ->setCustomer($customer)
                    ->getCoordinates();

                $response['table'] = $this->getLayout()
                    ->createBlock('dk_customerip/adminhtml_customer_edit_tab_view_infoTable')
                    ->setTemplate('dk_customerip/customer/tab/view/info_table.phtml')
                    ->setCustomer($customer)
                    ->toHtml();

                $this->getResponse()
                    ->clearHeaders()
                    ->setHeader('Content-type','application/json', true);
                $this->getResponse()->setBody(
                    Zend_Json_Encoder::encode($response)
                );

                return;
            }
        }

    }
}
