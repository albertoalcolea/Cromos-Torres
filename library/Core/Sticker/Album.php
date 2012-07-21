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
		
	
	public function toArray()
	{
		$albumArray = array(
			'product_id'		=> $this->_id,
			'product_type'		=> Core_Store_Product::TYPE_ALBUM,
			'collection_id'		=> $this->_collection->getId(),
			'product_name'		=> $this->_name,
			'product_details'	=> $this->_details,
			'product_price'		=> $this->_price,
			'product_stock'		=> $this->_stock,
			//'product_dateAdded'	=> $this->_dateAdded->get('yyyy-mm-dd'),
		);
		
		return $albumArray;
	}
	
	
	public function fromArray($albumArray)
	{
		$this->_id			= (int)$albumArray['product_id'];
		
		$collection = new Core_Sticker_Collection();
		$collection->fromArray($albumArray);
		
		$this->_collection	= $collection;
		
		$this->_name		= $albumArray['product_name'];
		$this->_details		= $albumArray['product_details'];
		$this->_price		= (double)$albumArray['product_price'];
		$this->_stock		= (int)$albumArray['product_stock'];
		//$this->_dateAdded	= $albumArray['product_dateAdded'];
	}
}
