<?php

namespace Tech\TaskTracking\Controller\Ticket;

class NewTicket extends \Magento\Framework\App\Action\Action {
	/**
	 *
	 */
	protected $_resultPageFactory;
	protected $_session;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Customer\Model\Session $session
	) {
		$this->_resultPageFactory = $resultPageFactory;
		$this->_session = $session;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		
		if ($this->_session->isLoggedIn()) {
			return $this->_resultPageFactory->create();
		} else {
			$this->messageManager->addNoticeMessage(__('You must be logged in to view this page.'));
			
			return $resultRedirect->setPath('customer/account/login');
		}
	}
}