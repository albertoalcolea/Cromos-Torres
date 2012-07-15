<?php

class Admin_EditorialController extends Zend_Controller_Action 
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


    /* list all editorials */
	public function indexAction()
	{
		$this->view->title = "Lista de Editoriales";
		
		$editorials = new Admin_Model_DbTable_Editorial();
		$data = $editorials->getAll();
		$this->view->data = $data ;
	}
	
	
	/* insert a new editorial */
	public function insertAction()
	{
		if ($this->getRequest()->isPost()) {
			$editorials = new Admin_Model_DbTable_Editorial();
			$editorial = new Core_Sticker_Editorial();

          	Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			
			$editorial->setName(	$f->filter($this->_request->getPost('name')))
					  ->setPriority($f->filter($this->_request->getPost('priority')))
					  ->setImageUrl($f->filter($this->_request->getPost('imageUrl')));
			
			/* !! Check not null or empty !!!!!! */
			if ($editorial->getName() === null || 
				$editorial->getName() === '' ||
			    $editorial->getPriority() === null || 
			    !($editorial->getPriority() > $editorial->MINPRIORITY && $editorial->getPriority() < $editorial->MAXPRIORITY) ||
			    $editorial->getImageUrl() === null || 
			    $editorial->getImageUrl() === '')
			{
				$this->view->message = "Datos invalidos";
				
			} else {
          		$editorials->addEditorial($editorial);
          		$this->_redirect('/admin/editorial');
			}
      	}
	}
	
  	
	/* update a editorial */
	public function updateAction()
	{
		$editorials = new Admin_Model_DbTable_Editorial();
		$editorial = new Core_Sticker_Editorial();
		
		/* show editorial */
		if (! $this->_request->isPost()) {
            $editorial = $editorials->getById($this->_getParam('id'));
            if (! $editorial !== null) {
                $this->view->editorial = $editorial;
            }    
           
		/* update editorial */ 
		} else {
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();			
			
			$editorial->setId($f->filter($this->_request->getPost('id')));
			$editorial->setName($f->filter($this->_request->getPost('name')));
			$editorial->setPriority($f->filter($this->_request->getPost('priority')));
			$editorial->setImageUrl($f->filter($this->_request->getPost('imageUrl')));
			
			/* !! Check not null or empty !!!!!! */
			
			$editorials->updateEditorial($editorial);
			$this->_redirect('/admin/editorial');
		}
	}
	
	
	/* delete a editorial */
	public function deleteAction()
	{
		if($this->_hasParam('id')){
			$editorials = new Admin_Model_DbTable_Editorial();
			
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$id = $f->filter($this->_getParam('id'));
			
			if (!empty($id)) {          
				$editorials->deleteEditorial($id); 
				$this->_redirect('/admin/editorial');  
			}   
		}
	}
 }
