<?php

namespace Tech\TaskTracking\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {
	/**
	 *
	 */
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
		
		$data = [
			[1, 'in progress', 1],
			[2, 'closed', 1],
			[3, 'pending', 1]
		];
		
		$columns = ['status_id', 'status_value', 'is_active'];
		$setup->getConnection()->insertArray($setup->getTable('tasktracking_status'), $columns, $data);
	}
}