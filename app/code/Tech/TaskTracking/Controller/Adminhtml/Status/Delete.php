<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Status;

class Delete extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		// check if we know what should be deleted
		$id = $this->getRequest()->getParam('status_id');
		if ($id) {
			try {
				// init model and delete
				$model = $this->_objectManager->create(\Tech\TaskTracking\Model\Status::class);
				$model->load($id);
				$model->delete();
				// display success message
				$this->messageManager->addSuccess(__('You deleted the status.'));
				// go to grid
				return $resultRedirect->setPath('*/*/');
			} catch (\Exception $e) {
				// display error message
				$this->messageManager->addError($e->getMessage());
				// go back to edit form
				return $resultRedirect->setPath('*/*/edit', ['status_id' => $id]);
			}
		}
		// display error message
		$this->messageManager->addError(__('We can\'t find a status to delete.'));
		// go to grid
		return $resultRedirect->setPath('*/*/');
	}
}
