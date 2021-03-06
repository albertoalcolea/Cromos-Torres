<?php

abstract class Core_Store_Cart_Factory
{
    const ADAPTER_NAMESPACE = 'Core_Store_Cart_Abstract_';
    
    static public function createInstance($adapterName)
    {
        if ( !is_string($adapterName) || !strlen($adapterName) ) {
            throw new Exception('Adapter Cart name must be specified in a string');
        }
        
        $classEngine = self::ADAPTER_NAMESPACE . $adapterName;
        Zend_Loader::loadClass($classEngine);
        
        if (Zend_Registry::isRegistered('coreSession')) {
            $sessionData = Zend_Registry::get('coreSession');
        } else {
            $sessionData = new Zend_Session_Namespace('coreSession');
            Zend_Registry::set('coreSession', $sessionData);
        }
        
        if ( isset($sessionData->cart) && ($sessionData->cart !== null) ) {
            $cartObject = $sessionData->cart;
			
        } else {
            if (class_exists($classEngine, false)) {
                $cartObject = call_user_func(array($classEngine, 'getInstance'));
            } else {
                throw new Exception("Adapter '$classEngine' not found");
            }
            
            $sessionData->cart = $cartObject;
        }
        
        if ( !$cartObject instanceof Core_Store_Cart_Abstract ) {
            throw new Exception ("Adapter class '$classEngine' does not extend Core_Store_Cart_Abstract");
        }
        
        return $cartObject;
    }
}
