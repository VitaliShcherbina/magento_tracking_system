<?php
/**
 * Ticket Resource Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel;

class Ticket extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('tasktracking_ticket', 'ticket_id');
	}
	
	
	/**
	 *
	 */
	protected function _getLoadSelect($field, $value, $object) {
		$select = parent::_getLoadSelect($field, $value, $object);
		
		$select->joinLeft(
			array('department' => 'tasktracking_department'),
			$this->getMainTable() . '.department_id = department.department_id',
			array('department_name')
		)->joinLeft(
			array('status' => 'tasktracking_status'),
			$this->getMainTable() . '.status_id = status.status_id',
			array('status_value')
		)->joinLeft(
			array('priority' => 'tasktracking_priority'),
			$this->getMainTable() . '.priority_id = priority.priority_id',
			array('priority_value')
		);
		
		return $select;
	}
}