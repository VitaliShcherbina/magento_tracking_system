<?php

namespace Tech\TaskTracking\Block\Ticket;

/**
 *
 */
class NewTicket extends \Magento\Framework\View\Element\Template {
	/**
	 *
	 */
	protected $departmentCollectionFactory;
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Tech\TaskTracking\Model\ResourceModel\Department\CollectionFactory $departmentCollectionFactory,
		array $data = []
	) {
		$this->departmentCollectionFactory = $departmentCollectionFactory;
		parent::__construct($context, $data);
	}
	
	
	/**
	 *
	 */
	public function getNextAction() {
		return '/tasktracking/ticket/steptwo';
	}
	
	
	/**
	 *
	 */
	 public function getDepartmentCollection() {
		$collection = $this->departmentCollectionFactory->create();
		$collection->addFieldToFilter('is_active', 1);
		
		return $collection;
	}
}