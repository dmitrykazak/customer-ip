<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class DK_CustomerIP_Model_Resource_Info extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('dk_customerip/customer_info_ip', 'info_id');
    }
}