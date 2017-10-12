<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Status;

class NewAction extends \Magento\Backend\App\Action {
	/**
	 * 
	 */
	protected $resultForwardFactory;
	protected $_coreRegistry;
	
	/**
	 * 
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
	) {
		$this->resultForwardFactory = $resultForwardFactory;
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context);
	}
	
	/**
	 * 
	 */
	public function execute() {
		$resultForward = $this->resultForwardFactory->create();
		
		return $resultForward->forward('edit');
	}
}
