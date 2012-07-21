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
				 ->setAttrib('onfocus', "deleteOnFocus('albumImage_imageUrl', 'http://')")
				 ->setAttrib('onblur', "revertOnBlur('albumImage_imageUrl', 'http://')")
				 ->setValue('http://')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Agregar imagen');
		
		/* Go back */
		$goBack = new Zend_Form_Element_Button('goBack');
		$goBack->setRequired(false)
    		   ->setLabel('Volver')
			   ->setAttrib('onclick', 'javascript:history.go(-1)');
		
		$this->addElements(array($imageUrl, $submit, $goBack));
	}
}
