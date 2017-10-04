<?php
/**
 * Status Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Status;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Teck\TaskTracking\Model\Status',
			'Teck\TaskTracking\Model\ResourceModel\Status'
		);
	}
}