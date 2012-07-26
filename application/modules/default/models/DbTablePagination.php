<?php

class Default_Model_DbTablePagination extends Zend_Db_Table_Abstract
{
    protected $_page = 0;
	protected $_itemsPerPage = 0;
	protected $_maxPages = 0;
	
	
	/*****************************************************************/
	/* Private                                                      */
	/*****************************************************************/
	private function getClassName()
	{
		//$out = explode('Admin_Model_DbTable_', get_class($this));
		//return $out[1];
		return substr(get_class($this), 20);
	}
	
	
	/*****************************************************************/
	/* Protected                                                     */
	/*****************************************************************/
	protected function createPaginator(Zend_Db_Select $select)
	{
		$paginatorClassName = "Default_Model_Paginator_" . $this->getClassName() . "Paginator";;
		
		$adapter   = new $paginatorClassName($select);
       	$paginator = new Zend_Paginator($adapter);
		
		$paginator->setItemCountPerPage($this->_itemsPerPage)  
              	  ->setCurrentPageNumber($this->_page)  
              	  ->setPageRange($this->_maxPages); 
		
		return $paginator;
	}
	
	
	/*****************************************************************/
	/* Public                                                        */
	/*****************************************************************/
    public function setPaginator($page, $itemsPerPage, $maxPages)
	{
		$this->_page			= $page;
		$this->_itemsPerPage	= $itemsPerPage;
		$this->_maxPages		= $maxPages;
	}
}
