<?php

class Default_Model_DbTable_Category extends Zend_Db_Table_Abstract
{
	protected $_name = 'category';
	protected $_primary = 'category_id';
	
	
	/*****************************************************************/
	/* Private                                                       */
	/*****************************************************************/
	private function rowToObject($row)
	{
		$category = new Core_Sticker_Category();
		$categoty->setId($row['category_id']);
		$categoty->setName($row['category_name']);
		$categoty->setOrder($row['category_order']);
		$categoty->setCollectionId($row['collection_id']);
		 
		return $category;
	}
	
	private function objectToRow(Core_Sticker_Category $category)
	{
		$row = array(
			'category_id' => $category->getId(),
			'category_name' => $category->getName(),
			'category_order' => $category->getOrder(),
			'collection_id' => $category->getCollectionId(),
		);
		
		return $row;
	}
	
	
    /*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
	public function getById($id)
	{
		 $row = $this->find($id)->current();
		 return rowToObject($row);
	}


	/* get all categories into a collection */
	public function getIntoCollection($collectionId)
	{
		$select = $this->select();
		$select->where('collection_id = ?', $collectionId);
 
		$rows = $this->fetchAll($select);
					
		return $rows;
	}
	
	
	/* add new category */
	public function addCategory(Core_Sticker_Category $category)
	{
		$this->insert(objectToRow($category));
	}
	
	
	/* update a category */
	public function updateCategory(Core_Sticker_Category $category)
	{
		$this->update(objectToRow($category), 'category_id = '. $category->getId());
	}
	
	
	/* delete a category */
	public function deleteCategory($id)
	{
		$row = $this->find($id)->current();
		if ( !empty($row) ) $row->delete();
	}
}

