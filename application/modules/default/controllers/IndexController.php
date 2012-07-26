<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->baseUrl = $this->_request->getBaseUrl();
		$cart = Core_Store_Cart_Factory::createInstance('StandardCart');
		$this->view->cartNumber = $cart->countContents();
		$this->view->section = 'inicio';
    }


    public function indexAction()
    {
        $table = new Default_Model_DbTable_Editorial();
		
		$this->view->editorials = $table->getAll();
		
		/*$product = new Core_Store_Product();
		$item = new Core_Store_Cart_Item($product, 79);
		$cart = Core_Store_Cart_Factory::createInstance('StandardCart');
		$cart->addCart($item);*/
		/*$cart->save(); // ¿?
		$cart->reset();*/
    }
}
