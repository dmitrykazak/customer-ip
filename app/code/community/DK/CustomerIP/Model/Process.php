<?php

/**
 * Class DK_CustomerIP_Model_Process
 */
class DK_CustomerIP_Model_Process
{
    /**
     * @var DK_CustomerIP_Helper_Normalizer $helperNormalizer
     */
    private $helperNormalizer;

    public function __construct()
    {
        $this->helperNormalizer = Mage::helper('dk_customerip/normalizer');
    }

    /**
     * Cron processing get and save information about IP of customer.
     */
    public function updateCustomerIp()
    {
        $customerCollection = Mage::getModel('dk_customerip/info')->getProcessingStatusCollection();

        $server = Mage::helper('dk_customerip')->getCurrentServiceModel();

        foreach ($customerCollection as $customer) {
            $info = $server
                ->setIp($customer->getRegistrationIp())
                ->call();

            if (!$server->getError() && $info) {
                Mage::getModel('dk_customerip/info')
                    ->setCustomer($customer)
                    ->setInfo($info)
                    ->setNormalizedInfo(
                        $this->helperNormalizer->normalize(
                            Zend_Json_Decoder::decode($info)
                        )
                    )
                    ->setCreatedTime(Varien_Date::now())
                    ->save();

                $customer
                    ->setStatusUpdateIp(DK_CustomerIP_Model_Info::UPDATED_STATUS)
                    ->save();
            }
        }
    }
}
