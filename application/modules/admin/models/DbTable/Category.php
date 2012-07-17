<?php

class Admin_Model_DbTable_Category extends Zend_Db_Table_Abstract
{
	protected $_name = 'category';
	protected $_primary = 'category_id';
	
	
	/*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
	private function rowToObject($row)
	{
		if ($row !== null) {
        	$category = new Core_Sticker_Category();
		
       		$category->fromArray($row);
		
        	return $category;
		} else {
			return false;
		}
	}
	
	private function objectToRow(Core_Sticker_Category $category)
	{
		 $row = $category->toArray();
		         
        return $row;
	}
	
	
    /*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
	public function getById($id)
	{
		$select = $this->select()
					   ->setIntegrityCheck(false)
					   ->from('category')
					   ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('category_id = ?', $id);
		
		$row = $this->fetchRow($select);
		 
		return $this->rowToObject($row);
	}


    /* get all categories */
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('category')
                       ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id');
					   
		$rows = $this->fetchAll($select);
		
		$categoryArray = array();
		
		foreach ($rows as $row) {
			array_push($categoryArray, $this->rowToObject($row));
		}
		
		return $categoryArray;
	}


	/* get all categories into a collection */
	public function getIntoCollection($collectionId)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('category')
                       ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('category.collection_id = ?', $collectionId);
					   
		$rows = $this->fetchAll($select);
		
		$categoryArray = array();

		foreach ($rows as $row) {
			array_push($categoryArray, $this->rowToObject($row));
		}
		
		return $categoryArray;
	}
	
	
	/* add new category */
	public function addCategory(Core_Sticker_Category $category)
	{
		$this->insert($this->objectToRow($category));
	}
	
	
	/* update a category */
	public function updateCategory(Core_Sticker_Category $category)
	{
		$this->update($this->objectToRow($category), 'category_id = '. $category->getId());
	}
	
	
	/* delete a category */
	public function deleteCategory($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}

