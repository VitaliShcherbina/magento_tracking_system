<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Ticket;

use Magento\Backend\App\Action;

class View extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	protected $_coreRegistry = null;
	protected $resultPageFactory;
	protected $_ticketFactory;
	
	/**
	 *
	 */
	public function __construct(
		Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory,
		\Magento\Framework\Registry $registry
	)
	{
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry     = $registry;
		$this->_ticketFactory    = $ticketFactory;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	protected function _isAllowed() {
		return $this->_authorization->isAllowed('Tech_TaskTracking::save');
	}
	
	
	/**
	 *
	 */
	protected function _initAction() {
		// load layout, set active menu and breadcrumbs
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('Tech_TaskTracking::tracking');
		return $resultPage;
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$id = $this->getRequest()->getParam('id');
		$model = $this->_ticketFactory->create();
		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This ticket no longer exists.'));
				
				$resultRedirect = $this->resultRedirectFactory->create();
				
				return $resultRedirect->setPath('*/*/');
			}
		}
		
		$this->_coreRegistry->register('ticket', $model);
		
		$resultPage = $this->_initAction();
		$resultPage->getConfig()->getTitle()->prepend(__('Ticket'));
		
		return $resultPage;
	}
}