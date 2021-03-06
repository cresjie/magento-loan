<?php

class S900_Loan_Model_Account extends Mage_Core_Model_Abstract{
	
	public function _construct(){
		$this->_init('loan/account');
		
	}

	protected function _afterLoad(){
		
		if( $this->birthday )
			$this->setData('birthday', new S900_Loan_Helper_Datetime( $this->birthday ));
		
		return parent::_afterLoad();
	}


	public function validate(){
		$errors = array();

		if (!Zend_Validate::is( trim($this->getTitle()) , 'NotEmpty')) {
            $errors[] = Mage::helper('loan')->__('The title cannot be empty.');
        }

		if (!Zend_Validate::is( trim($this->getFirstName()) , 'NotEmpty')) {
            $errors[] = Mage::helper('loan')->__('The first name cannot be empty.');
        }

        if (!Zend_Validate::is( trim($this->getLastName()) , 'NotEmpty')) {
            $errors[] = Mage::helper('loan')->__('The last name cannot be empty.');
        }

        if (!Zend_Validate::is($this->getEmail(), 'EmailAddress')) {
            $errors[] = Mage::helper('loan')->__('Invalid email address "%s".', $this->getEmail());
        }
        
        if( Mage::getModel($this->_resourceName)->load( $this->email, 'email')->getData() ){
            $errors[] = Mage::helper('loan')->__('EmailAddress already exist');
        }

        if (!Zend_Validate::is( $this->getBirthday() , 'Date',array('format' => 'dd/mm/YYYY'))) {
            $errors[] = Mage::helper('loan')->__('The mobile phone cannot be empty.');
        }

        if (!Zend_Validate::is( trim($this->getMobilePhone()) , 'Digits')) {
            $errors[] = Mage::helper('loan')->__('The mobile phone cannot be empty.');
        }

        if (!Zend_Validate::is( trim($this->getAddress()) , 'NotEmpty')) {
            $errors[] = Mage::helper('loan')->__('The Address cannot be empty.');
        }

        if (!Zend_Validate::is( trim($this->getAddressInfo()) , 'NotEmpty')) {
            $errors[] = Mage::helper('loan')->__('The Address Info cannot be empty.');
        }

        

		if (empty($errors)) {
            return true;
        }
        return $errors;
	}
}