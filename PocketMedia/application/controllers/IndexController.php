<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

	/*handles the login function, if user is logged in redirects to partner page*/
    public function indexAction()
    {
        $form = new Application_Form_Login();
		$request = $this->getRequest();
		if ($request->isPost()) {
			if ($form->isValid($request->getPost())) {
				if ($this->_process($form->getValues())) {
					// We're authenticated! Redirect to the home page
					$this->_helper->redirector('index', 'partner');
				}
			}
		}
		$this->view->form = $form;
		
    }
	
	/*validates the user data*/
    protected function _process($values)
    {
		$hash = $this->_getUserPass($values['username']);
		if($hash) {
			$hashCheck = crypt($values['password'], $hash);
			/* Get authentication adapter and check credentials*/
			$adapter = $this->_getAuthAdapter();
			$adapter->setIdentity($values['username']);
			$adapter->setCredential($hashCheck);
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($adapter);
			/* save the user data if login correct*/
			if ($result->isValid()) {
				$user = $adapter->getResultRowObject();
				$auth->getStorage()->write($user);
				return true;
			}
		}
		return false;

    }

	/*retrieves the authentication adapter*/
    protected function _getAuthAdapter()
    {
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		$authAdapter->setTableName('users')
		->setIdentityColumn('name')
		->setCredentialColumn('password');
		return $authAdapter;
    }
	
	/*return user hashed password from DB by it´s name*/
    protected function _getUserPass($name)
    {
		$users = new Application_Model_UsersMapper();
        $user = $users->getUserByName($name);
		$this->view->user = $user;
		if($user) {
			return $user->password;
		}
    }
	
	/*handles logout*/
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index');
    }


}



