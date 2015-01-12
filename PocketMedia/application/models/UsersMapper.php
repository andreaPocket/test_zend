<?php

class Application_Model_UsersMapper
{
protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
	
	public function save(Application_Model_User $user)
    {
		$password = $user->getPassword();
        $data = array(
			'user_type'   => $user->getUser_type(),
        );
		if($password!=''){
			$cost = 10;
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			$salt = sprintf("$2a$%02d$", $cost) . $salt;
			$hash = crypt($password, $salt);
			$data['password'] = $hash;
		}
		if($user->getName()!='') {
			$data['name'] = $user->getName();
		}
		$id = $user->getId();
        if (null === ($id = $user->getId()) || $id==0) {
            unset($data['id']);
            return $this->getDbTable()->insert($data);
        } else {
			return $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
	public function delete($id)
    {
        $where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $id);
		$this->getDbTable()->delete($where);
    }
 
    public function find($id, Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
		$user->setId($row->id);
        $user->setName($row->name);
		$user->setPassword($row->password);
		$user->setUser_type($row->user_type);
    }
	
	public function getUserByName($name)
    {
		$select  = $this->getDbTable()->select()->where('name = ?', $name);
		$result = $this->getDbTable()->fetchAll($select);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
		$user = new Application_Model_User;
		$user->setId($row->id);
        $user->setName($row->name);
		$user->setPassword($row->password);
		$user->setUser_type($row->user_type);
		return $user;
    }
	
	public function findById($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
		return $result;
    }
	
	public function userExists($id)
    {
        $select = $this->getDbTable()->select()->where('id = ?', $id);
		$result = $this->getDbTable()->fetchAll($select);
        if (0 == count($result)) {
            return false;
        }
		return true;
    }
	
	public function nameExists($name)
    {
        $select = $this->getDbTable()->select()->where('name = ?', $name);
		$result = $this->getDbTable()->fetchAll($select);
        if (0 == count($result)) {
            return false;
        }
		return true;
    }
	
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_User();
            $entry->setId($row->id)
                  ->setName($row->name)
				  ->setPassword($row->password)
				  ->setUser_type($row->user_type);
            $entries[] = $entry;
        }
        return $entries;
    }

}

