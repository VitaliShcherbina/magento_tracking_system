<?php
/**
 * Ticket Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Ticket;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected $_idFieldName = 'ticket_id';
	
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Tech\TaskTracking\Model\Ticket',
			'Tech\TaskTracking\Model\ResourceModel\Ticket'
		);
	}
}