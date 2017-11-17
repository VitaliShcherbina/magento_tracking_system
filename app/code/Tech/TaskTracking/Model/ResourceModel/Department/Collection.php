<?php
/**
 * Department Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected $_idFieldName = 'department_id';
	
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Tech\TaskTracking\Model\Department',
			'Tech\TaskTracking\Model\ResourceModel\Department'
		);
	}
	
	
	/**
	 *
	 */
	public function toOptionArray() {
		return parent::_toOptionArray('department_id', 'department_name');
	}
}