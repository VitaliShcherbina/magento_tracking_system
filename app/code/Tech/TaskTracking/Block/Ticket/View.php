<?php

namespace Tech\TaskTracking\Block\Ticket;

/**
 *
 */
class View extends \Magento\Framework\View\Element\Template {
	/**
	 *
	 */
	const SHOW_WITHOUT_PRIVATE = 0;
	
	protected $_ticketFactory;
	protected $_session;
	protected $_messageCollection;
	protected $_storeManager;
	protected $_ticketHelper;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory,
		\Magento\Customer\Model\Session $session,
		\Tech\TaskTracking\Model\ResourceModel\Message\CollectionFactory $messageCollectionFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Tech\TaskTracking\Helper\Data $ticketHelper,
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->_ticketFactory     = $ticketFactory;
		$this->_session           = $session;
		$this->_messageCollection = $messageCollectionFactory;
		$this->_storeManager      = $storeManager;
		$this->_ticketHelper      = $ticketHelper;
	}
	
	
	/**
	 *
	 */
	public function getTicketDataById($id) {
		return $this->_ticketHelper->getTicketDataById($id);
	}
	
	
	/**
	 *
	 */
	public function getMessagesByTicketId($ticketId) {
		return $this->_ticketHelper->getMessagesByTicketId($ticketId, self::SHOW_WITHOUT_PRIVATE);
	}
	
	
	/**
	 *
	 */
	public function getSubmitAction() {
		return '/tasktracking/ticket/messagesave';
	}
	
	
	/**
	 *
	 */
	public function getAttachmentUrlByTicketId($ticketId) {
		return $this->_ticketHelper->getAttachmentUrlByTicketId($ticketId);
	}
}