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
	public function getMessagesByTicketId($ticketId) {
		$messageCollection = $this->_messageCollection->create();
		$messageCollection
			->addFieldToFilter('ticket_id', $ticketId)
			->addFieldToFilter('is_private', self::SHOW_WITHOUT_PRIVATE)
			->load();
		
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
	public function getSubmitAction() {
		return '/tasktracking/ticket/messagesave';
	}
	
	
	/**
	 *
	 */
	public function decodeData($data) {
		return unserialize($data);
	}
	
	
	/**
	 *
	 */
	public function getAttachmentUrlByTicketId($ticketId) {
		return $this->_ticketHelper->getAttachmentUrlByTicketId($ticketId);
	}
}