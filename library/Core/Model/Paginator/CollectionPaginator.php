<?php

class Core_Model_Paginator_CollectionPaginator extends Zend_Paginator_Adapter_DbSelect
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

		$collectionArray = array();
		
		foreach ($rows as $row) {
			array_push($collectionArray, Core_Model_DbTable_Collection::rowToObject($row));
		}
		
        return $collectionArray;
    }
}