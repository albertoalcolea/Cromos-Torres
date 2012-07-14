<?php

class Admin_LoginController extends Zend_Controller_Action
{

    public function init()
    {
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->_helper->layout()->setLayout('login');
    }
    
    
    /* login */
    public function indexAction()
    {  		
		$user = Zend_Auth::getInstance()->getIdentity();
		if (empty($user)) {
			$this->view->title = "Login";
			
			if ($this->_request->isPost()) {
				Zend_Loader::loadClass('Zend_Filter_StripTags');
				$f = new Zend_Filter_StripTags();
				
          		$user = $f->filter($this->_request->getPost('user'));
          		$pass = $f->filter($this->_request->getPost('pass'));
				
				if (!empty($user) && !empty($pass)) {
					Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
					$dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
					
					$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
					
					// user tablename and login data 
					$authAdapter->setTableName('users');
					$authAdapter->setIdentityColumn('username');
					$authAdapter->setCredentialColumn('password');
					           
					$authAdapter->setIdentity($user);
					$authAdapter->setCredential(md5($pass));
					    
					$auth = Zend_Auth::getInstance();
					$result = $auth->authenticate($authAdapter);
				

					if ($result->isValid()) {
                		// save all user data without password 
                		$data = $authAdapter->getResultRowObject(null, 'password');
                		$auth->getStorage()->write($data);
                		$this->_redirect('/admin');
            		} else {
                		$this->view->message = "Datos invalidos";
            		}
           
          		} else {
					$this->view->message = "Ingrese usuario y contrase&ntilde;a";
          		}
			}
       
		} else{
			$this->_redirect('/admin');
		}
	}
    
	
    /* logout */
    public function logoutAction(){
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');  
    }
}

