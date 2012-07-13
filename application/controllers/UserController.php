<?php

class UserController extends Zend_Controller_Action{
    
	public function preDispatch(){
		$auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
			$this->_redirect('/login');
		}
    }
	
	
	public function init()
	{
		$this->view->baseUrl = $this->_request->getBaseUrl();
		$this->view->user = Zend_Auth::getInstance()->getIdentity();
		$this->_helper->layout()->setLayout('admin');
	}
    
    
    /* change password */
	public function changepasswordAction() {
		$this->view->title = "Cambiar contrase&ntilde;a";
		$this->view->successful = false;
		
		if ($this->_request->isPost()) {
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			
      		$actualpass = $f->filter($this->_request->getPost('actual-pass'));
      		$newpass = $f->filter($this->_request->getPost('new-pass'));
			$confirmpass = $f->filter($this->_request->getPost('confirm-pass'));
			
			if (!empty($actualpass) && !empty($newpass) && !empty($confirmpass)) {
				/* check actual password */
				$table = new Application_Model_DbTable_User();
				
				$user = $this->view->user;
				
				$checkActualPass = $table->checkPassword($user->id, $actualpass);
				
				if ($checkActualPass) {
					/* check new password */
					if ($newpass === $confirmpass) {						
						$table->updatePassword($user->id, $user->username, $newpass);
						$this->view->title = "Contrase&ntilde;a modificada correctamente";
						$this->view->successful = true;
						
					} else {
						$this->view->message = "La nueva contrase&ntilde;a y su confirmaci&oacute;n no coinciden";
					}
				} else {
					$this->view->message = "La contrase&ntilde;a actual no es v&aacute;lida";
				}
       
      		} else {
				$this->view->message = "Ingrese los datos solicitados";
      		}
		}
    }


	/* password changed*/
	public function passwordchangedAction() {
		$this->view->title = "Contrase&ntilde;a modificada correctamente";
	}
	
}
