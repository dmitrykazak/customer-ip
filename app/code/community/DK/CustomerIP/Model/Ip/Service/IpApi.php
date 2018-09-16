<?php

/**
 * Class DK_CustomerIP_Model_Ip_Service_IpApi
 */
class DK_CustomerIP_Model_Ip_Service_IpApi
    extends DK_CustomerIP_Model_Ip_Service_Abstract
{
    /**
     * @var string $url
     */
    protected $url = 'https://ipapi.co/{{IP_ADDRESS}}/json/';

    /**
     * @return array|mixed
     */
    public function call()
    {
        $url = str_replace('{{IP_ADDRESS}}', $this->getIp(), $this->url);

        try {
            $response = $this->httpClient
                ->setUri($url)
                ->setConfig(['timeout' => Mage::getStoreConfig('dk_customerip/ipapi/timeout')])
                ->request('GET')
                ->getBody();

            if ($response) {
                return $response;
            }

            return [];
        } catch (Exception $e) {
            array_push($this->message, $this->helper->__('Cannot get IP address %s.', $url));
        }
    }
}