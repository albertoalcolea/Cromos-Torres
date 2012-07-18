<?php

class Core_Helpers_Filter extends Zend_Controller_Action_Helper_Abstract
{
	public function direct($source)
	{
		Zend_Loader::loadClass('Zend_Filter_StripTags');
		$f = new Zend_Filter_StripTags();
		$out = $f->filter($source);
		
		if (empty($out)) {
			return false;
		} else {
			return $out;
		}
	}
}
