<?php

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();

$installer->addAttribute('customer', 'ip_status', [
    'type' => 'int',
    'label' => 'Status customer IP for updating',
    'visible' => true,
    'required' => false,
]);

$installer->endSetup();
