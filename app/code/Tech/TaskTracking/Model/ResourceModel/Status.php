<?php
/**
 * Status Resource Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel;

class Status extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('tasktracking_status', 'status_id');
	}
}