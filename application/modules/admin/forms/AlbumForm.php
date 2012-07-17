<?php

class Admin_Form_AlbumForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('stickerForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('album_id');
		$id->addFilter('Int');
		
		/* Collection */				
		$collections = new Admin_Model_DbTable_Collection();
		
		$collectionArray = array();
		
		foreach ($collections->getAll() as $c) {
			$collectionArray[$c->getId()] = $c->getName();
		}
				
		$collection = new Zend_Form_Element_Select('collection_id');
		$collection->setLabel("Colección")
				   ->setMultiOptions($collectionArray)
				   ->setRequired(true)
				   ->setAttrib('required', 'required')
				   ->addValidator('NotEmpty', true)
				   ->addFilter('Int');
		
		/* Image Url 1 */			 
		$imageUrl1 = new Zend_Form_Element_Text('album__imageUrl1');
		$imageUrl1->setLabel('Url de la imagen')
				  ->setRequired(true)
				  ->setAttrib('required', 'required')
             	  ->addValidator('NotEmpty', true)
			 	  ->addFilter('StripTags')
			 	  ->addFilter('StringTrim');
				  
		/* Image Url 2 */			 
		$imageUrl2 = new Zend_Form_Element_Text('album__imageUrl2');
		$imageUrl2->setLabel('Url de la imagen')
			 	  ->addFilter('StripTags')
			 	  ->addFilter('StringTrim');
				
		/* Image Url 3 */			 
		$imageUrl3 = new Zend_Form_Element_Text('album__imageUrl3');
		$imageUrl3->setLabel('Url de la imagen')
			 	  ->addFilter('StripTags')
			 	  ->addFilter('StringTrim');
				  
		/* Image Url 4 */			 
		$imageUrl4 = new Zend_Form_Element_Text('album__imageUrl4');
		$imageUrl4->setLabel('Url de la imagen')
			 	  ->addFilter('StripTags')
			 	  ->addFilter('StringTrim');
				  
		/* Image Url 5 */			 
		$imageUrl5 = new Zend_Form_Element_Text('album_imageUrl5');
		$imageUrl5->setLabel('Url de la imagen')
			 	  ->addFilter('StripTags')
			 	  ->addFilter('StringTrim');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		
		/* Cancel */
		$cancel = new Zend_Form_Element_Button('cancel');
		$cancel->setRequired(false)
    		   ->setLabel('Volver')
			   ->setAttrib('onclick', 'javascript:history.go(-1)');
		
		$this->addElements(array($id, $collection, $imageUrl1, $imageUrl2, 
			$imageUrl3, $imageUrl4, $imageUrl5, $submit, $cancel));
	}
}
