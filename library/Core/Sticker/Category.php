<?php
class Core_Sticker_Category
{
    private $_id = null;
   
    private $_name = null;
   
    private $_order = 0;
    
    private $_collection = null;
    

    public function __construct($id, $name, $order, Core_Sticker_Collection $collection)
    {
        $this->_id = (int)$id;
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
    
    public function getOrder()
    {
        return $this_order;
    }
    
    public function setOrder($order)
    {
        $this->_order = (int)$order;
    }
    
    public function getCollection()
    {
        return $this->_collection;
    }
    
    public function setCollection(Core_Sticker_Collection $collection)
    {
        $this->_collection = $collection;
    }
}
