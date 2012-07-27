<?php

class Core_Model_DbTable_Album extends Core_Model_DbTablePagination
{
	const ORDER_BY_PRICE_ASC	= 0;
	const ORDER_BY_PRICE_DESC	= 1;
	const ORDER_BY_NAME_ASC		= 2;
	const ORDER_BY_NAME_DESC	= 3;
	const ORDER_BY_ID_ASC		= 4;
	const ORDER_BY_ID_DESC		= 5;
	
	
    protected $_name = 'product';
    protected $_primary = 'product_id';
	
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$album = new Core_Sticker_Album();
		
       		$album->fromArray($row);
		
        	return $album;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Sticker_Album $album)
    {
        $row = $album->toArray();
        
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
				
			case self::ORDER_BY_NAME_ASC:
				$select->order(array('product.product_name ASC'));
				break;
				
			case self::ORDER_BY_NAME_DESC:
				$select->order(array('product.product_name DESC'));
				break;
				
			case self::ORDER_BY_ID_ASC:
				$select->order(array('editorial.editorial_id ASC', 
									 'collection.collection_id ASC',
					   				 'product.product_id ASC')
				);
				break;
			
			case self::ORDER_BY_ID_DESC:
				$select->order(array('editorial.editorial_id DESC', 
									 'collection.collection_id DESC',
					   				 'product.product_id DESC')
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
					   ->join('collection', 'product.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('product_id = ?', $id)
					   ->where('product_type = ?', Core_Store_Product::TYPE_ALBUM);
		
		$row = $this->fetchRow($select);
		 
		return self::rowToObject($row);
	}


    /* get all albums */
	public function getAll($orderBy = self::ORDER_BY_ID_ASC)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('collection', 'product.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('product_type = ?', Core_Store_Product::TYPE_ALBUM);
					   
		$this->orderBy($select, $orderBy);
					   
		return $this->createPaginator($select);
	}


	/* get all albums into a collection */
	public function getIntoCollection($collectionId, $orderBy = self::ORDER_BY_ID_ASC)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('collection', 'product.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('collection.collection_id = ?', $collectionId)
					   ->where('product_type = ?', Core_Store_Product::TYPE_ALBUM);
					   
		$this->orderBy($select, $orderBy);
		
		return $this->createPaginator($select);
	}
	
	
	/* add new album */
	public function addAlbum(Core_Sticker_Album $album)
	{
		return $this->insert(self::objectToRow($album));
	}
	
	
	/* update an album */
	public function updateAlbum(Core_Sticker_Album $album)
	{
		$this->update(self::objectToRow($album), $this->_primary . ' = ' . $album->getId());
	}
	
	
	/* delete an album */
	public function deleteAlbum($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
