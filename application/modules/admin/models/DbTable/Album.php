<?php

class Admin_Model_DbTable_Album extends Admin_Model_DbTablePagination
{
    protected $_name = 'album';
    protected $_primary = 'album_id';
	
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$album = new Core_Sticker_Album();
		
       		$album->fromArray($row);
		
        	return $album;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Sticker_Album $album)
    {
        $row = $album->toArray();
        
        return $row;
    }
    
    
	/*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
	public function getById($id)
	{
		$select = $this->select()
					   ->setIntegrityCheck(false)
					   ->from('album')
					   ->join('collection', 'album.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('album_id = ?', $id);
		
		$row = $this->fetchRow($select);
		 
		return self::rowToObject($row);
	}


    /* get all albums */
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('album')
                       ->join('collection', 'album.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->order(array('editorial.editorial_id ASC', 'collection.collection_id ASC',
					   				 'album.album_id ASC'));
					   
		return $this->createPaginator($select);
	}


	/* get all albums into a collection */
	public function getIntoCollection($collectionId)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('album')
                       ->join('collection', 'album.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('album.collection_id = ?', $collectionId)
					   ->order(array('album.album_id ASC'));
					   
		return $this->createPaginator($select);
	}
	
	
	/* add new album */
	public function addAlbum(Core_Sticker_Album $album)
	{
		return $this->insert(self::objectToRow($album));
	}
	
	
	/* update an album */
	public function updateAlbum(Core_Sticker_Album $album)
	{
		$this->update(self::objectToRow($album), 'album_id = '. $album->getId());
	}
	
	
	/* delete an album */
	public function deleteAlbum($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}
