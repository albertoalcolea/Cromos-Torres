<?php

class Admin_Form_StickerForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('stickerForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('sticker_id');
		$id->addFilter('Int');
		
		/* Name */
		$name = new Zend_Form_Element_Text('sticker_name');
        $name->setLabel('Nombre')
             ->setRequired(true)
			 ->setAttrib('required', 'required')
             ->addValidator('NotEmpty', true)
			 ->addFilter('StripTags')
			 ->addFilter('StringTrim');
	
		/* Image Url */			 
		$imageUrl = new Zend_Form_Element_Text('sticker_imageUrl');
		$imageUrl->setLabel('Url de la imagen')
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Category */				
		$categories = new Admin_Model_DbTable_Category();
		
		$categoryArray = array();
		
		foreach ($categories->getAll() as $c) {
			$categoryArray[$c->getId()] = $c->getName();
		}
		
		$category = new Zend_Form_Element_Select('category_id');
		$category->setLabel("Categoría")
				  ->setMultiOptions($categoryArray)
				  ->setRequired(true)
				  ->setAttrib('required', 'required')
				  ->addValidator('NotEmpty', true)
				  ->addFilter('Int');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		
		/* Cancel */
		$cancel = new Zend_Form_Element_Button('cancel');
		$cancel->setRequired(false)
    		   ->setLabel('Volver')
			   ->setAttrib('onclick', 'javascript:history.go(-1)');
		
		$this->addElements(array($id, $name, $imageUrl, $category, $submit, $cancel));
	}
}
