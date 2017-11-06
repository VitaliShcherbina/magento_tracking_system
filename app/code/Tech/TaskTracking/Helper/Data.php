<?php

namespace Tech\TaskTracking\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
	/**
	 *
	 */
	protected $_customerRepository;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Customer\Api\CustomerRepositoryInterfaceFactory $customerRepositoryFactory
	) {
		$this->_customerRepository = $customerRepositoryFactory->create();
	}
	
	
	/**
	 *
	 */
	public function loadCustomerNameById($customerId) {
		$customer = $this->_customerRepository->getById($customerId);
		$customerName = $customer->getFirstName() . ' ' . $customer->getLastName();
		
		return $customerName;
	}
}