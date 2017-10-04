<?php
/**
 * Message Resource Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel;

class Message extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('tasktracking_message', 'message_id');
	}
}