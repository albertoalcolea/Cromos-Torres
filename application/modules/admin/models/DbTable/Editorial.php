<?php
class Application_Model_DbTable_Editorial extends Zend_Db_Table_Abstract{
    
    protected $_name = 'editorial';
    protected $_primary = 'id';
    
    
    /*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
    private function rowToObject($row)
    {
        $editorial = new Core_Sticker_Editorial();
        $editorial->setId($row['id']);
        $editorial->setName($row['name']);
        $editorial->setPriority($row['priority']);
        $editorial->setImageURL($row['imageUrl']);
         
        return $editorial;
    }
    
    private function objectToRow(Core_Sticker_Editorial $editorial)
    {
        $row = array(
            'id' => $editorial->getId(),
            'name' => $editorial->getName(),
            'priority' => $editorial->getPriority(),
            'imageUrl' => $editorial->getImageUrl(),
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
