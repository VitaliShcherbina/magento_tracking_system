<?php
/**
 * Priority Collection for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model\ResourceModel\Priority;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	/**
	 *
	 */
	protected $_idFieldName = 'priority_id';
	
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(
			'Tech\TaskTracking\Model\Priority',
			'Tech\TaskTracking\Model\ResourceModel\Priority'
		);
	}
	
	
	/**
	 *
	 */
	public function toOptionArray() {
		return parent::_toOptionArray('priority_id', 'priority_value');
	}
}