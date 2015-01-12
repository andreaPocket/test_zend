<?php

class Application_Form_Partner extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
		
		// Add a name element
        $this->addElement('text', 'name', array(
            'label'      => 'Name:',
            'required'   => true
        ));
		// Add an address element
        $this->addElement('text', 'address', array(
            'label'      => 'Address:',
            'required'   => true
        ));
        // Add an email element
        $this->addElement('text', 'email', array(
            'label'      => 'Email:',
            'required'   => true,
            'validators' => array(
                'EmailAddress',
            )
        ));
		// Add a mobile element
        $this->addElement('text', 'mobile', array(
            'label'      => 'Phone Number:',
            'required'   => true,
        ));
		
		// Add an account manager element
        $this->addElement('text', 'account_manager', array(
            'label'      => 'Account Manager:',
        ));
		
		// Add a type element
        $this->addElement('select', 'partner_type', array(
            'label'      => 'Type of partner:',
            'required'   => true,
			'registerInArrayValidator' => false,
        ));
		
		
		// Add a comment element
        $this->addElement('textarea', 'details', array(
            'label'      => 'Comments:',
			'cols'		 => 20,
			'rows'		 => 5,
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

