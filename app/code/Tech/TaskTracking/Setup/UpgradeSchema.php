<?php
/**
 * UpgradeSchema for Tech TaskTracking module
 */

namespace Tech\TaskTracking\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 *
 */
class UpgradeSchema implements UpgradeSchemaInterface {
	/**
	 *
	 */
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$setup->startSetup();
		
		if (version_compare($context->getVersion(), '0.0.5', '<')) {
			$tableName = $setup->getTable('tasktracking_priority');
			$columns = [
				'importance' => [
					'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					'nullable' => false,
					'comment'  => 'Importance'
				],
			];
			$connection = $setup->getConnection();
			foreach ($columns as $name => $definition) {
				$connection->addColumn($tableName, $name, $definition);
			}
		}
		
		if (version_compare($context->getVersion(), '0.0.7', '<')) {
			$tableName = $setup->getTable('tasktracking_message');
			$columns = [
				'is_private' => [
					'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
					'nullable' => false,
					'comment'  => 'Is Private'
				],
				'admin_name' => [
					'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'nullable' => false,
					'length'   => 255,
					'comment'  => 'Admin Name'
				]
			];
			$connection = $setup->getConnection();
			foreach ($columns as $name => $definition) {
				$connection->addColumn($tableName, $name, $definition);
			}
		}
		
		$setup->endSetup();
	}
}