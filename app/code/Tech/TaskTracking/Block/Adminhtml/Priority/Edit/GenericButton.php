<?php

namespace Tech\TaskTracking\Block\Adminhtml\Priority\Edit;

use Magento\Search\Controller\RegistryConstants;

/**
 * 
 */
class GenericButton {
	/**
	 * 
	 */
	protected $urlBuilder;
	protected $registry;
	
	
	/**
	 * 
	 */
	public function __construct(
		\Magento\Backend\Block\Widget\Context $context,
		\Magento\Framework\Registry $registry
	) {
		$this->urlBuilder = $context->getUrlBuilder();
		$this->registry = $registry;
	}
	
	
	/**
	 * 
	 */
	public function getId() {
		$status = $this->registry->registry('tasktracking_priority');
		return $status ? $status->getPriorityId() : null;
	}
	
	
	/**
	 * 
	 */
	public function getUrl($route = '', $params = []) {
		return $this->urlBuilder->getUrl($route, $params);
	}
}