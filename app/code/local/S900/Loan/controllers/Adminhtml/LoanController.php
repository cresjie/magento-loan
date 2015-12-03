<?php

class S900_Loan_Adminhtml_LoanController extends Mage_Adminhtml_Controller_Action{
	
	protected function _initLoan($idField = 'loan_id'){
		$loan = Mage::getModel('loan/loan')->load( $this->getRequest()->getParam( $idField ) );
		Mage::register('current_loan',$loan);

		return $this;
	}


	public function indexAction(){
		$this->_title( 'Loan Manage' );
		$this->loadLayout();
		$this->_setActiveMenu('loan/loan');
		$this->renderLayout();
		
	}

	public function manageAction(){
		

		
		$this->_title( 'Loan Manage' );
		$this->loadLayout();
		$this->_setActiveMenu('loan/loan');
		$this->_addContent( $this->getLayout()->createBlock('loan/adminhtml_loan_manage') );

		$this->renderLayout();

		//var_dump($this->getLayout()->createBlock('loan/adminhtml_loan_manage_grid'));
		
	}
	
	public function gridAction(){
		
		$this->loadLayout();
		$this->getResponse()->setBody(
			$this->getLayout()->createBlock('loan/adminhtml_loan_manage_grid')->toHtml()
		);
	
	}

	public function newAction(){

		$this->_forward('edit');
	}

	public function editAction(){
		
		$this->_initLoan();

		$this->_title( 'Loan Edit' );

		$this->loadLayout();
		$this->_addContent( $this->getLayout()->createBlock('loan/adminhtml_loan_edit') );
		$this->renderLayout();
	}

	public function deleteAction(){

		$this->_initLoan();

		$loan = Mage::registry('current_loan');

		if( $loan->getLoanId() ){
			try{
				$loan->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess( Mage::helper('loan')->__('The loan has been deleted.') );
			}catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
		}

		$this->_redirect('*/loan/manage');
	}

	public function validateAction(){

		$this->_initLoan();
		$loan = Mage::registry('current_loan');

		$response = new Varien_Object();
		$response->setError(0);
		
		$loan->setData( $this->getRequest()->getPost() );
		
		$errors = $loan->validate();

		if( $errors !== true){
			foreach ($errors as $error) {
				$this->_getSession()->addError( $error );
			}
			$response->setError(1);
		}
		

		if ($response->getError()) {
            $this->_initLayoutMessages('adminhtml/session');
            $response->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
        }
		
		$this->getResponse()->setBody( $response->toJson() );
	
	}

	public function saveAction(){

		$data = $this->getRequest()->getPost();
		$redirectBack = $this->getRequest()->getParam('back', false);

		if($data){ 

			if( $this->getRequest()->getParam('loan_id') ){ //update loan object
				$this->_initLoan();
				$loan = Mage::registry('current_loan');

				$loan->addData( $data );

				try{
					
					$loan->save();

				}catch (Exception $e){
		                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		        }

	    	}else{ //create new loan
	    		$loan = Mage::getModel('loan/loan');
	    		$loan->setData( $data );

	    		try{
					
					$loan->save();

				}catch (Exception $e){
		                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		        }

	    	}
	    }

	    if( $redirectBack ){
	    	return $this->_redirect('*/loan/edit',array(
	    		'loan_id' => $loan->getLoanId()
	    	));


	    }

        $this->_redirect( '*/loan/manage' );

	}

	public function approveAction(){

		$this->_initLoan();
		$loan = Mage::registry('current_loan');

		$loan->setData('status',1);

		try{		
			$loan->save();
		}catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

		$this->_redirect( '*/loan/manage' );
	}

	public function declineAction(){

		$this->_initLoan();
		$loan = Mage::registry('current_loan');

		$loan->setData('status',0);

		try{		
			$loan->save();
		}catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

		$this->_redirect( '*/loan/manage' );
	}


}