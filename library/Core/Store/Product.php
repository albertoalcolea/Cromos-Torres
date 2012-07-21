<?php

class Core_Store_Product
{
	const TYPE_STICKER	= 1;
	const TYPE_ALBUM	= 2;
	
	
    protected $_id = null;
    
    protected $_name = null;
    
    protected $_details = null;
    
    protected $_price = null;
    
	protected $_stock = 0;
	
    protected $_dateAdded = null;
    
    
    public function __construct($id = null,
                                $name = null,
                                $details = null,
                                $price = null,
                                $stock = 0,
                                Zend_Date $dateAdded = null)
    {
    	if ($id !== null) {
        	$this->_id = (int)$id;
		}
        $this->_name = $name;
        $this->_details = $details;
        $this->_price = (double)$price;
		$this->_stock = (int)$stock;
        $this->_dateAdded = $dateAdded;
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
    
	
	public function getStock()
	{
		return $this->_stock;
	}
	
	
	public function setStock($stock)
	{
		$this->_stock = (int)$stock;
		return $this;
	}
	
	
    public function getDateAdded()
    {
        return $this->_dateAdded;
    }
	
    
    public function setDateAdded(Zend_Date $dateAdded)
    {
        $this->_dateAdded = $dateAdded;
		return $this;
    }
	
	
	public function getTypeName()
	{
		$typeName = substr(get_class($this), 13);
		$type = null;
		
		switch ($typeName) {
			case "Sticker":
				$type = "Cromo";
				break;
			case "Album":
				$type = "Álbum";
				break;
		}
		
		return $type;
	}
}
