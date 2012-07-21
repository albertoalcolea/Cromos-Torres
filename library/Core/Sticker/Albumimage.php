<?php

class Core_Sticker_Albumimage {
	private $_id = null;
	
	private $_imageUrl = null;
	
	private $_albumId = null;


	 public function __construct($id = null, 
    							 $imageUrl = null,
    							 $albumId = null)
    {
    	if ($id !== null) {
        	$this->_id = (int)$id;
		}
        $this->_imageUrl = $imageUrl;
        $this->_albumId = (int)$albumId;
    }
    
	
    public function getId()
    {
        return $this->_id;
    }
    
	
    public function setId($id)
    {
        if ($id !== null) {
        	$this->_id = (int)$id;
		}
		return $this;
    }
	
    
    public function getImageUrl()
    {
        return $this->_imageUrl;
    }
	
    
    public function setImageUrl($imageUrl)
    {
        $this->_imageUrl = $imageUrl;
		return $this;
    }
	
	
	public function getAlbumId()
	{
		return $this->_albumId;
	}
	
	
	public function setAlbumId($albumId)
	{
		$this->_albumId = (int)$albumId;
		return $this;
	}
		
	
	public function toArray()
	{
		$albumImageArray = array(
			'albumImage_id'			=> $this->_id,
			'albumImage_imageUrl'	=> $this->_imageUrl,
			'album_id'				=> $this->_albumId,
		);
		
		return $albumImageArray;
	}
	
	
	public function fromArray($albumImageArray)
	{
		$this->_id			= (int)$albumImageArray['albumImage_id'];
		$this->_imageUrl	= $albumImageArray['albumImage_imageUrl'];
		$this->_albumId		= (int)$albumImageArray['album_id'];
	}
}
