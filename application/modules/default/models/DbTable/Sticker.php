<?php

class Default_Model_DbTable_Sticker extends Default_Model_DbTablePagination
{
	const ORDER_BY_PRICE_ASC	= 0;
	const ORDER_BY_PRICE_DESC	= 1;
	const ORDER_BY_NUMBER_ASC	= 2;
	const ORDER_BY_NUMBER_DESC	= 3;
	
	
    protected $_name = 'product';
    protected $_primary = 'product_id';
	
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$sticker = new Core_Sticker_Sticker();
		
       		$sticker->fromArray($row);
		
        	return $sticker;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Sticker_Sticker $sticker)
    {
        $row = $sticker->toArray();
        
        return $row;
    }
	
	
	/*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
	/* Note: $select is a object (pass by reference, no return var) */
	private function orderBy($select, $orderBy)
	{
		switch ($orderBy) {
			case self::ORDER_BY_PRICE_ASC:
				$select->order(array('product.product_price ASC'));
				break;
				
			case self::ORDER_BY_PRICE_DESC:
				$select->order(array('product.product_price DESC'));
				break;
				
			case self::ORDER_BY_NUMBER_ASC:
				$select->order(array('editorial.editorial_id ASC', 
									 'collection.collection_id ASC',
							   		 'category.category_id ASC', 
							   		 'product.sticker_number ASC')
				);
				break;
				
			case self::ORDER_BY_NUMBER_DESC:
				$select->order(array('editorial.editorial_id DESC', 
									 'collection.collection_id DESC',
							   		 'category.category_id DESC', 
							   		 'product.sticker_number DESC')
				);
				break;
		}
	}
	
    
    /*****************************************************************/
	/* Public                                                        */
	/*****************************************************************/
    public function getById($id)
	{
		$select = $this->select()
					   ->setIntegrityCheck(false)
					   ->from('product')
					   ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('product_id = ?', $id)
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER);
		
		$row = $this->fetchRow($select);
		 
		return self::rowToObject($row);
	}
	    
    
    /* get all stickers */
	public function getAll($orderBy = self::ORDER_BY_NUMBER_ASC)
	{		
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER);
					   
		$this->orderBy($select, $orderBy);
					   
		return $this->createPaginator($select);
	}
    
    
    /* get all stickers into a collection */
	public function getIntoCollection($collectionId, $orderBy = self::ORDER_BY_NUMBER_ASC)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('collection.collection_id = ?', $collectionId)
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER);
		
		$this->orderBy($select, $orderBy);
					   
		return $this->createPaginator($select);
	}


	/* get all stickers into a category */
	public function getIntoCategory($categoryId, $orderBy = self::ORDER_BY_NUMBER_ASC)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('category.category_id = ?', $categoryId)
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER);
		
		$this->orderBy($select, $orderBy);
					   
		return $this->createPaginator($select);
	}
}
