<?php

namespace Tech\TaskTracking\Helper;

class Email extends \Magento\Framework\App\Helper\AbstractHelper {
	/**
	 *
	 */
	protected $_transportBuilder;
	protected $_logger;
	protected $_senderInfo = array(
		'name'  => 'Robot',
		'email' => 'robot@example.org'
	);
	
	const TECH_TICKET_TEMPLATE_ID = 'tech_ticket_email_template';
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
		\Psr\Log\LoggerInterface $logger
	) {
		$this->_transportBuilder = $transportBuilder;
		$this->_logger           = $logger;
	}
	
	
	/**
	 *
	 */
	public function sendTicketEmail($postData, $receiverInfo) {
		
		$postObject = new \Magento\Framework\DataObject();
		$postObject->setData($postData);
		
		$transport = $this->_transportBuilder
			->setTemplateIdentifier(self::TECH_TICKET_TEMPLATE_ID)
			->setTemplateOptions([
				'area'  => \Magento\Framework\App\Area::AREA_FRONTEND,
				'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
			])
			->setTemplateVars(['data' => $postObject])
			->setFrom($this->_senderInfo)
			->addTo($receiverInfo['email'], $receiverInfo['name'])
			->getTransport();
		$transport->sendMessage();
	}
	
	
	/**
	 *
	 */
	public function logSendEmail($message) {
		$this->_logger->info($message);
		$this->_logger->debug($message);
	}
}