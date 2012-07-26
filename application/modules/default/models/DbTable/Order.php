<?php

class Default_Model_DbTable_Order extends Default_Model_DbTablePagination
{
    protected $_name = 'order';
    protected $_primary = 'order_id';
	
    
    /*****************************************************************/
	/* Static                                                        */
	/*****************************************************************/
    public static function rowToObject($row)
    {
    	if ($row !== null) {
        	$order = new Core_Store_Order();
		
       		$order->fromArray($row);
		
        	return $order;
		} else {
			return false;
		}
    }
    
    public static function objectToRow(Core_Store_Order $order)
    {
        $row = $order->toArray();
        
        return $row;
    }
    
	
	/*****************************************************************/
	/* Public                                                        */
    /*****************************************************************/
	/* add new order */
	public function addOrder(Core_Store_Order $order)
	{
		//return $this->insert(self::objectToRow($album));
	}
}
