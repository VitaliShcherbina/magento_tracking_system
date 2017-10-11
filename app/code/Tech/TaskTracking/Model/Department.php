<?php
/**
 * Department Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model;

class Department extends \Magento\Framework\Model\AbstractModel {
	/**
	 *
	 */
	const STATUS_ENABLED  = 1;
	const STATUS_DISABLED = 0;
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('Tech\TaskTracking\Model\ResourceModel\Department');
	}
}