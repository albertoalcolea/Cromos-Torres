<?php

class Core_Model_Paginator_OrderPaginator extends Zend_Paginator_Adapter_DbSelect
{
	
    /**
     * Returns an array of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
     
    public function getItems($offset, $itemCountPerPage)
    {
        $rows = parent::getItems($offset, $itemCountPerPage);

		$orders = new Core_Model_DbTable_Order();

		$orderArray = array();
		
		foreach ($rows as $row) {
			$order = new Core_Store_Order();
			$order = Core_Model_DbTable_Order::rowToObject($row);
			$order->setItems($orders->getAllProductsIntoOrder($order->getId()));
			
			array_push($orderArray, $order);
		}
		
		return $orderArray;
    }
}