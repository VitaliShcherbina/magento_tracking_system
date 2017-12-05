<?php

namespace Tech\TaskTracking\Block\Ticket;

use Tech\TaskTracking\Helper\Data as DataHelper;
/**
 *
 */
class StepTwo extends \Magento\Framework\View\Element\Template {
	/**
	 *
	 */
	protected $_departmentFactory;
	protected $_priorityCollectionOptions;
	protected $_dataHelper;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Tech\TaskTracking\Model\DepartmentFactory $departmentFactory,
		\Tech\TaskTracking\Model\ResourceModel\Priority\PrioritySource\Options $priorityCollectionOptions,
		DataHelper $dataHelper,
		array $data = []
	) {
		$this->_departmentFactory         = $departmentFactory;
		$this->_priorityCollectionOptions = $priorityCollectionOptions;
		$this->_dataHelper                = $dataHelper;
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
		$model = $this->_departmentFactory->create();
		if ($id) {
			$model->load($id);
			
			return $model->getDepartmentName();
		}
	}
	
	
	/**
	 *
	 */
	 public function getPriorityData() {
		$priorityData = $this->_priorityCollectionOptions->toOptionArray();
		
		return $priorityData;
	}
	
	
	/**
	 *
	 */
	public function getMaxAttachments() {
		return DataHelper::MAX_ATTACHMENTS;
	}
}