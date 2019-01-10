<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();

$fields = [
    'registration_ip' => [
        'type' => 'varchar',
        'label' => 'Customer\'s IP at registration',
        'backend' => 'dk_customerip/entity_attribute_backend_ip',
        'visible' => false,
        'required' => false,
    ],
    'status_update_ip' => [
        'type' => 'int',
        'label' => 'Customer\'s status update IP',
        'visible' => false,
        'default' => DK_CustomerIP_Model_Info::DISABLED_STATUS,
        'required' => false,
    ],
];

foreach ($fields as $key => $option) {
    if ($installer->getAttribute('customer', $key)) {
        $installer->removeAttribute('customer', $key);
    }

    $installer->addAttribute('customer', $key, $option);
}

$connection = $installer->getConnection();
$table = $installer->getTable('newsletter_subscriber');

if (!$connection->tableColumnExists($table, 'registration_ip')) {
    $connection->addColumn($table, 'registration_ip', 'VARCHAR(20) NULL DEFAULT NULL');
}

if (!$connection->tableColumnExists($table, 'status_update_ip')) {
    $connection->addColumn($table, 'status_update_ip', 'TINYINT(1) unsigned NOT NULL DEFAULT 0');
}

$installer->endSetup();
