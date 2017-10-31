<?php

namespace Tech\TaskTracking\Model\ResourceModel\Priority\PrioritySource;

/**
 *
 */
class Options implements \Magento\Framework\Option\ArrayInterface {
	/**
	 *
	 */
	protected $_resourceModel;
	
	/**
	 *
	 */
	public function __construct(
		\Tech\TaskTracking\Model\ResourceModel\Priority\CollectionFactory $resourceModel
	) {
		$this->_resourceModel = $resourceModel;
	}
	
	
	/**
	 *
	 */
	public function toOptionArray() {
		$options = array();
		
		$options[] = array(
			'value' => '',
			'label' => __('Select Priority')
		);
		
		$priorityOptionArray = $this->_resourceModel->create()->addFieldToFilter('is_active', 1)->toOptionArray();
		
		foreach ($priorityOptionArray as $option) {
			$options[] = array(
				'value' => $option['value'],
				'label' => $option['label']
			);
		}
		
		return $options;
	}
}