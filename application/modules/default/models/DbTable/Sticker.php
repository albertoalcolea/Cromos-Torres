<?php

class Default_Model_DbTable_Sticker extends Default_Model_DbTablePagination
{
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
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER)
					   ->order(array('editorial.editorial_id ASC', 'collection.collection_id ASC',
					   				 'category.category_id ASC', 'product.sticker_number ASC'));
					   
		return $this->createPaginator($select);
	}
    
    
    /* get all stickers into a collection */
	public function getIntoCollection($collectionId)
	{	
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('collection.collection_id = ?', $collectionId)
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER)
					   ->order(array('category.category_id ASC', 'product.sticker_number ASC'));
					   
		return $this->createPaginator($select);
	}


	/* get all stickers into a category */
	public function getIntoCategory($categoryId)
	{	
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('category', 'product.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('category.category_id = ?', $categoryId)
					   ->where('product_type = ?', Core_Store_Product::TYPE_STICKER)
					   ->order(array('product.sticker_number ASC'));
					   
		return $this->createPaginator($select);
	}
}
