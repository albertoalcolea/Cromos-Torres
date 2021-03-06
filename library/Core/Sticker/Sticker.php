<?php

class Core_Sticker_Sticker extends Core_Store_Product
{
    private $_number = null;
    
    private $_imageUrl = null;
    
    private $_category = null;
    
    
    public function __construct($number = null,
                                $imageUrl = null,
                                Core_Sticker_Category $category = null)
    {
        $this->_number = $number;
        $this->_imageUrl = $imageUrl;
        $this->_category = $category;
    }
    
    
    public function getNumber()
    {
        return $this->_number;
    }
    
	
    public function setNumber($number)
    {
        $this->_number = $number;
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
    
	
    public function getCategory()
    {
        return $this->_category;
    }
	
    
    public function setCategory(Core_Sticker_Category $category)
    {
        $this->_category = $category;
		return $this;
    }
	
	
	public function toArray()
	{
		$stickerArray = array(
			'product_id'		=> $this->_id,
			'product_type'		=> Core_Store_Product::TYPE_STICKER,
			'sticker_number'	=> $this->_number,
			'sticker_imageUrl'	=> $this->_imageUrl,
			'category_id'		=> $this->_category->getId(),
			'product_name'		=> $this->_name,
			'product_details'	=> $this->_details,
			'product_price'		=> $this->_price,
			'product_stock'		=> $this->_stock,
			//'product_dateAdded'	=> $this->_dateAdded->toString('yyyy-MM-dd HH:mm:ss'),
		);
		
		return $stickerArray;
	}
	
	
	public function fromArray($stickerArray)
	{
		$this->_id			= (int)$stickerArray['product_id'];
		$this->_number		= $stickerArray['sticker_number'];
		$this->_imageUrl	= $stickerArray['sticker_imageUrl'];
		
		$category = new Core_Sticker_Category();
		$category->fromArray($stickerArray);
		
		$this->_category	= $category;
		
		$this->_name		= $stickerArray['product_name'];
		$this->_details		= $stickerArray['product_details'];
		$this->_price		= (double)$stickerArray['product_price'];
		$this->_stock		= (int)$stickerArray['product_stock'];
		$this->_dateAdded	= new Zend_Date($stickerArray['product_dateAdded'], Zend_Date::ISO_8601);
	}
}
