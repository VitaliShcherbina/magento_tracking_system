<?php

namespace Tech\TaskTracking\Model\ResourceModel\Ticket\Grid;

use Tech\TaskTracking\Model\ResourceModel\Ticket\Collection as GridCollection;
use Magento\Framework\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Tech\TaskTracking\Model\ResourceModel\Ticket as GridResource;
use Magento\Framework\Api\SearchCriteriaInterface;

class Collection extends GridCollection implements SearchResultInterface {
	/**
	 *
	 */
	protected $aggregations;
	
	
	/**
	 *
	 */
	protected function _construct() {
		$this->_init(Document::class, GridResource::class);
	}
	
	
	/**
	 *
	 */
	public function getAggregations() {
		return $this->aggregations;
	}
	
	
	/**
	 *
	 */
	public function setAggregations($aggregations) {
		$this->aggregations = $aggregations;
	}
	
	
	/**
	 *
	 */
	public function getAllIds($limit = null, $offset = null) {
		return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limit, $offset), $this->_bindParams);
	}
	
	
	/**
	 *
	 */
	public function getSearchCriteria() {
		return null;
	}
	
	
	/**
	 *
	 */
	public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null) {
		return $this;
	}
	
	
	/**
	 *
	 */
	public function getTotalCount() {
		return $this->getSize();
	}
	
	
	/**
	 *
	 */
	public function setTotalCount($totalCount) {
		return $this;
	}
	
	
	/**
	 *
	 */
	public function setItems(array $items = null) {
		return $this;
	}
	
	
	/**
	 *
	 */
	protected function _renderFiltersBefore() {
		$departmentTable = $this->getTable('tasktracking_department');
		$priorityTable   = $this->getTable('tasktracking_priority');
		$statusTable     = $this->getTable('tasktracking_status');
		$customerTable   = $this->getTable('customer_grid_flat');
		
		$this->getSelect()
			 ->join($departmentTable .' as department', 'main_table.department_id = department.department_id', array('department_name' => 'department_name'))
			 ->join($priorityTable .' as priority', 'main_table.priority_id = priority.priority_id', array('priority_value' => 'priority_value'))
			 ->join($statusTable .' as status', 'main_table.status_id = status.status_id', array('status_value' => 'status_value'))
			 ->join($customerTable .' as customer', 'main_table.customer_id = customer.entity_id', array('created_by' => 'name'));
		
		parent::_renderFiltersBefore();
	}
}