<?php

namespace Tech\TaskTracking\Block\Adminhtml\Ticket;

class Info extends \Magento\Backend\Block\Template {
	/**
	 *
	 */
	protected $_coreRegistry;
	protected $_ticketHelper;
	protected $_ticketFactory;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\Registry $registry,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory,
		\Tech\TaskTracking\Helper\Data $ticketHelper,
		array $data = []
	) {
		$this->_coreRegistry      = $registry;
		$this->_ticketFactory     = $ticketFactory;
		$this->_ticketHelper      = $ticketHelper;
		parent::__construct($context, $data);
	}
	
	
	/**
	 *
	 */
	public function getTicketId() {
		$ticketId = $this->_coreRegistry->registry('ticket')->getId();
		
		if ($ticketId) {
			return $ticketId;
		}
	}
	
	
	/**
	 *
	 */
	public function getTicketDataById($id) {
		$ticketModel = $this->_ticketFactory->create();
		$ticketModel->load($id, 'ticket_id');
		
		if (!$ticketModel->getId()) {
			return false;
		}
		
		$ticketData = $ticketModel->getData();
		
		$ticketData['customer_name'] = $this->_ticketHelper->loadCustomerNameById($ticketData['customer_id']);
		
		return $ticketData;
	}
	
	
	/**
	 *
	 */
	public function getDataHelper() {
		return $this->_ticketHelper;
	}
}