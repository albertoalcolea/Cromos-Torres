<?php

class Default_Model_Paginator_CategoryPaginator extends Zend_Paginator_Adapter_DbSelect
{
	
    /**
     * Returns an array of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
     
    public function getItems($offset, $itemCountPerPage)
    {
        $rows = parent::getItems($offset, $itemCountPerPage);


		$categoryArray = array();
		
		foreach ($rows as $row) {
			array_push($categoryArray, Default_Model_DbTable_Category::rowToObject($row));
		}
		
		return $categoryArray;
    }
}