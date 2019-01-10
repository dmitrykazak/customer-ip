<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();
$tableNameIP = $installer->getTable('dk_customerip/customer_info_ip');

if (!$connection->tableColumnExists($tableNameIP, 'normalized_info')) {
    $connection->addColumn($tableNameIP, 'normalized_info', 'TEXT NULL DEFAULT NULL');
}

$installer->endSetup();

