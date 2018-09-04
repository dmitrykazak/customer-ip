<?php

class DK_CustomerIP_Adminhtml_CustomeripController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
       try {
           $model = Mage::helper('dk_customerip')->getCurrentServiceModel();

           $model->setCustomerId('2')
               ->setIp('127.0.0.1');

           echo '<pre>';
           print_r($model->getData());
           die();


        } catch (Exception $e) {
           die();
        }

    }
}