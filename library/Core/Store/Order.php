<?php

class Core_Store_Order
{
    private $_id = null;
    
    private $_date = null;
    
    private $_firstName = null;
    
    private $_lastName = null;
    
    private $_address = null;
    
    private $_city = null;
    
    private $_postcode = null;
    
    private $_email = null;
    
    private $_paymentMethod = null;
    
    private $_products = null;
    
    
    public function __construct($id = null,
                                $date = null,
                                $firstName = null,
                                $lastName = null,
                                $address = null,
                                $city = null,
                                $postcode = null,
                                $email = null,
                                $paymentMethod = null,
                                ArrayAccess $products = null)
    {
        $this->_id = (int)$id;
        $this->_date = $date;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_address = $address;
        $this->_city = $city;
        $this->_postcode = (int)$postcode;
        $this->_email = $email;
        $this->_paymentMethod = $paymentMethod;
        $this->_products = $products;
    }
    
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function setId($id)
    {
        $this->_id = (int)id;
    }
    
    public function getDate()
    {
        return $this->_date;
    }
    
    public function setDate($date)
    {
        $this->_date = $date;
    }
    
    public function getFirstName()
    {
        return $this->_firstName;
    }
    
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }
    
    public function getLastName()
    {
        return $this->_lastName;
    }
    
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }
    
    public function getAddress()
    {
        return $this->_address;
    }
    
    public function setAddress($address)
    {
        $this->_address = $address;
    }
    
    public function getCity()
    {
        return $this->_city;
    }
    
    public function setCity($city)
    {
        $this->_city = $city;
    }
    
    public function getPostcode()
    {
        return $this->_postcode;
    }
    
    public function setPostcode($postcode)
    {
        $this->_postcode = (int)$postcode;
    }
    
    public function getEmail()
    {
        return $this->_email;
    }
    
    public function setEmail($email)
    {
        $this->_email = $email;
    }
    
    public function getPaymentMethod()
    {
        return $this->_paymentMethod;
    }
    
    public function setPaymentMethod($paymentMethod)
    {
        $this->_paymentMethod = $paymentMethod;
    }
    
    public function getProducts()
    {
        return $this->_products;
    }
    
    public function setProducts(ArrayAccess $products)
    {
        $this->_products = $products;
    }
}
