<?php

namespace Tech\TaskTracking\Block\Adminhtml\Priority\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton implements ButtonProviderInterface {
	/**
	 * 
	 */
	public function getButtonData() {
		return [
			'label' => __('Reset'),
			'class' => 'reset',
			'on_click' => 'location.reload();',
			'sort_order' => 30
		];
	}
}