<?php

class Admin_View_Helper_StringLength extends Zend_View_Helper_Abstract
{
	public function stringLength($text, $limit = 40)
	{
		$text = trim($text);
	    $text = strip_tags($text);
		
	    $out = '';
		
	    if (strlen($text) <= $limit) {
	        return $text;
			
	    } else {
	        $text = substr($text, 0, $limit);
	        $words = explode(' ', $text);
	        $out = implode(' ', $words);
	        $out .= '...';
	    }   
	    return $out;
	}
}
