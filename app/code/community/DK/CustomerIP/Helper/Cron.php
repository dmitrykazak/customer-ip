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
 * Class DK_CustomerIP_Helper_Cron
 */
class DK_CustomerIP_Helper_Cron extends Mage_Core_Helper_Abstract
{
    /**
     * @return bool
     */
    public function getImportEnabled()
    {
        return Mage::getStoreConfigFlag('dk_customerip/import/enabled');
    }

    /**
     * @return string
     */
    public function getImportTime()
    {
        return Mage::getStoreConfig('dk_customerip/import/time');
    }

    /**
     * @return string
     */
    public function getImportFrequency()
    {
        return Mage::getStoreConfig('dk_customerip/import/frequency');
    }

    /**
     * @return array
     */
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

    /**
     * @return string
     */
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
