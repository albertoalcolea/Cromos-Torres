<?php

class Admin_Model_DbTable_Category extends Admin_Model_DbTablePagination
{
	protected $_name = 'category';
	protected $_primary = 'category_id';
	
	
	/*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
	public static function rowToObject($row)
	{
		if ($row !== null) {
        	$category = new Core_Sticker_Category();
		
       		$category->fromArray($row);
		
        	return $category;
		} else {
			return false;
		}
	}
	
	public static function objectToRow(Core_Sticker_Category $category)
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
		 
		return self::rowToObject($row);
	}


    /* get all categories */
	public function getAll()
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('category')
                       ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->order(array('editorial.editorial_id ASC', 'collection.collection_id ASC',
					   				 'category.category_order ASC'));
					   
		return $this->createPaginator($select);
	}


	/* get all categories into a collection */
	public function getIntoCollection($collectionId)
	{
		$select = $this->select()
                       ->setIntegrityCheck(false)
					   ->from('category')
                       ->join('collection', 'category.collection_id = collection.collection_id')
					   ->join('editorial', 'editorial.editorial_id = collection.editorial_id')
					   ->where('category.collection_id = ?', $collectionId)
					   ->order(array('category.category_order ASC'));
					   
		return $this->createPaginator($select);
	}
	
	
	/* add new category */
	public function addCategory(Core_Sticker_Category $category)
	{
		return $this->insert(self::objectToRow($category));
	}
	
	
	/* update a category */
	public function updateCategory(Core_Sticker_Category $category)
	{
		$this->update(self::objectToRow($category), $this->_primary . ' = ' . $category->getId());
	}
	
	
	/* delete a category */
	public function deleteCategory($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}

