<?php
/**
 * Department Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Teck\TaskTracking\Model\Department',
			'Teck\TaskTracking\Model\ResourceModel\Department'
		);
	}
}