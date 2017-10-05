<?php
/**
 * Ticket Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model;

class Ticket extends \Magento\Framework\Model\AbstractModel {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('Tech\TaskTracking\Model\ResourceModel\Ticket');
	}
}