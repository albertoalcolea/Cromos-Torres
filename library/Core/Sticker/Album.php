<?php

class Core_Sticker_Album extends Core_Store_Product
{
    private $_images = null;
    
    private $_collection = null;
    
    
    public function __construct(ArrayAccess $images = null, 
    							Core_Sticker_Collection $collection = null)
    {
        $this->_images = $images;
        $this->_collection = $collection;
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
	
    
    public function getCollection()
    {
        return $this->_collection;
    }
	
    
    public function setCollection(Core_Sticker_Collection $collection)
    {
        $this->_collection = $collection;
		return $this;
    }
}
