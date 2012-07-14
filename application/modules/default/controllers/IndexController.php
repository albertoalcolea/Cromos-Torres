<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->view->user = Zend_Auth::getInstance()->getIdentity();
    }


    public function indexAction()
    {
        $table = new Default_Model_DbTable_Editorial();
		
		$this->view->editorials = $table->fetchAll();	
    }
	
}
