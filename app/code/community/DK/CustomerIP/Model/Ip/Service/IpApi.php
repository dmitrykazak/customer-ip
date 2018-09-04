<?php

class DK_CustomerIP_Model_Ip_Service_IpApi
    extends DK_CustomerIP_Model_Ip_Service_Object
    implements DK_CustomerIP_Model_Ip_Service_Interface
{
    protected $url = 'https://ipapi.co/{{IP_ADDRESS}}/json/';

    protected $message = [];
    /**
     * @var Varien_Http_Client $httpClient
     */
    protected $httpClient;

    /**
     * @var DK_CustomerIP_Helper_Data $helper
     */
    protected $helper;

    public function __construct()
    {
        $this->httpClient = new Varien_Http_Client();
        $this->helper = Mage::helper('dk_customerip');
    }

    public function update()
    {
        $url = str_replace('{{IP_ADDRESS}}', $this->getIp(), $this->url);

        try {
            $response = $this->httpClient
                ->setUri($url)
                ->setConfig(['timeout' => Mage::getStoreConfig('dk_customerip/ipapi/timeout')])
                ->request('GET')
                ->getBody();

            if ($response) {
                return Zend_Json_Decoder::decode($response);
            }

            return [];
        } catch (Exception $e) {
            array_push($this->message, $this->helper->__('Cannot get IP address %s.', $url));
        }
    }
}