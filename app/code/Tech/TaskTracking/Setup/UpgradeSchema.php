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
		if (version_compare($context->getVersion(), '0.0.5', '<')) {
			$setup->startSetup();
			
			$tableName = $setup->getTable('tasktracking_priority');
			$columns = [
				'importance' => [
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					'nullable' => false,
					'comment' => 'Importance',
				],
			];
			$connection = $setup->getConnection();
			foreach ($columns as $name => $definition) {
				$connection->addColumn($tableName, $name, $definition);
			}
			
			$setup->endSetup();
		}
	}
}