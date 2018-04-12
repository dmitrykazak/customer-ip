<?php

class DK_CustomerIP_Model_System_Config_Source_Service
{
    const XML_SERVICE_PATH = 'global/ip/services';

    protected static $options = [];

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
