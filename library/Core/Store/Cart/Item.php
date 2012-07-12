<?php

class Core_Store_Cart_Item
{
    private $_product = null;
    
    private $_quantity = 0;
    
    private $_subTotal = null;
    
    
    public function __construct(Core_Store_Product $product = null,
                                $quantity = null)
    {
        $this->_product = $product;
        $this->_quantity = $quantity;
        $this->_calculateSubTotal();
    }
    
    
    private function _calculateSubTotal()
    {
        $this->getSubTotal();
    }
    
    
    public function getProduct()
    {
        return $this->_product;
    }
    
    public function setProduct(Core_Store_Product $product)
    {
        $this->_product = $product;
        $this->_calculateSubTotal();
    }
    
    public function getId()
    {
        if ($this->_product !== null) {
            return $this->_product->getId();
        }
    }
    
    public function setId($id)
    {
        if ($this->_product !== null) {
            $this->_product->setId((int)$id);
        }
    }
    
    public function getName()
    {
        if ($this->_product !== null) {
            return $this->_product->getName();
        }
    }
    
    public function setName($name)
    {
        if ($this->_product !== null) {
            $this->_product->setName($name);
        }
    }
    
    public function getPrice()
    {
        if ($this->_product !== null) {
            return $this->_product->getPrice();
        }
    }
    
    public function setPrice($price)
    {
        if ($this->_product !== null) {
            $this->_product->setPrice((double)$price);
        }
    }
    
    public function getQuantity()
    {
        return $this->_quantity;
    }
    
    public function setQuantity($quantity)
    {
        $this->_quantity = (int)$quantity;
        $this->_calculateSubTotal();
    }
    
    public function getSubTotal()
    {
        if ($this->getPrice() != 0 && $this->getPrice() !== null) {
            $this->setSubTotal($this->getQuantity() * $this->getPrice());
            return $this->_subTotal;
        } else {
            return 0;
        }
    }
    
    public function setSubTotal($subTotal)
    {
        $this->_subTotal = (double)$subTotal;
    }
}
