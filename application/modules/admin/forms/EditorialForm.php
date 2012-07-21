<?php

class Admin_Form_EditorialForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('editorialForm');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('editorial_id');
		$id->addFilter('Int');
		
		/* Name */
		$name = new Zend_Form_Element_Text('editorial_name');
        $name->setLabel('Nombre')
             ->setRequired(true)
			 ->setAttrib('required', 'required')
             ->addValidator('NotEmpty', true)
			 ->addFilter('StripTags')
			 ->addFilter('StringTrim');
		
		/* Priority */
		$minPriority = Core_Sticker_Editorial::MINPRIORITY;
		$maxPriority = Core_Sticker_Editorial::MAXPRIORITY;
		
		$priorityArray = array();
		
		for ($i = $minPriority; $i <= $maxPriority; $i++) {
			$priorityArray[$i] = $i;
			
			if ($i == $minPriority) {
				$priorityArray[$i] = $priorityArray[$i] . ' - Menor prioridad';
			} else if ($i == $maxPriority) {
				$priorityArray[$i] = $priorityArray[$i] . ' - Mayor prioridad';
			}
		}
			 
		$priority = new Zend_Form_Element_Select('editorial_priority');
		$priority->setLabel('Prioridad')
				 ->setMultiOptions($priorityArray)
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
				 ->addValidator('NotEmpty', true)
				 ->addFilter('Int');
	
		/* Image Url */			 
		$imageUrl = new Zend_Form_Element_Text('editorial_imageUrl');
		$imageUrl->setLabel('Url de la imagen')
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
				 ->setAttrib('onfocus', "deleteOnFocus('editorial_imageUrl', 'http://')")
				 ->setAttrib('onblur', "revertOnBlur('editorial_imageUrl', 'http://')")
				 ->setValue('http://')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		
		/* Cancel */
		$cancel = new Zend_Form_Element_Button('cancel');
		$cancel->setRequired(false)
    		   ->setLabel('Volver')
			   ->setAttrib('onclick', 'javascript:history.go(-1)');
		
		$this->addElements(array($id, $name, $priority, $imageUrl, $submit, $cancel));
	}
}
