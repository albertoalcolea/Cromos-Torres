<?php

class Admin_Model_Paginator_StickerPaginator extends Zend_Paginator_Adapter_DbSelect
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


		$stickerArray = array();
		
		foreach ($rows as $row) {
			array_push($stickerArray, Admin_Model_DbTable_Sticker::rowToObject($row));
		}
		
		return $stickerArray;
    }
}