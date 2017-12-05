<?php

namespace Tech\TaskTracking\Block\Adminhtml\Ticket;

use Tech\TaskTracking\Helper\Data as DataHelper;

class Message extends \Magento\Backend\Block\Template {
	/**
	 *
	 */
	protected $_coreRegistry;
	protected $_dataHelper;
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
		DataHelper $dataHelper,
		array $data = []
	) {
		$this->_coreRegistry      = $registry;
		$this->_ticketFactory     = $ticketFactory;
		$this->_messageCollection = $messageCollectionFactory;
		$this->_dataHelper        = $dataHelper;
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
		return $ticketData = $this->_dataHelper->getTicketDataById($id);
	}
	
	
	/**
	 *
	 */
	public function getMessagesByTicketId($ticketId) {
		return $this->_dataHelper->getMessagesByTicketId($ticketId);
	}
	
	
	/**
	 *
	 */
	public function getAttachmentUrlByTicketId($ticketId) {
		return $this->_dataHelper->getAttachmentUrlByTicketId($ticketId);
	}
	
	
	public function getMaxAttachments() {
		return DataHelper::MAX_ATTACHMENTS;
	}
}