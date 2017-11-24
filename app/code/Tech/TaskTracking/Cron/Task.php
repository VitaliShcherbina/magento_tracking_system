<?php

namespace Tech\TaskTracking\Cron;

use \Psr\Log\LoggerInterface;

class Task {
	/**
	 *
	 */
	const CLOSED_STATUS = 'closed';
	
	protected $_logger;
	protected $_ticketCollection;
	protected $_messageCollection;
	protected $_dataHelper;
	
	/**
	 *
	 */
	public function __construct(
		LoggerInterface $logger,
		\Tech\TaskTracking\Model\ResourceModel\Ticket\CollectionFactory $ticketCollection,
		\Tech\TaskTracking\Model\ResourceModel\Message\CollectionFactory $messageCollection,
		\Tech\TaskTracking\Helper\Data $dataHelper
	) {
		$this->_logger            = $logger;
		$this->_ticketCollection  = $ticketCollection;
		$this->_messageCollection = $messageCollection;
		$this->_dataHelper        = $dataHelper;
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$statuses = $this->_dataHelper->getStatusData();
		
		foreach ($statuses as $status) {
			if ($status['label'] == self::CLOSED_STATUS) {
				$statusId = $status['value'];
				
				break;
			}
		}
		
		$ticketCollection = $this->_ticketCollection->create()->addFieldToFilter('status_id', $statusId)->getItems();
		
		foreach ($ticketCollection as $ticket) {
			$messagesForTicket = $this->_messageCollection->create()->addFieldToFilter('ticket_id', $ticket->getId())->getItems();
			
			foreach ($messagesForTicket as $message) {
				try {
					$message->delete();
				} catch (\Exception $e) {
					$this->_logger->info($e->getMessage());
					$this->_logger->debug($e->getMessage());
				}
			}
			try {
				$ticket->delete();
			} catch (\Exception $e) {
				$this->_logger->info($e->getMessage());
				$this->_logger->debug($e->getMessage());
			}
			
			$this->_logger->info('Ticket ' . $ticket->getId() . ' has been removed.');
			$this->_logger->debug('Ticket ' . $ticket->getId() . ' has been removed.');
		}
	}
}