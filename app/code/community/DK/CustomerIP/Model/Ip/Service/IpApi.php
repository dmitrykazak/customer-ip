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
 * Class DK_CustomerIP_Model_Ip_Service_IpApi
 */
class DK_CustomerIP_Model_Ip_Service_IpApi
    extends DK_CustomerIP_Model_Ip_Service_Abstract
{
    const XML_API_KEY_PATH = 'dk_customerip/ipapi/apikey';

    /**
     * @var string $url
     */
    private $url = 'https://ipapi.co/{{IP_ADDRESS}}/json/';

    /**
     * @return array|mixed
     */
    public function call()
    {
        $url = str_replace('{{IP_ADDRESS}}', $this->getIp(), $this->url);

        try {
            $client = $this->getHttpClient()
                ->setUri($url)
                ->setConfig(['timeout' => Mage::getStoreConfig('dk_customerip/ipapi/timeout')]);

            if ($apiKey = $this->getApiKey()) {
                $client->setParameterGet('key', $apiKey);
            }

            $response = $client->request('GET')->getBody();

            if ($response) {
                return $response;
            }

            return [];
        } catch (Exception $e) {
            array_push($this->error, $this->getHelper()->__('Cannot get IP address %s.', $url));
        }
    }
}
