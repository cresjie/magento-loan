<?php

class S900_Loan_Block_Adminhtml_Loan_Account_Edit extends Mage_Adminhtml_Block_Template{

	private $account;

	public function _construct(){
		$this->account = Mage::registry('current_account');
	}

	public function getAccount(){
		if( empty($this->account ))
			return Mage::getModel('loan/account');

		return $this->account;
	}

	public function getBackUrl(){
		return $this->getUrl('*/loan_account');
	}
}