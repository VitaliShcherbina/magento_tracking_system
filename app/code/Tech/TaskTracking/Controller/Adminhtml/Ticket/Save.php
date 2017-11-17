<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Ticket;

class Save extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	
	const ACL_RESOURCE = 'Tech_TaskTracking::tracking';
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		$this->resultPageFactory = $resultPageFactory;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	protected function _isAllowed() {
		$result = parent::_isAllowed();
		$result = $result && $this->_authorization->isAllowed(self::ACL_RESOURCE);
		
		return $result;
	}
	
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		$data = $this->getRequest()->getPostValue();
		var_dump($data);die;
		
		return $resultRedirect->setPath('*/*/*');
	}
}