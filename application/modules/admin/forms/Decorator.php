<?php

class Admin_Form_Decorator extends Zend_Form
{
	
	protected static $_standardElementDecorator = array(
        array('ViewHelper'),
        array('Label',			array('separator' => ' ', )),
        array('Description',	array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
        array('HtmlTag',		array('tag' => 'li')),
    );  


    protected static $_standardElementDecoratorAppendDescription = array(
        array('Description'),	//array('tag' => 'span', 'class' => 'element-description-prepend', 'placement' => 'prepend' )),
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
        array('HtmlTag',     	array('tag' => 'li')),
    );


    protected static $_standardElementDecoratorClearRight = array(
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', )),
        array('Description'),   //array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
        array('HtmlTag',     	array('tag' => 'li', 'class' => 'clearRight')),
    ); 


    protected static $_standardElementDecoratorClearLeft = array(
        array('ViewHelper'),
        array('Label',         	array('separator' => ' ', )),
        array('Description'),   //array('tag' => 'span', 'class' => 'element-description-append', 'placement' => 'append' )),
        array('Errors',			array('tag' => 'div', 'class' => 'alert-error')),
        array('HtmlTag',     	array('tag' => 'li', 'class' => 'clearLeft')),
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
        array('HtmlTag',		array('tag' => 'li')),
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
				 ->addDecorator('HtmlTag', array('tag' => 'ul'))
                 ->addDecorator('Form')
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
					$element->setAttrib('class', 'btn btn-large btn-inverse');
					$element->setAttrib('style', 'float: left; margin-right: 20px;');
                	break;
					
				case 'Zend_Form_Element_Button':
					$element->setDecorators(self::$_submitElementDecorator);        
					$element->setAttrib('class', 'btn btn-large');
					//$element->setAttrib('style', 'float: right;');
                	break;
					
                case 'Zend_Form_Element_Radio':
					$element->setDecorators(self::$_standardElementDecorator);
					break;
					
                case 'Zend_Form_Element_MultiCheckbox': 
                	$element->setDecorators(self::$_multiCheckboxElementDecorator);
                	break;
					
                case 'Zend_Form_Element_Select':
					$element->setAttrib('class', 'input-xlarge');
					$element->setDecorators(self::$_standardElementDecorator);
					break;
					
                case 'Zend_Form_Element_Text':
					$element->setAttrib('class', 'input-xlarge');
					$element->setDecorators(self::$_standardElementDecorator);
					break;
				
				case 'Zend_Form_Element_Textarea':
					$element->setAttrib('class', 'input-xlarge');
					$element->setDecorators(self::$_standardElementDecorator);
					break;
				
                default:
					$element->setDecorators(self::$_standardElementDecorator);
            }
        }

        return $this;
    }
}
