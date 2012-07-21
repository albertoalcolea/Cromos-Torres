<?php

class Admin_Model_DbTable_Sticker extends Admin_Model_DbTablePagination
{
    protected $_name = 'sticker';
    protected $_primary = 'sticker_id';
	
    
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
					   ->from('sticker')
					   ->join('category', 'sticker.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('sticker_id = ?', $id);
		
		$row = $this->fetchRow($select);
		 
		return self::rowToObject($row);
	}
	    
    
    /* get all stickers */
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('sticker')
                       ->join('category', 'sticker.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->order(array('editorial.editorial_id ASC', 'collection.collection_id ASC',
					   				 'category.category_id ASC', 'sticker.sticker_number ASC'));
					   
		return $this->createPaginator($select);
	}
    
    
    /* get all stickers into a collection */
	public function getIntoCollection($collectionId)
	{	
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('sticker')
                       ->join('category', 'sticker.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('collection.collection_id = ?', $collectionId)
					   ->order(array('category.category_id ASC', 'sticker.sticker_number ASC'));
					   
		return $this->createPaginator($select);
	}


	/* get all stickers into a category */
	public function getIntoCategory($categoryId)
	{	
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('sticker')
                       ->join('category', 'sticker.category_id = category.category_id')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('category.category_id = ?', $categoryId)
					   ->order(array('sticker.sticker_number ASC'));
					   
		return $this->createPaginator($select);
	}
	
	
	/* add new sticker */
	public function addSticker(Core_Sticker_Sticker $sticker)
	{
		return $this->insert(self::objectToRow($sticker));
	}
	
	
	/* update a sticker */
	public function updateSticker(Core_Sticker_Sticker $sticker)
	{
		$this->update(self::objectToRow($sticker), 'sticker_id = '. $sticker->getId());
	}
	
	
	/* delete a sticker */
	public function deleteSticker($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
