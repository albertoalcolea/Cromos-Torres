<?php

class Admin_Form_AlbumForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('albumForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('product_id');
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
		
		/* Name */
		$name = new Zend_Form_Element_Text('product_name');
        $name->setLabel('Nombre')
             ->setRequired(true)
			 ->setAttrib('required', 'required')
             ->addValidator('NotEmpty', true)
			 ->addFilter('StripTags')
			 ->addFilter('StringTrim');

		/* Price */
		$price = new Zend_Form_Element_Text('product_price');
		$price->setLabel('Precio')
			  ->setDescription('€')
			  ->setAttrib('style', 'text-align: right; width: 60px;')
			  ->setValue('0.00')
			  ->setRequired(true)
			  ->setAttrib('required', 'required')
              ->addValidator('NotEmpty', true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->setAttrib('onblur', "checkPrice('product_price')")
			  ->addValidator('regex', true, array('/[0-9]+.[0-9]{2}/'))
			  ->getValidator('regex')->setMessage("El precio debe tener el siguiente formato 0.00"); 
		
		/* Stock */
		$stock = new Zend_Form_Element_Text('product_stock');
		$stock->setLabel('Stock')
			  ->setDescription('unidades')
			  ->setAttrib('style', 'text-align: right; width: 60px;')
			  ->setValue('1')
			  ->setRequired(true)
			  ->setAttrib('required', 'required')
              ->addValidator('NotEmpty', true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->setAttrib('onblur', "checkIsInt('product_stock', 1)")
			  ->addFilter('Int');
		
		/* Details */
		$details = new Zend_Form_Element_Textarea('product_details');
		$details->setLabel("Detalles")
				->addFilter('StripTags')
				->addFilter('StringTrim');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		
		/* Cancel */
		$cancel = new Zend_Form_Element_Button('cancel');
		$cancel->setRequired(false)
    		   ->setLabel('Volver')
			   ->setAttrib('onclick', 'javascript:history.go(-1)');
		
		$this->addElements(array($id, $collection, $name, $price, $stock, $details, $submit, $cancel));
	}
}
