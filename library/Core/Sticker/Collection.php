<?php

class Core_Sticker_Collection
{
    private $_id = null;
    
    private $_name = null;
    
    private $_year = null;
    
    private $_imageUrl = null;
    
    private $_editorialId = null;
    
    
    public function __construct($id = null, 
                                $name = null, 
                                $year = null, 
                                $imageUrl = null, 
                                $editorialId = null)
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_year = (int)$year;
        $this->_imageUrl = $imageUrl;
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
    
    public function setName($name)
    {
        $this->_name = $name;
    }
    
    public function getYear()
    {
        return $this->_year;
    }
    
    public function setYear($year)
    {
        $this->_year = (int)$year;
    }
    
    public function getImageUrl()
    {
        return $this->_imageUrl;
    }
    
    public function setImageUrl($imageUrl)
    {
        $this->_imageUrl = $imageUrl;
    }
    
    public function getEditorialId()
    {
        return $this->_editorialId;
    }
    
    public function setEditorialId($editorialId)
    {
        $this->_editorialId = (int)$editorialId;
    }
}
