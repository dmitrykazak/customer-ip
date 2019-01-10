<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class DK_CustomerIP_Model_System_Config_Source_Service
{
    const XML_SERVICE_PATH = 'global/ip/services';

    protected static $options = [];

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if (!self::$options) {
            $services = Mage::getConfig()->getNode(self::XML_SERVICE_PATH)->asArray();

            foreach ($services as $code => $server) {
                array_push(self::$options, [
                    'label' => $server['name'],
                    'value' => $code,
                ]);
            }
        }

        return self::$options;
    }
}
