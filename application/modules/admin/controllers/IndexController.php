<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->view->user = Zend_Auth::getInstance()->getIdentity();
    }


	/* Admin panel */
    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
		if (!$auth->hasIdentity()) {
			$this->_redirect('/admin/login');
		}
		
		$this->_helper->layout()->setLayout('admin');
		
		/*$users = new Application_Model_DbTable_Users();
		$datos = $users->getUsuarios();
		$this->view->usuarios = $datos;
		
		$posts = new Application_Model_DbTable_Post();
		$post = $posts->listar();
		$this->view->datos = $post;*/
    }
	
}
