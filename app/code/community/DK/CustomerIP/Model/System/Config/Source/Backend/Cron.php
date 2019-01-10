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
 * Class DK_CustomerIP_Model_System_Config_Source_Backend_Cron
 */
class DK_CustomerIP_Model_System_Config_Source_Backend_Cron
    extends Mage_Core_Model_Config_Data
{
    const CRON_PATH = 'crontab/jobs/ip_customer_update/schedule/cron_expr';

    /**
     * @inheritdoc
     */
    protected function _afterSave()
    {
        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_PATH, 'path')
                ->setValue(Mage::helper('dk_customerip/cron')->getExprTime())
                ->setPath(self::CRON_PATH)
                ->save();

        } catch (Mage_Core_Exception $e) {
            throw Mage::exception(
                'DK_CustomerIP',
                Mage::helper('cron')->__('Unable to save the cron expression.')
            );
        }
    }
}
