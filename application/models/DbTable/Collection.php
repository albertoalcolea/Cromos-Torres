<?php

class Application_Model_DbTable_Collection extends Zend_Db_Table_Abstract
{
    protected $_name = 'collection';
    protected $_primary = 'collection_id';
    
    
    /*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
    private function rowToObject($row)
    {
        $collection = new Core_Sticker_Collection();
        $collection->setId($row['collection_id']);
        $collection->setName($row['collection_name']);
        $collection->setYear($row['collection_year']);
        $collection->setImageURL($row['collection_imageURL']);
        $collection->setEditorialId($row['editorial_id']);
         
        return $collection;
    }
    
    private function objectToRow(Core_Sticker_Collection $collection)
    {
        $row = array(
            'collection_id' => $collection->getId(),
            'collection_name' => $collection->getName(),
            'collection_year' => $collection->getYear(),
            'collection_imageURL' => $collection->getImageUrl(),
            'editorial_id' => $collection->getEditorialId(),
        );
        
        return $row;
    }
    
    
    /*****************************************************************/
	/* Public                                                        */
	/*****************************************************************/
    public function getById($id)
	{
		 $row = $this->find($id)->current();
		 return rowToObject($row);
	}
    
    
    /* get all collections into a editorial */
	public function getIntoEditorial($editorialId)
	{
		$select = $this->select();
		$select->where('editorial_id = ?', $editorialId);
 
		$rows = $this->fetchAll($select);
					
		return $rows;
	}
	
	
	/* add new collection */
	public function addCollection(Core_Sticker_Collection $collection)
	{
		$this->insert(objectToRow($collection));
	}
	
	
	/* update a collection */
	public function updateCollection(Core_Sticker_Collection $collection)
	{
		$this->update(objectToRow($collection), 'collection_id = '. $collection->getId());
	}
	
	
	/* delete a collection */
	public function deleteCollection($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
