<?php

class Core_Sticker_Editorial
{
	const MINPRIORITY = 1;
	const MAXPRIORITY = 5;
	
	
    private $_id = null;
    
    private $_name = null;
    
    private $_priority = 0;
    
    private $_imageUrl = null;
    
    
    public function __construct($id = null,
                                $name = null,
                                $priority = 0,
                                $imageUrl = null)
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_priority = (int)$priority;
        $this->_imageUrl = $imageUrl;
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
    
	
    public function getPriority()
    {
        return $this->_priority;
    }
	
    
    public function setPriority($priority)
    {
    	if ($priority >= self::MINPRIORITY && $priority <= self::MAXPRIORITY) {
        	$this->_priority = (int)$priority;
		}
		return $this;
    }
    
	
    public function getImageUrl()
    {
        return $this->_imageUrl;
    }
	
    
    public function setImageUrl($imageUrl)
    {
        $this->_imageUrl = $imageUrl;
		return $this;
    }
}
