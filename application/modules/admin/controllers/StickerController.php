<?php

class Admin_StickerController extends Zend_Controller_Action 
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
		$this->_redirect('/admin/sticker/list/page/1');
	}


    /* list all stickers */
	public function listAction()
	{
		$this->view->title = "Lista de Cromos"; 

		$stickers = new Admin_Model_DbTable_Sticker();	
		
		/* Filter by collection */
		if ($this->_hasParam('collection_id') && $this->_getParam('collection_id') > 0) {			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$collectionId = $f->filter($this->_getParam('collection_id'));
			
			if (!empty($collectionId)) {          
				$data = $stickers->getIntoCollection($collectionId);
			}

			$this->view->collection = $collectionId;
			$this->view->category = 0;
			
		/* Filter by category */
		} else if ($this->_hasParam('category_id') && $this->_getParam('category_id') > 0) {
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$categoryId = $f->filter($this->_getParam('category_id'));
			
			if (!empty($categoryId)) {          
				$data = $stickers->getIntoCategory($categoryId);
			}
			
			$this->view->collection = 0;
			$this->view->category = $categoryId;
		} else {	
			$data = $stickers->getAll();
			
			$this->view->collection = 0;
			$this->view->category = 0;
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
			$this->view->msgempty = "No existen cromos que mostrar";
		}
		
		/* Get the collections and categories for filtering */
		$collections = new Admin_Model_DbTable_Collection();
		$this->view->collections = $collections->getAll();
		
		$categories = new Admin_Model_DbTable_Category();
		$this->view->categories = $categories->getAll();
	}
	
	
	/* insert a new sticker */
	public function insertAction()
	{
		$this->view->title = "Agregar Cromo";
		
		$form = new Admin_Form_StickerForm();
		$form->submit->setLabel('Agregar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$stickers = new Admin_Model_DbTable_Sticker();
				$sticker = new Core_Sticker_Sticker();
				
				$sticker->setId(null)
						->setName($form->getValue('sticker_name'))
						->setImageUrl($form->getValue('sticker_imageUrl'));
				
				$category = new Core_Sticker_Category();
				$category->setId($form->getValue('category_id'));
				
				$sticker->setCategory($category);
				 
				$stickers->addSticker($sticker);
          		$this->_redirect('/admin/sticker');
			} else {
				$form->populate($formData);
			}
      	}
	}
	
  	
	/* update a sticker */
	public function updateAction()
	{		
		$this->view->title = "Editar Cromo";
		
		$form = new Admin_Form_StickerForm();
		$form->submit->setLabel('Editar');
		$this->view->form = $form;
			
		if ($this->getRequest()->isPost()) {			
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$stickers = new Admin_Model_DbTable_Sticker();
				$sticker = new Core_Sticker_Sticker();
				
				$sticker->setId($form->getValue('sticker_id'))
						   ->setName($form->getValue('sticker_name'))
						   ->setImageUrl($form->getValue('sticker_imageUrl'));
				
				$category = new Core_Sticker_Category();
				$category->setId($form->getValue('categoryId_id'));
				
				$sticker->setCategory($category);
				
				$stickers->updateSticker($sticker);
          		$this->_redirect('/admin/sticker');
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$stickers = new Admin_Model_DbTable_Sticker();
				$sticker = new Core_Sticker_Sticker();
				
				Zend_Loader::loadClass('Zend_Filter_StripTags');
				$f = new Zend_Filter_StripTags();
				$id = $f->filter($this->_getParam('id'));
				
				$sticker = $stickers->getById($id);
				
				if ($sticker) {
					$form->populate($sticker->toArray());
				} else {
					$this->_redirect('/admin/sticker');	
				}
      		} else {
      			$this->_redirect('/admin/sticker');
      		}
      	}
	}
	
	
	/* delete a sticker */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$collections = new Admin_Model_DbTable_Sticker();
			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$id = $f->filter($this->_getParam('id'));
			
			if (!empty($id)) {          
				$collections->deleteSticker($id); 
				$this->_redirect('/admin/sticker');  
			}   
		}
	}
 }
