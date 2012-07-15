<?php

class Core_Helpers_Logged extends Zend_Controller_Action_Helper_Abstract
{
	public function direct($redirector)
	{
		$auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
        	$urlOptions = array('module'=>'admin', 'controller'=>'login', 'action'=>'index');
			$redirector->gotoRoute($urlOptions);
			//$redirector->_redirect('/admin/login');
		}
	}
}
