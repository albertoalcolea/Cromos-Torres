<?php

class Admin_AlbumimagesController extends Zend_Controller_Action 
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
		$this->_redirect('/admin/album');
	}


    /* list all collections */
	public function listAction()
	{
		if ($this->_hasParam('album_id')) {
			if ( !($albumId = $this->_helper->filter($this->_getParam('album_id')))) {
				$this->_redirect('/admin/album');
			}
			
			$albums = new Admin_Model_DbTable_Album();
			$album = new Core_Sticker_Album();
			
			$album = $albums->getById($albumId);
			
			$this->view->title = "Im&aacute;genes del &aacute;lbum " . $album->getName();
			
			$this->view->data = array('1', '2');
		} else {
			$this->_redirect('/admin/album');
		}
	}
}	 