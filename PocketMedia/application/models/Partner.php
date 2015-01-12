<?php

class Application_Model_Partner
{
    protected $_name;
    protected $_address;
    protected $_email;
	protected $_mobile;
	protected $_accountManager;
	protected $_type;
	protected $_comment;
    protected $_id;
	
	public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value){
		$method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid partner property');
        }
        $this->$method($value);
	}
	
    public function __get($name){
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid partner property');
        }
        return $this->$method();
    }
	
	public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
 
    public function setName($name)
	{
        $this->_name = (string) $name;
        return $this;
    }
	
    public function getName()
	{
        return $this->_name;
    }
	
	public function setAddress($address)
	{
        $this->_address = (string) $address;
        return $this;
    }
	
    public function getAddress()
	{
        return $this->_address;
    }
 
    public function setEmail($email)
	{
        $this->_email = (string) $email;
        return $this;
    }
	
    public function getEmail()
	{
        return $this->_email;
    }
 
    public function setMobile($mobile)
	{
        $this->_mobile = (string) $mobile;
        return $this;
    }
	
    public function getMobile()
	{
        return $this->_mobile;
    }
	
	public function setAccount_manager($accountManager)
	{
        $this->_accountManager = (string) $accountManager;
        return $this;
    }
	
    public function getAccount_manager()
	{
        return $this->_accountManager;
    }
	
	public function setPartner_type($type)
	{
        $this->_type = (string) $type;
        return $this;
    }
	
    public function getPartner_type()
	{
        return $this->_type;
    }
	
	public function setDetails($comment)
	{
        $this->_comment = (string) $comment;
        return $this;
    }
	
    public function getDetails()
	{
        return $this->_comment;
    }
 
    public function setId($id)
	{
        $this->_id = (int) $id;
        return $this;
    }
	
    public function getId()
	{
        return $this->_id;
    }

}

