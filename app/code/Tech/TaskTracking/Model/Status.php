<?php
/**
 * Status Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model;

class Status extends \Magento\Framework\Model\AbstractModel {
	/**
	 *
	 */
	const STATUS_ENABLED    = 1;
	const STATUS_DISABLED   = 0;
	const DEFAULT_STATUS_ID = 3;
	
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('Tech\TaskTracking\Model\ResourceModel\Status');
	}
}