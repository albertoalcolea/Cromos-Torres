<?php

class Core_Store_Product
{
    protected $_id = null;
    
    protected $_name = null;
    
    protected $_details = null;
    
    protected $_price = null;
    
    protected $_dateAdded = null;
    
    
    public function __construct($id = null,
                                $name = null,
                                $details = null,
                                $price = null,
                                $dateAdded = null)
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_details = $details;
        $this->_price = (double)$price;
        $this->_dateAdded = $dateAdded;
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
	
    
    public function getDetails()
    {
        return $this->_details;
    }
	
    
    public function setDetails($details)
    {
        $this->_details = $details;
		return $this;
    }
    
	
    public function getPrice()
    {
        return $this->_price;
    }
    
	
    public function setPrice($price)
    {
        $this->_price = (double)$price;
		return $this;
    }
    
	
    public function getDateAdded()
    {
        return $this->_dateAdded;
    }
	
    
    public function setDateAdded($dateAdded)
    {
        $this->_dateAdded = $dateAdded;
		return $this;
    }
}
