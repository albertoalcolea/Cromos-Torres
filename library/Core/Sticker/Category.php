<?php

class Core_Sticker_Category
{
    private $_id = null;
    
    private $_name = null;
    
    private $_order = 0;
    
    private $_collection = null;
    
    
    public function __construct($id = null, 
    							$name = null, 
    							$order = 0, 
    							Core_Sticker_Collection $collection = null) 
    {
    	if ($id !== null) {
        	$this->_id = (int)$id;
		}
        $this->_name = $name;
        $this->_order = (int)$order;
        $this->_collection = $collection;
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
	
    
    public function getName()
    {
        return $this->_name;
    }
	
    
    public function setName($name)
    {
        $this->_name = $name;
		return $this;
    }
	
    
    public function getOrder()
    {
        return $this->_order;
    }
	
    
    public function setOrder($order)
    {
        $this->_order = (int)$order;
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
		$collectionArray = array(
			'category_id'		=> $this->_id,
			'category_name'		=> $this->_name,
			'category_order'	=> $this->_order,
			'collection_id'		=> $this->_collection->getId(),
		);
		
		return $collectionArray;
	}
	
	
	public function fromArray($categoryArray)
	{
		$this->_id			= (int)$categoryArray['category_id'];
		$this->_name		= $categoryArray['category_name'];
		$this->_order		= (int)$categoryArray['category_order'];
		
		$collection = new Core_Sticker_Collection();
		$collection->fromArray($categoryArray);
		
		$this->_collection	= $collection;
	}
}
