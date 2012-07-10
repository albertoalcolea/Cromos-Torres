<?php
class Core_Store_Product
{
    protected $_id = null;
   
    protected $_name = null;
   
    protected $_details = null;

    protected $_price = null;
   
    protected $_dateAdded = null;

 
    public function __construct($id, $name, $details, $price, $dateAdded)
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
        $this->_id = (int)$id;
    }
   
    public function getName()
    {
        return $this->_name;
    }
 
    public function setName($name)
    {
        $this->_name = $name;
    }
    
    public function getDetails()
    {
        return $this->_details;
    }
 
    public function setDetails($details)
    {
        $this->_details = $details;
    }
    
    public function getPrice()
    {
        return $this->_price;
    }
 
    public function setPrice($price)
    {
        $this->_price = (double)$price;
    }
 
    public function getDateAdded()
    {
        return $this->_dateAdded;
    }
 
    public function setDateAdded($date)
    {
        $this->_dateAdded = $date;
    }
}
