<?php

class Core_Model_DbTable_User extends Zend_Db_Table_Abstract
{   
    protected $_name = 'users';
    protected $_primary = 'id';
     
    
    /*****************************************************************/
	/* Public                                                        */
	/*****************************************************************/
    public function checkPassword($id, $pass)
	{
		 $row = $this->find($id)->current();
		 return $row['password'] === md5($pass);
	}
    
	
	/* update password */
	public function updatePassword($id, $user, $pass)
	{
		$row = array(
            'id' => $id,
            'username' => $user,
            'password' => md5($pass),
        );
		
		$this->update($row, $this->_primary . ' = '. $id);
	}
	
}
