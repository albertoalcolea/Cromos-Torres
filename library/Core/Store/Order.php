<?php

class Core_Store_Order
{	
	const TYPE_PAYPAL		= 0;
	const TYPE_BANKTRANSFER	= 1;
	
	
    private $_id = null;
    
    private $_date = null;
    
    private $_firstName = null;
    
    private $_lastName = null;
    
    private $_address = null;
    
    private $_city = null;
    
    private $_postcode = null;
    
    private $_email = null;
    
    private $_paymentMethod = 0;
    
    private $_items = null;
    
	
	private function findProduct($productId)
    {
        if ($this->inCart($productId)) {
            return $this->_contents->getItem($productId);
        }
        
        return null;
    }
	
    
    public function __construct($id = null,
                                $date = null,
                                $firstName = null,
                                $lastName = null,
                                $address = null,
                                $city = null,
                                $postcode = null,
                                $email = null,
                                $paymentMethod = null,
                                Core_Store_Cart_Item_Collection $items = null)
    {
    	if ($id !== null) {
        	$this->_id = (int)$id;
		}
        $this->_date = $date;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_address = $address;
        $this->_city = $city;
        $this->_postcode = (int)$postcode;
        $this->_email = $email;
        $this->_paymentMethod = (int)$paymentMethod;
        $this->_items = $items;
    }
    
    
    public function getId()
    {
        return $this->_id;
    }
    
	
    public function setId($id)
    {
    	if ($id !== null) {
        	$this->_id = (int)id;
		}
		return $this;
    }
    
	
    public function getDate()
    {
        return $this->_date;
    }
    
	
    public function setDate($date)
    {
        $this->_date = $date;
		return $this;
    }
    
	
    public function getFirstName()
    {
        return $this->_firstName;
    }
	
    
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
		return $this;
    }
    
	
    public function getLastName()
    {
        return $this->_lastName;
    }
	
    
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
		return $this;
    }
	
    
    public function getAddress()
    {
        return $this->_address;
    }
	
    
    public function setAddress($address)
    {
        $this->_address = $address;
		return $this;
    }
    
    public function getCity()
    {
        return $this->_city;
    }
	
    
    public function setCity($city)
    {
        $this->_city = $city;
		return $this;
    }
    
	
    public function getPostcode()
    {
        return $this->_postcode;
    }
    
	
    public function setPostcode($postcode)
    {
        $this->_postcode = (int)$postcode;
		return $this;
    }
    
	
    public function getEmail()
    {
        return $this->_email;
    }
    
	
    public function setEmail($email)
    {
        $this->_email = $email;
		return $this;
    }
    
	
    public function getPaymentMethod()
    {
        return $this->_paymentMethod;
    }
    
	
	public function getPaymentMethodName()
	{
		$paymentMethod = null;
		
		switch ($this->_paymentMethod) {
		    case self::TYPE_PAYPAL:
		        $paymentMethod = "Paypal";
		        break;
		    case self::TYPE_BANKTRANSFER:
		        $paymentMethod = "Transferencia bancaria";
		        break;
		}
		
		return $paymentMethod;
	}
	
	
    public function setPaymentMethod($paymentMethod)
    {
        $this->_paymentMethod = (int)$paymentMethod;
		return $this;
    }
    
	
    public function getItems()
    {
        return $this->_items;
    }
    
	
    public function setItems(Core_Store_Cart_Item_Collection $items)
    {
        $this->_items = $items;
		return $this;
    }
	
	
	public function addItem(Core_Store_Cart_Item $item)
    {
        if ($this->inOrder($item->getId())) {
            $this->updateQuantity($item->getId(), $item->getQuantity());
        } else {
            $this->_contents->addItem($item->getId(), $item);
        }
    }
    
	
    public function updateQuantity($productId, $quantity, $quantityFromPost = false)
    {
        $item = $this->findProduct($productId);
        
        if ($item !== null) {
            $quantity = ($quantityFromPost === true) ?  $quantity : $item->getQuantity() + $quantity;
            $item->setQuantity($quantity);
        }
    }
	
	
	public function inOrder($productId)
    {
        return $this->_items->offsetExists($productId);
    }
	
		
	public function toArray()
	{
		$orderArray = array(
			'order_id'				=> $this->_id,
			//'order_date'			=> $this->_date->toString('yyyyMMddHHmmss'),
			'order_firstName'		=> $this->_firstName,
			'order_lastName'		=> $this->_lastName,
			'order_address'			=> $this->_address,
			'order_city'			=> $this->_city,
			'order_postcode'		=> $this->_postcode,
			'order_email'			=> $this->_email,
			'order_paymentMethod' 	=> $this->_paymentMethod,
		);
		
		return $orderArray;
	}
	
	
	public function fromArray($orderArray)
	{
		$this->_id				= (int)$orderArray['order_id'];
		$this->_date			= new Zend_Date($orderArray['order_date'], Zend_Date::ISO_8601);
		$this->_firstName		= $orderArray['order_firstName'];
		$this->_lastName		= $orderArray['order_lastName'];
		$this->_address			= $orderArray['order_address'];
		$this->_city			= $orderArray['order_city'];
		$this->_postcode		= (int)$orderArray['order_postcode'];
		$this->_email			= $orderArray['order_email'];
		$this->_paymentMethod 	= (int)$orderArray['order_paymentMethod'];
	}
}
