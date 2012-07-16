<?php

class Admin_CollectionController extends Zend_Controller_Action 
{ 
     
	public function preDispatch()
	{
		$this->_helper->logged($this->_helper->redirector);
    }
	 
	 
	public function init()
	{
		$this->view->baseUrl = $this->_request->getBaseUrl();
		$this->view->user = Zend_Auth::getInstance()->getIdentity();
		$this->_helper->layout()->setLayout('admin');
	}


    /* list all editorials */
	public function indexAction()
	{
		$this->view->title = "Lista de Colecciones";
		
		$collections = new Admin_Model_DbTable_Collection();
		$data = $collections->getAll();
		$this->view->data = $data ;
	}
 }
