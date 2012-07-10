<?php
class Core_Sticker_Category
{
    private $_id = null;
   
    private $_name = null;
   
    private $_order = 0;
    
    private $_collectionId = null;
    

    public function __construct($id, $name, $order, $collectionId)
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
    
    public function getCollectionId()
    {
        return $this->_collectionId;
    }
    
    public function setCollectionId($collectionId)
    {
        $this->_collectionId = $collectionId;
    }
}
