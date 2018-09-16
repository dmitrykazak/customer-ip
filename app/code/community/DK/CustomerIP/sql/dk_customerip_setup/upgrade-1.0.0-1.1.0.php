<?php

/* @var $this Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();
$tableNameIP = $installer->getTable('dk_customerip/customer_info_ip');

if ($connection->isTableExists($tableNameIP)) {
    $connection->dropTable($tableNameIP);
}

$infoTable = $connection
    ->newTable($tableNameIP)
    ->addColumn(
        'info_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
        ]
    )
    ->addColumn(
        'customer_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'nullable' => false,
        ],
        'Customer ID for IP'
    )->addColumn(
        'info',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'nullable' => true,
            'default' => null,
        ],
        'All information on IP'
    )->addColumn(
        'created_time',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [
            'nullable' => false,
            'default' => '0000-00-00 00:00:00',
        ],
        'Date and Time of record creation'
    )->addIndex(
        $installer->getIdxName('dk_customerip/customer_info_ip', ['customer_id']),
        ['customer_id']
    )
    ->setComment(
        'Table for storing information for IP'
    );

$connection->createTable($infoTable);

$connection->addForeignKey(
    $installer->getFkName(
        $tableNameIP,
        'customer_id',
        'customer/entity',
        'entity_id'
    ),
    $tableNameIP,
    'customer_id',
    $installer->getTable('customer/entity'),
    'entity_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$installer->endSetup();

