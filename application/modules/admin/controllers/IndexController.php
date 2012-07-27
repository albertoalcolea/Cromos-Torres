<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
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
		
		$this->orderhistoryAction();
    }
	
	
	/* Order history */
	public function orderhistoryAction()
	{
		$this->view->title = "Historial de Ventas";
		
		$orders = new Core_Model_DbTable_Order();
		
		/* Get the actuall page, the number of registers to show and  
		 * the max number of pages in the paginator */
    	$page = $this->_getParam('page', 1);
    	$registers_per_page = 5;  
    	$max_pages = 15;
		
		$orders->setPaginator($page, $registers_per_page, $max_pages);
			
	
		if ($this->_hasParam('from') || $this->_hasParam('to')) {
			if ( !($fromDate = $this->_helper->filter($this->_getParam('from')))) {
				$fromDate = null;	
			} 	
			
			if ( !($toDate = $this->_helper->filter($this->_getParam('to')))) {
				$toDate = null;	
			}	
			
			
			$paginator = $orders->getInDateRange($fromDate, $toDate);
			
			$this->view->fromDate = $fromDate;
			$this->view->toDate = $toDate;
		} else {
			$paginator = $orders->getAll();
			
			$this->view->fromDate = '1/1/2012';
			$this->view->toDate = date('d/m/Y');
		}

		$this->view->data = $paginator;
		
		if ($paginator->getTotalItemCount() == 0) {
			$this->view->msgempty = "No existen ventas que mostrar";
		}
		
		$this->render('index');
	}
}
