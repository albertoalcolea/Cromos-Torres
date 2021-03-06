<?php

// Zend_Loader::loadClass('Core_Store_Cart_Item');

class Core_Store_Cart_Item_Collection implements ArrayAccess, IteratorAggregate, Countable
{
    protected $_objectArray = array();
    
    
    public function detach($offset)
    {
        $this->offsetUnset($offset);
        return $this;
    }
	
    
    public function attach($obj)
    {
        if (is_object($obj)) {
            $offset = null;
            
            if (method_exists($obj, 'getId')) {
                $offset = $obj->getId();
            }
            
            $this->offsetSet($offset, $obj);
            return $this;
        }
        throw new Exception('Must be a Object');
    }
    
	
    public function addItem($offset = null, Core_Store_Cart_Item $obj, $validate = true)
    {
        if ($offset === null) {
            if (method_exists($obj, 'getId')) {
                $offset = $obj->getId();
            }
        }
        
        $this->offsetSet($offset, $obj, $validate);
        return $this;
    }
    
	
    public function getItem($offset = null)
    {
        if ($offset === null) {
            return $this->getIterator();
        } else {
            return $this->offsetGet($offset);
        }
    }
    
	
    public function contains($obj)
    {
        return $this->offsetExists($obj);
    }
	
    
    public function getIterator()
    {
        return new ArrayIterator($this->_objectArray);
    }
	
    
    public function count()
    {
        return count($this->_objectArray);
    }
	
	
	public function countQuantity()
	{
		$count = 0;
		
		foreach ($this->_objectArray as $obj) {
			$count += $obj->getQuantity();
		}
		
		return $count;
	}
    
	
    public function offsetExists($offset)
    {
        if (is_object($offset)) {
            foreach ($this->_objectArray as $object) {
                if ($object === $offset) {
                    return true;
                }
            }
            return false;
        }
        
        return array_key_exists($offset, $this->_objectArray);
    }
	
    
    public function offsetGet($offset) {
        if ($this->offsetExists($offset) === true) {
            return $this->_objectArray[$offset];
        } else {
            return false;
        }
    }
	
    
    public function offsetSet($offset, $value, $validate = false)
    {
        if ($validate === true) {
            if (isset($offset) === true && $this->offsetExists($offset) === false) {
                $this->_objectArray[$offset] = $value;
            } else if ($this->offsetExists($offset) === false) {
                $this->_objectArray[] = $value;
            }
        } else {
            if (isset($offset) === true) {
                $this->_objectArray[$offset] = $value;
            } else {
                $this->_objectArray[] = $value;
            }
        }
    }
    
	
    public function offsetUnset($offset)
    {
        if (is_object($offset)) {
            foreach ($this->_objectArray as $idx => $object) {
                if ($object === $offset) {
                    unset($this->_objectArray[$idx]);
                    reset($this->_objectArray);
                    return;
                }
            }
        } else {
            if ($this-offsetExists($offset)) {
                unset($this->_objectArray[$offset]);
            }
        }
    }
}
