<?php

class S900_Loan_AjaxController extends Mage_Core_Controller_Front_Action{

	public function _construct(){
		$this->getResponse()->setHeader('Content-type','application/json');
	}
	public function indexAction(){
		$this->loadLayout();

		$this->renderLayout();
	}

	public function test_testAction(){
		
		$account =  Mage::getResourceModel('loan/account_collection');

		
		$account->addFieldToFilter('email','cj@sasdf.com')->getFirstItem()->getData() ;



	}

	public function add_accountAction(){
		

		$account = Mage::getModel('loan/account');
		$account->setData( $this->getRequest()->getPost() );

		$validator = $account->validate();

		if( is_array($validator) )
			return $this->getResponse()->setBody( json_encode(array('success' => false,'error_msg' => $validator) ) ); 

		$account->save();		
		$this->getResponse()->setBody( json_encode( array('success' => true,'data' => $account->toArray(),'redirect' => Mage::getBaseUrl() ) ) ); 
	}

	public function add_loanAction(){
		

		$loan = Mage::getModel('loan/loan');
		$loan->setData( $this->getRequest()->getPost() );

		$validator = $loan->validate();

		if( is_array($validator) )
			return $this->getResponse()->setBody( json_encode(array('success' => false,'error_msg' => $validator) ) ); 

		$loan->save();
		$this->getResponse()->setBody( json_encode( array('success' => true,'data' => $loan->toArray()) ) );
	}

	public function get_accountAction(){
		
		$request = $this->getRequest();

		$account = Mage::getResourceModel('loan/account_collection')
				->addFieldToFilter('email', $request->getPost('email'))
				->addFieldToFilter('mobile_phone', $request->getPost('mobile_phone') )
				->getFirstItem();
			
		if( !$account->getData() )
			return $this->getResponse()->setBody( json_encode(array('success' => false,'error_msg' => 'Account doesnt exits') ) ); 
		


		$this->getResponse()->setBody( json_encode( array('success' => true,'data' => $account->toArray(),'redirect' => Mage::getBaseUrl() ) ) ); 
	}

}