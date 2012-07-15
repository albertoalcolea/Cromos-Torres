<?php

class Core_Sticker_Album extends Core_Store_Product
{
    private $_images = null;
    
    private $_collectionId = null;
    
    
    public function __construct(ArrayAccess $images = null, $collectionId = null)
    {
        $this->_images = $images;
        $this->_collectionId = (int)$collectionId;
    }
    
	
    public function getImages()
    {
        return $this->_images;
    }
    
	
    public function setImages(ArrayAccess $images)
    {
        $this->_images = $images;
		return $this;
    }
	
    
    public function getCollectionId()
    {
        return $this->_collectionId;
    }
	
    
    public function setCollectionId($collectionId)
    {
        $this->_collectionId = (int)$collectionId;
		return $this;
    }
}
