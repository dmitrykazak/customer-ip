<?php

class DK_CustomerIP_TestController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        echo "<pre>";
        print_r(Mage::helper('dk_customerip/cron')->getExprTime());
        die();
    }
}