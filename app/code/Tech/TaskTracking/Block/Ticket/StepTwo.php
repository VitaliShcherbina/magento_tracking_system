<?php

namespace Tech\TaskTracking\Block\Ticket;

/**
 *
 */
class StepTwo extends \Magento\Framework\View\Element\Template {
	/**
	 *
	 */
	protected $departmentFactory;
	protected $priorityCollectionOptions;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Tech\TaskTracking\Model\DepartmentFactory $departmentFactory,
		\Tech\TaskTracking\Model\ResourceModel\Priority\PrioritySource\Options $priorityCollectionOptions,
		array $data = []
	) {
		$this->departmentFactory = $departmentFactory;
		$this->priorityCollectionOptions = $priorityCollectionOptions;
		parent::__construct($context, $data);
	}
	
	
	/**
	 *
	 */
	public function getSubmitAction() {
		return '/tasktracking/ticket/save';
	}
	
	
	/**
	 *
	 */
	public function getDepartmentNameById($id) {
		$model = $this->departmentFactory->create();
		if ($id) {
			$model->load($id);
			
			return $model->getDepartmentName();
		}
	}
	
	
	/**
	 *
	 */
	 public function getPriorityData() {
		
		$priorityData = $this->priorityCollectionOptions->toOptionArray();
		
		return $priorityData;
	}
}