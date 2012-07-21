<?php

class Admin_Form_DecoratorInline extends Zend_Form
{
	
	protected static $_standardElementDecorator = array(
        array('ViewHelper'),
        array('Label',			array('separator' => ' ', )),
        array('Description'),	//array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
    );  


    protected static $_standardElementDecoratorAppendDescription = array(
        array('Description'),	//array('tag' => 'span', 'class' => 'element-description-prepend', 'placement' => 'prepend' )),
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
    );


    protected static $_standardElementDecoratorClearRight = array(
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', )),
        array('Description'),   //array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
    ); 


    protected static $_standardElementDecoratorClearLeft = array(
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', )),
        array('Description'),   //array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
    ); 


    /**
     *
     * Remeber to set 'separator' => '' into the element
     * @var array
     */
	protected static $_multiCheckboxElementDecorator = array(
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', 'tag' => 'span')),
        array('Description'),   //array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
        array('HtmlTag',     	array('tag' => 'div', 'class' => 'multiCheckbox')),

    );


    protected static $_hiddenElementDecorator = array(
        array('ViewHelper')
    );


    protected static $_submitElementDecorator = array(
        array('ViewHelper'),
    );


    public function __construct($options = null)
    {
		parent::__construct($options);
    }


    /**
     * Load the custom decorators
     *
     * @return void
     */
    public function loadDefaultDecorators(){

        if (!$this->loadDefaultDecoratorsIsDisabled()) {
            $this->clearDecorators()
                 ->addDecorator('FormElements')
                 ->addDecorator('Form', array('class' => 'form-inline'))
            ;
        } 

        foreach ($this->getDisplayGroups() as $group) {
            if ($group->loadDefaultDecoratorsIsDisabled()) continue;

            $group->clearDecorators();

            $group->addDecorators(
                array(
                    array('FormElements'),
                    //array('Description', array('tag' => 'p', 'class' => 'group-description', 'placement' => 'prepend' )),
                    new Zend_Form_Decorator_Fieldset(),
                )
            );
        }

        foreach ($this->getElements() as $element) {
            if ($element->loadDefaultDecoratorsIsDisabled()) continue;

            switch ($element->getType()){

                case 'Zend_Form_Element_Hidden':      	
                	$element->setDecorators(self::$_hiddenElementDecorator);
                	break;
					
                case 'Zend_Form_Element_Submit':
                	$element->setDecorators(self::$_submitElementDecorator);        
					$element->setAttrib('class', 'btn btn-inverse');
                	break;
					
				case 'Zend_Form_Element_Button':
					$element->setDecorators(self::$_submitElementDecorator);   
					$element->setAttrib('class', 'btn');    
					$element->setAttrib('style', 'margin-left: 5px;');
                	break;
					
                case 'Zend_Form_Element_Radio':
					$element->setDecorators(self::$_standardElementDecorator);
					break;
					
                case 'Zend_Form_Element_MultiCheckbox': 
                	$element->setDecorators(self::$_multiCheckboxElementDecorator);
                	break;
					
                case 'Zend_Form_Element_Select':
					$element->setDecorators(self::$_standardElementDecorator);
					break;
					
                case 'Zend_Form_Element_Text':
					$element->setAttrib('class', 'input-xlarge');
					$element->setAttrib('style', 'margin: 0 5px;');
					$element->setDecorators(self::$_standardElementDecorator);
					break;
				
				case 'Zend_Form_Element_Textarea':
					$element->setDecorators(self::$_standardElementDecorator);
					break;
				
                default:
					$element->setDecorators(self::$_standardElementDecorator);
            }
        }

        return $this;
    }
}
