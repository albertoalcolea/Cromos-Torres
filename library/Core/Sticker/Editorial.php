<?php
class Core_Sticker_Editorial
{
    private $_id = null
    
    private $_name = null;

    private $_priority = 0;
   
    private $_imageURL = null;
    

    public function __construct($id, $name, $priority, $imageURl)
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_priority = (int)$priority;
        $this->_imageURL = $imageURL;
    }

   
    public function getId()
    {
        return $this->_id;
    }
    
    public function setId($id)
    {
        $this->_id = (int)$id;
    }
    
    public function getName()
    {
        return $this->_name;
    }
 
    public function setNumber($name)
    {
        $this->_name = $name;
    }
   
    public function getPriority()
    {
        return $this->_priority;
    }
    
    public function setPriority($priority)
    {
        $this->_priority = (int)$priority;
    }

    public function getImageURL()
    {
        return $this->_imageURL;
    }
 
    public function setImageURL($imageURL)
    {
        $this->_imageURL = $imageURL;
    }
}
