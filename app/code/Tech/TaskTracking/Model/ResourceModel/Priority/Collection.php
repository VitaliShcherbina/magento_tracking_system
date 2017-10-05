<?php
/**
 * Priority Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Priority;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Tech\TaskTracking\Model\Priority',
			'Tech\TaskTracking\Model\ResourceModel\Priority'
		);
	}
}