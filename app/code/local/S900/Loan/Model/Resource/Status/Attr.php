<?php

class S900_Loan_Model_Resource_Status_Attr extends Mage_Core_Model_Resource_Db_Abstract{
	
	public function _construct(){
		$this->_init('loan/status_attr','status_code');
	}
}