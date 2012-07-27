<?php

class Admin_Form_CategoryForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('categoryForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('category_id');
		$id->addFilter('Int');
		
		/* Name */
		$name = new Zend_Form_Element_Text('category_name');
        $name->setLabel('Nombre')
             ->setRequired(true)
			 ->setAttrib('required', 'required')
             ->addValidator('NotEmpty', true)
			 ->addFilter('StripTags')
			 ->addFilter('StringTrim');
	
		/* Order */
		$orderArray = array();
		for ($i=1; $i<=25; $i++) {
			$orderArray[$i] = $i;
		}	
				 
		$order = new Zend_Form_Element_Select('category_order');
		$order->setLabel('Orden')
	    	  ->setAttrib('style', 'width: 60px;')
			  ->setMultiOptions($orderArray)
			  ->setRequired(true)
		  	  ->setAttrib('required', 'required')
			  ->addValidator('NotEmpty', true)
			  ->addFilter('Int');
		
		/* Collection */				
		$collections = new Core_Model_DbTable_Collection();
		
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
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		
		/* Cancel */
		$cancel = new Zend_Form_Element_Button('cancel');
		$cancel->setRequired(false)
    		   ->setLabel('Volver')
			   ->setAttrib('onclick', 'javascript:history.go(-1)');
		
		$this->addElements(array($id, $name, $order, $collection, $submit, $cancel));
	}
}
