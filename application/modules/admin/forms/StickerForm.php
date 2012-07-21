<?php

class Admin_Form_StickerForm extends Admin_Form_Decorator
{
	private $_collectionId;
	
	public function init()
	{
		$this->setName('stickerForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('product_id');
		$id->addFilter('Int');
		
		/* Number */
		$number = new Zend_Form_Element_Text('sticker_number');
        $number->setLabel('Numero')
			   ->setRequired(true)
			   ->setAttrib('required', 'required')
               ->addValidator('NotEmpty', true)
			   ->addFilter('StripTags')
			   ->addFilter('StringTrim');
			 
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
		
		/* Image Url */			 
		$imageUrl = new Zend_Form_Element_Text('sticker_imageUrl');
		$imageUrl->setLabel('Url de la imagen')
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
				 ->setAttrib('onfocus', "deleteOnFocus('sticker_imageUrl', 'http://')")
				 ->setAttrib('onblur', "revertOnBlur('sticker_imageUrl', 'http://')")
				 ->setValue('http://')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Category */				
		$categories = new Admin_Model_DbTable_Category();
		
		$categoryArray = array();
		
		foreach ($categories->getIntoCollection($this->_collectionId) as $c) {
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
		
		$this->addElements(array($id, $number, $name, $price, $stock, $details,
								 $imageUrl, $category, $submit, $cancel));
	}


	public function setCollectionId($collectionId)
	{
		$this->_collectionId = (int)$collectionId;
	}
}
