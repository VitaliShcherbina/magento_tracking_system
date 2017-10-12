<?php

namespace Tech\TaskTracking\Model\ResourceModel\Priority\Grid;

use Tech\TaskTracking\Model\ResourceModel\Priority\Collection as GridCollection;
use Magento\Framework\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Tech\TaskTracking\Model\ResourceModel\Priority as GridResource;
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
}