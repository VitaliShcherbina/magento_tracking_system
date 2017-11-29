<?php

namespace Tech\TaskTracking\Controller\Ticket;

class View extends \Magento\Framework\App\Action\Action {
	/**
	 *
	 */
	protected $resultPageFactory;
	protected $_session;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Customer\Model\Session $session
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_session = $session;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		$ticketId = (int) $this->getRequest()->getParam('id');
		
		if ($this->_session->isLoggedIn() and $ticketId) {
			$resultPage = $this->resultPageFactory->create();
			$resultPage->getLayout()->getBlock('user.ticket')->setTicketId($ticketId);
			$resultPage->getLayout()->getBlock('user.message')->setTicketId($ticketId);
			
			return $resultPage;
		} else {
			$this->messageManager->addNoticeMessage(__('You must be logged in to view this page.'));
			
			return $resultRedirect->setPath('customer/account/login');
		}
		
	}
}