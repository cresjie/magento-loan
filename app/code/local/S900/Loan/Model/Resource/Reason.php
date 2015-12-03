<?php

class S900_Loan_Model_Resource_Reason extends Mage_Core_Model_Resource_Db_Abstract{
	
	public function _construct(){
		$this->_init('loan/reason','cat_id');
	}
}