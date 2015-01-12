<?php

class UserController extends MyLib_BaseLoginController
{

    public function init()
    {
		/*check login - MyLib_BaseLoginController functionality, if not an admin user redirect to partner page*/
        $this->checkLogin();
		if (!$this->isAdmin()) {
			$this->_helper->redirector('index', 'partner');
			
		}
    }

    public function indexAction()
    {
		/*get data for user overview*/
        $users = new Application_Model_UsersMapper();
        $this->view->users = $users->fetchAll();
    }
	
	public function deleteAction()
    {
		if ($this->getRequest()->isPost()) {
			if($mapper->userExists($request->getPost('id'))) {
				$mapper->delete($request->getPost('id'));
				$this->_helper->redirector('index');
            }
        }
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_User();
		$this->view->newEntry = true;
		$mapper  = new Application_Model_UsersMapper();
		/*if the form was submitted save the data*/
        if ($request->isPost()) {
			/*deleting action*/
			if ($request->getPost('delete')) {
				if($mapper->userExists($request->getPost('id'))) {
					$mapper->delete($request->getPost('id'));
					$this->_helper->redirector('index');
				}
			}
			$user = new Application_Model_User($form->getValues());
			/*don´t check for name and password if edit*/
			if($mapper->userExists($request->getPost('id'))) {
				$form->name->setRequired(false)->setValidators(array());
				$form->name->setAllowEmpty(true);
				$form->password->setRequired(false)->setValidators(array());
				$form->password->setAllowEmpty(true);
			}
			/*validate the form*/
            if ($form->isValid($request->getPost())) {
				$user = new Application_Model_User($form->getValues());
				/*edit existing user or add new user if the name doesn´t exist yet*/
				if($mapper->userExists($user->id) || !$mapper->nameExists($user->name)){
					$mapper->save($user);
					$this->_helper->redirector('index');
				}
				$this->view->userExist=true;
            }
        }
		/**populate form with user data if edit**/
		$idUser=$request->getParam('id');
		if(!is_nan($idUser)) {
			$user = $mapper->findById($idUser);
			if(is_object($user)) {
				$form->populate($user->current()->toArray());
				/*set edit values*/
				$form->name->setAttrib('disabled', 'disabled');
				$this->view->newEntry = false;
				$form->submit->setLabel('Edit');
				// Add the submit button
				$form->addElement('submit', 'delete', array(
					'ignore'   => true,
					'label'    => 'Delete',
				));
			}
		}
        $this->view->form = $form;
    }

}



