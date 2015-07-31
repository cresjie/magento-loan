<?php

class S900_Loan_ApplyController extends Mage_Core_Controller_Front_Action{
	

	public function indexAction(){
		
		$this->loadLayout();

		$this->renderLayout();
	
	}

	


	public function submitAction(){

		$data = $this->getRequest()->getPost();

		if($data){

			$loan = Mage::getModel('loan/loan');
    		$loan->setData( $data );

    		try{
				
				$loan->save();

			}catch (Exception $e){
	                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
	        }
		}

		$this->getResponse()->setRedirect( Mage::getBaseUrl() );
	}

	
}