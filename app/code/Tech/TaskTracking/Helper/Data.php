<?php

namespace Tech\TaskTracking\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
	/**
	 *
	 */
	const MAX_ATTACHMENTS = 5;
	
	protected $_customerRepository;
	protected $_storeManager;
	
	protected $_priorityCollection;
	protected $_statusCollection;
	protected $_departmentCollection;
	protected $_ticketFactory;
	protected $_messageCollection;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Customer\Api\CustomerRepositoryInterfaceFactory $customerRepositoryFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Tech\TaskTracking\Model\ResourceModel\Priority\CollectionFactory $priorityCollectionFactory,
		\Tech\TaskTracking\Model\ResourceModel\Status\CollectionFactory $statusCollectionFactory,
		\Tech\TaskTracking\Model\ResourceModel\Department\CollectionFactory $departmentCollectionFactory,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory,
		\Tech\TaskTracking\Model\ResourceModel\Message\CollectionFactory $messageCollectionFactory
	) {
		$this->_storeManager         = $storeManager;
		$this->_customerRepository   = $customerRepositoryFactory->create();
		$this->_priorityCollection   = $priorityCollectionFactory->create();
		$this->_statusCollection     = $statusCollectionFactory->create();
		$this->_departmentCollection = $departmentCollectionFactory->create();
		$this->_ticketFactory        = $ticketFactory;
		$this->_messageCollection    = $messageCollectionFactory;
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
	
	
	/**
	 *
	 */
	public function getTicketDataById($ticketId) {
		$ticketData = $this->_ticketFactory->create()->load($ticketId)->getData();
		$ticketData['customer_name'] = $this->loadCustomerNameById($ticketData['customer_id']);
		
		return $ticketData;
	}
	
	
	/**
	 *
	 */
	public function getMessagesByTicketId($ticketId, $private = 1) {
		$messageCollection = $this->_messageCollection->create();
		$messageCollection->addFieldToFilter('ticket_id', $ticketId);
		$private ? '' : $messageCollection->addFieldToFilter('is_private', $private);
		$messageCollection->load();
		
		$messageData = array();
		foreach ($messageCollection as $item) {
			$messageData[] = $item->getData();
		}
		
		if ($messageData and count($messageData) > 0) {
			$messageData = array_reverse($messageData);
		}
		
		return $messageData;
	}
	
	
	/**
	 *
	 */
	public function callMethodAndCheckDataInArray($value, $methodName) {
		$query = 'get' . ucfirst(mb_strtolower($methodName)) . 'Data';
		$data  = $this->$query();
		
		if ($data and count($data) > 0) {
			foreach ($data as $item) {
				if ($item['value'] == $value) {
					return true;
				}
			}
		}
		
		return false;
	}
}