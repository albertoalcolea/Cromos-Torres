<?php

class Admin_Model_DbTable_Collection extends Zend_Db_Table_Abstract
{
    protected $_name = 'collection';
    protected $_primary = 'collection_id';
    
    
    /*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
    private function rowToObject($row)
    {
    	if ($row !== null) {
        	$collection = new Core_Sticker_Collection();
		
       		$collection->fromArray($row);
		
        	return $collection;
		} else {
			return false;
		}
    }
    
    private function objectToRow(Core_Sticker_Collection $collection)
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
		 
		return $this->rowToObject($row);
	}
	    
    
    /* get all collections */
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('collection')
                       ->join('editorial', 'collection.editorial_id = editorial.editorial_id');
					   
		$rows = $this->fetchAll($select);
		
		$collectionArray = array();
		
		foreach ($rows as $row) {
			array_push($collectionArray, $this->rowToObject($row));
		}
		
		return $collectionArray;
	}
    
    
    /* get all collections into a editorial */
	public function getIntoEditorial($editorialId)
	{	
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('collection')
                       ->join('editorial', 'collection.editorial_id = editorial.editorial_id')
					   ->where('collection.editorial_id = ?', $editorialId);
					   
		$rows = $this->fetchAll($select);
		
		$collectionArray = array();

		foreach ($rows as $row) {
			array_push($collectionArray, $this->rowToObject($row));
		}
		
		return $collectionArray;
	}
	
	
	/* add new collection */
	public function addCollection(Core_Sticker_Collection $collection)
	{
		$this->insert($this->objectToRow($collection));
	}
	
	
	/* update a collection */
	public function updateCollection(Core_Sticker_Collection $collection)
	{
		$this->update($this->objectToRow($collection), 'collection_id = '. $collection->getId());
	}
	
	
	/* delete a collection */
	public function deleteCollection($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
