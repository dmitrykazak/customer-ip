<?php

class DK_CustomerIP_Helper_Cron extends Mage_Core_Helper_Abstract
{

    public function getImportEnabled()
    {
        return Mage::getStoreConfig('dk_customerip/import/enabled');
    }

    public function getImportTime()
    {
        return Mage::getStoreConfig('dk_customerip/import/time');
    }

    public function getImportFrequency()
    {
        return Mage::getStoreConfig('dk_customerip/import/frequency');
    }

    public function asArrayTime()
    {
        $regexp = '/(?<hour>\d{2}?),(?<minute>\d{2}),(?<second>\d{2})/';

        if (preg_match($regexp, $this->getImportTime(), $matches)) {
            return array_map(function ($value) {
                return intval($value);
            }, $matches);
        }

        return [];
    }

    public function getExprTime()
    {
        $frequencyWeekly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_WEEKLY;
        $frequencyMonthly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_MONTHLY;

        $time = $this->asArrayTime();

        $cronExpr = [
            $time['minute'],
            $time['hour'],
            ($this->getImportFrequency() === $frequencyMonthly) ? 1 : '*',
            '*',
            ($this->getImportFrequency() === $frequencyWeekly) ? 1 : '*',
        ];

        return join(' ', $cronExpr);
    }
}
