<?php

class DK_CustomerIP_Model_Process
{
    public function updateCustomerIp()
    {
        $collection = Mage::getModel('customer/customer')
            ->getCollection()
            ->addAttributeToFilter('status_update_ip', DK_CustomerIP_Model_Info::PROCESSING_STATUS);

        $model = Mage::helper('dk_customerip')->getCurrentServiceModel();

        foreach ($collection as $customer) {
            $json = $model
                ->setIp($customer->getRegistrationIp())
                ->call();

            $infoIpModel = Mage::getModel('dk_customerip/info')
                ->setCustomerId($customer->getId())
                ->setCreatedTime(Varien_Date::now())
                ->setInfo($json)
                ->save();

            $customer
                ->setStatusUpdateIp(DK_CustomerIP_Model_Info::UPDATED_STATUS)
                ->save();
        }
    }
}
