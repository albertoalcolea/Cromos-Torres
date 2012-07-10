<?php
class Core_Sticker_Collection
{
    private $_id = null;
    
    private $_name = null;

    private $_year = null;
   
    private $_imageURL = null;
   
    private $_editorialId = null;
    

    public function __construct($id, $name, $year, $imageURL, $editorialId)
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_year = (int)$year;
        $this->_imageURL = $imageURL;
        $this->_editorialId = (int)$editorialId;
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
   
    public function getEditorialId()
    {
        return $this->_editorialId;
    }
 
    public function setEditorialId($editorialId)
    {
        $this->_editorialId = $editorialId;
    }
}
