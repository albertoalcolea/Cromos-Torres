<?php

class Admin_Form_EditorialForm extends Admin_Form_Decorator
{
	public function init()
	{
		$this->setName('agregarEditorial');
		
		/* Id */
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		
		/* Name */
		$name = new Zend_Form_Element_Text('name');
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
			 
		$priority = new Zend_Form_Element_Select('priority');
		$priority->setLabel('Prioridad')
				 ->setMultiOptions($priorityArray)
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
				 ->addValidator('NotEmpty', true)
				 ->addFilter('Int');
	
		/* Image Url */			 
		$imageUrl = new Zend_Form_Element_Text('imageUrl');
		$imageUrl->setLabel('Url de la imagen')
				 ->setRequired(true)
				 ->setAttrib('required', 'required')
             	 ->addValidator('NotEmpty', true)
			 	 ->addFilter('StripTags')
			 	 ->addFilter('StringTrim');
		
		/* Submit */		 
		$submit = new Zend_Form_Element_Submit('submit');
		
		$this->addElements(array($id, $name, $priority, $imageUrl, $submit));
	}
}
