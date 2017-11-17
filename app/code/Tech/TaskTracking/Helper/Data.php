<?php

namespace Tech\TaskTracking\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
	/**
	 *
	 */
	protected $_customerRepository;
	protected $_storeManager;
	
	protected $_priorityCollection;
	protected $_statusCollection;
	protected $_departmentCollection;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Customer\Api\CustomerRepositoryInterfaceFactory $customerRepositoryFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Tech\TaskTracking\Model\ResourceModel\Priority\CollectionFactory $priorityCollectionFactory,
		\Tech\TaskTracking\Model\ResourceModel\Status\CollectionFactory $statusCollectionFactory,
		\Tech\TaskTracking\Model\ResourceModel\Department\CollectionFactory $departmentCollectionFactory
	) {
		$this->_storeManager         = $storeManager;
		$this->_customerRepository   = $customerRepositoryFactory->create();
		$this->_priorityCollection   = $priorityCollectionFactory->create();
		$this->_statusCollection     = $statusCollectionFactory->create();
		$this->_departmentCollection = $departmentCollectionFactory->create();
	}
	
	
	/**
	 *
	 */
	public function loadCustomerNameById($customerId) {
		$customer = $this->_customerRepository->getById($customerId);
		$customerName = $customer->getFirstName() . ' ' . $customer->getLastName();
		
		return $customerName;
	}
	
	
	/**
	 *
	 */
	public function getAttachmentUrlByTicketId($ticketId) {
		$mediaUrl = $this ->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		$mediaUrl .= 'tickets/' . $ticketId . '/';
		
		return $mediaUrl;
	}
	
	
	/**
	 *
	 */
	 public function getPriorityData() {
		
		$priorityData = $this->_priorityCollection->addFieldToFilter('is_active', 1)->toOptionArray();
		
		return $priorityData;
	}
	
	
	/**
	 *
	 */
	public function getStatusData() {
		$statusData = $this->_statusCollection->addFieldToFilter('is_active', 1)->toOptionArray();
		
		return $statusData;
	}
	
	
	/**
	 *
	 */
	public function getDepartmentData() {
		$departmentData = $this->_departmentCollection->addFieldToFilter('is_active', 1)->toOptionArray();
		
		return $departmentData;
	}
}