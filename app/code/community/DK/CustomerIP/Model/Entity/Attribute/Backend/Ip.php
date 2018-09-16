<?php

class DK_CustomerIP_Model_Entity_Attribute_Backend_Ip
    extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
    /**
     * @var DK_CustomerIP_Helper_Data $helper
     */
    private $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('dk_customerip');
    }

    public function beforeSave($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attrCode);

        if (!$object->getId() && is_null($value)) {
            $object->setData(
                $attrCode,
                $this->helper->getRemoteAddress()
            )->setData(
                'status_update_ip',
                DK_CustomerIP_Model_Info::PROCESSING_STATUS
            );
        }

        return parent::beforeSave($object);
    }
}
