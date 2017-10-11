<?php

namespace Tech\TaskTracking\Model\Department;

use Tech\TaskTracking\Model\ResourceModel\Department\CollectionFactory;
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
		
		foreach ($items as $department) {
			$this->loadedData[$department->getDepartmentId()] = $department->getData();
		}
		
		$data = $this->dataPersistor->get('tasktracking_department');
		if (!empty($data)) {
			$department = $this->collection->getNewEmptyItem();
			$department->setData($data);
			$this->loadedData[$department->getDepartmentId()] = $department->getData();
			$this->dataPersistor->clear('tasktracking_department');
		}
		
		return $this->loadedData;
	}
}
