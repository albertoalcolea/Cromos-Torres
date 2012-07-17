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
		$this->view->data = $data ;
				
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
					  ->setName($form->getValue('editorial_name'))
					  ->setPriority($form->getValue('editorial_priority'))
					  ->setImageUrl($form->getValue('editorial_imageUrl'));
				
				$albums->addEditorial($album);
          		$this->_redirect('/admin/album');
			} else {
				$form->populate($formData);
			}
      	}
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
				
				$album->setId($form->getValue('editorial_id'))
					  ->setName($form->getValue('editorial_name'))
					  ->setPriority($form->getValue('editorial_priority'))
					  ->setImageUrl($form->getValue('editorial_imageUrl'));
				
				$albums->updateEditorial($album);
          		$this->_redirect('/admin/album');
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$albums = new Admin_Model_DbTable_Album();
				$album = new Core_Sticker_Album();
				
				Zend_Loader::loadClass('Zend_Filter_StripTags');
				$f = new Zend_Filter_StripTags();
				$id = $f->filter($this->_getParam('id'));
				
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
	}
	
	
	/* delete a album */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$albums = new Admin_Model_DbTable_Album();
			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$id = $f->filter($this->_getParam('id'));
			
			if (!empty($id)) {          
				$albums->deleteAlbum($id); 
				$this->_redirect('/admin/album');  
			}   
		}
	}
 }
