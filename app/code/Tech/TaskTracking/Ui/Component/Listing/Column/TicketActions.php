<?php

namespace Tech\TaskTracking\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;

class TicketActions extends Column {
	/**
	 * 
	 */
	const URL_PATH_VIEW    = 'tasktracking/ticket/view';
	
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
				if (isset($item['ticket_id'])) {
					
					$item[$this->getData('name')] = [
						'view' => [
							'href' => $this->urlBuilder->getUrl(
								static::URL_PATH_VIEW,
								[
									'id' => $item['ticket_id']
								]
							),
							'label' => __('View')
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