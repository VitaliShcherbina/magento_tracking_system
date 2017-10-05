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
			'Tech\TaskTracking\Model\Message',
			'Tech\TaskTracking\Model\ResourceModel\Message'
		);
	}
}