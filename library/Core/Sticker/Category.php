<?php

class Core_Sticker_Category
{
    private $_id = null;
    
    private $_name = null;
    
    private $_order = 0;
    
    private $_collectionId = null;
    
    
    public function __construct($id = null, $name = null, $order = 0, $collectionId = null) 
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_order = (int)$order;
        $this->_collectionId = (int)$collectionId;
    }
        
    
    public function getId()
    {
        return $this->_id;
    }
    
	
    public function setId($id)
    {
        $this->_id = (int)$id;
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
