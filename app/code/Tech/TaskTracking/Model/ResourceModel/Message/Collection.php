<?php
/**
 * Message Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Message;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Teck\TaskTracking\Model\Message',
			'Teck\TaskTracking\Model\ResourceModel\Message'
		);
	}
}