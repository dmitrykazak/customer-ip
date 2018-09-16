<?php

class DK_CustomerIP_TestController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        Mage::getModel('dk_customerip/process')->updateCustomerIp();
    }
}