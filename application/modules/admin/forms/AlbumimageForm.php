<?php

class Admin_Form_AlbumimageForm extends Admin_Form_DecoratorInline
{
	public function init()
	{
		$this->setName('albumImageForm');

		/* Image Url */			 
		$imageUrl = new Zend_Form_Element_Text('albumImage_imageUrl');
		$imageUrl->setLabel('Url de la imagen:')
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Agregar imagen');
		
		$this->addElements(array($imageUrl, $submit));
	}
}
