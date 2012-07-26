<?php

class Default_Model_DbTable_Album extends Default_Model_DbTablePagination
{
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
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('collection', 'product.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('product_type = ?', Core_Store_Product::TYPE_ALBUM)
					   ->order(array('editorial.editorial_id ASC', 'collection.collection_id ASC',
					   				 'product.product_id ASC'));
					   
		return $this->createPaginator($select);
	}


	/* get all albums into a collection */
	public function getIntoCollection($collectionId)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('product')
                       ->join('collection', 'product.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('collection.collection_id = ?', $collectionId)
					   ->where('product_type = ?', Core_Store_Product::TYPE_ALBUM)
					   ->order(array('product.product_id ASC'));
					   
		return $this->createPaginator($select);
	}
}
