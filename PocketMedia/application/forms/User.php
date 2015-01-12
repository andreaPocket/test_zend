<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
		
		// Add a name element
        $this->addElement('text', 'name', array(
			'filters' 	 => array('StringTrim'),
            'label'      => 'Name:',
            'required'   => true
        ));
		
		// Add an password element (not required so as it is possible to change just type without reseting password)
        $this->addElement('password', 'password', array(
            'label'      => 'Password:',
			'required'   => true
        ));
        
		// Add a type element
        $this->addElement('select', 'user_type', array(
            'label'      => 'Type of user:',
            'required'   => true,
			'multiOptions' => array( 'user' => 'user', 'admin' => 'admin',), 
			'registerInArrayValidator' => false
        ));
			
		// Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add',
        ));

		// Add the submit button
        $this->addElement('hidden', 'id', array(
        ));
    }


}

