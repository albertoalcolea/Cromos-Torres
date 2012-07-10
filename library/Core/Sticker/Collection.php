<?php
class Core_Sticker_Collection
{
    private $_name = null;

    private $_year = null;
   
    private $_imageURL = null;
   
    private $_editorial = null;
    

    public function __construct($name, $year, $imageURL, Core_Sticker_Editorial $editorial)
    {
        $this->_name = $name;
        $this->_year = (int)$year;
        $this->_imageURL = $imageURL;
        $this->_editorial = $editorial;
    }

   
    public function getName()
    {
        return $this->_name;
    }
 
    public function setNumber($name)
    {
        $this->_name = $name;
    }
   
    public function getYear()
    {
        return $this->_year;
    }
    
    public function setYear($year)
    {
        $this->_year = (int)$year;
    }

    public function getImageURL()
    {
        return $this->_imageURL;
    }
 
    public function setImageURL($imageURL)
    {
        $this->_imageURL = $imageURL;
    }
   
    public function getEditorial()
    {
        return $this->_editorial;
    }
 
    public function setEditorial(Core_Sticker_Editorial $editorial)
    {
        $this->_editorial = $editorial;
    }
}
