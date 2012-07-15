<?php

class Core_Sticker_Sticker extends Core_Store_Product
{
    private $_number = 0;
    
    private $_imageUrl = null;
    
    private $_categoryId = null;
    
    
    public function __construct($number = 0,
                                $imageUrl = null,
                                $categoryId = null)
    {
        $this->_number = (int)$number;
        $this->_imageUrl = $imageUrl;
        $this->_categoryId = (int)$categoryId;
    }
    
    
    public function getNumber()
    {
        return $this->_number;
    }
    
	
    public function setNumber($number)
    {
        $this->_number = (int)$number;
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
    
	
    public function getCategoryId()
    {
        return $this->_categoryId;
    }
	
    
    public function setCategoryId($categoryId)
    {
        $this->_categoryId = (int)$categoryId;
		return $this;
    }
}
