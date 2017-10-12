<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Status;

use Magento\Backend\App\Action\Context;
use Tech\TaskTracking\Model\Status;
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
		if ($data) {
			$id = $this->getRequest()->getParam('status_id');
			
			if (isset($data['is_active']) && $data['is_active'] === 'true') {
				$data['is_active'] = Status::STATUS_ENABLED;
			}
			if (empty($data['status_id'])) {
				$data['status_id'] = null;
			}
			$model = $this->_objectManager->create(\Tech\TaskTracking\Model\Status::class)->load($id);
			if (!$model->getId() && $id) {
				$this->messageManager->addError(__('This status no longer exists.'));
				return $resultRedirect->setPath('*/*/');
			}
			
			$model->setData($data);
			
			try {
				$model->save();
				$this->messageManager->addSuccess(__('You saved the status.'));
				$this->dataPersistor->clear('tasktracking_status');
				
				if ($this->getRequest()->getParam('back')) {
					return $resultRedirect->setPath('*/*/edit', ['status_id' => $model->getId()]);
				}
				return $resultRedirect->setPath('*/*/');
			} catch (LocalizedException $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\Exception $e) {
				$this->messageManager->addException($e, __('Something went wrong while saving the status.'));
			}
			
			$this->dataPersistor->set('tasktracking_status', $data);
			return $resultRedirect->setPath('*/*/edit', ['status_id' => $this->getRequest()->getParam('status_id')]);
		}
		return $resultRedirect->setPath('*/*/');
	}
}