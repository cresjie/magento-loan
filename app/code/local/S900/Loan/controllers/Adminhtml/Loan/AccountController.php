<?php

class S900_Loan_Adminhtml_Loan_AccountController extends Mage_Adminhtml_Controller_Action{

	protected function _init( $idField = 'id'){
		$account = Mage::getModel('loan/account')->load( $this->getRequest()->getParam( $idField ) );

		Mage::register('current_account',$account);
		return $this;
	}
	public function indexAction(){
		$this->_title('Loan Account');

		$this->loadLayout();
		$this->_addContent( $this->getLayout()->createBlock('loan/adminhtml_loan_account') );
		$this->renderLayout();
	}

	public function newAction(){

		$this->_forward('edit');
	}

	public function editAction(){

		$this->_init();
		$this->_title('Loan Account');
		$this->loadLayout();
		$this->renderLayout();
	}

	public function saveAction(){
		$session = Mage::getSingleton('adminhtml/session');
		$data = $this->getRequest()->getPost();
		$id = $this->getRequest()->getParam('id');


		if( $id ){ //if id is set, edit the account

			$account = Mage::getModel('loan/account')->load($id);
			$account->addData($data);


		}else{

			$account = Mage::getModel('loan/account');
			$account->setData($data);
		}
		

		$validate = $account->validate();

		if( is_array($validate) ){
			foreach ($validate as $msg) {
				$session->addError($msg);
				
			}

			if( $account->isObjectMew() )
				return $this->_redirect('*/*/new');

			return $this->_redirect('*/*/edit',array('id' => $this->getRequest()->getParam('id')));
		}
		

		$account->save();

		

		$this->_redirect('*/loan_account');

		
	}
	public function deleteAction(){
		$id = $this->getRequest()->getParam('id');
		$session = Mage::getSingleton('adminhtml/session');

		$account = Mage::getModel('loan/account')->load($id);
		$account->delete();

		$history = Mage::getModel('loan/loan')->getCollection()
						->addFieldToFilter('account_id',$id);
		$history->walk('delete');

		$session->addSuccess('Successfully deleted Account');

		$this->_redirect('*/loan_account');
	}

}