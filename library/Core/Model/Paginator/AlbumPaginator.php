<?php

class Core_Model_Paginator_AlbumPaginator extends Zend_Paginator_Adapter_DbSelect
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


		$albumArray = array();
		
		foreach ($rows as $row) {
			array_push($albumArray, Core_Model_DbTable_Album::rowToObject($row));
		}
		
		return $albumArray;
    }
}