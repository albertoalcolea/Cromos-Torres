<?php

class Admin_Form_CollectionForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('collectionForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('collection_id');
		$id->addFilter('Int');
		
		/* Name */
		$name = new Zend_Form_Element_Text('collection_name');
        $name->setLabel('Nombre')
             ->setRequired(true)
			 ->setAttrib('required', 'required')
             ->addValidator('NotEmpty', true)
			 ->addFilter('StripTags')
			 ->addFilter('StringTrim');
		
		/* Year */			
		$yearArray = array();
		
		foreach (range(date('Y', time()), 1960) as $y) {
			$yearArray[$y] = $y;
		}
			 
		$year = new Zend_Form_Element_Select('collection_year');
		$year->setLabel('Año')
			 ->setAttrib('style', 'width: 80px;')
			 ->setMultiOptions($yearArray)
			 ->setRequired(true)
			 ->setAttrib('required', 'required')
			 ->addValidator('NotEmpty', true)
			 ->addFilter('Int');
	
		/* Image Url */			 
		$imageUrl = new Zend_Form_Element_Text('collection_imageUrl');
		$imageUrl->setLabel('Url de la imagen')
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
				 ->setAttrib('onfocus', "deleteOnFocus('collection_imageUrl', 'http://')")
				 ->setAttrib('onblur', "revertOnBlur('collection_imageUrl', 'http://')")
				 ->setValue('http://')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Editorial */				
		$editorials = new Core_Model_DbTable_Editorial();
		
		$editorialArray = array();
		
		foreach ($editorials->getAll() as $e) {
			$editorialArray[$e->getId()] = $e->getName();
		}
		
		$editorial = new Zend_Form_Element_Select('editorial_id');
		$editorial->setLabel("Editorial")
				  ->setMultiOptions($editorialArray)
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
		
		$this->addElements(array($id, $name, $year, $imageUrl, $editorial, $submit, $cancel));
	}
}
