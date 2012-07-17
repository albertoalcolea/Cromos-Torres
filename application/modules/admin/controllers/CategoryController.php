<?php

class Admin_CategoryController extends Zend_Controller_Action 
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


	public function indexAction()
	{
		$this->_redirect('/admin/category/list/page/1');
	}


    /* list all categories */
	public function listAction()
	{
		$this->view->title = "Lista de Categor&iacute;as"; 

		$categories = new Admin_Model_DbTable_Category();	
		
		/* Filter by collection */
		if ($this->_hasParam('collection_id') && $this->_getParam('collection_id') > 0) {			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$collectionId = $f->filter($this->_getParam('collection_id'));
			
			if (!empty($collectionId)) {          
				$data = $categories->getIntoCollection($collectionId);
			}

			$this->view->collection = $collectionId;
			
		} else {	
			$data = $categories->getAll();
			
			$this->view->collection = 0;
		}
		
		/* Get the actuall page */
    	$page = $this->_getParam('page', 1);
		
		/* The number of registers to show */ 
    	$registers_per_page = 10;  
		
		/* Max number of pages in the paginator */
    	$max_pages = 10;
		
		$paginator = Zend_Paginator::factory($data);  
		
		$paginator->setItemCountPerPage($registers_per_page)  
              	  ->setCurrentPageNumber($page)  
              	  ->setPageRange($max_pages);  
		
		$this->view->data = $paginator;
		
		if (count($data) == 0) {
			$this->view->msgempty = "No existen categor&iacute;s que mostrar";
		}
		
		/* Get the collections for filtering */
		$collections = new Admin_Model_DbTable_Collection();
		$this->view->collections = $collections->getAll();
	}
	
	
	/* insert a new category */
	public function insertAction()
	{
		$this->view->title = "Agregar Categor&iacute;a";
		
		$form = new Admin_Form_CategoryForm();
		$form->submit->setLabel('Agregar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$categories = new Admin_Model_DbTable_Category();
				$category = new Core_Sticker_Category();
				
				$category->setId(null)
						 ->setName($form->getValue('category_name'))
						 ->setOrder($form->getValue('category_order'));
				
				$collection = new Core_Sticker_Collection();
				$collection->setId($form->getValue('collection_id'));
				
				$category->setCollection($collection);
				 
				$categories->addCategory($category);
          		$this->_redirect('/admin/category');
			} else {
				$form->populate($formData);
			}
      	}
	}
	
  	
	/* update a category */
	public function updateAction()
	{		
		$this->view->title = "Editar Categor&iacute;a";
		
		$form = new Admin_Form_CategoryForm();
		$form->submit->setLabel('Editar');
		$this->view->form = $form;
			
		if ($this->getRequest()->isPost()) {			
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$categories = new Admin_Model_DbTable_Category();
				$category = new Core_Sticker_Category();
				
				$category->setId($form->getValue('category_id'))
						 ->setName($form->getValue('category_name'))
						 ->setOrder($form->getValue('category_order'));
				
				$collection = new Core_Sticker_Collection();
				$collection->setId($form->getValue('collection_id'));
				
				$category->setCollection($collection);
				
				$categories->updateCategory($category);
          		$this->_redirect('/admin/category');
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$categories = new Admin_Model_DbTable_Category();
				$category = new Core_Sticker_Category();
				
				Zend_Loader::loadClass('Zend_Filter_StripTags');
				$f = new Zend_Filter_StripTags();
				$id = $f->filter($this->_getParam('id'));
				
				$category = $categories->getById($id);
				
				if ($category) {
					$form->populate($category->toArray());
				} else {
					$this->_redirect('/admin/category');	
				}
      		} else {
      			$this->_redirect('/admin/category');
      		}
      	}
	}
	
	
	/* delete a category */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$categories = new Admin_Model_DbTable_Category();
			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$id = $f->filter($this->_getParam('id'));
			
			if (!empty($id)) {          
				$categories->deleteCategory($id); 
				$this->_redirect('/admin/category');  
			}   
		}
	}
 }
