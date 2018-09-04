<?php

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();

$installer->addAttribute('customer', 'registration_ip', [
    'type' => 'varchar',
    'label' => 'Customer\'s IP at registration',
    'visible' => false,
    'backend' => 'dk_customerip/entity_attribute_backend_ip',
    'required' => false,
]);

$installer->endSetup();
