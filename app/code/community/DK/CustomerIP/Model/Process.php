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

    /**
     * @var DK_CustomerIP_Helper_Data $helperServer
     */
    private $helperServer;

    /**
     * @var DK_CustomerIP_Helper_Data $server
     */
    private $server;

    public function __construct()
    {
        $this->helperNormalizer = Mage::helper('dk_customerip/normalizer');
        $this->helperServer = Mage::helper('dk_customerip');
    }

    /**
     * Cron processing get and save information about IP of customer.
     */
    public function saveInfo()
    {
        $customerCollection = Mage::getModel('dk_customerip/info')->getProcessingStatusCollection();

        foreach ($customerCollection as $customer) {
            $this->updateCustomerIp($customer);
        }
    }

    /**
     * @param Mage_Customer_Model_Customer $customer
     */
    public function updateCustomerIp(Mage_Customer_Model_Customer $customer)
    {
        $info = $this->getServer()
            ->setIp($customer->getRegistrationIp())
            ->call();

        if (!$this->getServer()->getError() && $info) {
            $infoModel = Mage::getModel('dk_customerip/info')
                ->getCollection()
                ->addFieldToFilter('customer_id', $customer->getId())
                ->setPageSize(1)
                ->setCurPage(1)
                ->getFirstItem();

            if (!$infoModel->getInfoId()) {
                $infoModel = Mage::getModel('dk_customerip/info')
                    ->setCustomer($customer);
            }

            $infoModel->setInfo($info)
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

    /**
     * @return Mage_Core_Model_Abstract
     */
    public function getServer()
    {
        if (!$this->server) {
            $this->server = $this->helperServer->getCurrentServiceModel();
        }

        return $this->server;
    }
}
