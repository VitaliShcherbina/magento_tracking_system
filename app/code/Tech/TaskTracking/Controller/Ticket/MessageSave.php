<?php

namespace Tech\TaskTracking\Controller\Ticket;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;

class MessageSave extends \Magento\Framework\App\Action\Action {
	/**
	 *
	 */
	protected $_resultPageFactory;
	protected $_dataPersistor;
	
	protected $_session;
	protected $_mediaDirectory;
	protected $_fileUploaderFactory;
	protected $_dateFactory;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Customer\Model\Session $session,
		DataPersistorInterface $dataPersistor,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
		\Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory
	) {
		$this->_resultPageFactory   = $resultPageFactory;
		$this->_session             = $session;
		$this->_dataPersistor       = $dataPersistor;
		$this->_mediaDirectory      = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->_dateFactory         = $dateFactory;
		parent::__construct($context);
	}
	
	
	/**
	 *
	 */
	public function execute() {
		$resultRedirect = $this->resultRedirectFactory->create();
		
		if ($this->_session->isLoggedIn()) {
			$data = $this->getRequest()->getPostValue();
			
			if ($data['ticket_id']) {
				$attachments = $this->getRequest()->getFiles('attachment');
				
				$uploadedFileNames = array();
				if ($attachments and count($attachments) > 0) {
					foreach ($attachments as $attachment) {
						try{
							$target = $this->_mediaDirectory->getAbsolutePath('tickets/' . $data['ticket_id'] . '/');
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
				$messageData['ticket_id']    = $data['ticket_id'];
				$messageData['message_text'] = $data['message_text'];
				$messageData['created_at']   = $currentDate;
				
				if ($uploadedFileNames and count($uploadedFileNames) > 0) {
					$messageData['attachment'] = serialize($uploadedFileNames);
				}
				else {
					$messageData['attachment'] = null;
				}
				
				$messageModel = $this->_objectManager->create(\Tech\TaskTracking\Model\Message::class)->load(null);
				$messageModel->setData($messageData);
				try {
					$messageModel->save();
					$this->_dataPersistor->clear('tasktracking_message');
				} catch (LocalizedException $e) {
					$this->messageManager->addErrorMessage($e->getMessage());
				} catch (\Exception $e) {
					$this->messageManager->addException($e, __('Something went wrong while saving the message.'));
				}
				$this->_dataPersistor->set('tasktracking_message', $messageData);
				
				$this->messageManager->addSuccessMessage(__('Message for ticket ' . $data['ticket_id'] . ' has been successfully saved'));
				
				return $resultRedirect->setPath('*/*/view', array('id' => $data['ticket_id']));
			}
			else {
				$this->messageManager->addErrorMessage(__('No ticket id.'));
				
				return $resultRedirect->setPath('*/*/');
			}
		}
		else {
			$this->messageManager->addNoticeMessage(__('You must be logged in.'));
			
			return $resultRedirect->setPath('customer/account/login');
		}
	}
}