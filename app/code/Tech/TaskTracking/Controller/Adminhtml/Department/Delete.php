<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Department;

class Delete extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		// check if we know what should be deleted
		$id = $this->getRequest()->getParam('department_id');
		if ($id) {
			try {
				// init model and delete
				$model = $this->_objectManager->create(\Tech\TaskTracking\Model\Department::class);
				$model->load($id);
				$model->delete();
				// display success message
				$this->messageManager->addSuccess(__('You deleted the block.'));
				// go to grid
				return $resultRedirect->setPath('*/*/');
			} catch (\Exception $e) {
				// display error message
				$this->messageManager->addError($e->getMessage());
				// go back to edit form
				return $resultRedirect->setPath('*/*/edit', ['department_id' => $id]);
			}
		}
		// display error message
		$this->messageManager->addError(__('We can\'t find a block to delete.'));
		// go to grid
		return $resultRedirect->setPath('*/*/');
	}
}
