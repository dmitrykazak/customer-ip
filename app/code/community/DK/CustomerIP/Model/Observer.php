<?php

class DK_CustomerIP_Model_Observer
{
    public function customerIpRegistration(Varien_Event_Observer $observer)
    {
        /** @var Mage_Customer_Model_Customer $customer */
        $customer = $observer->getEvent()->getCustomer();

        if ($customer && $customer->isObjectNew()) {
            $customer->setRegistrationIp(Mage::helper('core/http')->getRemoteAddr());
        }
    }
}
