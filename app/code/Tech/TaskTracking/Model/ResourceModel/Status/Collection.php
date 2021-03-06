<?php
/**
 * Status Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Status;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected $_idFieldName = 'status_id';
	
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Tech\TaskTracking\Model\Status',
			'Tech\TaskTracking\Model\ResourceModel\Status'
		);
	}
	
	
	/**
	 *
	 */
	public function toOptionArray() {
		return parent::_toOptionArray('status_id', 'status_value');
	}
}