<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Status;

class Edit extends \Magento\Backend\App\Action {
	/**
	 * 
	 */
	const MENU_ITEM  = 'Tech_TaskTracking::tracking';
	const TITLE_NEW  = 'New Status';
	const TITLE_EDIT = 'Edit Status';
	
	protected $resultPageFactory;
	protected $_coreRegistry;
	
	
	/**
	 * 
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context);
	}
	
	
	/**
	 * 
	 */
	public function execute() {
		// Get ID and create model
		$id = $this->getRequest()->getParam('status_id');
		$model = $this->_objectManager->create(\Tech\TaskTracking\Model\Status::class);
		
		// Initial checking
		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This status no longer exists.'));
				
				$resultRedirect = $this->resultRedirectFactory->create();
				
				return $resultRedirect->setPath('*/*/');
			}
		}
		
		$this->_coreRegistry->register('tasktracking_status', $model);
		
		// Build edit form
		$resultPage = $this->resultPageFactory->create();
		
		$resultPage->setActiveMenu(self::MENU_ITEM);
		$resultPage->getConfig()->getTitle()->prepend($model->getId() ? __(self::TITLE_EDIT) : __(self::TITLE_NEW));
		
		return $resultPage;
	}
}
