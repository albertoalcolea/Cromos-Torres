<?php

class Core_Test
{
    private $_message = "caca";
    
    public function __construct() {}
    
    public function hola()
    {
        return $this->_message;
    }
}
