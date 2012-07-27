<?php

class Admin_StickerController extends Zend_Controller_Action 
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
		if ($this->_hasParam('action_method')) {
			if ($this->_getParam('action_method') == "insert") {
				$this->view->title = "Agregar cromo";
				$this->view->action = "insert";
				
			} else {
				$this->_redirect("/admin/sticker");
			}
		} else {		
  			$this->view->title = "Listar cromos";
			$this->view->action = "list";
		} 
	
		$collections = new Core_Model_DbTable_Collection();
		
		$data = $collections->getAll();
		
		if (count($data) == 0) {
			$this->view->msgempty = "Debe crear primero una colecci&oacute;n";
		} else {
			$this->view->data = $data;
		}
	}


    /* list all stickers */
	public function listAction()
	{
		/* Check the collection_id param */
		if ($this->_hasParam('collection_id') && $this->_getParam('collection_id') > 0) {
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/sticker');	
			}

		} else {
			$this->_redirect('admin/sticker');
		}
		
		/* Set the title with the collection name */
		$collections = new Core_Model_DbTable_Collection();
		$collection = $collections->getById($collectionId);
		$this->view->title = "Lista de Cromos de la colecci&oacute;n " . $collection->getName(); 

		/* Set in the view the collection ID */
		$this->view->collectionId = $collectionId;

		$stickers = new Core_Model_DbTable_Sticker();	
		
		/* Get the actuall page, the number of registers to show and  
		 * the max number of pages in the paginator */
    	$page = $this->_getParam('page', 1);
    	$registers_per_page = 10;  
    	$max_pages = 10;
		
		$stickers->setPaginator($page, $registers_per_page, $max_pages);
		
		
		/* Filter by category */
		if ($this->_hasParam('category_id') && $this->_getParam('category_id') > 0) {
			if ( !($categoryId = $this->_helper->filter($this->_getParam('category_id')))) {
				$this->_redirect('/admin/sticker');	
			}       
			
			$paginator = $stickers->getIntoCategory($categoryId);
			
			$this->view->category = $categoryId;
			
		} else {
			$paginator = $stickers->getIntoCollection($collectionId);
			
			$this->view->category = 0;	
		}
		
		$this->view->data = $paginator;
		
		if ($paginator->getTotalItemCount() == 0) {
			$this->view->msgempty = "No existen cromos que mostrar";
		}
		
		/* Get the categories for filtering */		
		$categories = new Core_Model_DbTable_Category();
		$this->view->categories = $categories->getIntoCollection($collectionId);
		
		$this->view->titleCategories = "Categor&iacute;as";
		$this->view->msgemptyCategories = "No existen categor&iacute;as que mostrar";
	}
	
	
	/* insert a new sticker */
	public function insertAction()
	{
		if ($this->_hasParam("collection_id")) {
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/sticker/index/action_method/insert');	
			}
			
  			$form = new Admin_Form_StickerForm(array('collectionId' => $collectionId));
  		} else {
  			$this->_redirect('/admin/sticker/index/action_method/insert');
  		}
		
		$this->view->title = "Agregar Cromo";
		
		$form->submit->setLabel('Agregar');
		$form->setAction($this->view->baseUrl() . "/admin/sticker/insert/collection_id/" . $collectionId);
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$stickers = new Core_Model_DbTable_Sticker();
				$sticker = new Core_Sticker_Sticker();
				
				$sticker->setId(null)
						->setNumber($form->getValue('sticker_number'))
						->setImageUrl($form->getValue('sticker_imageUrl'))
						->setName($form->getValue('product_name'))
						->setDetails($form->getValue('product_details'))
						->setPrice($form->getValue('product_price'))
						->setStock($form->getValue('product_stock'));
				
				$category = new Core_Sticker_Category();
				$category->setId($form->getValue('category_id'));
				
				$sticker->setCategory($category);
				 
				$stickers->addSticker($sticker);
          		$this->_redirect('/admin/sticker/list/collection_id/' . $collectionId);
			} else {
				$form->populate($formData);
			}
      	}
		
		$this->render('form');
	}
	
  	
	/* update a sticker */
	public function updateAction()
	{
		if ($this->_hasParam("collection_id")) {
			if ( !($collectionId = $this->_helper->filter($this->_getParam('collection_id')))) {
				$this->_redirect('/admin/sticker');	
			}
			
  			$form = new Admin_Form_StickerForm(array('collectionId' => $collectionId));
  		} else {
  			$this->_redirect('/admin/sticker');
  		}
							
		$this->view->title = "Editar Cromo";
		
		$form->submit->setLabel('Editar');
		$form->setAction($this->view->baseUrl() . "/admin/sticker/update/collection_id/" . $collectionId);
		$this->view->form = $form;
			
		if ($this->getRequest()->isPost()) {			
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$stickers = new Core_Model_DbTable_Sticker();
				$sticker = new Core_Sticker_Sticker();
			
				$sticker->setId($form->getValue('product_id'))
						->setNumber($form->getValue('sticker_number'))
						->setImageUrl($form->getValue('sticker_imageUrl'))
						->setName($form->getValue('product_name'))
						->setDetails($form->getValue('product_details'))
						->setPrice($form->getValue('product_price'))
						->setStock($form->getValue('product_stock'));
				
				$category = new Core_Sticker_Category();
				$category->setId($form->getValue('category_id'));
				
				$sticker->setCategory($category);
				
				$stickers->updateSticker($sticker);
          		$this->_redirect('/admin/sticker/list/collection_id/' . $collectionId);
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$stickers = new Core_Model_DbTable_Sticker();
				$sticker = new Core_Sticker_Sticker();
				
				if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
					$this->_redirect('/admin/sticker/list/collection_id/' . $collectionId);	
				}
				
				$sticker = $stickers->getById($id);
				
				if ($sticker) {
					$form->populate($sticker->toArray());
				} else {
					$this->_redirect('/admin/sticker/list/collection_id/' . $collectionId);	
				}
      		} else {
      			$this->_redirect('/admin/sticker/list/collection_id/' . $collectionId);
      		}
      	}
		
		$this->render('form');
	}
	
	
	/* delete a sticker */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$collections = new Core_Model_DbTable_Sticker();
			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$id = $f->filter($this->_getParam('id'));
			
			if (!empty($id)) {          
				$collections->deleteSticker($id);
				
				if ($this->_hasParam('collection_id')) {
					$collectionId = $f->filter($this->_getParam('collection_id'));
					
					$this->_redirect('admin/sticker/list/collection_id/' . $collectionId);
				} else {
					$this->_redirect('/admin/sticker');
				}  
			}   
		}
	}
 }
