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
	
	
	/**
	 *
	 */
	protected function _afterLoad() {
		$result = parent::_afterLoad();
		foreach ($this->_items as $item) {
			$attachments = unserialize($item->getAttachment());
			$item->setData('attachment', $attachments);
		}
		
		return $result;
	}
}