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
        $table = new Application_Model_DbTable_Editorial();
		
		$this->view->editorials = $table->fetchAll();	
    }
	
	
	/* Admin panel */
    public function adminAction()
    {
		$auth = Zend_Auth::getInstance();
		if (!$auth->hasIdentity()) {
			$this->_redirect('/login');
		} 
		
		$this->_helper->layout()->setLayout('admin');
		
		$userInfo = $auth->getStorage()->read();
		$this->view->username = $userInfo->username;
		
		/*$users = new Application_Model_DbTable_Users();
		$datos = $users->getUsuarios();
		$this->view->usuarios = $datos;
       
		$posts = new Application_Model_DbTable_Post();
		$post = $posts->listar();
		$this->view->datos = $post;*/
    }
}
