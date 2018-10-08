<?php

/* @var $this Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();
$tableNameIP = $installer->getTable('dk_customerip/customer_info_ip');

$connection->addColumn($tableNameIP, 'normalized_info', 'TEXT NULL DEFAULT NULL');

$installer->endSetup();
