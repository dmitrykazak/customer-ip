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
 * Class DK_CustomerIP_Model_Info
 *
 * @method string getNormalizedInfo()
 * @method string getInfo()
 */
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
            ->addAttributeToSelect([
                'registration_ip',
            ])
            ->addAttributeToFilter(
                'status_update_ip', DK_CustomerIP_Model_Info::PROCESSING_STATUS
            );
    }

    /**
     * @param $customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        if ($customer instanceof Mage_Customer_Model_Customer) {
            $this->setCustomerId($customer->getId());
        } else {
            $this->setCustomerId($customer);
        }

        return $this;
    }
}
