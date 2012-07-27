<?php

class MailController extends Zend_Controller_Action
{

    public function init()
    {
		$cart = Core_Store_Cart_Factory::createInstance('StandardCart');
		$this->view->cartNumber = $cart->countContents();
		$this->view->section = 'carrito';
    }


    public function indexAction()
    {
		if ($this->getRequest()->isPost()) {
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			
      		$from = $f->filter($this->_request->getPost('from'));
      		$to = $f->filter($this->_request->getPost('to'));
			$subject = $f->filter($this->_request->getPost('subject'));
			$msg = $f->filter($this->_request->getPost('msg'));
			
			if (!empty($from) && !empty($to) && !empty($subject) && !empty($msg)) {
       			$mail = new Zend_Mail();
				$mail->setBodyText($msg);
                $mail->setFrom($from, 'el del from');
                $mail->addTo($to, 'el del to');
                $mail->setSubject($subject);
                $mail->send();
				
      		} else {
				$this->view->message = "Ingrese los datos solicitados";
      		}
		}
    }
}
