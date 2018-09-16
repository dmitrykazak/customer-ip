<?php

class DK_CustomerIP_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function newsletterSubscriberSaveBefore(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('dk_customerip');

        /** @var Mage_Core_Model_Abstract $subscriber */
        $subscriber = $observer->getEvent()->getSubscriber();

        if ($subscriber && $subscriber->isObjectNew()) {
            $subscriber
                ->setRegistrationIp($helper->getRemoteAddress())
                ->setStatusUpdateIp(DK_CustomerIP_Model_Info::PROCESSING_STATUS);
        }
    }
}
