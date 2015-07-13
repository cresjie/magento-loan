<?php


class S900_Loan_Model_Loan extends Mage_Core_Model_Abstract{
	
	public function _construct(){
		$this->_init('loan/loan');
		
	}

	protected function _beforeSave(){
		parent::_beforeSave();
		
		$now = Varien_Date::now();
		
		if( $this->_isObjectNew )
			$this->setData('created_at', $now);
		else
			$this->setData('updated_at', $now);
		
		return $this;
	}

	/**
	* returns true if data is valid, else
	* returns array of errors
	*/
	public function validate(){

		$errors = array();
		$helper = Mage::helper('loan');

		if( !( Zend_Validate::is($this->getEmail(),'NotEmpty') && Zend_Validate::is($this->getEmail(),'EmailAddress') ) ){
			$errors[] = 'Email should be a valid email address';
		}

		if( ! Zend_Validate::is($this->getFirstName(),'NotEmpty')  ){
			$errors[] = 'First Name is required';
		}

		if( !Zend_Validate::is($this->getLastName(), 'NotEmpty')  ){
			$errors[] = 'Last Name is required';
		}

		if( !( Zend_Validate::is($this->getLoanValue(), 'NotEmpty') && Zend_Validate::is($this->getLoanValue(),'Float') )  ){
			$errors[] = 'Loan Value should be a valid number';
		}

		if( !Zend_Validate::is($this->getStatus(),'NotEmpty')  ){
			$errors[] = 'Status should not be empty';
		}

		if( empty($errors) )
			return true;

		return $errors;
	}
}