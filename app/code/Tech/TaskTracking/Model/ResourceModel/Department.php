<?php
/**
 * Department Resource Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel;

class Department extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('tasktracking_department', 'department_id');
	}
}