<?php

abstract class DK_CustomerIP_Model_Ip_Service_Abstract extends Varien_Object
{
    const XML_API_KEY_PATH = '';

    /**
     * @var DK_CustomerIP_Helper_Data $helper
     */
    private $helper;

    /**
     * @var Varien_Http_Client $httpClient
     */
    private $httpClient;

    /**
     * @var array $error
     */
    protected $error = [];

    public function _construct()
    {
        $this->httpClient = new Varien_Http_Client();
    }

    /**
     * @return DK_CustomerIP_Helper_Data
     */
    public function getHelper()
    {
        if (!$this->helper) {
            $this->helper = Mage::helper('dk_customerip');
        }

        return $this->helper;
    }

    /**
     * @return Varien_Http_Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return Mage::getStoreConfig(static::XML_API_KEY_PATH);
    }

    abstract public function call();
}
