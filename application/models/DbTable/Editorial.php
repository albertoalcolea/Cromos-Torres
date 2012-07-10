<?php
class Application_Model_DbTable_Post extends Zend_Db_Table_Abstract{
    
    protected $_name = 'editorial';
    protected $_primary = 'editorial_id';
    
    
    /*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
    private function rowToObject($row)
    {
        $editorial = new Core_Sticker_Editorial();
        $editorial->setId($row['editorial_id']);
        $editorial->setName($row['editorial_name']);
        $editorial->setPriority($row['collection_priority']);
        $editorial->setImageURL($row['editorial_imageURL']);
         
        return $editorial;
    }
    
    private function objectToRow(Core_Sticker_Editorial $editorial)
    {
        $row = array(
            'editorial_id' => $editorial->getId(),
            'editorial_name' => $editorial->getName(),
            'collection_priority' => $editorial->getPriority(),
            'editorial_imageURL' => $editorial->getImageUrl(),
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
    
    
    /* get all editorials */
	public function getAll()
	{
		return $this->fetchAll();
	}
	
	
	/* add new editorial */
	public function addEditorial(Core_Sticker_Editorial $editorial)
	{
		$this->insert(objectToRow($editorial));
	}
	
	
	/* update a editorial */
	public function updateEditorial(Core_Sticker_Editorial $editorial)
	{
		$this->update(objectToRow($editorial), 'editorial_id = '. $editorial->getId());
	}
	
	
	/* delete a editorial */
	public function deleteEditorial($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
