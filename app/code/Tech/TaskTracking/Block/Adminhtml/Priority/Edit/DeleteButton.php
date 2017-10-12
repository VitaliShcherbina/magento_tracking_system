<?php

namespace Tech\TaskTracking\Block\Adminhtml\Priority\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface {
	/**
	 * 
	 */
	public function getButtonData() {
		$data = [];
		if ($this->getId()) {
			$data = [
				'label' => __('Delete'),
				'class' => 'delete',
				'on_click' => 'deleteConfirm(\''
					. __('Are you sure you want to delete this status ?')
					. '\', \'' . $this->getDeleteUrl() . '\')',
				'sort_order' => 20,
			];
		}
		return $data;
	}
	
	
	/**
	 * 
	 */
	public function getDeleteUrl() {
		return $this->getUrl('*/*/delete', ['priority_id' => $this->getId()]);
	}
}