<?php

namespace Custom\HelloWorld\Setup;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        try {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('custom_sample_item'))
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true
                    ],
                    'Item id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Item name'
                )
                ->addIndex(
                    $setup->getIdxName('custom_sample_item', ['name']),
                    ['name']
                )
                ->setComment(
                    'Sample Items'
                );
            $setup->getConnection()->createTable($table);
        } catch (Zend_Db_Exception $e) {
            $level = 'ERROR';
            ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->log($level, $e->getMessage());
        }

        $setup->endSetup();
    }
}
