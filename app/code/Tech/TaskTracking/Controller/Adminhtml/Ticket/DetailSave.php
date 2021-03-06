<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Ticket;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;

class DetailSave extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	protected $_dateFactory;
	protected $_resultJsonFactory;
	protected $_ticketFactory;
	protected $_dataHelper;
	protected $_emailHelper;
	
	/**
	 *
	 */
	public function __construct(
		Action\Context $context,
		\Magento\Framework\Controller\ResultFactory $resultFactory,
		\Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory,
		\Tech\TaskTracking\Helper\Data $dataHelper,
		\Tech\TaskTracking\Helper\Email $emailHelper
	) {
		$this->_resultJsonFactory = $resultFactory;
		$this->_dateFactory       = $dateFactory;
		$this->_ticketFactory     = $ticketFactory;
		$this->_dataHelper        = $dataHelper;
		$this->_emailHelper       = $emailHelper;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$request    = $this->getRequest()->getPostValue();
		$resultJson = $this->_resultJsonFactory->create(ResultFactory::TYPE_JSON);
		
		$message = '';
		$success = false;
		
		if ($request and $request['ticket_id']) {
			$ticketModel = $this->_ticketFactory->create()->load($request['ticket_id']);
			if (!$ticketModel->getId()) {
				$message = __('This ticket no longer exists.');
			}
			else {
				$ticketModel->setDepartmentId($request['department_id']);
				$ticketModel->setStatusId($request['status_id']);
				$ticketModel->setPriorityId($request['priority_id']);
				$currentDate = $this->_dateFactory->create()->gmtDate();
				$ticketModel->setUpdatedAt($currentDate);
				try {
					$ticketModel->save();
					$success = true;
					$message = __('Ticket ' . $request['ticket_id'] . ' successfully saved.');
				} catch (LocalizedException $e) {
					$message = $e->getMessage();
				} catch (\Exception $e) {
					$message = __('Something went wrong while saving the ticket.');
				}
				
				$emailData = $this->_dataHelper->getTicketDataById($request['ticket_id']);
				$customerFullName = $this->_dataHelper->loadCustomerNameById($emailData['customer_id']);
				$emailData['customer_name'] = $customerFullName;
				
				$receiverInfo = array(
					'name'  => $customerFullName,
					'email' => $emailData['email']
				);
				
				/*$this->_emailHelper->sendTicketEmail($emailData, $receiverInfo);*/
				$this->_emailHelper->logSendEmail(print_r($emailData, true));
			}
		}
		else {
			$message = __('Ticket does not save.');
		}
		
		$response = array(
			'success' => $success,
			'message' => $message
		);
		
		return $resultJson->setData($response);
	}
}