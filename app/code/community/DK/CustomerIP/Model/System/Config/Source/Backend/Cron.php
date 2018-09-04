<?php

class DK_CustomerIP_Model_System_Config_Source_Backend_Cron extends Mage_Core_Model_Config_Data
{
    const CRON_PATH = 'crontab/jobs/ip_customer_update/schedule/cron_expr';

    protected function _afterSave()
    {
        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_PATH, 'path')
                ->setValue(Mage::helper('dk_customerip/cron')->getExprTime())
                ->setPath(self::CRON_PATH)
                ->save();

        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
        }
    }
}
