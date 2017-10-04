<?php
/**
 * InstallSchema for Tech TaskTracking module
 */

namespace Tech\TaskTracking\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * 
 */
class InstallSchema implements InstallSchemaInterface {
	/**
	 * 
	 */
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$installer = $setup;
		$installer->startSetup();
		/**
		 * Create table 'Department'
		 */
		$table = $installer->getConnection()
			->newTable($installer->getTable('tasktracking_department'))
			->addColumn(
				'department_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Department ID'
			)
			->addColumn(
				'department_name',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				64,
				['nullable' => false],
				'Department Name'
			)
			->addColumn(
				'is_active',
				\Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
				null,
				['nullable' => false, 'default' => '0'],
				'Is active'
			)
			->setComment('Tech TaskTracking Department table');
		
		$installer->getConnection()->createTable($table);
		
		
		/**
		 * Create table 'Status'
		 */
		$table = $installer->getConnection()
			->newTable($installer->getTable('tasktracking_status'))
			->addColumn(
				'status_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Status ID'
			)
			->addColumn(
				'status_value',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				64,
				['nullable' => false],
				'Status Value'
			)
			->addColumn(
				'is_active',
				\Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
				null,
				['nullable' => false, 'default' => '0'],
				'Is active'
			)
			->setComment('Status table');
		
		$installer->getConnection()->createTable($table);
		
		
		/**
		 * Create table 'Priority'
		 */
		$table = $installer->getConnection()
			->newTable($installer->getTable('tasktracking_priority'))
			->addColumn(
				'priority_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Status ID'
			)
			->addColumn(
				'priority_value',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				64,
				['nullable' => false],
				'Priority Value'
			)
			->addColumn(
				'is_active',
				\Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
				null,
				['nullable' => false, 'default' => '0'],
				'Is active'
			)
			->setComment('Priority table');
		
		$installer->getConnection()->createTable($table);
		
		
		/**
		 * Create table 'Ticket'
		 */
		$table = $installer->getConnection()
			->newTable($installer->getTable('tasktracking_ticket'))
			->addColumn(
				'ticket_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Ticket ID'
			)
			->addColumn(
				'department_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Department ID'
			)
			->addColumn(
				'customer_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Customer ID'
			)
			->addColumn(
				'status_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Status ID'
			)
			->addColumn(
				'priority_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Priority ID'
			)
			->addColumn(
				'email',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				80,
				['nullable' => false],
				'EMAIL'
			)
			->addColumn(
				'created_at',
				\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
				'Created At'
			)
			->addColumn(
				'updated_at',
				\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
				'Updated At'
			)
			->setComment('Ticket table');
		
		$installer->getConnection()->createTable($table);
		
		
		/**
		 * Create table 'Message'
		 */
		$table = $installer->getConnection()
			->newTable($installer->getTable('tasktracking_message'))
			->addColumn(
				'message_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Message ID'
			)
			->addColumn(
				'message_text',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Message Text'
			)
			->addColumn(
				'attachment',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Attachment'
			)
			->addColumn(
				'ticket_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Ticket ID'
			)
			->addColumn(
				'created_at',
				\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
				'Created At'
			)
			->setComment('Message table');
		
		$installer->getConnection()->createTable($table);
		
		$installer->endSetup();
	}
}