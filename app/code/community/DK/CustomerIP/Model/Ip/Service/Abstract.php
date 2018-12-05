<?php

abstract class DK_CustomerIP_Model_Ip_Service_Abstract extends Varien_Object
{
    /**
     * @var Varien_Http_Client $httpClient
     */
    protected $httpClient;

    /**
     * @var array $error
     */
    protected $error = [];

    /**
     * @var DK_CustomerIP_Helper_Data $helper
     */
    protected $helper;

    public function _construct()
    {
        $this->httpClient = new Varien_Http_Client();
        $this->helper = Mage::helper('dk_customerip');
    }

    abstract public function call();
}
