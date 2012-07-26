<?php

class Default_Model_DbTable_Albumimage extends Default_Model_DbTablePagination
{
    protected $_name = 'albumImage';
    protected $_primary = 'albumImage_id';
    
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$albumImage = new Core_Sticker_Albumimage();
		
       		$albumImage->fromArray($row);
		
        	return $albumImage;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Sticker_Albumimage $albumImage)
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
		 
		return self::rowToObject($row);
	}


	/* get all images into a album */
	public function getIntoAlbum($album_id)
	{
		$select = $this->select()
					   ->where('album_id = ?', $album_id)
					   ->order(array('albumImage_id ASC'));
					   
		return $this->createPaginator($select);
	}
}
