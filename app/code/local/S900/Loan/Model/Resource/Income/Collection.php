<?php

class S900_Loan_Model_Resource_Income_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{
	
	public function _construct(){
		$this->_init('loan/income');
	}
}