<?php

class DK_CustomerIP_Model_Info extends Mage_Core_Model_Abstract
{
    const DISABLED_STATUS = 0;
    const PROCESSING_STATUS = 1;
    const UPDATED_STATUS = 2;

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('dk_customerip/info');
    }

    /**
     * Get collection customer has processing status
     *
     * @return Mage_Customer_Model_Resource_Customer_Collection
     */
    public function getProcessingStatusCollection()
    {
        return Mage::getModel('customer/customer')
            ->getCollection()
            ->addAttributeToFilter(
                'status_update_ip', DK_CustomerIP_Model_Info::PROCESSING_STATUS
            );
    }
}
