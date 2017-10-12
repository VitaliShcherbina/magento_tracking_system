<?php

namespace Tech\TaskTracking\Model\Priority;

use Tech\TaskTracking\Model\ResourceModel\Priority\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * 
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {
	/**
	 * 
	 */
	protected $collection;
	protected $dataPersistor;
	protected $loadedData;
	
	
	/**
	 * 
	 */
	public function __construct(
		$name,
		$primaryFieldName,
		$requestFieldName,
		CollectionFactory $departmentCollectionFactory,
		DataPersistorInterface $dataPersistor,
		array $meta = [],
		array $data = []
	) {
		$this->collection = $departmentCollectionFactory->create();
		$this->dataPersistor = $dataPersistor;
		parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
	}
	
	
	/**
	 * 
	 */
	public function getData() {
		if (isset($this->loadedData)) {
			return $this->loadedData;
		}
		$items = $this->collection->getItems();
		
		foreach ($items as $status) {
			$this->loadedData[$status->getPriorityId()] = $status->getData();
		}
		
		$data = $this->dataPersistor->get('tasktracking_priority');
		if (!empty($data)) {
			$status = $this->collection->getNewEmptyItem();
			$status->setData($data);
			$this->loadedData[$status->getPriorityId()] = $status->getData();
			$this->dataPersistor->clear('tasktracking_priority');
		}
		
		return $this->loadedData;
	}
}
