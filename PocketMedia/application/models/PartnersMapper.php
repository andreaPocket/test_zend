<?php

class Application_Model_PartnersMapper
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
            $this->setDbTable('Application_Model_DbTable_Partner');
        }
        return $this->_dbTable;
    }
	
	public function delete($id)
    {
        $where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $id);
		$this->getDbTable()->delete($where);
    }
 
    public function save(Application_Model_Partner $partner)
    {
        $data = array(
			'name'    => $partner->getName(),
			'address'    => $partner->getAddress(),
            'email'   => $partner->getEmail(),
			'mobile'    => $partner->getMobile(),
			'account_manager'    => $partner->getAccount_manager(),
			'partner_type'    => $partner->getPartner_type(),
			'details'    => $partner->getDetails(),
		);
		$id = $partner->getId();
        if (null === ($id = $partner->getId()) || $id==0) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Partner $partner)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $partner->setName($row->name)
				  ->setAddress($row->address)
				  ->setEmail($row->email)
                  ->setMobile($row->mobile)
				  ->setAccount_manager($row->account_manager)
				  ->setPartner_type($row->partner_type)
                  ->setDetails($row->details)
                  ->setId($row->id);
    }
	
	public function findById($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
		return $result;
    }
	
	public function partnerExists($id)
    {
		$select = $this->getDbTable()->select()->where('id = ?', $id);
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
            $entry = new Application_Model_Partner();
            $entry->setName($row->name)
				  ->setAddress($row->address)
				  ->setEmail($row->email)
                  ->setMobile($row->mobile)
				  ->setAccount_manager($row->account_manager)
				  ->setPartner_type($row->partner_type)
                  ->setDetails($row->details)
                  ->setId($row->id);
            $entries[] = $entry;
        }
        return $entries;
    }

}

