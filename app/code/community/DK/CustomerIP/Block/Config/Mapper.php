<?php

class DK_CustomerIP_Block_Config_Mapper
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected function _prepareToRender()
    {
        $helper = Mage::helper('dk_customerip');

        $this->addColumn('mapper_field', [
            'label' => $helper->__('Mapper Field'),
            'style' => 'width:100px',
        ]);

        $this->addColumn('field', [
            'label' => $helper->__('Field'),
            'style' => 'width:100px',
        ]);

        $this->_addAfter = false;
        $this->_addButtonLabel = $helper->__('Add');
    }
}