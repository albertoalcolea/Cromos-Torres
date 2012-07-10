<?php
class Core_Sticker_Sticker extends Core_Store_Product
{
    private $_number = 0;
   
    private $_imageURL = null;
   
    private $_category = null;
    

    public function __construct($number, $imageURL, Core_Sticker_Category $category)
    {
        $this->_number = (int)$number;
        $this->_imageURL = $imageURL;
        $this->_category = $category;
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
   
    public function getCategory()
    {
        return $this->_category;
    }
 
    public function setCategory(Core_Sticker_Category $category)
    {
        $this->_category = $category;
    }
}
