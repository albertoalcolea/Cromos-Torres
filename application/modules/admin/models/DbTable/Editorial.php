<?php
class Admin_Model_DbTable_Editorial extends Zend_Db_Table_Abstract{
    
    protected $_name = 'editorial';
    protected $_primary = 'id';
    
    
    /*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
    private function rowToObject($row)
    {
    	if ($row !== null) {
        	$editorial = new Core_Sticker_Editorial();
		
       		$editorial->fromArray($row);
		
        	return $editorial;
		} else {
			return false;
		}
    }
    
    private function objectToRow(Core_Sticker_Editorial $editorial)
    {
        $row = $editorial->toArray();
        
        return $row;
    }
    
    
    /*****************************************************************/
	/* Public                                                        */
	/*****************************************************************/
    public function getById($id)
	{
		 $row = $this->find($id)->current();
		 return $this->rowToObject($row);
	}
    
    
    /* get all editorials */
	public function getAll()
	{
		return $this->fetchAll();
	}
	
	
	/* add new editorial */
	public function addEditorial(Core_Sticker_Editorial $editorial)
	{
		$this->insert($this->objectToRow($editorial));
	}
	
	
	/* update a editorial */
	public function updateEditorial(Core_Sticker_Editorial $editorial)
	{
		$this->update($this->objectToRow($editorial), 'id = '. $editorial->getId());
	}
	
	
	/* delete a editorial */
	public function deleteEditorial($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
