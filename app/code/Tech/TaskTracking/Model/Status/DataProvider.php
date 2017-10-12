<?php

namespace Tech\TaskTracking\Model\Status;

use Tech\TaskTracking\Model\ResourceModel\Status\CollectionFactory;
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
			$this->loadedData[$status->getStatusId()] = $status->getData();
		}
		
		$data = $this->dataPersistor->get('tasktracking_status');
		if (!empty($data)) {
			$status = $this->collection->getNewEmptyItem();
			$status->setData($data);
			$this->loadedData[$status->getStatusId()] = $status->getData();
			$this->dataPersistor->clear('tasktracking_status');
		}
		
		return $this->loadedData;
	}
}
