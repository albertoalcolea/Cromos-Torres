<?php

// Zend_Loader::loadClass('Core_Store_Cart_Abstract');

class Core_Store_Cart_Abstract_StandardCart extends Core_Store_Cart_Abstract
{
    static private $_instance = null;
    
    
    private function findProduct($productId)
    {
        if ($this->inCart($productId)) {
            return $this->_contents->getItem($productId);
        }
        
        return null;
    }
    
    
    protected function __construct()
    {
        $this->reset();
    }
    
    
    static public function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    
    public function reset()
    {
        $this->_contents = new Core_Store_Cart_Item_Collection();
        $this->_total = 0;
        
        $sessionData = Zend_Registry::getInstance()->get('coreSession');
        
        if (isset($sessionData->cartId)) {
            unset($sessionData->cartId);
        }
    }
    
    public function addCart(Core_Store_Cart_Item $item)
    {
        if ($this->inCart($item->getId())) {
            $this->updateQuantity($item->getId(), $item->getQuantity());
        } else {
            $this->_contents->addItem($item->getId(), $item);
            $this->cleanup();
        }
    }
    
    public function updateQuantity($productId, $quantity, $quantityFromPost = false)
    {
        $item = $this->findProduct($productId);
        
        if ($item !== null) {
            $quantity = ($quantityFromPost === true) ?  $quantity : $item->getQuantity() + $quantity;
            $item->setQuantity($quantity);
            
            $this->cleanup();
        }
    }
    
    public function cleanup()
    {
        foreach ($this->_contents->getIterator() as $key => $value) {
            if ($this->getQuantity($key) < 1) {
                $this->_contents->detach($key);
            }
        }
    }
    
    public function countContents()
    {
        //return (int)$this->_contents->count();
        return (int)$this->_contents->countQuantity();
    }
    
    public function getQuantity($productId)
    {
        if ($this->inCart($productId)) {
            if ( ($item = $this->_contents->getItem($productId)) && ($item->getQuantity() > 0) ) {
                return $item->getQuantity();
            }
            return 0;
        } else {
            return 0;
        }
    }
    
    public function inCart($productId)
    {
        return $this->_contents->offsetExists($productId);
    }
    
    public function has($productId)
    {
        return $this->inCart($productId);
    }
    
    public function remove($productId)
    {
        $product = $this->findProduct($productId);
        if ($product !== null) {
            $this->_contents->detach($product);
        }
    }
    
    public function removeProducts(ArrayAccess $productsIds)
    {
        if ($productsIds !== null) {
            for ( $iterator = $productsIds->getIterator(); $iterator->valid(); $iterator->next() ) {
                $this->remove((String)$iterator->current());
            }
        }
    }
    
    public function removeAll()
    {
        $this->reset();
    }
    
    public function getProducts()
    {
        $this->calculateTotals();
        return $this->_contents;
    }
    
    public function calculateTotals()
    {
        $this->_total = 0;
        
        foreach ($this->_contents->getIterator() as $productId => $item) {
            $this->_total += $item->getSubTotal;
        }
    }
    
    public function getContents()
    {
        return $this->_contents;
    }
    
    public function getTotal()
    {
        return (double)$this->_total;
    }
}
