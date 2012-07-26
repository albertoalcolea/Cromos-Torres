<?php

abstract class Core_Store_Cart_Abstract
{
    protected $_contents = null;
    
    protected $_total = 0;
   
     
    abstract public function reset();
    
    abstract public function addCart(Core_Store_Cart_Item $item);
    
    abstract public function updateQuantity($products_id, $quantity);
    
    abstract public function cleanup();
    
    abstract public function countContents();
    
    abstract public function getQuantity($products_id);
    
    abstract public function inCart($products_id);
    
    abstract public function remove($products_id);
    
    abstract public function removeAll();
    
    abstract public function getProducts();
    
    abstract public function getContents();
    
    abstract public function getTotal();
    
	
    public function save()
    {
        try {
            $sessionData = Zend_Registry::get('coreSession');
            
            if (isset($sessionData->cart)) {
                unset($sessionData->cart);
            }
            
            $sessionData->cart = $this;
            
        } catch (Exception $e) {
            print "Message: " . $e->getMessage() . "\n";
        }
    }
}
