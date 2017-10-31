<?php

namespace Tech\TaskTracking\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;

class Topmenu implements ObserverInterface {
	/**
	* Task Tracking module Observer
	* Add item to main menu (frontend side)
	*/
	protected $_url;
	
	/**
	 *
	 */
	public function __construct(
		\Magento\Framework\UrlInterface $url
	) {
		$this->_url = $url;
	}
	
	
	/**
	 *
	 */
	public function execute(EventObserver $observer) {
		
		$menu = $observer->getMenu();
		$tree = $menu->getTree();
		$data = [
			'name'      => __('Tickets'),
			'id'        => 'task_tickets',
			'url'       => $this->_url->getUrl('tasktracking/ticket/index'),
			'is_active' => 0
		];
		$node = new Node($data, 'id', $tree, $menu);
		$menu->addChild($node);
		
		return $this;
	}
}