<?php
/**
 * Priority Model for Tech TaskTracking module
 */
namespace Tech\TaskTracking\Model;

class Priority extends \Magento\Framework\Model\AbstractModel {
	/**
	 *
	 */
	protected function _construct() {
		$this->_init('Tech\TaskTracking\Model\ResourceModel\Priority');
	}
}