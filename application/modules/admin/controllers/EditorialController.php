<?php

class Admin_EditorialController extends Zend_Controller_Action 
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


    /* list all editorials */
	public function indexAction()
	{
		$this->view->title = "Lista de Editoriales";
		$this->view->minPriority = Core_Sticker_Editorial::MINPRIORITY;
		$this->view->maxPriority = Core_Sticker_Editorial::MAXPRIORITY;
		
		$editorials = new Core_Model_DbTable_Editorial();
		$data = $editorials->getAll();
		$this->view->data = $data ;
				
		if (count($data) == 0) {
			$this->view->msgempty = "No existen colecciones que mostrar";
		}
	}
	
	
	/* insert a new editorial */
	public function insertAction()
	{
		$this->view->title = "Agregar Editorial";
		
		$form = new Admin_Form_EditorialForm();
		$form->submit->setLabel('Agregar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$editorials = new Core_Model_DbTable_Editorial();
				$editorial = new Core_Sticker_Editorial();
				
				$editorial->setId(null)
						  ->setName($form->getValue('editorial_name'))
						  ->setPriority($form->getValue('editorial_priority'))
						  ->setImageUrl($form->getValue('editorial_imageUrl'));
				
				$editorials->addEditorial($editorial);
          		$this->_redirect('/admin/editorial');
			} else {
				$form->populate($formData);
			}
      	}
		
		$this->render('form');
	}
	
  	
	/* update a editorial */
	public function updateAction()
	{
		$this->view->title = "Editar Editorial";
		
		$form = new Admin_Form_EditorialForm();
		$form->submit->setLabel('Editar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$editorials = new Core_Model_DbTable_Editorial();
				$editorial = new Core_Sticker_Editorial();
				
				$editorial->setId($form->getValue('editorial_id'))
						  ->setName($form->getValue('editorial_name'))
						  ->setPriority($form->getValue('editorial_priority'))
						  ->setImageUrl($form->getValue('editorial_imageUrl'));
				
				$editorials->updateEditorial($editorial);
          		$this->_redirect('/admin/editorial');
			} else {
				$form->populate($formData);
			}
      	} else {
      		if ($this->_hasParam('id')) {
      			$editorials = new Core_Model_DbTable_Editorial();
				$editorial = new Core_Sticker_Editorial();
				
				if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
					$this->_redirect('/admin/editorial');	
				}
				
				$editorial = $editorials->getById($id);
				
				if ($editorial) {
					$form->populate($editorial->toArray());
				} else {
					$this->_redirect('/admin/editorial');	
				}
      		} else {
      			$this->_redirect('/admin/editorial');
      		}
      	}
		
		$this->render('form');
	}
	
	
	/* delete a editorial */
	public function deleteAction()
	{
		if ($this->_hasParam('id')) {
			$editorials = new Core_Model_DbTable_Editorial();
			
			if ( !($id = $this->_helper->filter($this->_getParam('id')))) {
				$this->_redirect('/admin/editorial');	
			}
			       
			$editorials->deleteEditorial($id); 
			$this->_redirect('/admin/editorial');  
		}
	}
 }
