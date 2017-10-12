<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Priority;

use Magento\Backend\App\Action\Context;
use Tech\TaskTracking\Model\Priority;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;

class Save extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	protected $dataPersistor;
	protected $_coreRegistry;
	
	/**
	 *
	 */
	public function __construct(
		Context $context,
		\Magento\Framework\Registry $coreRegistry,
		DataPersistorInterface $dataPersistor
	) {
		$this->dataPersistor = $dataPersistor;
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		$data = $this->getRequest()->getPostValue();
		$mode = true;
		if ($data) {
			$id = $this->getRequest()->getParam('priority_id');
			
			if (isset($data['is_active']) && $data['is_active'] === 'true') {
				$data['is_active'] = Priority::STATUS_ENABLED;
			}
			if (empty($data['priority_id'])) {
				$data['priority_id'] = null;
				$mode = false;
			}
			
			$model = $this->_objectManager->create(\Tech\TaskTracking\Model\Priority::class)->load($id);
			
			if (!is_numeric($data['importance'])) {
				$this->messageManager->addError(__('Importance must be a number.'));
				
				return $resultRedirect->setPath('*/*/' . ($mode ? 'edit' : 'new'), ['priority_id' => $model->getId()]);
			}
			
			if (!$model->getId() && $id) {
				$this->messageManager->addError(__('This priority no longer exists.'));
				return $resultRedirect->setPath('*/*/');
			}
			
			$model->setData($data);
			
			try {
				$model->save();
				$this->messageManager->addSuccess(__('You saved the priority.'));
				$this->dataPersistor->clear('tasktracking_priority');
				
				if ($this->getRequest()->getParam('back')) {
					return $resultRedirect->setPath('*/*/edit', ['priority_id' => $model->getId()]);
				}
				return $resultRedirect->setPath('*/*/');
			} catch (LocalizedException $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\Exception $e) {
				$this->messageManager->addException($e, __('Something went wrong while saving the priority.'));
			}
			
			$this->dataPersistor->set('tasktracking_priority', $data);
			return $resultRedirect->setPath('*/*/edit', ['priority_id' => $this->getRequest()->getParam('priority_id')]);
		}
		return $resultRedirect->setPath('*/*/');
	}
}