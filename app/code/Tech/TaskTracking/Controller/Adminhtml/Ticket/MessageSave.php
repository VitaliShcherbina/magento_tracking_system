<?php

namespace Tech\TaskTracking\Controller\Adminhtml\Ticket;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;

class MessageSave extends \Magento\Backend\App\Action {
	/**
	 *
	 */
	protected $_coreRegistry = null;
	protected $_messageFactory;
	
	protected $_dataPersistor;
	protected $_mediaDirectory;
	protected $_fileUploaderFactory;
	protected $_dateFactory;
	protected $_ticketFactory;
	
	/**
	 *
	 */
	public function __construct(
		Action\Context $context,
		\Magento\Framework\Registry $registry,
		DataPersistorInterface $dataPersistor,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
		\Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory,
		\Tech\TaskTracking\Model\MessageFactory $messageFactory,
		\Tech\TaskTracking\Model\TicketFactory $ticketFactory
	)
	{
		$this->_coreRegistry        = $registry;
		$this->_dataPersistor       = $dataPersistor;
		$this->_mediaDirectory      = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->_dateFactory         = $dateFactory;
		$this->_messageFactory      = $messageFactory;
		$this->_ticketFactory       = $ticketFactory;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$message  = $this->getRequest()->getPostValue();
		$resultRedirect = $this->resultRedirectFactory->create();
		
		if ($message and array_key_exists('ticket_id', $message)) {
			$attachments = $this->getRequest()->getFiles('attachment');
			
			$uploadedFileNames = array();
			if ($attachments and count($attachments) > 0) {
				foreach ($attachments as $attachment) {
					try{
						$target = $this->_mediaDirectory->getAbsolutePath('tickets/' . $message['ticket_id'] . '/');
						$uploader = $this->_fileUploaderFactory->create(['fileId' => $attachment]);
						$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
						$uploader->setAllowRenameFiles(true);
						$result = $uploader->save($target);
						if ($result['file']) {
							$uploadedFileNames[] = $result['file']; 
						}
					} catch (\Exception $e) {
						$this->messageManager->addError($e->getMessage());
					}
				}
			}
			
			$messageData = array();
			$currentDate = $this->_dateFactory->create()->gmtDate();
			$messageData['ticket_id']    = $message['ticket_id'];
			$messageData['message_text'] = $message['message_text'];
			$messageData['created_at']   = $currentDate;
			
			if ($uploadedFileNames and count($uploadedFileNames) > 0) {
				$messageData['attachment'] = serialize($uploadedFileNames);
			}
			else {
				$messageData['attachment'] = null;
			}
			
			$messageModel = $this->_messageFactory->create();
			$messageModel->setData($messageData);
			try {
				$messageModel->save();
				$this->_dataPersistor->clear('tasktracking_message');
				$ticketModel = $this->_ticketFactory->create()->load($message['ticket_id']);
				$ticketModel->setUpdatedAt($currentDate);
				$ticketModel->save();
			} catch (LocalizedException $e) {
				$this->messageManager->addErrorMessage($e->getMessage());
			} catch (\Exception $e) {
				$this->messageManager->addException($e, __('Something went wrong while saving the message.'));
			}
			$this->_dataPersistor->set('tasktracking_message', $messageData);
			
			$this->messageManager->addSuccessMessage(__('Message for ticket ' . $message['ticket_id'] . ' has been successfully saved'));
			
			return $resultRedirect->setPath('*/*/view', array('id' => $message['ticket_id']));
		}
		else {
			$this->messageManager->addErrorMessage(__('No ticket id.'));
			
			return $resultRedirect->setPath('*/*/');
		}
	}
}