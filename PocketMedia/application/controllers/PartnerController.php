<?php

class PartnerController extends MyLib_BaseLoginController
{

    public function init()
    {
		/*check login - MyLib_BaseLoginController functionality*/
         $this->checkLogin();
    }

    public function indexAction()
    {
		/*get data for partner overview*/
        $partners = new Application_Model_PartnersMapper();
        $this->view->partnersEntries = $partners->fetchAll();
    }

    public function editAction()
    {
		$request = $this->getRequest();
        $form    = new Application_Form_Partner();
		$this->view->newEntry = true;
		$mapper  = new Application_Model_PartnersMapper();
		/**if the for was submitted save the data and redirect to partner index**/
        if ($request->isPost()) {
			/*deleting action*/
			if ($request->getPost('delete')) {
				if($mapper->partnerExists($request->getPost('id'))) {
					$mapper->delete($request->getPost('id'));
					$this->_helper->redirector('index');
				}
			}
            if ($form->isValid($request->getPost())) {	
                $partner = new Application_Model_Partner($form->getValues());
                $mapper->save($partner);
                return $this->_helper->redirector('index');
            }
        }
		/**populate select from db**/
		$partnerTypesMapper = new Application_Model_PartnerTypeMapper();
		$partnerTypes = $partnerTypesMapper->fetchAll();
		$data = array();
		foreach($partnerTypes as $type){
			$typeName = $type->getName();
			$data[$typeName] = $typeName;		
		}
		$form->partner_type->addMultiOptions($data);
		/**populate form with partner data if edit**/
		$idPartner=$this->_request->getParams('id');
		if(!is_nan($idPartner)) {
			$mapper  = new Application_Model_PartnersMapper();
			$partner = $mapper->findById($idPartner);
			if(is_object($partner)) {
				$form->populate($partner->current()->toArray());
				$this->view->newEntry = false;
				/*set edit values*/
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



