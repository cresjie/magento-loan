<?php

class S900_Loan_Adminhtml_Loan_ConfigController extends Mage_Adminhtml_Controller_Action{
	public function indexAction(){
		$this->_title( 'Loan Configuration' );

		$this->loadLayout();

		$this->renderLayout();
	}

	public function saveAction(){

		$config = new Mage_Core_Model_Config;
		$request = $this->getRequest();
		
		if( json_decode( $request->getParam('amount_options'), true) )
			$config->saveConfig('s900/loan/amount_options', $request->getParam('amount_options'));
		if( json_decode( $request->getParam('duration_options'), true) )
			$config->saveConfig('s900/loan/duration_options', $request->getParam('duration_options') );

		if( $request->getParam('ajax') ){
			$this->getResponse()->setHeader('Content-type','application/json');
			return $this->getResponse()->setBody( json_encode( array('redirect' => $this->getUrl('*/loan/manage') ) ) );
			
		}
		
		$this->_redirect('*/loan/manage');
			
		
	}

	public function getAction(){
		$config = array(
			'amount_options' => json_decode(Mage::getStoreConfig('s900/loan/amount_options'),true),
			'duration_options' => json_decode(Mage::getStoreConfig('s900/loan/duration_options'),true)
		);

		$this->getResponse()->setHeader('Content-type','application/json');
		$this->getResponse()->setBody( json_encode( $config ) );
	}
	
}