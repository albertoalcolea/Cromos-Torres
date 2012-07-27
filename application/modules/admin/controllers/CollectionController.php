<?php

class Admin_CollectionController extends Zend_Controller_Action 
{ 
     
	public function preDispatch()
	{
		$this->_helper->logged($this->_helper->redirector);
    }
	 
	 
	public function init()
	{
		$this->view->user = Zend_Auth::getInstance()->getIdentity();
		$this->_helper->layout()->setLayout('admin');
	}


	public function indexAction()
	{
		$this->_redirect('/admin/collection/list/page/1');
	}


    /* list all collections */
	public function listAction()
	{
		$this->view->title = "Lista de Colecciones";

		$collections = new Core_Model_DbTable_Collection();
		
		/* Get the actuall page, the number of registers to show and  
		 * the max number of pages in the paginator */
    	$page = $this->_getParam('page', 1);
    	$registers_per_page = 10;  
    	$max_pages = 10;
		
		$collections->setPaginator($page, $registers_per_page, $max_pages);
			
		
		/* Filter by editorial */
		if ($this->_hasParam('editorial_id') && $this->_getParam('editorial_id') > 0) {
			if ( !($editorialId = $this->_helper->filter($this->_getParam('editorial_id')))) {
				$this->_redirect('/admin/collection');	
			}
			         
			$paginator = $collections->getIntoEditorial($editorialId);

			$this->view->editorial = $editorialId;
			
		} else {	
			$paginator = $collections->getAll();
			
			$this->view->editorial = 0;
		} 
		
		$this->view->data = $paginator;
		
		if ($paginator->getTotalItemCount() == 0) {
			$this->view->msgempty = "No existen colecciones que mostrar";
		}
		
		/* Get the editorial for filtering */
		$editorials = new Core_Model_DbTable_Editorial();
		$this->view->editorials = $editorials->getAll();
	}
	
	
	/* insert a new collection */
	public function insertAction()
	{
		$this->view->title = "Agregar Colecci&oacute;n";
		
		$form = new Admin_Form_CollectionForm();
		$form->submit->setLabel('Agregar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$collections = new Core_Model_DbTable_Collection();
				$collection = new Core_Sticker_Collection();
				
				$collection->setId(null)
						   ->setName($form->getValue('collection_name'))
						   ->setYear($form->getValue('collection_year'))
						   ->setImageUrl($form->getValue('collection_imageUrl'));
				
				$editorial = new Core_Sticker_Editorial();
				$editorial->setId($form->getValue('editorial_id'));
				
				$collection->setEditorial($editorial);
				 
				$collectionId = $collections->addCollection($collection);
				
				/* Add a default category for this collection */
				$categories = new Core_Model_DbTable_Category();
				$category = new Core_Sticker_Category();
				
				$collection->setId($collectionId);
				
				$category->setId(null)
						 ->setName($collection->getName())
						 ->setOrder(1)
						 ->setCollection($collection);
						 
				$categories->addCategory($category);
				
          		$this->_redirect('/admin/collection');
			} else {
				$form->populate($formData);
			}
      	}

		$this->render('form');
	}
	
  	
	/* update a collection */
	public function updateAction()
	{		
		$this->view->title = "Editar Colecci&oacute;n";
		
		$form = new Admin_Form_CollectionForm();
		$form->submit->setLabel('Editar');
		$this->view->form = $form;
			
		if ($this->getRequest()->isPost()) {			
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$collections = new Core_Model_DbTable_Collection();
				$collection = new Core_Sticker_Collection();
				
				$collection->setId($form->getValue('collection_id'))
						   ->setName($form->getValue('collection_name'))
						   ->setYear($form->getValue('collection_year'))
						   ->setImageUrl($form->getValue('collection_imageUrl'));
				
				$editorial = new Core_Sticker_Editorial();
				$editorial->setId($form->getValue('editorial_id'));
				
				$collection->setEditorial($editorial);
				
				$collections->updateCollection($collection);
          		$this->_redirect('/admin/collection');
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$collections = new Core_Model_DbTable_Collection();
				$collection = new Core_Sticker_Collection();
				
				if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
					$this->_redirect('/admin/collection');	
				}
				
				$collection = $collections->getById($id);
				
				if ($collection) {
					$form->populate($collection->toArray());
				} else {
					$this->_redirect('/admin/collection');	
				}
      		} else {
      			$this->_redirect('/admin/collection');
      		}
      	}
		
		$this->render('form');
	}
	
	
	/* delete a collection */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$collections = new Core_Model_DbTable_Collection();
			
			if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
				$this->_redirect('/admin/editorial');	
			}
        
			$collections->deleteCollection($id); 
			$this->_redirect('/admin/collection');  
		}
	}
 }
