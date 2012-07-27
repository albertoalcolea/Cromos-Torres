<?php

class Core_Model_DbTable_Editorial extends Zend_Db_Table_Abstract
{
    protected $_name = 'editorial';
    protected $_primary = 'editorial_id';
    
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$editorial = new Core_Sticker_Editorial();
		
       		$editorial->fromArray($row);
		
        	return $editorial;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Sticker_Editorial $editorial)
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
		return self::rowToObject($row);
	}
    
    
    /* get all editorials */
	public function getAll()
	{
		$rows = $this->fetchAll();
		
		$editorialArray = array();
		
		foreach ($rows as $row) {
			array_push($editorialArray, self::rowToObject($row));
		}
		
		return $editorialArray;
	}
	
	
	/* add new editorial */
	public function addEditorial(Core_Sticker_Editorial $editorial)
	{
		return $this->insert(self::objectToRow($editorial));
	}
	
	
	/* update a editorial */
	public function updateEditorial(Core_Sticker_Editorial $editorial)
	{
		$this->update(self::objectToRow($editorial), $this->_primary . ' = ' . $editorial->getId());
	}
	
	
	/* delete a editorial */
	public function deleteEditorial($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
