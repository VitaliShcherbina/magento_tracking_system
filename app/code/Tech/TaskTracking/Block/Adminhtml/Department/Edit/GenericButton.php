<?php

namespace Tech\TaskTracking\Block\Adminhtml\Department\Edit;

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
		$department = $this->registry->registry('tasktracking_department');
		return $department ? $department->getDepartmentId() : null;
	}
	
	
	/**
	 * 
	 */
	public function getUrl($route = '', $params = []) {
		return $this->urlBuilder->getUrl($route, $params);
	}
}