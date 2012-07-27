<?php

class Admin_CategoryController extends Zend_Controller_Action 
{
	/* Private methods with returnUrl in param */
	private function updateCategory($returnUrl)
	{		
		$this->view->title = "Editar Categor&iacute;a";
		
		$form = new Admin_Form_CategoryForm();
		$form->submit->setLabel('Editar');
		$this->view->form = $form;
			
		if ($this->getRequest()->isPost()) {			
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$categories = new Core_Model_DbTable_Category();
				$category = new Core_Sticker_Category();
				
				$category->setId($form->getValue('category_id'))
						 ->setName($form->getValue('category_name'))
						 ->setOrder($form->getValue('category_order'));
				
				$collection = new Core_Sticker_Collection();
				$collection->setId($form->getValue('collection_id'));
				
				$category->setCollection($collection);
				
				$categories->updateCategory($category);
          		$this->_redirect($returnUrl);
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$categories = new Core_Model_DbTable_Category();
				$category = new Core_Sticker_Category();
				
				if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
					$this->_redirect($returnUrl);	
				}
				
				$category = $categories->getById($id);
				
				if ($category) {
					$form->populate($category->toArray());
				} else {
					$this->_redirect($returnUrl);	
				}
      		} else {
      			$this->_redirect($returnUrl);
      		}
      	}
		
		$this->render('form');
	}
 
    private function deleteCategory($returnUrl)
	{
		if ($this->_hasParam('id')) {
			$categories = new Core_Model_DbTable_Category();
			
			if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
				$this->_redirect($returnUrl);	
			}
			      
			$categories->deleteCategory($id);
			$this->_redirect($returnUrl);  
		}
	}
	
	
	/* PUBLIC */
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
		$this->_redirect('/admin/category/list/page/1');
	}


    /* list all categories */
	public function listAction()
	{
		$this->view->title = "Lista de Categor&iacute;as"; 

		$categories = new Core_Model_DbTable_Category();	
		
		/* Get the actuall page, the number of registers to show and  
		 * the max number of pages in the paginator */
    	$page = $this->_getParam('page', 1);
    	$registers_per_page = 10;  
    	$max_pages = 10;
		
		$categories->setPaginator($page, $registers_per_page, $max_pages);
		
		
		/* Filter by collection */
		if ($this->_hasParam('collection_id') && $this->_getParam('collection_id') > 0) {
			
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/category');	
			}			
			       
			$paginator = $categories->getIntoCollection($collectionId);

			$this->view->collection = $collectionId;
			
		} else {	
			$paginator = $categories->getAll();
			
			$this->view->collection = 0;
		}
		 
		
		$this->view->data = $paginator;
		
		if ($paginator->getTotalItemCount() == 0) {
			$this->view->msgempty = "No existen categor&iacute;s que mostrar";
		}
		
		/* Get the collections for filtering */
		$collections = new Core_Model_DbTable_Collection();
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
				$categories = new Core_Model_DbTable_Category();
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
		
		$this->render('form');
	}
	
	
	/* insert a new category into a collection */
	public function cacaAction()
	{
		$this->view->title = "Agregar Categor&iacute;a";
		
		if ($this->_hasParam('collection_id')) {
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/category');	
			}
			
			$formArray = array();
			$formArray['collection_id'] = $collectionId;
			
			$form = new Admin_Form_CategoryForm();
			$form->submit->setLabel('Agregar');
			$this->view->form = $form;
			
			$form->populate($formArray);
			
			if ($this->getRequest()->isPost()) {
				$formData = $this->getRequest()->getPost();
				
				if ($form->isValid($formData)) {
					$categories = new Core_Model_DbTable_Category();
					$category = new Core_Sticker_Category();
					
					$category->setId(null)
							 ->setName($form->getValue('category_name'))
							 ->setOrder($form->getValue('category_order'));
					
					$collection = new Core_Sticker_Collection();
					$collection->setId($form->getValue('collection_id'));
					
					$category->setCollection($collection);
					 
					$categories->addCategory($category);
					$this->_redirect('/admin/sticker/list/collection_id/' . $collection->getId());
				} else {
					$form->populate($formData);
				}
	      	}
		} else {
			$this->_redirect('/admin/category');
		}
		
		$this->render('form');
	}
	
  	
	/* update a category */
	public function updateAction()
	{		
		$this->updateCategory('/admin/category');
	}
	
	
	/* update a category into a collection */
	public function updateintocollectionAction()
	{
		if ($this->_hasParam('collection_id')) {
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/category');	
			}
			
			$this->updateCategory('/admin/sticker/list/collection_id/' . $collectionId);
		} else {
			$this->updateCategory('/admin/category');
		}
	}
	
	/* delete a category */
	public function deleteAction()
	{
		$this->deleteCategory('/admin/category');
	}
	
	
	/* delete a category into a collection */
	public function deleteintocollectionAction()
	{
		if ($this->_hasParam('collection_id')) {
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/category');	
			}
			
			$this->deleteCategory('/admin/sticker/list/collection_id/' . $collectionId);
		} else {
			$this->deleteCategory('/admin/category');
		}
	}
 }
