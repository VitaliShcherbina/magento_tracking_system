<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Status;

class Index extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	
	const ACL_RESOURCE = 'Tech_TaskTracking::tracking';
	const MENU_ITEM    = 'Tech_TaskTracking::tracking';
	const TITLE        = 'Statuses';
	
	protected $resultPageFactory;
	
	
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
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu(self::MENU_ITEM);
		$resultPage->getConfig()->getTitle()->prepend(__(self::TITLE));
		
		return $resultPage;
	}
}