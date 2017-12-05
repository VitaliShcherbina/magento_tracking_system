<?php

namespace Tech\TaskTracking\Controller\Ticket;

class StepTwo extends \Magento\Framework\App\Action\Action {
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
		
		if ($this->_session->isLoggedIn()) {
			$id = $this->getRequest()->getParam('department_id');
			
			if (!$id && !is_numeric($id)) {
				$this->messageManager->addError(__('Please select the Department.'));
				
				return $resultRedirect->setPath('*/*/newticket');
			}
			$resultPage = $this->resultPageFactory->create();
			$resultPage->getLayout()->getBlock('ticket.step.two')->setDepartmentId($id);
			
			return $resultPage;
		}
		else {
			$this->messageManager->addNoticeMessage(__('You must be logged in to view this page.'));
			
			return $resultRedirect->setPath('customer/account/login');
		}
	}
}