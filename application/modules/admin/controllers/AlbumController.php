<?php

class Admin_AlbumController extends Zend_Controller_Action 
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


    /* list all albums */
	public function indexAction()
	{
		$this->view->title = "Lista de &Aacute;lbumes";
		
		$albums = new Admin_Model_DbTable_Album();
		$data = $albums->getAll();
		
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
			$this->view->msgempty = "No existen &aacute;lbumes que mostrar";
		}
	}
	
	
	/* insert a new album */
	public function insertAction()
	{
		$this->view->title = "Agregar Album";
		
		$form = new Admin_Form_AlbumForm();
		$form->submit->setLabel('Agregar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$albums = new Admin_Model_DbTable_Album();
				$album = new Core_Sticker_Album();
				
				$album->setId(null)
					  ->setName($form->getValue('product_name'))
					  ->setDetails($form->getValue('product_details'))
					  ->setPrice($form->getValue('product_price'));
				
				$collection = new Core_Sticker_Collection();
				$collection->setId($form->getValue('collection_id'));
				
				$album->setCollection($collection);
				
				$albums->addAlbum($album);
          		$this->_redirect('/admin/album');
			} else {
				$form->populate($formData);
			}
      	}
      	
		$this->view->imagesLink = 'href="#" onclick="alert(\'Debe crear un &aacute;lbum antes de a&ntilde;adir im&aacute;genes en &eacute;l\')"';
      	$this->render('form');
	}
	
  	
	/* update a album */
	public function updateAction()
	{
		$this->view->title = "Editar Album";
		
		$form = new Admin_Form_AlbumForm();
		$form->submit->setLabel('Editar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$albums = new Admin_Model_DbTable_Album();
				$album = new Core_Sticker_Album();
				
				$album->setId($form->getValue('album_id'))
					  ->setName($form->getValue('product_name'))
					  ->setDetails($form->getValue('product_details'))
					  ->setPrice($form->getValue('product_price'));
				
				$collection = new Core_Sticker_Collection();
				$collection->setId($form->getValue('collection_id'));
				
				$album->setCollection($collection);
				
				$albums->updateAlbum($album);
          		$this->_redirect('/admin/album');
			} else {
				$id = $form->getValue('album_id');
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$albums = new Admin_Model_DbTable_Album();
				$album = new Core_Sticker_Album();
				
				if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
					$this->_redirect('/admin/album');	
				}
				
				$album = $albums->getById($id);
				
				if ($album) {
					$form->populate($album->toArray());
				} else {
					$this->_redirect('/admin/album');	
				}
      		} else {
      			$this->_redirect('/admin/album');
      		}
      	}
		
		$this->view->imagesLink = 'href="' . $this->view->baseUrl() . '/admin/album/images/album_id/' . $id . '"';
		$this->render('form');
	}
	
	
	/* delete a album */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$albums = new Admin_Model_DbTable_Album();
			
			if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
				$this->_redirect('/admin/album');	
			}
			         
			$albums->deleteAlbum($id); 
			$this->_redirect('/admin/album');  
		}
	}
	
	
	/* show images of album */
	public function imagesAction()
	{
		if ($this->_hasParam('album_id')) {
			if ( !($albumId = $this->_helper->filter($this->_getParam('album_id')))) {
				$this->_redirect('/admin/album');
			}
			
			$albumImages = new Admin_Model_DbTable_Albumimage();
			
			$form = new Admin_Form_AlbumimageForm();
			$form->setAction($this->view->baseUrl() . "/admin/album/images/album_id/" . $albumId);
			
			if ($this->getRequest()->isPost()) {
				$formData = $this->getRequest()->getPost();
				
				if ($form->isValid($formData)) {
					$albumImage = new Core_Sticker_Albumimage();
					
					$albumImage->setId(null)
							   ->setImageUrl($form->getValue('albumImage_imageUrl'))
							   ->setAlbumId($albumId);
					 
					$albumImages->addAlbumImage($albumImage);
				} else {
					$form->populate($formData);
				}
	      	}
			
			
			$albums = new Admin_Model_DbTable_Album();
			$album = new Core_Sticker_Album();
			
			$album = $albums->getById($albumId);
			
			$this->view->title = "Im&aacute;genes del &aacute;lbum " . $album->getName();
			
			$this->view->albumId = $albumId;
					
			$this->view->titleForm = "Agregar imagen";
			
			$this->view->form = $form;
			
			
			$albumImages = new Admin_Model_DbTable_Albumimage();
			$data = $albumImages->getIntoAlbum($albumId);
		
			/* Get the actuall page */
	    	$page = $this->_getParam('page', 1);
			
			/* The number of registers to show */ 
	    	$registers_per_page = 12;  
			
			/* Max number of pages in the paginator */
	    	$max_pages = 10;
			
			$paginator = Zend_Paginator::factory($data);  
			
			$paginator->setItemCountPerPage($registers_per_page)  
	              	  ->setCurrentPageNumber($page)  
	              	  ->setPageRange($max_pages);  
			
			$this->view->data = $paginator;
		
			if (count($data) == 0) {
				$this->view->msgempty = "No existen im&aacute;genes que mostrar";
			}
		} else {
			$this->_redirect('/admin/album');
		}
	}


	/* delete image of album */
	public function deleteimageAction ()
	{
		if ($this->_hasParam('id')) {
			$albumImages = new Admin_Model_DbTable_Albumimage();
			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$id = $f->filter($this->_getParam('id'));
			
			if (!empty($id)) {          
				$albumImages->deleteAlbumImage($id);
				
				if ($this->_hasParam('album_id')) {
					$albumId = $f->filter($this->_getParam('album_id'));
					
					$this->_redirect('admin/album/images/album_id/' . $albumId);
				} else {
					$this->_redirect('/admin/album');
				}  
			}   
		}
	}
 }
