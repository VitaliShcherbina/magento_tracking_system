<?php

namespace Tech\TaskTracking\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;

class DepartmentActions extends Column {
	/**
	 * 
	 */
	const URL_PATH_EDIT    = 'tasktracking/department/edit';
	const URL_PATH_DELETE  = 'tasktracking/department/delete';
	
	protected $urlBuilder;
	private $escaper;
	/**
	 * 
	 */
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		UrlInterface $urlBuilder,
		array $components = [],
		array $data = []
	) {
		$this->urlBuilder = $urlBuilder;
		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	/**
	 * 
	 */
	public function prepareDataSource(array $dataSource) {
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as & $item) {
				if (isset($item['department_id'])) {
					$title = $this->getEscaper()->escapeHtml($item['department_name']);
					
					$item[$this->getData('name')] = [
						'edit' => [
							'href' => $this->urlBuilder->getUrl(
								static::URL_PATH_EDIT,
								[
									'department_id' => $item['department_id']
								]
							),
							'label' => __('Edit')
						],
						'delete' => [
							'href' => $this->urlBuilder->getUrl(
								static::URL_PATH_DELETE,
								[
									'department_id' => $item['department_id']
								]
							),
							'label' => __('Delete'),
							'confirm' => [
								'title' => __('Delete %1', $title),
								'message' => __('Are you sure you want to delete a %1 record?', $title)
							]
						]
					];
				}
			}
		}
		
		return $dataSource;
	}
	
	
	/**
	 * 
	 */
	private function getEscaper() {
		if (!$this->escaper) {
			$this->escaper = ObjectManager::getInstance()->get(Escaper::class);
		}
		
		return $this->escaper;
	}
}