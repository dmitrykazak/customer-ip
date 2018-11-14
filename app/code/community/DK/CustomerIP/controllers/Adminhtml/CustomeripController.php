<?php

class DK_CustomerIP_Adminhtml_CustomeripController extends Mage_Adminhtml_Controller_Action
{
    public function getAction()
    {
        if ($this->getRequest()->isAjax()) {
            if ($customerId = $this->getRequest()->getParam('customer')) {
                $customer = Mage::getModel('customer/customer')->load($customerId);

                $server = Mage::helper('dk_customerip')->getCurrentServiceModel();

                $info = $server
                    ->setIp($customer->getRegistrationIp())
                    ->call();

                if (!$server->getError() && $info) {
                    $infoModel = Mage::getModel('dk_customerip/info')
                        ->getCollection()
                        ->addFieldToFilter('customer_id', $customer->getId())
                        ->setPageSize(1)
                        ->setCurPage(1)
                        ->getFirstItem();

                    $infoModel->setInfo($info)
                        ->setNormalizedInfo(
                            Mage::helper('dk_customerip/normalizer')->normalize(
                                Zend_Json_Decoder::decode($info)
                            )
                        )
                        ->setCreatedTime(Varien_Date::now())
                        ->save();

                    $customer
                        ->setStatusUpdateIp(DK_CustomerIP_Model_Info::UPDATED_STATUS)
                        ->save();
                }

                $response = [];

                $response['table'] = $this->getLayout()
                    ->createBlock('dk_customerip/adminhtml_customer_edit_tab_view_infoTable')
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