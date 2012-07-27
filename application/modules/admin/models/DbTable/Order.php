<?php

class Admin_Model_DbTable_Order extends Admin_Model_DbTablePagination
{
    protected $_name = 'order';
    protected $_primary = 'order_id';
	
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$order = new Core_Store_Order();
		
       		$order->fromArray($row);
		
        	return $order;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Store_Order $order)
    {
        $row = $order->toArray();
        
        return $row;
    }
    
	
	/*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
	public function getById($id)
	{
		$row = $this->find($id)->current();
		
		$order = new Core_Store_Order();
		$order = self::rowToObject($row);
		$order->setProducts($this->getAllProductsIntoOrder($id));
		
		return $order;
	}


    /* get all orders */
	public function getAll()
	{
		$select = $this->select()
					   ->from('order')
					   ->order(array('order.order_date DESC'));
					   
		return $this->createPaginator($select);
	}
	
	
	/* get all orders in date range */
	public function getInDateRange($minDate, $maxDate)
	{
		$select = $this->select()
					   ->from('order')
					   ->where("order_date >= STR_TO_DATE(?, '%d/%m/%Y')", $minDate)
					   ->where("order_date <= STR_TO_DATE(?, '%d/%m/%Y')", $maxDate)
					   ->order(array('order.order_date DESC'));
					   
		return $this->createPaginator($select);
	}


	/* get all products in an order */
	public function getAllProductsIntoOrder($order_id, $minDate = null, $maxDate = null)
	{
		$select = $this->select()
					   ->setIntegrityCheck(false)
					   ->from('orderProducts', array('quantity'))
					   ->join('product', 'orderProducts.product_id = product.product_id')
					   ->joinLeft('category', 'product.category_id = category.category_id')
					   ->joinLeft('collection', '(category.collection_id = collection.collection_id) 
					   		OR (product.collection_id = collection.collection_id)')
					   ->joinLeft('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('orderProducts.order_id = ?', $order_id);
					   
		if ($minDate !== null) {
			$select->where("order.order_date >= STR_TO_DATE(?, '%d/%m/%Y')", $minDate);
		}

		if ($maxDate !== null) {
			$select->where("order.order_date <= STR_TO_DATE(?, '%d/%m/%Y')", $maxDate);
		}
		
		$rows = $this->fetchAll($select);
		
		$itemCollection = new Core_Store_Cart_Item_Collection();
		
		foreach ($rows as $row) {
			switch ($row['product_type']) {
				case Core_Store_Product::TYPE_STICKER:
					$item = new Core_Store_Cart_Item(Admin_Model_DbTable_Sticker::rowToObject($row), 
						$row['quantity']);
					break;
				case Core_Store_Product::TYPE_ALBUM:
					$item = new Core_Store_Cart_Item(Admin_Model_DbTable_Album::rowToObject($row), 
						$row['quantity']);
					break;
			}

			$itemCollection->addItem($item->getId(), $item);
		}
		
		return $itemCollection;
	}

	
	/* add new order */
	public function addOrder(Core_Store_Order $order)
	{
		//return $this->insert(self::objectToRow($album));
	}
	
	
	/* update an order */
	public function updateOrder(Core_Store_Order $order)
	{
		//$this->update(self::objectToRow($album), $this->_primary . ' = ' . $album->getId());
	}
	
	
	/* delete an order */
	public function deleteOrder($id)
	{
		//$row = $this->find($id)->current();
		//if ( !empty($row) ) $row->delete();
	}
}
