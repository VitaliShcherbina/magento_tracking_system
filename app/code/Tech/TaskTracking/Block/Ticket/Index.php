<?php

namespace Tech\TaskTracking\Block\Ticket;

/**
 *
 */
class Index extends \Magento\Framework\View\Element\Template {
	/**
	 *
	 */
	protected $_gridFactory;
	protected $_session;
	protected $configProvider;
	protected $_layoutProcessors;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Tech\TaskTracking\Model\ResourceModel\Ticket\Grid\CollectionFactory $gridFactory,
		\Magento\Customer\Model\Session $session,
		\Magento\Checkout\Model\CompositeConfigProvider $configProvider,
		array $layoutProcessors = [],
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->_gridFactory      = $gridFactory;
		$this->_session          = $session;
		$this->configProvider    = $configProvider;
		$this->_layoutProcessors = $layoutProcessors;
	}
	
	
	/**
	 *
	 */
	public function getTicketsDataForUser() {
		$ticketsData = array();
		
		$customerId = $this->_session->getCustomer()->getId();
		$ticketGridCollection = $this->_gridFactory->create();
		
		$ticketsItems = $ticketGridCollection->addFieldToFilter('customer_id', $customerId)->getItems();
		
		if ($ticketsItems and count($ticketsItems) > 0) {
			foreach ($ticketsItems as $ticketsItem) {
				$ticketsData[] = json_encode(array(
					'ticket_id'       => $ticketsItem->getTicketId(),
					'department_name' => $ticketsItem->getDepartmentName(),
					'updated_at'      => $ticketsItem->getUpdatedAt(),
					'priority_value'  => $ticketsItem->getPriorityValue(),
					'status_value'    => $ticketsItem->getStatusValue()
				));
			}
		}
		
		return json_encode($ticketsData);
	}
}