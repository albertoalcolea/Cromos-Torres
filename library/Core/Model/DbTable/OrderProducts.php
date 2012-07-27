<?php

class Core_Model_DbTable_OrderProducts extends Zend_Db_Table_Abstract
{
    protected $_name = 'orderProducts';
    protected $_primary = array('order_id', 'product_id');
	
	
	/*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
    
	/* add new order - product relation with the quantity of product */
	public function addOrderProduct($orderId, $productId, $quantity)
	{
		$orderProduct = array(
			'order_id' => $orderId,
			'product_id' => $productId,
			'quantity' => $quantity,
		);
		
		return $this->insert($orderProduct);
	}
}
