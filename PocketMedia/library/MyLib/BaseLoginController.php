<?php
/**Custo base Controler that ads login handle**/
class MyLib_BaseLoginController extends Zend_Controller_Action
{
	
	protected $_user;
	
    public function init() {}
	
	/*sets the data for logged user in 'loggedUser' that is accessible in view, if noone is logged in redirects to login page.	*/
	public function checkLogin() 
	{
		if(!$this->_user) {
			$auth = Zend_Auth::getInstance();
			if ($auth->hasIdentity()) {
					$this->_user = $auth->getIdentity();
					$this->view->loggedUser = $this->_user;
			}
			else {
				$request = Zend_Controller_Front::getInstance()->getRequest();
				$controller = $request->getControllerName();
				$action = $request->getActionName();
				//redirect to login page
				if($controller != 'index' || $action != 'index') {
						$this->_helper->redirector('index', 'index');
				}
			}
		}
	}
	/*checks if the user is admin returns boolean*/
	public function isAdmin() {
		if( !$this->_user ) { 
			checkLogin(); 
		}
		if( $this->_user->user_type == 'admin' ) {
			return true;
		}
		return false;
	}
}

