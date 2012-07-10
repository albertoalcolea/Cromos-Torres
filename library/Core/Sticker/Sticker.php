<?php
class Core_Sticker_Sticker extends Core_Store_Product
{
    private $_number = 0;
   
    private $_imageURL = null;
   
    private $_categoryId = null;
    

    public function __construct($number, $imageURL, $categoryId)
    {
        $this->_number = (int)$number;
        $this->_imageURL = $imageURL;
        $this->_categoryId = (int)$categoryId;
    }

   
    public function getNumber()
    {
        return $this->_number;
    }
 
    public function setNumber($number)
    {
        $this->_number = (int)$number;
    }
   
    public function getImageURL()
    {
        return $this->_imageURL;
    }
 
    public function setImageURL($imageURL)
    {
        $this->_imageURL = $imageURL;
    }
   
    public function getCategoryId()
    {
        return $this->_categoryId;
    }
 
    public function setCategoryId($categoryId)
    {
        $this->_categoryId = $categoryId;
    }
}
