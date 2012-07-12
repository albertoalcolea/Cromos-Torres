<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $table = new Application_Model_DbTable_Editorial();
		
		$this->view->editorials = $table->fetchAll();	
    }
}

