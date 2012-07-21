<?php

class Admin_Model_DbTable_Albumimage extends Zend_Db_Table_Abstract
{
    protected $_name = 'albumImage';
    protected $_primary = 'albumImage_id';
    
    
    /*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
    private function rowToObject($row)
    {
    	if ($row !== null) {
        	$albumImage = new Core_Sticker_Albumimage();
		
       		$albumImage->fromArray($row);
		
        	return $albumImage;
		} else {
			return false;
		}
    }
    
    private function objectToRow(Core_Sticker_Albumimage $albumImage)
    {
        $row = $albumImage->toArray();
        
        return $row;
    }
    
	/*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
	public function getById($id)
	{
		$row = $this->find($id);
		 
		return $this->rowToObject($row);
	}


	/* get all images into a album */
	public function getIntoAlbum($album_id)
	{
		$select = $this->select()
					   ->where('album_id = ?', $album_id)
					   ->order(array('albumImage_id ASC'));
					   
		$rows = $this->fetchAll($select);
		
		$albumImageArray = array();
		
		foreach ($rows as $row) {
			array_push($albumImageArray, $this->rowToObject($row));
		}
		
		return $albumImageArray;
	}
	
	
	/* add new album image */
	public function addAlbumImage(Core_Sticker_Albumimage $albumImage)
	{
		return $this->insert($this->objectToRow($albumImage));
	}
	
	
	/* update an album */
	public function updateAlbumImage(Core_Sticker_Albumimage $albumImage)
	{
		$this->update($this->objectToRow($albumImage), 'albumImage_id = '. $id);
	}
	
	
	/* delete an album */
	public function deleteAlbumImage($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
