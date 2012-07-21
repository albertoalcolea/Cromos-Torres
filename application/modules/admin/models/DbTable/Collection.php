<?php

class Admin_Model_DbTable_Collection extends Admin_Model_DbTablePagination
{
    protected $_name = 'collection';
    protected $_primary = 'collection_id';
    
	
	/*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
	public static function rowToObject($row)
	{
		if ($row !== null) {
        	$collection = new Core_Sticker_Collection();
		
       		$collection->fromArray($row);
		
        	return $collection;
		} else {
			return false;
		}
	}
	
	public static function objectToRow(Core_Sticker_Collection $collection)
	{
		$row = $collection->toArray();    
		
        return $row;
	}
	
    
    /*****************************************************************/
	/* Public                                                        */
	/*****************************************************************/
    public function getById($id)
	{
		$select = $this->select()
					   ->setIntegrityCheck(false)
					   ->from('collection')
					   ->join('editorial', 'collection.editorial_id = editorial.editorial_id')
					   ->where('collection_id = ?', $id);
		
		$row = $this->fetchRow($select);
		 
		return self::rowToObject($row);
	}
	    
    
    /* get all collections */
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('collection')
                       ->join('editorial', 'collection.editorial_id = editorial.editorial_id')
					   ->order(array('editorial.editorial_id ASC', 'collection.collection_year DESC'));  

		return $this->createPaginator($select);
	}
    
    
    /* get all collections into a editorial */
	public function getIntoEditorial($editorialId)
	{	
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('collection')
                       ->join('editorial', 'collection.editorial_id = editorial.editorial_id')
					   ->where('collection.editorial_id = ?', $editorialId)
					   ->order(array('collection.collection_year DESC'));
					   
		return $this->createPaginator($select);
	}
	
	
	/* add new collection */
	public function addCollection(Core_Sticker_Collection $collection)
	{
		return $this->insert(self::objectToRow($collection));
	}
	
	
	/* update a collection */
	public function updateCollection(Core_Sticker_Collection $collection)
	{
		$this->update(self::objectToRow($collection), 'collection_id = '. $collection->getId());
	}
	
	
	/* delete a collection */
	public function deleteCollection($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
