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
}