<?php


class S900_Loan_Model_Loan extends Mage_Core_Model_Abstract{
	
	public function _construct(){
		$this->_init('loan/loan');
		
	}

	protected function _beforeSave(){
		parent::_beforeSave();
		
		$now = Varien_Date::now();
		
		if( $this->_isObjectNew )
			$this->setData('apply_at', $now);
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

		if( ! Zend_Validate::is($this->getAccountId(),'NotEmpty')  ){
			$errors[] = 'Account id should be a valid numeric value';
		}
		if( ! Zend_Validate::is($this->getAmount(),'Float')  ){
			$errors[] = 'Amount should be a valid numeric value';
		}

		if( ! Zend_Validate::is($this->getDuration(),'NotEmpty')  ){
			$errors[] = 'Duration is required';
		}

		if( !Zend_Validate::is($this->getInterest(), 'Float')  ){
			$errors[] = 'Interest should be a valid numeric value';
		}

		if( ! Zend_Validate::is($this->getReasonCatId(), 'NotEmpty')   ){
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