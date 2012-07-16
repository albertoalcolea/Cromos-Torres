<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{	
	function _initViewHelpers() 
    { 
		$this->bootstrap('layout'); 
		$layout = $this->getResource('layout'); 
		$view = $layout->getView(); 
		$view->doctype('HTML5'); 
		$view->headTitle()->setSeparator(' - '); 
		$view->headTitle('Cromos torres'); 
	}
}

