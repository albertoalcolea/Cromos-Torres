<?php

class Core_Sticker_Collection
{
    private $_id = null;
    
    private $_name = null;
    
    private $_year = null;
    
    private $_imageUrl = null;
    
    private $_editorial = null;
    
    
    public function __construct($id = null, 
                                $name = null, 
                                $year = null, 
                                $imageUrl = null, 
                                Core_Sticker_Editorial $editorial = null)
    {
        $this->_id = (int)$id;
        $this->_name = $name;
        $this->_year = (int)$year;
        $this->_imageUrl = $imageUrl;
        $this->_editorial = $editorial;
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


    public function getYear()
    {
        return $this->_year;
    }
    
	
    public function setYear($year)
    {
        $this->_year = (int)$year;
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
    
	
    public function getEditorial()
    {
        return $this->_editorial;
    }
    
	
    public function setEditorial(Core_Sticker_Editorial $editorial)
    {
        $this->_editorial = $editorial;
		return $this;
    }
	
	
	public function toArray()
	{
		$collectionArray = array(
			'collection_id' 		=> $this->_id,
			'collection_name' 		=> $this->_name,
			'collection_year' 		=> $this->_year,
			'collection_imageUrl'	=> $this->_imageUrl,
			'editorial_id' 			=> $this->_editorial->getId(),
		);
		return $collectionArray;
	}
	
	
	public function fromArray($collectionArray)
	{
		$this->_id			= (int)$collectionArray['collection_id'];
		$this->_name		= $collectionArray['collection_name'];
		$this->_year		= (int)$collectionArray['collection_year'];
		$this->_imageUrl	= $collectionArray['collection_imageUrl'];
		
		$editorial = new Core_Sticker_Editorial();
		$editorial->fromArray($collectionArray);
		
		$this->_editorial 	= $editorial;
	}
}
