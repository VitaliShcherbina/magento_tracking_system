<?php

namespace Tech\TaskTracking\Block\Adminhtml\Ticket;

class Message extends \Magento\Backend\Block\Template {
	/**
	 *
	 */
	protected $_coreRegistry;
	protected $_ticketHelper;
	protected $_ticketFactory;
	protected $_messageCollection;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\Registry $registry,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory,
		\Tech\TaskTracking\Model\ResourceModel\Message\CollectionFactory $messageCollectionFactory,
		\Tech\TaskTracking\Helper\Data $ticketHelper,
		array $data = []
	) {
		$this->_coreRegistry      = $registry;
		$this->_ticketFactory     = $ticketFactory;
		$this->_messageCollection = $messageCollectionFactory;
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
		return $ticketData = $this->_ticketHelper->getTicketDataById($id);
	}
	
	
	/**
	 *
	 */
	public function getMessagesByTicketId($ticketId) {
		return $this->_ticketHelper->getMessagesByTicketId($ticketId);
	}
	
	
	/**
	 *
	 */
	public function getAttachmentUrlByTicketId($ticketId) {
		return $this->_ticketHelper->getAttachmentUrlByTicketId($ticketId);
	}
}