<?php

namespace Ateli\Merchant\Setup;

use Magento\Framework\DB\Ddl\Table as ColumnType;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    const TABLE_NAME = 'ateli_merchant';

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists(self::TABLE_NAME)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable(self::TABLE_NAME)
            )->addColumn(
                'id',
                ColumnType::TYPE_INTEGER,
                10,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ]
            )->addColumn(
                'name',
                ColumnType::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ]
            )->addColumn(
                'web_address',
                ColumnType::TYPE_TEXT,
                255,
                [
                    'nullable' => true,
                ]
            )->addColumn(
                'email',
                ColumnType::TYPE_TEXT,
                255,
                [
                    'nullable' => false,
                ]
            )->addColumn(
                'created_at',
                ColumnType::TYPE_DATETIME,
                null,
                [
                    'nullable' => false,
                ]
            );

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }

}
